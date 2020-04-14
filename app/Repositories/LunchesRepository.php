<?php
    
    
    namespace App\Repositories;
    

    use App\Lunch;

    class LunchesRepository
        extends Repository
    {
        
        public function __construct(Lunch $lunch)
        {
            $this->model = $lunch;
        }
    
        public function saveLunch($request)
        {
            $data = $request->except('_token');
            $model = new $this->model;
            $model->fill($data);
            $model->save();
            $courses = session('courses');
            foreach ($courses as $n => $course){
                unset($courses[$n]['name']);
                unset($courses[$n]['type']);
                unset($courses[$n]['type_id']);
                unset($courses[$n]['size']);
            }
//            dd($model->id);
            $model->sizeCourse($model->id)->sync($courses);
            return ['status' => 'Комплекс додано'];
        }
    
    }
