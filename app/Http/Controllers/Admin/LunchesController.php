<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Course;
use App\Lunch;
use App\Repositories\LunchesRepository;
use App\Size;
use App\Type;
use Illuminate\Http\Request;
use Arr;
use Gate;
use Validator;

class LunchesController extends AdminController
{
    
    protected $lunches_rep;
    
    public function __construct(LunchesRepository $lunches_rep)
    {
        parent::__construct();
        $this->lunches_rep = $lunches_rep;
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
        $sizes = Size::all()->keyBy('id');
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
                'categories' => Category::all(),
                'types' => Type::all()->sortBy('sort'),
                'sizes' => Size::all()->sortBy('size'),
                'number' => $this->lunches_rep->getLastNum() + 1 ?? 1
            ])
            ->render();
        return $this->renderOutput();
    }
    
    public function getCourses(Request $request)
    {
        return $this->content = view('admin.courses_select')
            ->with([
                'courses' => Course::where('type_id', $request->input('type'))->get()
            ])
            ->render();
    }
    
    public function addCourse(Request $request)
    {
        if (Gate::denies('Course_Create')){
            abort(403);
        }
        $validator = Validator::make($request->all(), [
            'type_id' => 'required',
            'course_id' => 'required',
            'size_id' => 'required'
        ]);
        if ($validator->fails()){
            return response()->json(['error' => $validator->errors()->all()]);
        }
        $id = $request->input('course_id');
        $courses = session('courses');
        if (!isset($courses[$id])){
            $courses[$id] = $request->all();
            session(['courses' => $courses]);
        }
        return $this->lunches_rep->renderItems(Course::class);
    }
    
    public function delCourse(Request $request)
    {
        if (Gate::denies('Course_Create')){
            abort(403);
        }
        $this->lunches_rep->deleteItem($request, Course::class);
        return $this->lunches_rep->renderItems(Course::class);
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
        if (Gate::denies('Course_Create')){
            abort(403);
        }
        $lunch = Lunch::findOrFail($id);
        $this->title = 'Редагування обіду №' . $lunch->number;
        $sizes = Size::all()->keyBy('id');
        $types = Type::all()->keyBy('id');
//        dump($sizes, $types);
        $courses = [];
        foreach ($lunch->sizeCourse as $course){
            $courses[$course->id] = [
                'course_id' => $course->id,
                'type_id' => $course->type_id,
                'size_id' => $course->pivot->size_id,
                'type' => $types[$course->type_id]->name,
                'size' => $sizes[$course->pivot->size_id]->size,
                'name' => $course->name
            ];
        }
//        dd($courses);
        session(['courses' => $courses]);
        $this->content = view('admin.lunch_edit')
            ->with([
                'lunch' => $lunch,
                'types' => $types,
                'sizes' => $sizes,
                'ingredients' => $this->lunches_rep->renderItems(Course::class),
                'categories' => Category::all()
            ])
            ->render();
        return $this->renderOutput();
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
        if (Gate::denies('Course_Create')){
            abort(403);
        }
        $result = $this->lunches_rep->saveLunch($request, $id);
        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        return redirect(route('lunches.index'))->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::denies('Course_Create')){
            abort(403);
        }
        $lunch = Lunch::findOrFail($id);
        if (count($lunch->menu) > 0){
            return response(500);
        }
        $lunch->sizeCourse()->detach();
        $result = $lunch->delete();
        if(is_array($result) && !empty($result['error'])) {
            return response(500);
        }
        return response(200);
    }
    
    protected function detachAllMenus($lunch)
    {
        $lunch->menu()->update(['lunch_id' => null]);
    }
    
}
