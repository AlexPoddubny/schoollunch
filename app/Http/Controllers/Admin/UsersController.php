<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsersController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->template = 'admin.index';
    }
    
    public function index()
    {
        $this->title = 'Адмінка::Користувачі';
        return $this->renderOutput();
    }
}
