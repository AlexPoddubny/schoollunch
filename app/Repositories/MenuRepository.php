<?php
    
    
    namespace App\Repositories;


    use App\Menu;

    class MenuRepository
        extends Repository
    {
        
        public function __construct(Menu $menu)
        {
            $this->model = $menu;
        }
    
        public function saveMenu($request)
        {
            $data = $request->except('_token');
            if (isset($data['privileged'])){
                $data['privileged'] = $request->boolean('privileged');
            }
            $model = new $this->model;
            $model->fill($data);
            $model->save();
            return ['status' => 'Позицію меню додано'];
        }
        
    }
