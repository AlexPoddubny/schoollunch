<?php
    
    
    namespace App;
    
    
    use Illuminate\Database\Eloquent\Relations\Pivot;

    class CourseSize
        extends Pivot
    {
        public function size()
        {
            return $this->belongsToMany(Course::class);
        }
    
        public function course()
        {
            return $this->belongsToMany(Size::class);
        }
        
    }
