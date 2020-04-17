<?php
    
    namespace App;
    
    use Illuminate\Database\Eloquent\Model;
    
    class BreakTime extends Model
    {
        public $timestamps = FALSE;
        
        public $table = 'breaks';
        
        protected $fillable = [
            'break_num',
            'school_id',
            'break_time'
        ];
    
        public function school()
        {
            return $this->belongsTo(School::class);
        }
    
        public function schoolClass()
        {
            return $this->hasMany(SchoolClass::class);
        }
    
        public function menu()
        {
            return $this->hasMany(Menu::class, 'break_id');
        }
        
    }
