<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class hoadon extends Model
{
    //
    protected $table = 'hoadons';

    protected $fillable = [
        'pr_id','user_id','sum'
    ];

    public $timestamps = false;

    public function sanpham(){
        return $this->belongsTo('App\Models\Product','pr_id','id');
    }

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }
}
