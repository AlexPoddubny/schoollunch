<?php
    
    namespace App;
    
    use Illuminate\Database\Eloquent\Model;
    
    class SchoolClass extends Model
    {
    
        public $timestamps = FALSE;
        
        protected $fillable = [
            'name',
            'break_id',
            'category_id',
            'teacher_id'
        ];
    
        public function teacher()
        {
            return $this->belongsTo('App\User', 'teacher_id');
        }
    
        public function school()
        {
            return $this->belongsTo('App\School');
        }
    
        public function breakTime()
        {
            return $this->belongsTo('App\BreakTime', 'break_id');
        }
    
        public function category()
        {
            return $this->belongsTo('App\Category');
        }
        
    }
