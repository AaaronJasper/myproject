<?php

namespace App\Services;
use Illuminate\Http\Request;
use App\Http\Requests\blogrequest;
use Illuminate\Support\Facades\DB;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\SonComment;

class CommentService 
{
    //儲存主留言留功能
    public function storeService(Request $request )
    {
        $res=DB::table("comments")->insert([
            "user_id"=>auth()->id(),
            "content"=>$request->input("comment"),
            "created_at"=>date('Y-m-d H:i:s'),
            "blog_id"=>$request->input("blog_id")
        ]);
        return $res;
    }

    //更新留言功能
    public function updateService(Request $request,Comment $comment)
    {
        $id=$comment->blog_id;
        $comment->content=$request->input("comment");
        $comment->save();
        return $id;
    }

    //刪除留言功能
    public function destroyService(Comment $comment)
    {   
        //先刪除子留言
        $soncomments=DB::table("soncomments")
        ->where('soncomments.comment_id',$comment->id)
        ->delete();
        //刪除主留言
        $comments=$comment->delete();
        if($soncomments and $comments){
            $res=true;
        }else{
            $res=false;
        }
        return $res;
    }

}