<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name','id_loaisp','price','soluong','img','thongtin',
        'desc','sale','coupe','viewcount','producer'
    ];

    public $timestamps = false;

    public function loaisanpham(){
        return $this->belongsTo('App\Models\loaisanpham','id_loaisp','id');
    }

    public function xeploai(){
        return $this->belongsTo('App\Models\xeploai','id_loaisp','id');
    }

    public function hoadon(){
        return $this->belongsTo('App\Models\hoadon','pr_id','id');
    }

}
