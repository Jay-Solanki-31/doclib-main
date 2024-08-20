<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuditTrail extends Model
{
    // Point to table in database
    protected $table = 'audit_trail';

    // Primary Key
    public $primaryKey = 'id';

    // timestamps
    public $timestamps = true;

    // hidden attributes
    protected $hidden = [

    ];


    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

}
