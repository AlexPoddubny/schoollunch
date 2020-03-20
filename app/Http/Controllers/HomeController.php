<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
//    public $vars = [];

    public $content = 'Головна сторінка';
    
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->vars = Arr::add($this->vars, 'title', config('app.name', 'Laravel'));
        return $this->renderOutput();
    }
}
