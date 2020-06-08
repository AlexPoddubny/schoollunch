<?php
    
    
    namespace App\Repositories;
    
    
    use App\Course;
    use Arr;

    class CoursesRepository
        extends Repository
    {
        
        public function __construct(Course $course)
        {
            $this->model = $course;
        }
    
        public function saveCourse($request, $id = null)
        {
            $data = $request->except('_token');
            $products = session('products');
            if (count($products) == 0){
                return ['error' => 'Страву без інгредієнтів не може бути додано'];
            }
            foreach ($products as $n => $product){
                $products[$n] = Arr::except($products[$n], 'name');
            }
            if ($id){
                $model = $this->model::find($id);
            } else {
                $model = new $this->model;
            }
            if ($request->hasFile('image')){
                $data['photo'] = $this->upload($request);
            }
            $model->fill($data);
            $model->save();
            $model->product()->sync($products);
            return ['status' => 'Страву збережено'];
        }
    
        public function upload($request)
        {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $file->move(public_path() . '/images', $name);
            return $name;
        }
        
    }
