<?php
    
    namespace App\Http\Controllers\Admin;
    
    use App\Course;
    use App\Http\Controllers\Controller;
    use App\Repositories\CoursesRepository;
    use App\Repositories\ProductsRepository;
    use App\Repositories\SizesRepository;
    use App\Repositories\TypesRepository;
    use Illuminate\Http\Request;
    
    class CoursesController
        extends AdminController
    {
        
        protected $courses_rep;
        protected $products_rep;
        protected $sizes_rep;
        protected $types_rep;
        
        public function __construct(
            CoursesRepository $courses_rep,
            ProductsRepository $products_rep,
            SizesRepository $sizes_rep,
            TypesRepository $types_rep
        )
        {
            $this->courses_rep = $courses_rep;
            $this->products_rep = $products_rep;
            $this->sizes_rep = $sizes_rep;
            $this->types_rep = $types_rep;
        }
        
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $courses = $this->courses_rep->getPaginated(10);
            $types = $this->types_rep->getAll();
            $sizes = $this->sizes_rep->getAll();
            $this->content = view('admin.courses_index')
                ->with([
                    'courses' => $courses,
                    'types' => $types,
                    'sizes' => $sizes
                ])
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
//            $course = new Course();
            $products = $this->products_rep->getPaginated(10);
            $sizes = $this->sizes_rep->getAll();
            $types = $this->types_rep->getAll();
            $this->content = view('admin.course_create')
                ->with([
                    'products' => $products,
//                    'course' => $course,
                    'sizes' => $sizes,
                    'types' => $types
                ])
                ->render();
            return $this->renderOutput();
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
