<?php
    
    
    namespace App\Relations;
    
    
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsToMany;
    
    class SizeCourseRelation
        extends BelongsToMany
    {
        
        /*public function __construct(Builder $query, Model $parent, $table, $foreignPivotKey, $relatedPivotKey, $parentKey, $relatedKey, $relationName = null)
        {
            parent::__construct($query, $parent, $table, $foreignPivotKey, $relatedPivotKey, $parentKey, $relatedKey, $relationName);
        }*/
        
        protected $pivotColumns = ['size_id'];
        
        public function newPivot($attributes = [], $exists = false)
        {
            $pivot = new CourseWithSizePivot([$this->parent, $attributes, $this->table, $exists]);
            
            return $pivot->setPivotKeys($this->foreignKey, $this->otherKey);
        }
        
        public function get($columns = ['*'])
        {
            $courses = parent::get($columns);
            
            // Получаем список всех объектов CourseWithSizePivot
            $pivots = $courses->map(function ($course) {
                return $course->pivot;
            })->load('size');
            
            return $courses;
        }
        
    }
