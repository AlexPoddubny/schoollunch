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
    }
