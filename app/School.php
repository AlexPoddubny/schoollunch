<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    public $timestamps = FALSE;
    
    public function admin()
    {
        return $this->hasOne('App\Users', );
    }
}
