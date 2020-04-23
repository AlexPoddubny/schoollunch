<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gate;

class IndexController extends AdminController
{
    
    public function index()
    {
        if (Gate::denies(['View_Admin_Menu'])){
            return redirect(route('home.index'));
        }
        $this->content = view('admin.index')->render();
        return $this->renderOutput();
    }
    
}
