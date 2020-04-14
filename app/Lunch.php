<?php

namespace App;

use App\Relations\SizeCourseRelation;
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
    
    
    
    /*public function join(Course $course, Size $size)
    {
        $this->sizeCourse()->attach($course, ['size_id' => $size->id]);
    }*/
    
    /*public function sizeCourse()
    {
        return $this->belongsToMany(Course::class, 'courses_lunches')
            ->withPivot('size_id');
    }*/
    
    /*public function sizeCourse()
    {
        return new SizeCourseRelation(
            (new Course())->newQuery(),
            $this,
            'courses_lunches',
            'lunch_id', 'id',
            'course_id', 'id'
        );
    }*/
    
    public function courses()
    {
        return $this->belongsToMany(Course::class)->using(CourseSize::class);
    }
    
}
