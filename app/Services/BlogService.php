<?php

namespace App\Services;
use Illuminate\Http\Request;
use App\Http\Requests\blogrequest;
use Illuminate\Support\Facades\DB;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\SonComment;

class BlogService
{
    //首頁查詢功能
    public function indexService(Request $request)
    {
        $keyword = $request->keyword;
        $order = $request->order;
        $category_id = $request->category_id;
        $type = $request->type;
        if($keyword!=""){
            if ($order == null and $category_id == null and $type == null) {
                $blogs = Blog::where('status', '公開')
                ->whereHas('user', function($query) use($keyword) {
                    $query->where('name', 'like', "%{$keyword}%");
                })
                ->orWhere('tittle', 'like', "%{$keyword}%")
                ->orWhere('content', 'like', "%{$keyword}%")
                ->orWhere('category_id', 'like', "%{$keyword}%")
                ->inRandomOrder()->get();
            }
            elseif ($order != null and $category_id == null and $type == null) {
                $blogs = Blog::where('status', '公開')
                ->whereHas('user', function($query) use($keyword) {
                    $query->where('name', 'like', "%{$keyword}%");
                })
                ->orWhere('tittle', 'like', "%{$keyword}%")
                ->orWhere('content', 'like', "%{$keyword}%")
                ->orWhere('category_id', 'like', "%{$keyword}%")->orderBy("id", $order)->get();
            }
            elseif ($order == null and $category_id != null and $type == null) {
                $blogs = Blog::where('status', '公開')
                ->whereHas('user', function($query) use($keyword) {
                    $query->where('name', 'like', "%{$keyword}%");
                })
                ->orWhere('tittle', 'like', "%{$keyword}%")
                ->orWhere('content', 'like', "%{$keyword}%")
                ->orderBy('id', "desc")
                ->where("category_id", $category_id)->get();
            }
            elseif ($order == null and $category_id == null and $type != null) {
                $blogs = Blog::where('status', '公開')
                ->whereHas('user', function($query) use($keyword) {
                    $query->where('name', 'like', "%{$keyword}%");
                })
                ->orWhere('tittle', 'like', "%{$keyword}%")
                ->orWhere('content', 'like', "%{$keyword}%")
                ->orWhere('category_id', 'like', "%{$keyword}%")->orderBy($type, "desc")->get();
            }
            elseif ($order != null and $category_id != null and $type == null) {
                $blogs = Blog::where('status', '公開')
                ->whereHas('user', function($query) use($keyword) {
                    $query->where('name', 'like', "%{$keyword}%");
                })
                ->orWhere('tittle', 'like', "%{$keyword}%")
                ->orWhere('content', 'like', "%{$keyword}%")
                ->orderBy("id", $order)
                ->where("category_id", $category_id)->get();
            }
            elseif ($order == null and $category_id != null and $type != null) {
                $blogs = Blog::where('status', '公開')
                ->whereHas('user', function($query) use($keyword) {
                    $query->where('name', 'like', "%{$keyword}%");
                })
                ->orWhere('tittle', 'like', "%{$keyword}%")
                ->orWhere('content', 'like', "%{$keyword}%")
                ->orderBy($type, "desc")
                ->where("category_id", $category_id)->get();
            }
            elseif ($order != null and $category_id == null and $type != null) {
                $blogs = Blog::where('status', '公開')
                ->whereHas('user', function($query) use($keyword) {
                    $query->where('name', 'like', "%{$keyword}%");
                })
                ->orWhere('tittle', 'like', "%{$keyword}%")
                ->orWhere('content', 'like', "%{$keyword}%")
                ->orWhere('category_id', 'like', "%{$keyword}%")
                ->orderBy($type, $order)->get();
            }
            else{
                $blogs = Blog::where('status', '公開')
                ->whereHas('user', function($query) use($keyword) {
                    $query->where('name', 'like', "%{$keyword}%");
                })
                ->orWhere('tittle', 'like', "%{$keyword}%")
                ->orWhere('content', 'like', "%{$keyword}%")
                ->where("category_id", $category_id)
                ->orderBy($type, $order)->get();
            }
        }
        else{
            if ($order == null and $category_id == null and $type == null) {
                $blogs = Blog::where('status', '公開')->inRandomOrder()->get();
            }
            elseif ($order != null and $category_id == null and $type == null) {
                $blogs = Blog::where('status', '公開')->orderBy("id", $order)->get();
            }
            elseif ($order == null and $category_id != null and $type == null) {
                $blogs = Blog::where('status', '公開')->orderBy('id', "desc")
                    ->where("category_id", $category_id)->get();
            }
            elseif ($order == null and $category_id == null and $type != null) {
                $blogs = Blog::where('status', '公開')->orderBy($type, "desc")->get();
            }
            elseif ($order != null and $category_id != null and $type == null) {
                $blogs = Blog::where('status', '公開')->orderBy("id", $order)
                    ->where("category_id", $category_id)->get();
            }
            elseif ($order == null and $category_id != null and $type != null) {
                $blogs = Blog::where('status', '公開')->orderBy($type, "desc")
                    ->where("category_id", $category_id)->get();
            }
            elseif ($order != null and $category_id == null and $type != null) {
                $blogs = Blog::where('status', '公開')->orderBy($type, $order)->get();
            }
            else{
                $blogs = Blog::where('status', '公開')->orderBy($type, $order)
                ->where("category_id", $category_id)->get();
            }
        }
            return $blogs;
    }

