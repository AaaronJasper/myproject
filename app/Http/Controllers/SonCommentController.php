<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Soncomment;

class SonCommentController extends Controller
{
    /**
     * 執行儲存子留言
     */
    public function store(Request $request)
    {
        $id=$request->blog_id;
        if($request->comment == null){return back()->with(["success"=>"內容不能為空"]);}
        $res=DB::table("soncomments")->insert([
            "user_id"=>auth()->id(),
            "content"=>$request->input("comment"),
            "created_at"=>date('Y-m-d H:i:s'),
            "blog_id"=>$request->input("blog_id"),
            "comment_id"=>$request->input("comment_id")
        ]);
        if($res){
            return redirect('blog/'.$id);
        }else{
            return redirect('blog/'.$id);
        }
    }

    /**
     * 前往子留言更新頁面
     */
    public function edit(Soncomment $soncomment)
    {
        return view("soncommentedit",["soncomment"=>$soncomment]);
    }

    /**
     * 執行子留言更新
     */
    public function update(Request $request, Soncomment $soncomment)
    {
        $id=$soncomment->blog_id;
        $soncomment->content=$request->input("comment");
        $soncomment->save();
        return redirect('blog/'.$id);
    }

    /**
     * 執行子留言刪除
     */
    public function destroy(Soncomment $soncomment)
    {
        $id=$soncomment->blog_id;
        $res=$soncomment->delete();
        if($res){
            return redirect('blog/'.$id);
        }else{return redirect('blog/'.$id);
        }
    }
}
