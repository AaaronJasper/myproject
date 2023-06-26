<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Follow;
use App\Models\User;
use App\Services\BlogService;

class FollowBlogController extends Controller
{
    private $blogService;
    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }
    /**
     * 顯示追蹤中的文章
     */
    public function __invoke()
    {
        $id = auth()->id();
        $blogs = $this->blogService->followblogService($id);
        $counts = $this->blogService->index_count_comment_service($blogs);
        return view("blog.followblog", ["blogs" => $blogs, "counts" => $counts]);
    }
}
