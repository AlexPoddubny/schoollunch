<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends AdminController
{
    
    protected $content = 'Індексна сторінка';
    
    public function __construct()
    {
        parent::__construct();
        $this->template = 'admin.index';
    }
    
    public function index()
    {
        $this->title .= 'Головна сторінка';
        return $this->renderOutput();
    }
    
}