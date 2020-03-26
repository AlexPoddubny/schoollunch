<?php
    
    namespace App\Http\Controllers;
    
    use App\Repositories\SchoolClassesRepository;
    use App\Repositories\SchoolsRepository;
    use App\Repositories\StudentsRepository;
    use Illuminate\Http\Request;
    use Illuminate\Support\Arr;
    
    class HomeController extends Controller
    {
        
        public $school_rep;
        public $classes_rep;
        public $stud_rep;
        
        
        /**
         * Create a new controller instance.
         *
         * @return void
         */
        public function __construct(
            SchoolsRepository $school_rep,
            SchoolClassesRepository $classes_rep,
            StudentsRepository $stud_rep
        )
        {
            $this->middleware('auth');
            $this->school_rep = $school_rep;
            $this->classes_rep = $classes_rep;
            $this->stud_rep = $stud_rep;
        }
    
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         * @throws \Throwable
         */
        public function index()
        {
            $this->vars = Arr::add($this->vars, 'title', '');
            $schools = $this->school_rep->getNotNull('admin_id');
            $this->content = view('children')
                ->with(['schools' => $schools])
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
            // сохраняем связь parent->student
            // добавляем роль parent
            
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
