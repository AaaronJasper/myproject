<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\blogrequest;
use Illuminate\Support\Facades\DB;
use App\Models\Blog;
use App\Models\Like;
use App\Models\User;
use App\Services\BlogService;

class Blogcontroller extends Controller
{
    private $blogService;
    public function __construct(BlogService $blogService)
    {
        $this->middleware("auth")->except("show","index");
        $this->blogService=$blogService;
    }
    /**
     * 首頁 
     */
    public function index(Request $request)
    {
        $blogs=$this->blogService->indexService($request);
        $counts=$this->blogService->index_count_comment_service($blogs);
        return view("blog.blogindex",["blogs"=>$blogs,"counts"=>$counts]); 
    }

    /**
     * 創建頁面
     */
    public function create()
    {
        return view('blog.blogcreate');
    }

    /**
     * 執行儲存文章
     */
    public function store(blogrequest $request)
    {
        $result=$this->blogService->storeservice($request);
        if($result){
            $id=User::where("id",auth()->id())->select("users.*")->first();
            $id->blogs_count=$id->blogs_count+1;
            $id->save();
            return back()->with(["success"=>"添加成功"]);
        }else{
            return back()->withErrors("添加失敗")->withInput();
        }
    }

    /**
     * 單一文章頁面
     */
    public function show(Blog $blog)
    {
        $blog_one=$this->blogService->showService_blog($blog);
        $comments=$this->blogService->showService_comment($blog);
        $soncomments=$this->blogService->showService_soncomment($blog);
        $hasLiked = Like::where('blog_id', $blog->id)->where('user_id', auth()->id())->exists();
        return view("blog.blogshow",["blog_one"=>$blog_one,"comments"=>$comments,"soncomments"=>$soncomments,'hasLiked'=> $hasLiked]);
    }

    /**
     * 執行文章更新
     */
    public function update(blogrequest $request,Blog $blog)
    {
        $blogs=$this->blogService->updateService($request,$blog);
        if($blogs){
            return back()->with(["success"=>"更新成功"]);
        }else{return back()->withErrors("添加失敗")->withInput();
        }
    }

    /**
     * 執行刪除
     */
    public function destroy(Blog $blog)
    {
        $result=$this->blogService->destroyService($blog);
        $id=User::where("id",auth()->id())->select("users.*")->first();
        $id->blogs_count=$id->blogs_count-1;
        $id->save();
        return back()->with(["delete"=>"刪除成功"]); 
    }
}