<?php
    
    namespace App\Http\Controllers;
    
    use App\Repositories\SchoolClassesRepository;
    use App\Repositories\StudentsRepository;
    use App\Student;
    use Illuminate\Http\Request;
    use Gate;
    
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
        
        public function __construct(
            StudentsRepository $students,
            SchoolClassesRepository $class_rep
        )
        {
            parent::__construct();
            $this->students = $students;
            $this->class_rep = $class_rep;
        }
    
        public function index()
        {
            if(!($schoolClass = $this->user->schoolClass)){
                abort(403);
            }
            $this->title = 'Класне керівництво: ' . $schoolClass->name . ', ' . $schoolClass->school->name;
            $this->content = view('students_index')
                ->with([
                    'students' => $schoolClass->student()
                        ->with('parent')
                        ->get()
                        ->sortBy('fullname'),
                    'route' => 'students.store',
                    'schoolClass' => $schoolClass
                ])
                ->render();
            return $this->renderOutput();
        }
    
        public function confirm($student_id, $parent_id)
        {
            if (Gate::denies('Parent_Confirm')){
                abort(403);
            }
            $student = Student::find($student_id);
            $student->parent()->updateExistingPivot($parent_id, ['confirmed_at' => now()]);
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
         * @throws \Illuminate\Validation\ValidationException
         */
        public function store(Request $request)
        {
            if (isset($request['fullname'])){
                $this->validate($request, [
                    'fullname' => ['required', 'max:100']
                ]);
                $result = $this->students->add($request, $request->input('class'));
            } elseif (isset($request['list'])){
                $this->validate($request,[
                    'list' => ['required']
                ]);
                $result = $this->students->addMass($request, $request->input('class'));
            } else {
                return back();
            }
            return back()->with($result);
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
            if (Gate::denies('Fill_Class')){
                abort(403);
            }
            $student = Student::find($id);
            $student->parent()->detach();
            $result = $student->delete();
            return back()->with($result);
        }
    }
