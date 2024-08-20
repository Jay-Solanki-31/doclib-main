<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LibFile extends Model
{
    // Point to table in database
    protected $table = "lib_files";

    public function directory(){
        return $this->belongsTo('App\LibDirectory', 'directory_id');
    }
}
