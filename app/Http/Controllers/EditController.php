<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class EditController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Blog $blog)
    {
        $blogs=Blog::where('user_id',auth()->id())->get();
        return view("blog.blogedit",["blogs"=>$blogs]);
    }
}
