<?php
    
    
    namespace App\Repositories;
    
    
    use App\Student;

    class StudentsRepository
        extends Repository
    {
        
        public function __construct(Student $student)
        {
            $this->model = $student;
        }
        
    }
