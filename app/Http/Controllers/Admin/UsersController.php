<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;

class UsersController extends AdminController
{
    
    protected $content = 'Редагування користувачів';
    
    public function __construct()
    {
        parent::__construct();
        $this->template = 'admin.index';
    }
    
    public function index()
    {
        $this->title .= 'Користувачі';
        return $this->renderOutput();
    }
}
