<?php
    
    
    namespace App\Relations;
    
    
    use App\Size;
    use Illuminate\Database\Eloquent\Relations\Pivot;

    class CourseWithSizePivot
        extends Pivot
    {
        
        public function size()
        {
            return $this->belongsTo(Size::class, 'size_id');
        }
    
    }
