<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassLevel extends Model
{
        //Table name
    protected $table = 'classes';

    // Primary Key;
    public $primaryKey = 'id';

    // timestamps
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('App\User', 'AddedBy');   
    }

    public function books()
    {
        return $this->hasMany('App\Book', 'ClassID');
    }
}
