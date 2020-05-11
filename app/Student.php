<?php
    
    namespace App;
    
    use Illuminate\Database\Eloquent\Model;
    use Spatie\Searchable\Searchable;
    use Spatie\Searchable\SearchResult;

    class Student
        extends Model
//        implements Searchable
    {
        
        public $timestamps = false;
        
        protected $fillable = [
            'fullname',
            'privilege',
            'class_id'
        ];
        
        public function schoolClass()
        {
            return $this->belongsTo(SchoolClass::class, 'class_id');
        }
    
        public function parent()
        {
            return $this->belongsToMany(User::class, 'children_parents', 'child_id', 'parent_id')
                ->withTimestamps()
                ->withPivot('confirmed_at');
        }
    /*
        public function getSearchResult(): SearchResult
        {
            $url = $this->id;
            return new SearchResult(
                $this,
                $this->fullname,
                $url
            );
        }*/
    }
