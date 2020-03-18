<?php
    
    
    namespace App\Repositories;
    
    
    use App\BreakTime;
    use Illuminate\Http\Request;

    class BreakTimesRepository
        extends Repository
    {
        
        protected $school_rep;
        
        public function __construct(BreakTime $breakTime, SchoolRepository $school_rep)
        {
            $this->model = $breakTime;
            $this->school_rep = $school_rep;
        }
        
    }
