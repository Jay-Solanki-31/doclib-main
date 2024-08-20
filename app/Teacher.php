<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    //Table name
    protected $table = 'teachers';

    // Primary Key;
    public $primaryKey = 'id';

    // timestamps
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('App\User', 'AddedBy');   
    }

    public function other_usr()
    {
        return $this->belongsTo('App\OtherUser', 'id', 'TeacherID');   
    }

    public function class()
    {
        return $this->belongsTo('App\ClassLevel', 'ClassID');
    }

    public function school()
    {
        return $this->belongsTo('App\School', 'SchoolID');
    }

}
