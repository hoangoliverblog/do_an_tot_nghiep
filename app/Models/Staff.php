<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    //
    protected $table = 'Staff';
    protected $fillable = [
        'name','address','email', 'password','image','otp','status','gioitinh','phone'
    ];
}
