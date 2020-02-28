<?php
    
    
    namespace App\Repositories;
    
    use Config;
    
    abstract class Repository
    {
        protected $model = false;
    
        public function get()
        {
            return $this->model::all();
        }
        
    }
