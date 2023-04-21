<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\blogrequest;
use Illuminate\Support\Facades\DB;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\User;
use App\Services\BlogService;

class TestController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user=Comment::where("id",9)->first();
        $blogs=$user->soncomments;
        dd($blogs);
    }
}
