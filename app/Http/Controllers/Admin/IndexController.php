<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gate;

class IndexController extends AdminController
{
    
    protected $content = 'Адміністрування системи';
    
    public function __construct()
    {
        parent::__construct();
        if (Gate::denies('View_Admin')){
            abort(403);
        }
        $this->template = 'admin.index';
    }
    
    public function index()
    {
        $this->title .= $this->content;
        return $this->renderOutput();
    }
    
}
