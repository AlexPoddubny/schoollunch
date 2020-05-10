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
            $products = session('products');
            foreach ($products as $n => $product){
                $products[$n] = Arr::except($products[$n], 'name');
            }
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
