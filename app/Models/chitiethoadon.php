<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class chitiethoadon extends Model
{
    
    protected $table = 'chitiethoadons';

    protected $fillable = [
        'hd_id',
    ];

    public $timestamps = false;

    public function hoadon(){
        return $this->belongsTo('App\Models\hoadon','hd_id','id');
    }
}
