<?php
    
    namespace App\Http\Controllers;
    
    use App\Repositories\SchoolClassesRepository;
    use App\Repositories\SchoolsRepository;
    use App\Repositories\UsersRepository;
    use App\School;
    use App\Size;
    use App\Student;
    use Illuminate\Http\Request;
    use Gate;
    use Auth;
    use Arr;
    
    class HomeController extends Controller
    {
        
        public $school_rep;
        public $classes_rep;
        public $user_rep;
        protected $title = 'Мої школяри';
        protected $user;
    
    
        /**
         * Create a new controller instance.
         *
         * @param SchoolClassesRepository $classes_rep
         * @param UsersRepository $user_rep
         */
        public function __construct(
            SchoolClassesRepository $classes_rep,
            UsersRepository $user_rep
        )
        {
            parent::__construct();
            $this->middleware(['auth', 'verified']);
            $this->classes_rep = $classes_rep;
            $this->user_rep = $user_rep;
        }
    
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         * @throws \Throwable
         */
        public function index()
        {
            $this->content = view('children')
                ->with([
                    'user' => $this->user,
                    'schools' => School::has('admin')->get()->sortBy('id'),
                    'children' => $this->user->child()
                        ->with([
                            'schoolClass.school',
                            'schoolClass.breakTime.menu' => function($query){
                                $query->where('date', date('Y-m-d'))
                                    ->with('lunch.sizeCourse');
                        }])
                        ->get()
                        ->sortBy('fullname'),
                    'sizes' => Size::all()->keyBy('id')
                ])
                ->render();
            return $this->renderOutput();
        }
    
        public function getClasses(Request $request)
        {
            if ($request->ajax()){
                return $schoolClasses = $this->classes_rep
                    ->getWithRelated($request->input('id'), 'student', 'school_id');
            }
            return null;
        }
        
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            //
        }
        
        /**
         * Store a newly created resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            $result = $this->user_rep->saveChild($request, $this->user);
            return redirect('home')->with($result);
        }
    
        public function remove($child)
        {
            $result = $this->user_rep->detachChild($child, $this->user);
            return redirect('home')->with($result);
        }
        
        /**
         * Display the specified resource.
         *
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            //
        }
        
        /**
         * Show the form for editing the specified resource.
         *
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            //
        }
        
        /**
         * Update the specified resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, $id)
        {
            //
        }
        
        /**
         * Remove the specified resource from storage.
         *
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            //
        }
    
        public function search(Request $request)
        {
            $searchTerm = $request->except('_token');
            $students = Student::where('fullname', 'like', '%' . $searchTerm['query'] . '%')
                ->where('class_id', $searchTerm['schoolClass'])
                ->get();
            return view('search.student')
                ->with([
                    'students' => $students,
                    'name' => $request->input('name')
                ])
                ->render();
        }
    }
