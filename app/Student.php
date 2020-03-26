<?php
    
    namespace App;
    
    use Illuminate\Database\Eloquent\Model;
    use Spatie\Searchable\Searchable;
    use Spatie\Searchable\SearchResult;

    class Student
        extends Model
        implements Searchable
    {
        
        public $timestamps = false;
        
        protected $fillable = [
            'fullname',
            'class_id'
        ];
        
        public function schoolClass()
        {
            return $this->belongsTo('App\SchoolClass', 'class_id');
        }
    
        public function parent()
        {
            return $this->belongsToMany('App\Student', 'children_parents', 'parent_id', 'child_id');
        }
    
        public function getSearchResult(): SearchResult
        {
            $url = route('students.show', ['student' => $this->id]);
            return new SearchResult(
                $this,
                $this->fullname,
                $url
            );
        }
    }
