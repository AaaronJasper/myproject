<?php

namespace App\Services;
use Illuminate\Http\Request;
use App\Http\Requests\blogrequest;
use Illuminate\Support\Facades\DB;
use App\Models\Blog;
use App\Models\User;
use App\Models\Comment;
use App\Models\Soncomment;

class OwnService
{
    //更新頭像功能
    public function storeService(Request $request)
    {
        //獲取上傳頭像
        $file=$request->file('avatar'); 
        //存儲於public
        $path=$file->store('avatar','public');
        //更新用戶頭像
        $uid=auth()->id();
        $res=DB::table("users")
        ->where('id',$uid)
        ->update(["avatar"=>$path]);
        return $res;
    }

    //從文章點擊進來的查看功能
    //取得blogs
    public function showService_blogs(int $id)
    {
        $authorres=Blog::where("id",$id)->select("user_id")->get();
        $authorid=$authorres[0]->user_id;
        $blogs=Blog::where('status','公開')
            ->where("user_id",$authorid)
            ->orderby('id','desc')
            ->select('blogs.*')->get();
        return $blogs;
    }
    //從文章點擊進來的查看功能
    //取得author
    public function showService_author(int $id)
    {
        $authorres=Blog::where("id",$id)->select("user_id")->get();
        $authorid=$authorres[0]->user_id;
        $author=User::where("id",$authorid)->select("users.*")->get();
        return $author;
    }

    //從留言點擊進來的查看功能
    //取得blogs
    public function editService_blogs(int $id)
    {
        $authorres=Comment::where("id",$id)->select("user_id")->get();
        $authorid=$authorres[0]->user_id;
        $blogs=Blog::where('status','公開')
            ->where("user_id",$authorid)
            ->orderby('id','desc')
            ->select('blogs.*')->get();
        return $blogs;
    }
    //從留言點擊進來的查看功能
    //取得author
    public function editService_author(int $id)
    {
        $authorres=Comment::where("id",$id)->select("user_id")->get();
        $authorid=$authorres[0]->user_id;
        $author=User::where("id",$authorid)->select("users.*")->get();
        return $author;
    }

    //從子留言點擊進來的查看功能
    //取得blogs
    public function soncommentService_blogs(int $id)
    {
        $authorres=Soncomment::where("id",$id)->select("user_id")->get();
        $authorid=$authorres[0]->user_id;
        $blogs=Blog::where('status','公開')
            ->where("user_id",$authorid)
            ->orderby('id','desc')
            ->select('blogs.*')->get();
        return $blogs;
    }
    //從子留言點擊進來的查看功能
    //取得author
    public function soncommentService_author(int $id)
    {
        $authorres=Soncomment::where("id",$id)->select("user_id")->get();
        $authorid=$authorres[0]->user_id;
        $author=User::where("id",$authorid)->select("users.*")->get();
        return $author;
    }

}