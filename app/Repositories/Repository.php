<?php
    
    
    namespace App\Repositories;
    
    use Config;
    
    abstract class Repository
    {
        protected $model = false;
    
        public function getPaginated($num)
        {
            return $this->model::paginate($num);
        }
    
        public function getWithRelationCount($table)
        {
            return $this->model::withCount($table)->get();
        }
    
        public function create($request)
        {
            $data = $request->except('_token');
            return $this->model::create($data);
        }
    
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
    
        public function renderItems($type)
        {
            $type = strtolower(after($type, '\\')) . 's';
            $view = 'admin.' . $type . '_list';
            if (view()->exists($view)) {
                return view($view)
                    ->with([
                        'items' => session($type)
                    ])
                    ->render();
            }
            return null;
        }
        
    }
