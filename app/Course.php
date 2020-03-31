<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function product()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot(['brutto', 'netto']);
    }
    
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
    
    /*public function nutrientValue()
    {
        return $this->belongsTo(NutrientValue::class);
    }*/
    
}
