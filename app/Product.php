<?php
    
    namespace App;
    
    use Illuminate\Database\Eloquent\Model;
//    use Spatie\Searchable\Searchable;
//    use Spatie\Searchable\SearchResult;

    class Product
        extends Model
//        implements Searchable
    {
        
        public $timestamps = false;
        
        protected $fillable = [
            'name'
        ];
        
        public function course()
        {
            return $this->belongsToMany(Course::class, 'courses_products')
                ->withPivot(['brutto', 'netto']);
        }
    
        public function getSearchResult(): SearchResult
        {
            $url = $this->id;
            return new SearchResult(
                $this,
                $this->name,
                $url
            );
        }
        
    }
