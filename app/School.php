<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    //Table name
    protected $table = 'schools';

    // Primary Key;
    public $primaryKey = 'id';

    // timestamps
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('App\User', 'AddedBy');   
    }
    
}
