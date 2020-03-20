<?php
    
    namespace App;
    
    use Illuminate\Database\Eloquent\Model;
    
    class Student extends Model
    {
        
        public $timestamps = false;
        
        protected $fillable = [
            'fullname',
            'class_id'
        ];
        
        public function schoolClass()
        {
            return $this->belongsTo('App\SchoolClass', 'class_id');
        }
        
    }
