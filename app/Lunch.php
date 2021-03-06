<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lunch extends Model
{
    
    protected $fillable = [
        'number',
        'category_id',
        'privileged'
    ];
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function join(Course $course, Size $size)
    {
        $this->sizeCourse()->attach($course, ['size_id' => $size->id]);
    }
    
    public function sizeCourse()
    {
        return $this->belongsToMany(Course::class, 'courses_lunches')
            ->withPivot('size_id');
    }
    
    public function menu()
    {
//        return $this->belongsTo(Menu::class);
        return $this->hasMany(Menu::class);
    }
    
}
