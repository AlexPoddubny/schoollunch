<?php

namespace App\Http\Controllers\Admin;

use Gate;

class IndexController extends AdminController
{
    
    public function index()
    {
        /*if (Gate::denies(['View_Admin_Menu'])){
            return redirect(route('home.index'));
        }*/
        if ($this->user->hasRole('Admin')){
            return redirect(route('schools.index'));
        }
        if ($this->user->hasRole('SchoolAdmin')){
            return redirect(route('school.index'));
        }
        if ($this->user->hasRole('Cook')){
            return redirect(route('courses.index'));
        }
    }
    
}
