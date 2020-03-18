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
            return $this->belongsTo('App\School');
        }
        
    }
