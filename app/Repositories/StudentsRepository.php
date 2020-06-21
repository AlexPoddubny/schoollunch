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
    
        public function add(Request $request, $classId)
        {
            $data = $request->except('_token');
            if (isset($data['privilege'])){
                $data['privilege'] = $request->boolean('privilege');
            }
            $schoolClass = SchoolClass::find($classId);
            $student = new Student($data);
            $schoolClass->student()->save($student);
            return ['status' => 'Учня додано до класу'];
        }
    
        public function addMass(Request $request, $classId)
        {
            $data = explode("\r\n", $request->input('list'));
            $schoolClass = SchoolClass::find($classId);
            foreach ($data as $item){
                $student = new Student();
                $student['fullname'] = $item;
                $schoolClass->student()->save($student);
            }
            return ['status' => 'Учнів додано до класу'];
        }
        
    }
