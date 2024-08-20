<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LibSubDirFile extends Model
{
    // Point to table in database
    protected $table = 'lib_sub_dir_files';

    public function directory(){
        return $this->belongsTo('LibSubDirectory');
    }
}
