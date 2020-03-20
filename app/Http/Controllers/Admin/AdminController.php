<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Lavary\Menu\Menu;
use Gate;


class AdminController extends Controller
{

//    protected $user;
    protected $title = 'Адміністрування: ';
//    protected $template = 'admin.index';

//    protected $vars = [];
    
    /*public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            if (!$this->user){
                abort(403);
            };
            return $next($request);
        });
    }*/
    
    /*public function renderOutput()
    {
        $this->vars = Arr::add($this->vars, 'title', $this->title);
        $menu = $this->getMenu();
        $navigation = view('navigation')->with('menu', $menu)->render();
        $this->vars = Arr::add($this->vars, 'navigation', $navigation);
        if($this->content){
            $this->vars = Arr::add($this->vars, 'content', $this->content);
        }
        return view($this->template)->with($this->vars);
    }
    */
    public function getMenu()
    {
        return \Menu::make('adminMenu', function ($menu){
            if(Gate::allows('View_Admin')) {
                $menu->add('Підключення шкіл', ['route' => 'schools.index', 'class' => 'nav-item'])->link->attr(['class' => 'nav-link active']);
                $menu->add('Користувачі', ['route' => 'users.index', 'class' => 'nav-item'])->link->attr(['class' => 'nav-link active']);
                $menu->add('Ролі та дозволи', ['route' => 'roles.index', 'class' => 'nav-item'])->link->attr(['class' => 'nav-link active']);
            }
            if(Gate::allows('View_School_Admin')) {
                $menu->add('Адмініструвати школи', ['route' => 'school.index', 'class' => 'nav-item'])->link->attr(['class' => 'nav-link active']);
            }
        });
    }
    
}
