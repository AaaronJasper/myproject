<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\User;
use App\Models\Follow;
use Illuminate\Support\Facades\DB;
use App\Services\BlogService;

class FollowController extends Controller
{
    private $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService=$blogService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id=auth()->id();
        $follows=Follow::where("user_id",$id)->select("follows.*")->get();
        $authors=[];
        foreach($follows as $follow){
            $result=User::where("id",$follow->follow_id)->select("users.*")->first();
            $authors[]=$result;
        }
        return view("followindex",["authors"=>$authors]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * 執行追蹤或取消追蹤的功能
     */
    public function update(Request $request, int $id)
    {
        //取得blog
        $users=User::where("id",$id)->get();
        $user=$users[0];
        $follows=Follow::where("follow_id",$id)->where("user_id",auth()->id())->get();
        //確認是否有按追蹤過
        if(empty($follows[0])){
            $user->follow=$user->follow+1; 
            $result=DB::table("follows")->insert([
                "user_id"=>auth()->id(),
                "follow_id"=>$id,
                "created_at"=>date('Y-m-d H:i:s')
            ]);
        }else{
            $user->follow=$user->follow-1;
            $result=Follow::where("follow_id",$id)->where("user_id",auth()->id())->delete();
        }
        //進行儲存
        if($result){
            $user->save();
        }
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
