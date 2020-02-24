<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    
    protected $user;
    
    public function index()
    {
        $this->user = Auth::user();
        if (!$this->user){
            abort(403);
        };
    }
    
}
