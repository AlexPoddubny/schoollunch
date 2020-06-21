<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\SchoolsRepository;
use App\Repositories\UsersRepository;
use App\Rules\NumRule;
use App\School;
use App\User;
use Illuminate\Http\Request;
use ImportSchools;
use Gate;

class SchoolsController extends AdminController
{
    
    protected $school_rep;
    
    public function __construct(SchoolsRepository $school_rep)
    {
        parent::__construct();
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
        if (Gate::denies('School_Register')){
            abort(403);
        }
        $this->title .= 'Підключення шкіл';
        $schools = $this->school_rep->getAllWithRelated(['admin', 'cook'])->get();
        $this->content = view('admin.schools')
            ->with([
                'schools' => $schools
            ])
            ->render();
        return $this->renderOutput();
    }
    
    public function import()
    {
        if (Gate::denies('School_Register')){
            abort(403);
        }
        foreach (ImportSchools::import() as $item){
            School::create(['name' => $item]);
        }
        return redirect(route('schools.index'));
    }
    
    public function generate(Request $request)
    {
        if (Gate::denies('School_Register')){
            abort(403);
        }
        $this->validate($request, [
            'firstnum' => ['required', 'integer', 'min:1'],
            'lastnum' => ['required', 'integer', new NumRule($request->get('firstnum'))],
            'schoolsname' => ['required', 'string', 'min:5', 'max:100']
        ]);
        $data = $request->except('_token');
        for ($i = $data['firstnum']; $i <= $data['lastnum']; $i++){
            School::create(['name' => $data['schoolsname'] . ' ' . $i]);
        }
        return redirect(route('schools.index'));
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
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        if (Gate::denies('School_Register')){
            abort(403);
        }
        $this->validate($request, [
            'schoolname' => ['required', 'string', 'max:100']
        ]);
        $schoolname = $request->input('schoolname');
        School::create(['name' => $schoolname]);
        return redirect(route('adminIndex'));
    }
    
    public function delete($id, $type)
    {
        if (Gate::denies('School_' . ucfirst($type) . '_Assign')){
            abort(403);
        }
        $result = $this->school_rep->removeCookAdmin($id, $type);
        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        return redirect(route('adminIndex'))->with($result);
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
        $school = School::find($id);
        $this->title .= $school->name;
        $this->content = view('admin.school_view')
            ->with(['school' => $school])
            ->render();
        return $this->renderOutput();
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @param $type
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function edit($id, $type)
    {
        if (Gate::denies('School_' . ucfirst($type) . '_Assign')){
            abort(403);
        }
        $school = School::with($type)->where('id', $id)->first();
        $this->title .= $school->name;
        if ($school->$type == null){
            $this->title .= ' - Не призначено';
        }
        $user = $school->$type;
//        dump($user);
        $this->content = view('admin.school_edit')
            ->with([
                'school' => $school,
                'user' => $user,
                'type' => $type
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
        if (Gate::denies('School_Register')){
            abort(403);
        }
//        dd($request);
        $this->validate($request, [
            'name' => ['required', 'string', 'max:100'],
            'type' => ['required'],
            'user_id' => ['required']
        ]);
        $result = $this->school_rep->saveSchool($request, $id);
        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        return redirect(route('adminIndex'))->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::denies('School_Register')){
            abort(403);
        }
        School::destroy($id);
        return redirect(route('schools.index'));
    }
}
