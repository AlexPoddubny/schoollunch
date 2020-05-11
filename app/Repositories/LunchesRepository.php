<?php
    
    
    namespace App\Repositories;
    

    use App\Lunch;
    use Arr;

    class LunchesRepository
        extends Repository
    {
        
        public function __construct(Lunch $lunch)
        {
            $this->model = $lunch;
        }
    
        public function saveLunch($request, $id = null)
        {
            $data = $request->except('_token');
            if (isset($data['privileged'])){
                $data['privileged'] = $request->boolean('privileged');
            }
            if ($id) {
                $model = $this->model::find($id);
            } else {
                $model = new $this->model;
            }
            $model->fill($data);
            $model->save();
            $courses = session('courses');
            foreach ($courses as $n => $course){
                $courses[$n] = Arr::only($courses[$n], ['course_id', 'size_id']);
            }
            $model->sizeCourse()->sync($courses);
            return ['status' => 'Комплекс збережено'];
        }
    
        public function getLastNum()
        {
            return $this->model::get('number')->sortByDesc('number')->first()->number;
        }
    
    }
