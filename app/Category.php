<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    
    public $timestamps = FALSE;
    
    public function schoolClass()
    {
        return $this->hasMany(SchoolClass::class);
    }
    
}
