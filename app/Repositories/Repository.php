<?php
    
    
    namespace App\Repositories;
    
    use Config;
    
    abstract class Repository
    {
        protected $model = false;
    /*
        public function getAll()
        {
            return $this->model::all();
        }
        */
        public function getPaginated($num)
        {
            return $this->model::paginate($num);
        }
    /*
        public function getWhere($id, $key = 'id')
        {
            return $this->model::where($key, $id)->get();
        }
    
        public function getArray($arr)
        {
            return $this->model::find($arr);
        }
        
        public function getArrayWithRelated($arr, $table)
        {
            return $this->model::with($table)->find($arr);
        }
        */
        public function getWithRelationCount($table)
        {
            return $this->model::withCount($table)->get();
        }
    
        public function create($request)
        {
            $data = $request->except('_token');
            return $this->model::create($data);
        }
    /*
        public function new()
        {
            return new $this->model;
        }
        
        public function save()
        {
            return $this->model->save();
        }
    
        public function delete($id)
        {
            return $this->model::destroy($id);
        }
    */
        /**
         * @param $index
         * @param $table
         * @param string $key
         * @return mixed
         */
        public function getWithRelated($index, $table, $key = 'id')
        {
            return $this->model::with($table)->where($key, $index)->get();
        }
        /*
        public function getNotNull($key = 'id')
        {
            return $this->model::whereNotNull($key)->get();
        }*/
    
        /**
         * @param $table
         * @param string $key
         * @return mixed
         */
        public function getNotNullWithRelated($table, $key = 'id')
        {
            return $this->model::with($table)->whereNotNull($key)->get();
        }
        
        public function getAllWithRelated($table)
        {
            return $this->model::with($table);
        }
    
        public function deleteItem($request, $type)
        {
            $type = strtolower(after($type, '\\')) . 's';
            $id = $request->input('id');
            $items = session($type);
            if (isset($items[$id])){
                unset($items[$id]);
                session([$type => $items]);
            }
        }
        
    }
