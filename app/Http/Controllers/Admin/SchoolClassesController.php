<?php
    
    namespace App\Http\Controllers\Admin;
    
    use App\Category;
    use App\Repositories\BreakTimesRepository;
    use App\Repositories\CategoriesRepository;
    use App\Repositories\SchoolClassesRepository;
    use App\Repositories\SchoolsRepository;
    use App\Repositories\StudentsRepository;
    use App\Repositories\UsersRepository;
    use App\SchoolClass;
    use App\User;
    use Illuminate\Http\Request;
    use Gate;
    
    class SchoolClassesController
        extends AdminController
    {
        
        protected $class_rep;
        protected $students;
        
        protected $related = [
            'school.breakTime',
            'teacher',
            'category',
        ];
        
        public function __construct(
            SchoolClassesRepository $class_rep,
            StudentsRepository $students
        )
        {
            parent::__construct();
            $this->class_rep = $class_rep;
            $this->students = $students;
        }
        
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            //
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
         * @throws \Throwable
         */
        public function edit($id)
        {
            if (Gate::denies('Class_Edit')) {
                abort(403);
            }
            $schoolClass = $this->class_rep->getWithRelated($id, $this->related)->first();
            $this->title .= $schoolClass->school->name . ': ' . $schoolClass->name;
            $this->content = view('admin.schoolClass_edit')
                ->with([
                    'schoolClass' => $schoolClass,
                    'students' => $schoolClass->student()->get(),
                    'categories' => Category::all(),
                    'route' => 'addstudent'
                ])
                ->render();
            return $this->renderOutput();
        }
    
        public function addStudent(Request $request)
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
         * Update the specified resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @param int $id
         * @return \Illuminate\Http\Response
         * @throws \Illuminate\Validation\ValidationException
         */
        public function update(Request $request, $id)
        {
            if (Gate::denies('Class_Edit')) {
                abort(403);
            }
            $this->validate($request, [
                'name' => ['required', 'regex:/(^\d{1,2}[-][А-Я]$)/u'],
                'break_id' => ['required'],
                'category_id' => ['required']
            ]);
            $result = $this->class_rep->saveClass($request, $id);
            return back()->with($result);
        }
    
        public function removeTeacher($class)
        {
            if (Gate::denies('Class_Edit')) {
                abort(403);
            }
            $schoolClass = SchoolClass::findOrFail($class);
            $schoolClass->teacher->removeRole('ClassTeacher');
            $schoolClass->teacher_id = null;
            $schoolClass->save();
            return back();
        }
        
        /**
         * Remove the specified resource from storage.
         *
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            if (Gate::denies('Class_Edit')) {
                abort(403);
            }
            $schoolClass = SchoolClass::findOrFail($id);
            if (count($schoolClass->student) > 0){
                return response()->json(['error' => ['Неможливо видалити клас з учнями']]);
            }
            $schoolClass->delete();
            return response()->json(['message' => ['Клас видалено']]);
        }
    }
