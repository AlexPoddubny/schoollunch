<?php

namespace App\Http\Controllers;

use App\Category;
use App\Lunch;
use App\Repositories\CategoriesRepository;
use App\Repositories\MenuRepository;
use App\Repositories\SchoolsRepository;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    
    public $schoolClasses;
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $school = $this->user->cook;
        $this->title = $school->name . ' Меню столової';
        $this->content = view('menu')->render();
        return $this->renderOutput();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $school = $this->user->cook;
        $breaks = $school->breakTime;
        $categories = $this->categories_rep->getAll();
        $this->title = 'Додати пункт до меню';
        $this->content = view('menu_add')
            ->with([
                'school' => $school,
                'breaks' => $breaks,
                'categories' => $categories
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
