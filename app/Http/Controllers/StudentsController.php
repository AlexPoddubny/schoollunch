<?php
    
    namespace App\Http\Controllers;
    
    use App\BreakTime;
    use App\Repositories\SchoolClassesRepository;
    use App\Repositories\StudentsRepository;
    use App\Student;
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
        protected $id;
    
        protected $related = [
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
            $schoolClass = $this->user->schoolClass;
            if(!$schoolClass){
                abort(403); //в дальнейшем переделать на Gate::denies
            }
//            $students = $this->students->getWithRelated($classId, $this->related, 'class_id');
            $students = $this->students->getWhere($schoolClass->id, 'class_id');
            dump($students);
            $this->content = view('students_index')
                ->with(['students' => $students])
                ->render();
            return $this->renderOutput();
        }
    
        public function add(Request $request)
        {
            $data = $request->except('_token');
            $student = new Student();
            $student->fill($data);
            $this->user->schoolClass->student()->save($student);
            return redirect(route('students.index'));
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
