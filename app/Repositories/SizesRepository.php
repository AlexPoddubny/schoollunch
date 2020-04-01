<?php
    
    
    namespace App\Repositories;
    
    
    use App\Size;

    class SizesRepository
        extends Repository
    {
        
        public function __construct(Size $size)
        {
            $this->model = $size;
        }
        
    }
