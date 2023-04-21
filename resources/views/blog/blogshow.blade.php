<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>文章列表</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        
        body {
            background-color: #F9F9F9;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #FFFFFF;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        
        .card {
            margin-bottom: 20px;
            background-color: #FFFFFF;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            padding: 10px;
            background-color: #F2F2F2;
            font-size: 20px;
            font-weight: bold;
            color: #333333;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        .card-body {
            padding: 10px;
            font-size: 14px;
            color: #555555;
        }

        .card-footer {
            padding: 10px;
            background-color: #F2F2F2;
            font-size: 12px;
            color: #777777;
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
        }
        .comment-box {
        border: 1px solid #ccc;
        padding: 10px;
        margin-bottom: 10px;  
    }
    .comment-box h3 {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 5px;
    }
    .comment-box p {
        font-size: 14px;
        margin-bottom: 5px;
    }
    .comment-box .comment-time {
        font-size: 12px;
        color: #666;
        display: block;
        margin-top: 5px;
    }
    .comment-box form {
    display: inline-block;
}
      
    </style>
</head>
<body>
    <div class="container">
    <div>
    <a href="{{route('blog.index')}}">首頁</a>
    <a href="{{route('dashboard')}}">登錄頁面</a>
    <a href="{{route('blog.create')}}">發布頁面</a>
    <a href="{{route('edit')}}">編輯頁面</a>
    </div><br/>
            <div class="card">
                <div class="card-header">{{$blog_one->tittle}}</div> 
                <div class="card-body">
                    <p><strong>作者：</strong><a href="{{route ('newown.fromContent',$blog_one)}}">{{$blog_one->user->name}}</a></p>
                    <p><strong>類型：</strong>{{$blog_one->category_id}}</p>
                    <p><strong>瀏覽量：</strong>{{$blog_one->view}}</p>
                    <p><strong>按讚數：</strong>{{$blog_one->like}}</p>
                    <p><strong>內容：</strong>{{$blog_one->content}}</p>
                    @auth
                    @if ($hasLiked)
                    <form action="{{ route('like.update',$blog_one) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-danger">收回讚</button>
                    </form>
                    @else
                    <form action="{{ route('like.update',$blog_one) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-primary">按讚</button>
                    </form>
                    @endif
                    @endauth
                    </div>
                <div class="card-footer"><strong>創建時間：</strong>{{$blog_one->created_at}}</div>
            </div>
            <h2>評論區</h2>
            <br/>
            @foreach ($comments as $comment)
            <div class="comment-box">
            <!--主留言-->
            <img width="50" height='50' 
                src='{{$comment->user->avatar? asset("storage/".$comment->user->avatar): asset("images/images.jpeg")}}'>
            @if($comment->user_id == $blog_one->user_id)
            <h4>原PO</h4>
            @else
            <h3><a href="{{route ('newown.fromComment',$comment)}}">{{ $comment->user->name }}</a></h3>
            @endif
            <h2>{{ $comment->content }}</h2>
            <span class="comment-time">{{ $comment->created_at }}</span>
            @if($comment->user_id == auth()->id())
            <form method="get" action="{{route('comment.edit',$comment)}}">
            @csrf
            <button class="form-submit" type="submit">修改</button>
            </form>
            @endif
            @if($comment->user_id == auth()->id())
            <form method="post" action="{{route('comment.destroy',$comment)}}">
            @method("DELETE")
            @csrf
            <button class="form-submit" type="submit">刪除</button>
            </form>
            @endif
            <br/>
            <br/>
            <!--子留言-->
            @foreach($soncomments as $soncomment)
            @if($soncomment->comment_id == $comment->id)
            <img width="20" height='20' 
                src='{{$soncomment->user->avatar? asset("storage/".$soncomment->user->avatar): asset("images/images.jpeg")}}'>
            @if($soncomment->user_id == $blog_one->user_id)
            <h3>原PO</h3>
            @else
            <h4><a href="{{route ('newown.fromSonComment',$soncomment)}}">{{ $soncomment->user->name }}</a></h4>
            @endif
            <h3>{{ $soncomment->content }}</h3>
            <span class="comment-time">{{ $soncomment->created_at }}</span>
            @if($soncomment->user_id == auth()->id())
            <form method="get" action="{{route('soncomment.edit',$soncomment)}}">
            @csrf
            <button class="form-submit" type="submit">修改</button>
            </form>
            @endif
            @if($soncomment->user_id == auth()->id())
            <form method="post" action="{{route('soncomment.destroy',$soncomment)}}">
            @method("DELETE")
            @csrf
            <button class="form-submit" type="submit">刪除</button>
            </form>
            <br><br>
            @endif
            @endif
            @endforeach
            <br>
            <!--子留言表格-->
            @auth
            <img width="20" height='20' 
                src='{{auth()->user()->avatar? asset("storage/".auth()->user()->avatar): asset("images/images.jpeg")}}'>
            <form method="post" action="{{route('soncomment.store')}}">
                @csrf
                <input type="hidden" name="blog_id" value="{{ $blog_one->id }}">
                <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                <textarea name="comment" id="comment" cols="30" rows="1"></textarea>
                <button type="submit" value="post">回覆</button>
            </form>
            @endauth
            </div>
            @endforeach
            <div class="comments-container">
        <!--主留言表格-->
        <div class="comment-box">
        @include("common.error")
            @if(session('success'))
            <div>{{session('success')}}
            </div>
            @endif
        <h3>留言</h3>
        @auth
        <img width="60" height='60' 
            src='{{auth()->user()->avatar? asset("storage/".auth()->user()->avatar): asset("images/images.jpeg")}}'>
            <form method="post" action="{{route('comment.store')}}">
                @csrf
                <input type="hidden" name="blog_id" value="{{ $blog_one->id }}">
                <textarea name="comment" id="comment" cols="30" rows="5"></textarea>
                <button type="submit" value="post">送出</button>
            </form>
        @else
            <p>請先<a href="{{route('login')}}">登錄</a>後再留言</p>
        @endauth
        </div>
        </div>
        </div>
</body>
</html>