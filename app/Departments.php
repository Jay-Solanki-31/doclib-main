<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
    //Table name
    protected $table = 'departments';

    // Primary Key;
    public $primaryKey = 'id';

    // timestamps
    public $timestamps = true;
}
