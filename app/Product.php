<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    public $timestamps = false;
    
    public function course()
    {
        return $this->belongsToMany(Course::class)
            ->withPivot(['brutto', 'netto']);
    }
    
}
