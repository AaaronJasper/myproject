<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\User;
use App\Models\Follow;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Services\OwnService;
use App\Services\BlogService;

class NewOwnController extends Controller
{
    private $ownService;
    private $blogService;

    public function __construct(OwnService $ownService,BlogService $blogService)
    {
        $this->ownService=$ownService;
        $this->blogService=$blogService;
    }

    /**
     * 從文章點進來個人文章的方法
     */
    public function fromContent(int $id)
    {
        //$id是blogs_id
        $blogs=$this->ownService->showService_blogs($id);
        $author=$this->ownService->showService_author($id);
        //使用blogservie的查詢留言數
        $counts=$this->blogService->index_count_comment_service($blogs);
        //確認有無追蹤
        $hasFollowed=Follow::where('user_id', auth()->id())->where("follow_id",$author[0]->id)->exists();
        return view("ownblog",["blogs"=>$blogs,"author"=>$author,"counts"=>$counts,"hasFollowed"=>$hasFollowed]);
    }

    /**
     * 從主留言點選進來個人文章的方法
     */
    public function fromComment(int $id)
    {
        //$id是comments.id
        $blogs=$this->ownService->editService_blogs($id);
        $author=$this->ownService->editService_author($id);
        //使用blogservie的查詢留言數
        $counts=$this->blogService->index_count_comment_service($blogs);
        //確認有無追蹤
        $hasFollowed=Follow::where('user_id', auth()->id())->where("follow_id",$author[0]->id)->exists();
        return view("ownblog",["blogs"=>$blogs,"counts"=>$counts,"author"=>$author,"hasFollowed"=>$hasFollowed]);
    }

    /**
     * 從子留言點選進來個人文章的方法
     */
    public function fromSonComment(int $id)
    {
        //$id是soncomments.id
        $blogs=$this->ownService->soncommentService_blogs($id);
        $author=$this->ownService->soncommentService_author($id);
        //使用blogservie的查詢留言數
        $counts=$this->blogService->index_count_comment_service($blogs);
        //確認有無追蹤
        $hasFollowed=Follow::where('user_id', auth()->id())->where("follow_id",$author[0]->id)->exists();
        return view("ownblog",["blogs"=>$blogs,"counts"=>$counts,"author"=>$author,"hasFollowed"=>$hasFollowed]);
    }

    /**
     * 從追蹤頁面點選進來個人文章的方法
     */
    public function fromFollow(int $id)
    {
        //取得需要回傳的值
        //$id是users.id
        $blogs=Blog::where('status','公開')
            ->where("user_id",$id)
            ->orderby('id','desc')
            ->select('blogs.*')->get();
        $author=User::where("id",$id)->select("users.*")->get();
        $counts=$this->blogService->index_count_comment_service($blogs);
        $hasFollowed=Follow::where('user_id', auth()->id())->where("follow_id",$author[0]->id)->exists();
        return view("ownblog",["blogs"=>$blogs,"author"=>$author,"counts"=>$counts,"hasFollowed"=>$hasFollowed]);
    }
}
