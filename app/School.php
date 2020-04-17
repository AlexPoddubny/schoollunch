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
            return $this->belongsTo(User::class, 'admin_id');
        }
        
        public function cook()
        {
            return $this->belongsTo(User::class, 'cook_id');
        }
        
        public function breakTime()
        {
            return $this->hasMany(BreakTime::class)->orderBy('break_num');
        }
        
        public function schoolClass()
        {
            return $this->hasMany(SchoolClass::class)->orderBy('name');
        }
    
        public function menu()
        {
            return $this->hasMany(Menu::class);
        }
        
    }
