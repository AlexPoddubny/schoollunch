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
         * @throws \Throwable
         */
        public function index()
        {
            $courses = $this->courses_rep->getAllWithRelated('type')->orderBy('rc')->paginate(10);
            $links = $courses->appends(['sort' => 'rc'])->links();
            $products = $this->products_rep->getAll()->sortBy('name');
            $types = $this->types_rep->getAll()->sortBy('sort');
            $sizes = $this->sizes_rep->getAll()->sortBy('size');
            $this->content = view('admin.courses_index')
                ->with([
                    'courses' => $courses,
                    'products' => $products,
                    'types' => $types,
                    'sizes' => $sizes,
                    'links' => $links
                ])
                ->render();
            return $this->renderOutput();
        }
    
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         * @throws \Throwable
         */
        public function create()
        {
            $this->title .= 'Додавання страви';
            $products = $this->products_rep->getAll()->sortBy('name');
            $types = $this->types_rep->getAll();
            session(['products' => []]);
            $this->content = view('admin.course_create')
                ->with([
                    'products' => $products,
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
            $result = $this->courses_rep->saveCourse($request);
            if(is_array($result) && !empty($result['error'])) {
                return back()->with($result);
            }
            return redirect(route('courses.index'));
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
    
        public function addProduct(Request $request)
        {
            $id = $request->input('id');
            $products = session('products');
            if (!in_array($id, $products)){
                $products[] = $request->input('id');
                session(['products' => $products]);
            }
            return $this->renderProducts();
        }
    
        public function delProduct(Request $request)
        {
            $id = $request->input('id');
            $products = session('products');
            if (in_array($id, $products)){
                unset($products[array_search($id, $products)]);
                session(['products' => $products]);
            }
            return $this->renderProducts();
        }
    
        protected function renderProducts()
        {
            return view('admin.products_list')
                ->with([
                    'items' => $this->products_rep->getArray(session('products'))
                ])
                ->render();
        }
        
    }
