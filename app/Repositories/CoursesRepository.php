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
        
    }
