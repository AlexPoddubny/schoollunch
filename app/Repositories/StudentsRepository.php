<?php
    
    
    namespace App\Repositories;
    
    
    use App\SchoolClass;
    use App\Student;
    use App\User;
    use Illuminate\Http\Request;

    class StudentsRepository
        extends Repository
    {
        
        public function __construct(Student $student)
        {
            $this->model = $student;
        }
    
        public function add(Request $request, SchoolClass $schoolClass)
        {
            $data = $request->except('_token');
            $student = new Student($data);
            $schoolClass->student()->save($student);
            return ['status' => 'Учня додано у клас'];
        }
    
        public function addMass(Request $request, SchoolClass $schoolClass)
        {
            $data = explode("\r\n", $request->input('list'));
            foreach ($data as $item){
                $student = new Student();
                $student['fullname'] = $item;
                $schoolClass->student()->save($student);
            }
            return ['status' => 'Учнів додано до класу'];
        }
        
    }
