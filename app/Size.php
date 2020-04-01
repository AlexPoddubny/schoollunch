<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    
    public $timestamps = false;
    
    protected $fillable = [
        'size',
        'factor'
    ];
    
}
