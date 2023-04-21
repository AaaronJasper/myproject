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
<a href="{{route('blog.index')}}">首頁</a>
    <div class="container">
        <h3>留言</h3>
        @auth
        @include("common.error")
            @if(session('success'))
            <div>{{session('success')}}
            </div>
        @endif
            <form method="post" action="{{route('soncomment.update',$soncomment)}}">
                @method("PUT")
                @csrf
                <label for="comment">留言內容：</label>
                <textarea name="comment" id="comment" cols="30" rows="5" >{{$soncomment->content}}</textarea>
                <button type="submit" value="post">修改</button>
            </form>
        @else
            <p>請先<a href="{{route('login')}}">登錄</a>後再留言</p>
        @endauth
        </div>
        </div>
        </div>
</body>
</html>