    //查詢留言數的功能
    public function index_count_comment_service($blogs)
    {
        $count=[];
        foreach($blogs as $blog){
            $comments=Comment::where("blog_id",$blog->id)->get();
            $soncomments=Soncomment::where("blog_id",$blog->id)->get();
            $count[]=count($comments)+count($soncomments);
        }
        return $count;
    }

    //儲存功能
    public function storeservice(blogrequest $request)
    {
        $result=DB::table("blogs")->insert([
            "user_id"=>auth()->id(),
            "tittle"=>$request->input("tittle"),
            "content"=>$request->input("content"), 
            "category_id"=>$request->input("category_id"),
            "created_at"=>date('Y-m-d H:i:s')
        ]);
        return $result;
    }

    //單一展示文章功能，共三項
    public function showService_blog(Blog $blog)
    {
        //增加瀏覽量
        $blog->increment('view');
        //取得文章資訊
        $id=$blog->id;
        $blog_one=Blog::where('status','公開')
        ->where("blogs.id",$id)->first();
        return $blog_one;
    }
    public function showService_comment(Blog $blog)
    {
        $id=$blog->id;
        //取得留言資料
        $comments=Comment::where("blog_id",$id)
        ->orderby('id',"asc")->get();
        return $comments;
    }
    public function showService_soncomment(Blog $blog)
    {
        $id=$blog->id;
        //取得子留言資料
        $soncomments=SonComment::where("blog_id",$id)
        ->orderby('id',"asc")->get();
        return $soncomments;
    }

    //更新文章的功能
    public function updateService(blogrequest $request,Blog $blog)
    {
        $blog->tittle=$request->input("tittle");
        $blog->content=$request->input("content");
        $blog->category_id=$request->input("category_id");
        $blog->status=$request->input("status");
        $blog->save();
        return $blog;
    }

    //刪除文章的功能
    public function destroyService(Blog $blog)
    {
        //先刪除子留言
        $soncomments=DB::table("soncomments")
        ->where('soncomments.blog_id',$blog->id)
        ->delete();
        //刪除主留言
        $comments=DB::table("comments")
        ->where('comments.blog_id',$blog->id)
        ->delete();
        //刪除文章
        $blogs=$blog->delete();
        if($soncomments and $comments and $blogs){
            $result=true;
        }else{
            $result=false;
        }
        return $result;
    }

     // 顯示追蹤中的文章的功能
    public function followblogService($id)
    {
        $blogs = Blog::join('follows', 'blogs.user_id', '=', 'follows.follow_id')
                ->join('users','blogs.user_id','=','users.id')->where('status','公開')
                ->where('follows.user_id', $id)
                ->select('blogs.*',"users.name","users.avatar")
                ->orderby('id',"desc")
                ->get();
        return $blogs;
    }
}