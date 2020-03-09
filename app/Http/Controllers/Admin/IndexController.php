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
        return redirect(route('schools.index'));
    }
    
}
