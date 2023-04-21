<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\blogrequest;
use Illuminate\Support\Facades\DB;
use App\Models\Blog;
use App\Models\Like;
use App\Services\BlogService;

class LikeController extends Controller
{
    private $blogService;
    public function __construct(BlogService $blogService)
    {
        $this->blogService=$blogService;
    }

    public function show(){}

    /**
     * 執行按讚或取消讚的動作
     */
    public function update(Request $request, int $id)
    {
        //取得blog
        $blogs=Blog::where("id",$id)->get();
        $blog=$blogs[0];
        $likes=Like::where("blog_id",$id)->where("user_id",auth()->id())->get();
        //確認是否有按過讚
        if(empty($likes[0])){
            $blog->like=$blog->like+1; 
            $result=DB::table("likes")->insert([
                "user_id"=>auth()->id(),
                "blog_id"=>$id,
                "created_at"=>date('Y-m-d H:i:s')
            ]);
        }else{
            $blog->like=$blog->like-1;
            $result=Like::where("blog_id",$id)->where("user_id",auth()->id())->delete();
        }
        //進行儲存
        if($result){
            $blog->save();
        }
        //更改完再回傳
        //取得需要回傳視圖的資料，利用BlogService
        $blog_one=$this->blogService->showService_blog($blog);
        $comments=$this->blogService->showService_comment($blog);
        $soncomments=$this->blogService->showService_soncomment($blog);
        $hasLiked = Like::where('blog_id', $id)->where('user_id', auth()->id())->exists();
        return view("blog.blogshow",["blog_one"=>$blog_one,"comments"=>$comments,"soncomments"=>$soncomments,'hasLiked'=> $hasLiked]);
    }
}
