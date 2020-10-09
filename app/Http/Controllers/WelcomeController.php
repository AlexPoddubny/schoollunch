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
     * @throws \Throwable
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
        return redirect(route('menu.show', [
            'menu' => $request->input('school')
        ]));
    }
    
}
