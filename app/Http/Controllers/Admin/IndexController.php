<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gate;

class IndexController extends AdminController
{
    
    protected $content = 'Адміністрування системи';
    
    public function __construct()
    {
        parent::__construct();
        $this->template = 'admin.index';
    }
    
    public function index()
    {
        if (Gate::denies('View_Admin')){
            abort(403);
        }
        $this->title .= $this->content;
        $schools = School::all();
        $this->content = view('admin.schools')
            ->with(['schools' => $schools])
            ->render();
        return $this->renderOutput();
    }
    
}
