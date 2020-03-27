<?php
    
    namespace App\Http\Controllers;
    
    use App\Repositories\SchoolClassesRepository;
    use App\Repositories\SchoolsRepository;
    use App\Repositories\UsersRepository;
    use Illuminate\Http\Request;
    use Auth;
    
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
         * @return void
         */
        public function __construct(
            SchoolsRepository $school_rep,
            SchoolClassesRepository $classes_rep,
            UsersRepository $user_rep
        )
        {
            $this->middleware('auth');
            $this->school_rep = $school_rep;
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
            $user = Auth::user();
            $children = $user->child()->with('schoolClass.school')->withPivot('confirmed_at')->get();
            dump($children);
            $schools = $this->school_rep->getNotNull('admin_id');
            $this->content = view('children')
                ->with(['schools' => $schools])
                ->with(['children' => $children])
                ->render();
            return $this->renderOutput();
        }
    
        public function getClasses(Request $request)
        {
            if ($request->ajax()){
                return $schoolClasses = $this->classes_rep
                    ->getWithRelated($request->only('id')['id'], 'student', 'school_id');
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
            $result = $this->user_rep->saveChild($request, Auth::user());
            if(is_array($result) && !empty($result['error'])) {
                return redirect('home')->with($result);
            }
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
    }
