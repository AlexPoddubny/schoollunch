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
     */
    public function index()
    {
        $this->title .= $this->content;
        $schools = $this->school_rep->get();
        $this->content = view('admin.schools')
            ->with(['schools' => $schools])
            ->render();
        return $this->renderOutput();
    }
    
    public function import()
    {
        foreach (ImportSchools::import() as $item){
            $school = new School();
            $school->name = $item;
            $school->save();
        }
    }
    
    public function generate(Request $request)
    {
    
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
