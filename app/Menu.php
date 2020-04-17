<?php
    
    namespace App;
    
    use Illuminate\Database\Eloquent\Model;
    
    class Menu extends Model
    {
        protected $fillable = [
            'date',
            'school_id',
            'break_id',
            'lunch_id',
            'privileged'
        ];
        
        protected $casts = [
            'privileged' => 'boolean'
        ];
    
        public function school()
        {
            return $this->belongsTo(School::class);
        }
    
        public function breakTime()
        {
            return $this->belongsTo(BreakTime::class, 'break_id');
        }
    
        public function lunch()
        {
            return $this->belongsTo(Lunch::class);
        }
        
    }
