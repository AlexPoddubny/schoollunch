<?php
    
    
    namespace App\Repositories;
    
    
    use App\Course;

    class CoursesRepository
        extends Repository
    {
        
        public function __construct(Course $course)
        {
            $this->model = $course;
        }
    
        public function saveCourse($request)
        {
            $data = $request->except('_token');
            $model = new $this->model;
            $model->fill($data);
            $model->save();
            $model->product()->sync($data['product']);
            return ['status' => 'Страву додано'];
        }
        
    }
