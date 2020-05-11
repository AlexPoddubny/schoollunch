<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    
    protected $fillable = [
        'rc',
        'name',
        'type_id',
        'albumens',
        'fats',
        'carbonhydrates',
        'calories',
        'recipe',
        'description',
        'photo',
        'costs',
    ];
    
    public function product()
    {
        return $this->belongsToMany(Product::class, 'courses_products')
            ->withPivot(['brutto', 'netto']);
    }
    
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
    
    public function lunch()
    {
        return $this->belongsToMany(Lunch::class, 'courses_lunches')
            ->withPivot('size_id');
    }
    
}
