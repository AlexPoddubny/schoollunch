<?php
    
    namespace App\Http\Controllers\Admin;
    
    use App\Repositories\BreakTimesRepository;
    use App\Repositories\CategoriesRepository;
    use App\Repositories\SchoolClassesRepository;
    use App\Repositories\SchoolsRepository;
    use App\Repositories\UsersRepository;
    use Illuminate\Http\Request;
    use Gate;
    
    class SchoolClassesController
        extends AdminController
    {
        
        protected $class_rep;
        protected $cat_rep;
        
        protected $related = [
            'school.breakTime',
            'teacher',
            'category',
//        'student'
        ];
        
        public function __construct(
            SchoolClassesRepository $class_rep,
            CategoriesRepository $cat_rep
        )
        {
            parent::__construct();
            $this->class_rep = $class_rep;
            $this->cat_rep = $cat_rep;
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
            if (Gate::denies('Class_Edit')) {
                abort(403);
            }
            $result = $this->class_rep->saveClass($request);
            if (is_array($result) && !empty($result['error'])) {
                return back()->with($result);
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
            if (Gate::denies('Class_Edit')) {
                abort(403);
            }
            $schoolClass = $this->class_rep->getWithRelated($id, $this->related)->first();
            $this->title .= $schoolClass->school->name . ': ' . $schoolClass->name;
            $this->content = view('admin.schoolClass_edit')
                ->with([
                    'schoolClass' => $schoolClass,
                    'students' => $schoolClass->student()->get(),
                    'categories' => $this->cat_rep->getAll()
                ])
                ->render();
            return $this->renderOutput();
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
