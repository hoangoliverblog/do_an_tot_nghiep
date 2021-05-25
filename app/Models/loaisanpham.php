<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class loaisanpham extends Model
{
    protected $table = 'loaisanphams';

    protected $fillable = [
        'name'
    ];

    public $timestamps = false;

    public function loaisanpham(){
        return $this->hasMany('App\Models\Product','id_loaisp','id');
    }
}
