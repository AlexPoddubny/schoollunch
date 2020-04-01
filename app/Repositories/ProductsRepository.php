<?php
    
    
    namespace App\Repositories;
    
    
    use App\Product;

    class ProductsRepository
        extends Repository
    {
        
        public function __construct(Product $product)
        {
            $this->model = $product;
        }
        
    }
