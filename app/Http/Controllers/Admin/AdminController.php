<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if (!$this->user = Auth::user()){
            abort(403);
        }
    }
    
    public function renderOutput()
    {
        $this->vars = Arr::add($this->vars, 'title', $this->title);
        $menu = $this->getMenu();
    }
    
}
