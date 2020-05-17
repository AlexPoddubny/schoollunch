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

class MenuController extends Controller
{

//    public $schoolClasses;
    protected $school_rep;
    protected $categories_rep;
    protected $menu_rep;
    
    public function __construct(
        SchoolsRepository $school_rep,
        CategoriesRepository $categories_rep,
        MenuRepository $menu_rep
    )
    {
        parent::__construct();
        $this->school_rep = $school_rep;
        $this->categories_rep = $categories_rep;
        $this->menu_rep = $menu_rep;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @param null $school_id
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function index($id = null)
    {
        if ($id){
            $school = School::find($id);
        } else {
            $school = $this->user->cook;
        }
        $this->title = $school->name . ': Меню столової';
        $menu = Menu::with('lunch.sizeCourse.type', 'lunch.category', 'breakTime')
            ->where('school_id', $school->id)
            ->whereBetween('date', [date('Y-m-d'), date('Y-m-d', strtotime("next friday"))])
            ->get()
            ->sortBy('breakTime.break_num')
            ->groupBy('date')
            ->sortKeys();
        dump($menu);
//        dd($menu);
        $this->content = view('menu')
            ->with([
                'menus' => $menu,
                'sizes' => Size::all()->keyBy('id')
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
        if (Gate::denies('Menu_Create')){
            abort(403);
        }
        // додати можливість створення пункту меню Адміністратором
        $school = $this->user->cook;
//        dd($school);
        $this->title = 'Додати пункт до меню';
        $this->content = view('menu_add')
            ->with([
                'school' => $school,
                'breaks' => $school->breakTime,
                'categories' => Category::all()
            ])
            ->render();
        return $this->renderOutput();
    }
    
    public function getLunches(Request $request)
    {
        return $this->content = view('lunches_list')
            ->with([
                'lunches' => Lunch::with('sizeCourse')
                    ->where('category_id', $request->input('category'))
                    ->where('privileged', $request->boolean('privileged'))
                    ->get()
            ])
            ->render();
    }
    /*
    public function loadClasses(Request $request)
    {
        return $this->content = view('classes_list')
            ->with([
                'classes' => SchoolClass::where('school_id', $this->user->cook->id)
                    ->where('break_id', $request->input('break_id'))
                    ->where('category_id', $request->input('category'))
                    ->get()
            ])
            ->render();
    }*/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::denies('Menu_Create')){
            abort(403);
        }
        $result = $this->menu_rep->saveMenu($request);
        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        return redirect(route('menu.index'));
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
