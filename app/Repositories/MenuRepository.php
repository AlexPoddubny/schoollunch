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
            /*
            $classes = $data['class_id'];
            unset($data['class_id']);
            */
            $model = new $this->model;
            $model->fill($data);
            $model->save();
//            dd($model, $classes);
//            dd($classes);
//            $model->schoolClass()->sync($classes);
            return ['status' => 'Позицію меню додано'];
        }
        
    }
