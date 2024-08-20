<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookType extends Model
{
        //Table name
    protected $table = 'book_types';

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
        return $this->hasMany('App\Book', 'BookTypeID');
    }
}
