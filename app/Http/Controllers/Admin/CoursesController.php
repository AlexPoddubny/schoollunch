<?php
    
    namespace App\Http\Controllers\Admin;
    
    use App\Course;
    use App\Http\Controllers\Controller;
    use App\Product;
    use App\Repositories\CoursesRepository;
    use App\Repositories\ProductsRepository;
    use App\Repositories\SizesRepository;
    use App\Repositories\TypesRepository;
    use App\Size;
    use App\Type;
    use Illuminate\Http\Request;
    use Gate;
    use Validator;
    
    class CoursesController
        extends AdminController
    {
        
        protected $courses_rep;
        
        public function __construct(CoursesRepository $courses_rep)
        {
            parent::__construct();
            $this->courses_rep = $courses_rep;
        }
    
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         * @throws \Throwable
         */
        public function index()
        {
            if (Gate::denies('Course_Create')){
                abort(403);
            }
            $courses = $this->courses_rep->getAllWithRelated('type')->orderBy('rc')->paginate(10);
            $links = $courses->appends(['sort' => 'rc'])->links();
            $this->title .= 'Страви та продукти';
            $this->content = view('admin.courses_index')
                ->with([
                    'courses' => $courses,
                    'products' => Product::all()->sortBy('name'),
                    'types' => Type::all()->sortBy('sort'),
                    'sizes' => Size::all()->sortBy('size'),
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
            if (Gate::denies('Course_Create')){
                abort(403);
            }
            $this->title .= 'Додавання страви';
            $products = Product::all()->sortBy('name');
            $types = Type::all();
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
            if (Gate::denies('Course_Create')){
                abort(403);
            }
//            dd($request);
            $this->validate($request, [
                'rc' => ['required', 'numeric', 'min:1'],
                'name' => ['required', 'max:100'],
                'type_id' => ['required'],
                'albumens' => ['required'],
                'fats' => ['required'],
                'carbonhydrates' => ['required'],
                'calories' => ['required'],
                'recipe' => ['required'],
                'description' => ['required'],
            ]);
            $result = $this->courses_rep->saveCourse($request);
            if(is_array($result) && !empty($result['error'])) {
                return back()->with($result);
            }
            return redirect(route('courses.index'))->with($result);
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
            if (Gate::denies('Course_Create')){
                abort(403);
            }
            $course = Course::findOrFail($id);
            $this->title = 'Редагування страви: ' . $course->rc . ': ' . $course->name;
            $products = [];
            foreach ($course->product as $product){
                $products[$product->id] = [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'brutto' => $product->pivot->brutto,
                    'netto' => $product->pivot->netto,
                ];
            }
            session(['products' => $products]);
            $this->content = view('admin.course_edit')
                ->with([
                    'course' => $course,
                    'ingredients' => $this->renderProducts(),
                    'types' => Type::all(),
                    'products' => Product::all()->sortBy('name')
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
            if (Gate::denies('Course_Create')){
                abort(403);
            }
            $result = $this->courses_rep->saveCourse($request, $id);
            if(is_array($result) && !empty($result['error'])) {
                return back()->with($result);
            }
            return redirect(route('courses.index'))->with($result);
        }
        
        /**
         * Remove the specified resource from storage.
         *
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            if (Gate::denies('Course_Create')){
                abort(403);
            }
            $course = Course::findOrFail($id);
            $course->lunch()->detach();
            $course->product()->detach();
            $result = $course->delete();
            if(is_array($result) && !empty($result['error'])) {
                return response(500);
            }
            return response(200);
        }
    
        public function addProduct(Request $request)
        {
            if (Gate::denies('Course_Create')){
                abort(403);
            }
            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'brutto' => 'required',
                'netto' => 'required|lte:brutto'
            ]);
            if ($validator->fails()){
                return response()->json(['error' => $validator->errors()->all()]);
            }
            $id = $request->input('id');
            $products = session('products');
            if (!isset($products[$id])){
                $products[$id] = [
                    'product_id' => $id,
                    'name' => $request->input('name'),
                    'brutto' => $request->input('brutto'),
                    'netto' => $request->input('netto'),
                ];
                session(['products' => $products]);
            }
            return $this->renderProducts();
        }
    
        public function delProduct(Request $request)
        {
            if (Gate::denies('Course_Create')){
                abort(403);
            }
            $this->courses_rep->deleteItem($request, Product::class);
            return $this->renderProducts();
        }
    
        protected function renderProducts()
        {
            return view('admin.products_list')
                ->with([
                    'items' => session('products')
                ])
                ->render();
        }
        
    }
