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
            if ($request->hasFile('image')){
                $data['photo'] = $this->upload($request);
            }
            $model->fill($data);
            $model->save();
            $model->product()->sync($data['product']);
            return ['status' => 'Страву додано'];
        }
    
        public function upload($request)
        {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $file->move(public_path() . '/images', $name);
            return $name;
        }
        
    }
