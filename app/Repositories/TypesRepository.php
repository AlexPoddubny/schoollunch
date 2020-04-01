<?php
    
    
    namespace App\Repositories;
    
    
    use App\Type;

    class TypesRepository
        extends Repository
    {
        
        public function __construct(Type $type)
        {
            $this->model = $type;
        }
        
    }
