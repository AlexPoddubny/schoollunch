<?php
    
    
    namespace App\Repositories;
    
    
    use App\School;

    class SchoolsRepository
        extends Repository
    {
        public function __construct(School $school)
        {
            $this->model = $school;
        }
    }
