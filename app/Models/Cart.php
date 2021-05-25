<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
    protected $table = 'carts';

    protected $fillable = [
        'hd_id','name','soluong','sum'
    ];

    public $timestamps = false;

    public function hoadon(){
        return $this->belongsTo('App\Models\hoadon','hd_id','id');
    }
}
