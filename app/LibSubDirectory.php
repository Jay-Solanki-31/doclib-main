<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LibSubDirectory extends Model
{
    // Point to table in database
    protected $table = 'lib_sub_directories';

    public function parent_dir(){
        return $this->belongsTo('App\LibDirectory');
    }

    public function files(){
        return $this->hasMany('App\LibSubDirFile');
    }

}
