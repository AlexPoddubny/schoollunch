<?php
    
    namespace App\Http\Controllers;
    
    use App\Repositories\SchoolClassesRepository;
    use App\Repositories\StudentsRepository;
    use Illuminate\Http\Request;
    
    class StudentsController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        
        protected $students;
        protected $class_rep;
    
        protected $related = [
            'school',
            'student'
        ];
        
        public function __construct(StudentsRepository $students, SchoolClassesRepository $class_rep)
        {
            parent::__construct();
            $this->students = $students;
            $this->class_rep = $class_rep;
        }
    
        public function index()
        {
            $classId = $this->user->schoolClass;
            if(!$classId){
                abort(403); //в дальнейшем переделать на Gate::denies
            }
//            $students = $this->students->getWithRelated($classId, $this->related, 'class_id');
            $students = $this->students->getWhere($classId, 'class_id');
            dump($students);
            $this->content = view('students_index')
                ->with(['students' => $students])
                ->render();
            return $this->renderOutput();
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
            //
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
