<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soncomment extends Model
{
    use HasFactory;
    //連接主留言
    public function comment(){
        return $this->belongsTo('App\Models\Comment');
    }
    //連接發布者
    public function user(){
        return $this->belongsTo("App\Models\User");
    }
}
