<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class xeploai extends Model
{
    protected $table = 'xeploais';

    protected $fillable = [
        'pr_id','level'
    ];

    public $timestamps = false;

    public function sanpham(){
        return $this->belongsTo('App\Models\Product','pr_id','id');
    }
    public function loaisanpham(){
        return $this->belongsTo('App\Models\loaisanpham','pr_id','id');
    }
}
