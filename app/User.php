<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

// class User extends Authenticatable implements MustVerifyEmail
class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'FirstName', 'SecondName', 'email', 'password', 'UserRole', 'Obfuscator', 'validity', 'gender', 'title'
    ];

    public $primaryKey = 'id';
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user_role()
    {
        return $this->belongsTo('App\UserRoles', 'UserRole');   
    }
    
    public function user_title()
    {
        return $this->belongsTo('App\Titles', 'title');   
    }
}
