<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    protected static function tableName()
    {
        $name = strtolower(static::class());
        $name = substr($name, strripos($name, '\\') + 1);
        $l = substr($name, -1);
        switch ($l){
            case 's':
                $name .= 'es';
                break;
            case 'y':
                $name = substr($name, 0, strlen($name) - 1) . 'ies';
                break;
            default:
                $name .= 's';
                break;
        }
        static::$table = $name;
    }
    
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        static::tableName();
    }
}
