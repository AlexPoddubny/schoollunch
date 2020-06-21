<?php
    
    namespace App;
    
    use Illuminate\Database\Eloquent\Model;
    
    class SchoolClass extends Model
    {
    
        public $timestamps = false;
        
        protected $fillable = [
            'name',
            'break_id',
            'category_id',
            'teacher_id'
        ];
    
        public function teacher()
        {
            return $this->belongsTo(User::class, 'teacher_id');
        }
    
        public function school()
        {
            return $this->belongsTo(School::class);
        }
    
        public function breakTime()
        {
            return $this->belongsTo(BreakTime::class, 'break_id');
        }
    
        public function category()
        {
            return $this->belongsTo(Category::class);
        }
    
        public function student()
        {
            return $this->hasMany(Student::class, 'class_id');
        }
        
    }
