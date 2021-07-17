<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = [
        'user_id','pr_id','content','emailIfNotLogin'
    ];

    public $timestamps = false;

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }

    public function product(){
        return $this->belongsTo('App\Models\Product','pr_id','id');
    }
}
