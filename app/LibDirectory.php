<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LibDirectory extends Model
{
    // Point to table in the database
    protected $table = 'lib_directories';

    public function sub_directories(){
        return $this->hasMany('App\LibSubDirectory');
    }

    public function files(){
        return $this->hasMany('App\LibFile');
    }
}
