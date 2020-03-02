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
        
        public function getPaginated($num)
        {
            return $this->model::paginate($num);
        }
    
        public function getWhere($id, $key = 'id')
        {
            return $this->model::where($key, $id)->first();
        }
    
        public function getWithRelationCount($table)
        {
            return $this->model::withCount($table)->get();
        }
        
    }
