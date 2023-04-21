<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    //連接文章
    public function blog(){
        return $this->belongsTo('App\Models\Blog');
    }
    //連接發布者
    public function user(){
        return $this->belongsTo("App\Models\User");
    }
    //連接子留言
    public function soncomments(){
        return $this->hasMany('App\Models\Soncomment');
    }
}
