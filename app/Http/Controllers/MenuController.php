<?php

namespace App\Http\Controllers;

use App\Category;
use App\Lunch;
use App\Menu;
use App\Repositories\CategoriesRepository;
use App\Repositories\MenuRepository;
use App\Repositories\SchoolsRepository;
use App\School;
use App\Size;
use Illuminate\Http\Request;
use Gate;
use Arr;

class MenuController extends Controller
{

    protected $menu_rep;
    protected $rule = [
        'date' => 'required|after_or_equal:today',
        'break_id' => 'required',
        'category_id' => 'required',
        'lunch_id' => 'required',
    ];
    
    public function __construct(MenuRepository $menu_rep)
    {
        parent::__construct();
        $this->menu_rep = $menu_rep;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @param null $id
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function index()
    {
        if ($this->user->isCook) {
//            $school = $this->user->cook;
            return redirect(route('menu.show', [
                'menu' => $this->user->cook->id
            ]));
        } else {
            $schools = School::all();
            $this->content = view('selector')
                ->with([
                    'schools' => $schools,
                    'route' => 'menu.select'
                ])
                ->render();
            return $this->renderOutput();
        }
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function create($id)
    {
        $school = School::find($id);
        if (Gate::denies('Menu_Create', $school)){
            abort(403);
        }
        $this->title = 'Додати пункт до меню школи: ' . $school->name;
        $this->content = view('menu_add')
            ->with([
                'school' => $school,
                'breaks' => $school->breakTime,
                'categories' => Category::all()
            ])
            ->render();
        return $this->renderOutput();
    }
    
    public function select(Request $request)
    {
        return redirect(route('menu.show', [
            'menu' => $request->input('school')
        ]));
    }
    
    public function getLunches(Request $request)
    {
        $lunches = Lunch::with('sizeCourse')
            ->where('category_id', $request->input('category'))
            ->where('privileged', $request->boolean('privileged'))
            ->get()
            ->keyBy('id');
        $lunchesList = [];
        foreach ($lunches as $n => $lunch){
            $lunchesList[$n] = view('lunch')
                ->with([
                    'lunch' => $lunch,
                    'sizes' => Size::all()->keyBy('id')
                ])
                ->render();
        }
        return response()->json([
            'list' => view('lunches_list')
                ->with([
                    'lunches' => $lunches
                ])
                ->render(),
            'lunches' => $lunchesList, //масив готових view на кожен обід з назвами страв та розміром
        ]);
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
        if (Gate::denies('Menu_Create', School::find($request->input('school_id')))){
            abort(403);
        }
        $this->validate($request, $this->rule);
        $result = $this->menu_rep->saveMenu($request);
        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        return redirect(route('menu.show', [
            'menu' => $request->input('school_id')
        ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $school = School::findOrFail($id);
        $this->title = $school->name . ': Меню їдальні';
        $menu = Menu::with('lunch.sizeCourse.type', 'lunch.category', 'breakTime')
            ->where('school_id', $school->id)
            ->whereBetween('date', [date('Y-m-d', strtotime("last monday")), date('Y-m-d', strtotime("saturday next week"))])
            ->get()
            ->sortBy('breakTime.break_num')
            ->groupBy('date')
            ->sortKeys();
        // day to copy menu
        $days = $menu->keys()->all();
        $nextDay = date_format(date_modify(date_create(end($days)), '1 day'), 'Y-m-d');
        if (date('w', strtotime($nextDay)) == 0){
            $nextDay = date('Y-m-d', strtotime('monday'));
        }
        $this->content = view('menu')
            ->with([
                'menus' => $menu,
                'sizes' => Size::all()->keyBy('id'),
                'school' => $school,
                'nextDay' => $nextDay
            ])
            ->render();
        return $this->renderOutput();
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
        $menu = Menu::findOrFail($id);
        $school = School::findOrFail($menu->school_id);
        if (Gate::denies('Menu_Create', $school)){
            abort(403);
        }
        $this->title = 'Редагування шкільного меню: ' . $school->name;
        $lunch = Lunch::with('sizeCourse')
            ->where('id', $menu->lunch_id)
            ->get()
            ->first();
        $lunches = Lunch::where('category_id', $lunch->category_id)
            ->get();
        $this->content = view('menu_edit')
            ->with([
                'menu' => $menu,
                'breaks' => $school->breakTime,
                'categories' => Category::all(),
                'lunches' => $lunches
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
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $menu = Menu::find($id);
        $school = School::findOrFail($menu->school_id);
        if (Gate::denies('Menu_Create', $school)){
            abort(403);
        }
        $this->validate($request, $this->rule);
        $result = $menu->update($request->all());
        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        return redirect(route('menu.show', [
            'menu' => $menu->school_id
        ]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        if (Gate::denies('Menu_Create', School::findOrFail($menu->school_id))){
            abort(403);
        }
        $result = $menu->delete();
        if(is_array($result) && !empty($result['error'])) {
            return response()->json(['error' => 'Неможливо видалити позицію меню'], 500);
        }
        return response()->json(['message' => 'Позицію меню видалено'], 200);
    }
    
    public function replicate(Request $request)
    {
        if (Gate::denies('Menu_Create', School::find($request->input('school_id')))){
            abort(403);
        }
        $this->validate($request, [
            'todate' => 'required'
        ]);
        $menus = Menu::where('school_id', $request->input('school_id'))
            ->where('date', $request->input('fromdate'))
            ->get();
        foreach ($menus as $menu){
            $menu->replicate()->fill([
                'date' => $request->input('todate')
            ])->save();
        }
        return redirect(route('menu.show', [
            'menu' => $request->input('school_id')
        ]));
    }
    
}
