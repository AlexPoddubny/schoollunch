<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\CategoriesRepository;
use App\Repositories\CoursesRepository;
use App\Repositories\LunchesRepository;
use App\Repositories\SizesRepository;
use App\Repositories\TypesRepository;
use Illuminate\Http\Request;
use Arr;
use Gate;

class LunchesController extends AdminController
{
    
    protected $courses_rep;
    protected $types_rep;
    protected $sizes_rep;
    protected $lunches_rep;
    protected $categories_rep;
    
    public function __construct(
        CoursesRepository $courses_rep,
        TypesRepository $types_rep,
        SizesRepository $sizes_rep,
        LunchesRepository $lunches_rep,
        CategoriesRepository $categories_rep
    )
    {
        parent::__construct();
        $this->courses_rep = $courses_rep;
        $this->types_rep = $types_rep;
        $this->sizes_rep = $sizes_rep;
        $this->lunches_rep = $lunches_rep;
        $this->categories_rep = $categories_rep;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('Course_Create')){
            abort(403);
        }
        $this->title .= 'Комплексні обіди';
        $lunches = $this->lunches_rep->getAllWithRelated(['sizeCourse.type', 'category'])->get();
        $sizes = $this->sizes_rep->getAll()->keyBy('id');
        $this->content = view('admin.lunches')
            ->with([
                'lunches' => $lunches,
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
        if (Gate::denies('Course_Create')){
            abort(403);
        }
        session(['courses' => []]);
        $this->content = view('admin.lunch_create')
            ->with([
                'categories' => $this->categories_rep->getAll(),
                'types' => $this->types_rep->getAll()->sortBy('sort'),
                'sizes' => $this->sizes_rep->getAll()->sortBy('size'),
                'number' => $this->lunches_rep->getLastNum() + 1 ?? 1
            ])
            ->render();
        return $this->renderOutput();
    }
    
    public function getCourses(Request $request)
    {
        return $this->content = view('admin.courses_select')
            ->with([
                'courses' => $this->courses_rep->getWhere($request->input('type'), 'type_id')
            ])
            ->render();
    }
    
    public function addCourse(Request $request)
    {
        if (Gate::denies('Course_Create')){
            abort(403);
        }
        $id = $request->input('id');
        $courses = session('courses');
        if (!in_array($id, $courses)){
            $courses[$id] = [
                'course_id' => $id,
                'type_id' => $request->input('type_id'),
                'size_id' => $request->input('size_id'),
                'type' => $request->input('type'),
                'size' => $request->input('size'),
                'name' => $request->input('name')
            ];
            session(['courses' => $courses]);
        }
        return $this->renderCourses();
    }
    
    public function renderCourses()
    {
        return $this->content = view('admin.courses_list')
            ->with([
                'items' => session('courses')
            ])
            ->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::denies('Course_Create')){
            abort(403);
        }
        $this->validate($request, [
            'number' => ['required'],
            'category_id' => ['required']
        ]);
        $result = $this->lunches_rep->saveLunch($request);
        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        return redirect(route('lunches.index'))->with($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
