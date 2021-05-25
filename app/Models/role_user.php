<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class role_user extends Model
{
    protected $table = 'role_users';

    protected $fillable = [
        'role_name'
    ];

    public $timestamps = false;

    public function user(){
        return $this->hasMany('App\User','role_id','id');
    }
}
