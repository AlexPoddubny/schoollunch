<?php

namespace App\Http\Controllers;

use App\School;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($this->user){
            return redirect(route('home.index'));
        }
        $this->title = 'Ласкаво просимо!';
        $schools_list = view('selector')
            ->with([
                'schools' => School::has('menu')->get(),
                'route' => 'select'
            ])
            ->render();
        $this->content = view('welcome')
            ->with([
                'schools' => $schools_list,
            ])
            ->render();
        return $this->renderOutput();
    }
    
    public function select(Request $request)
    {
//        dd($request);
        return redirect(route('menu.show', [
            'menu' => $request->input('school')
        ]));
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
