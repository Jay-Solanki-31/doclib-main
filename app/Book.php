<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
         //Table name
    protected $table = 'books';

    // Primary Key;
    public $primaryKey = 'id';

    // timestamps
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('App\User', 'AddedBy');   
    }

    public function class()
    {
        return $this->belongsTo('App\ClassLevel', 'ClassID');
    }

    public function type()
    {
        return $this->belongsTo('App\BookType', 'BookTypeID');
    }
}
