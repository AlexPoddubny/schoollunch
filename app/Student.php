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
    
        public function parent()
        {
            return $this->belongsToMany('App\Student', 'children_parents', 'parent_id', 'child_id');
        }
        
    }
