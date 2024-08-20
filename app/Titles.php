<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Titles extends Model
{
    // Table
    protected $table = 'titles';

    //Primary Key
    public $primaryKey = 'id';

    // timestamps
    public $timestamps = true;

    // hidden attributes
    protected $hidden = [

    ];
}
