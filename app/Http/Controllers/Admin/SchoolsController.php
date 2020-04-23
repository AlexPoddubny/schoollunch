<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\SchoolsRepository;
use App\Repositories\UsersRepository;
use App\School;
use Illuminate\Http\Request;
use ImportSchools;
use Gate;

class SchoolsController extends AdminController
{
    
    protected $user_rep;
    protected $school_rep;
    
    public function __construct(UsersRepository $user_rep, SchoolsRepository $school_rep)
    {
        parent::__construct();
        $this->user_rep = $user_rep;
        $this->school_rep = $school_rep;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function index()
    {
        if (Gate::denies('View_School_Admin')){
            abort(403);
        }
        $this->title .= 'Підключення шкіл';
//        $schools = School::all();
        $schools = $this->school_rep->getAllWithRelated(['admin', 'cook'])->get();
        $this->content = view('admin.schools')
            ->with(['schools' => $schools])
            ->render();
        return $this->renderOutput();
    }
    
    public function import()
    {
        foreach (ImportSchools::import() as $item){
            School::create(['name' => $item]);
        }
        return redirect(route('adminIndex'));
    }
    
    public function generate(Request $request)
    {
        $data = $request->except('_token');
        for ($i = $data['firstnum']; $i <= $data['lastnum']; $i++){
            School::create(['name' => $data['schoolname'] . ' ' . $i]);
        }
        return redirect(route('adminIndex'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = $this->school_rep->saveSchool($request);
        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        return back()->with($result);
    }
    
    public function add(Request $request)
    {
        $schoolname = $request->input('schoolname');
        School::create(['name' => $schoolname]);
        return redirect(route('adminIndex'));
    }
    
    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function show($id)
    {
        $school = $this->school_rep->getWhere($id)->first();
        $this->content = view('admin.school_view')
            ->with(['school' => $school])
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
    public function edit($id, $type)
    {
        $school = School::with($type)->where('id', $id)->first();
        $this->title .= $school->name;
        if ($school->$type == null){
            $this->title .= ' - Не призначено';
        }
        $this->content = view('admin.school_' . $type . '_edit')
            ->with(['school' => $school])
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
        School::destroy($id);
        return redirect(route('adminIndex'));
    }
}
