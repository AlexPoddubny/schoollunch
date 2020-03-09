<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Arr;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    protected $user;
    protected $vars = [];
    protected $title;
    protected $content = FALSE;
    protected $template;
    
    public function renderOutput()
    {
        $this->vars = Arr::add($this->vars, 'title', $this->title);
        if($this->content){
            $this->vars = Arr::add($this->vars, 'content', $this->content);
        }
        return view($this->template)->with($this->vars);
    }
    
}
