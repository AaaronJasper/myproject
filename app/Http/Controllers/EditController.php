<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class EditController extends Controller
{
    public function edit(Request $request)
    {
        $blogs=Blog::where('user_id',auth()->id())->get();
        return view("blog.blogedit",["blogs"=>$blogs]);
    }
}
