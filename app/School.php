<?php
    
    namespace App;
    
    use Illuminate\Database\Eloquent\Model;
    
    class School extends Model
    {
        public $timestamps = FALSE;
        
        protected $fillable = [
            'name'
        ];
        
        public function admin()
        {
            return $this->belongsTo('App\User', 'admin_id');
        }
        
        public function cook()
        {
            return $this->belongsTo('App\User', 'cook_id');
        }
        
        public function breakTime()
        {
            return $this->hasMany('App\BreakTime')->orderBy('break_num');
        }
        
        public function schoolClass()
        {
            return $this->hasMany('App\SchoolClass')->orderBy('name');
        }
        
    }
