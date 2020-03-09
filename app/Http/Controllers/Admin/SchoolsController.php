<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\SchoolsRepository;
use App\School;
use Illuminate\Http\Request;
use ImportSchools;

class SchoolsController extends AdminController
{
    
    protected $content = 'Підключення шкіл';
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->title .= $this->content;
        $schools = School::all();
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
        //
    }
    
    public function add(Request $request)
    {
        $data = $request->only('schoolname');
        School::create(['name' => $data['schoolname']]);
        return redirect(route('adminIndex'));
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
        School::destroy($id);
        return redirect(route('adminIndex'));
    }
}
