<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class OtherUser extends Authenticatable
{

    use Notifiable;

    protected $guard = 'other_user';

    protected $fillable = [
        'name', 'email', 'password', 'UserRole', 'Obfuscator','StudentID','TeacherID', 'validity', 'gender', 'title'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    //Table name
    protected $table = 'other_user';

    // Primary Key;
    public $primaryKey = 'id';

    // timestamps
    public $timestamps = true;

    public function teacher()
    {
        return $this->belongsTo('App\Teacher', 'TeacherID');   
    }

    public function student()
    {
        return $this->belongsTo('App\Student', 'StudentID');   
    }

    public function user_title()
    {
        return $this->belongsTo('App\Titles', 'title');   
    }

}
