<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'tittle', 'name', 'content', 'category_id', 'view', 'created_at', 'updated_at'];
    
    //連接使用者
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    //連接主留言
    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }
}
