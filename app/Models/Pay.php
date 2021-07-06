<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    // use HasFactory;
    protected $table = 'payments';
    protected $primaryKey = 'id';
    protected $fillable = [
        'hoadon_id',
        'product_id',
        'user_name',
        'money',
        'note',
        'vn_reponse_code',
        'code_vnpay',
        'code_bank'
    ];

    public function product(){
        return $this->belongsTo('App\Models\Product', 'product_id', 'id') ;
    }

    public function hoadon(){
        return $this->belongsTo('App\Models\hoadon', 'hoadon_id', 'id') ;
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_email', 'email') ;
    }

    

}