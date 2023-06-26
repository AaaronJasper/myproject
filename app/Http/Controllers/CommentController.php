<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use App\Models\Comment;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private $commentService;
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }
    /**
     * 執行儲存留言
     */
    public function store(Request $request)
    {
        if ($request->comment == null) {
            return back()->with(["success" => "內容不能為空"]);
        }
        $res = $this->commentService->storeService($request);
        $id = $request->blog_id;
        if ($res) {
            return redirect('blog/' . $id);
        } else {
            return redirect('blog/' . $id);
        }
    }

    /**
     * 更新留言頁面
     */
    public function edit(Comment $comment)
    {
        return view("commentedit", ["comment" => $comment]);
    }

    /**
     * 執行更新
     */
    public function update(Request $request, Comment $comment)
    {
        $id = $this->commentService->updateService($request, $comment);
        return redirect('blog/' . $id);
    }

    /**
     * 執行刪除留言
     */
    public function destroy(Comment $comment)
    {
        $res = $this->commentService->destroyService($comment);
        $id = $comment->blog_id;
        if ($res) {
            return redirect('blog/' . $id);
        } else {
            return redirect('blog/' . $id);
        }
    }
}
