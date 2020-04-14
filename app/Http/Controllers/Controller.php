<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Gate;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    protected $user;
    protected $vars = [];
    protected $title = 'Домашня сторінка';
    protected $content = FALSE;
    protected $template = 'index';
    
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            if (!$this->user){
                abort(403);
            };
            return $next($request);
        });
    }
    
    public function renderOutput()
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
    
    public function getMenu()
    {
        $attr = ['class' => 'nav-link active'];
        return \Menu::make('mainMenu', function ($menu) use ($attr){
//            if(Gate::allows('View_Class')) {
                $menu->add('Мої школяри', ['route' => 'home.index', 'class' => 'nav-item'])->link->attr($attr);
//            }
            if(Gate::allows('View_Class')) {
                $menu->add('Класне керівництво', ['route' => 'students.index', 'class' => 'nav-item'])->link->attr($attr);
            }
//            if(Gate::allows('View_Cook')) {
//                $menu->add('Комплексні обіди', ['route' => 'lunches.index', 'class' => 'nav-item'])->link->attr($attr);
                $menu->add('Щоденне меню', ['route' => 'menus.index', 'class' => 'nav-item'])->link->attr($attr);
//            }
            if(Gate::allows(['View_Admin', 'View_School_Admin'])) {
                $menu->add('Адмініструвати', ['url' => 'admin', 'class' => 'nav-item'])->link->attr($attr);
            }
        });
    }
    
}
