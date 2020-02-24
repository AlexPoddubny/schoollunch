<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Lavary\Menu\Menu;

class AdminController extends Controller
{
    protected $u_rep;
    protected $user;
    protected $template;
    protected $content = FALSE;
    protected $title;
    protected $vars = [];
    
    public function __construct()
    {
        if (!($this->user = Auth::user())){
            abort(403);
        }
    }
    
    public function renderOutput()
    {
        $this->vars = Arr::add($this->vars, 'title', $this->title);
        $menu = $this->getMenu();
        $navigation =view('admin.navigation')->with('menu', $menu)->render();
        $this->vars = Arr::add($this->vars, 'navigation', $navigation);
        if($this->content){
            $this->vars = Arr::add($this->vars, 'content', $this->content);
        }
        return view($this->template)->with($this->vars);
    }
    
    public function getMenu()
    {
        return Menu::make('adminMenu', function ($menu){
            $menu->add('Користувачі', ['route' => 'admin.users.index']);
        });
    }
    
}
