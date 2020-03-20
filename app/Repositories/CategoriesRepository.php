<?php
    
    
    namespace App\Repositories;
    
    
    use App\Category;
    use Illuminate\Http\Request;

    class CategoriesRepository
        extends Repository
    {
        
        public function __construct(Category $category)
        {
            $this->model = $category;
        }
        
    }
