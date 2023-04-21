<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>文章發布</title>
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
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #555555;
        }
        
        .form-control {
            display: block;
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #DDDDDD;
            transition: border-color 0.2s ease-in-out;
        }
        
        .form-control:focus {
            border-color: #007BFF;
            outline: none;
        }
        
        .form-control::-webkit-input-placeholder {
            color: #BBBBBB;
        }
        
        .form-control::-moz-placeholder {
            color: #BBBBBB;
        }
        
        .form-control:-ms-input-placeholder {
            color: #BBBBBB;
        }
        
        .form-control::placeholder {
            color: #BBBBBB;
        }
        
        .form-select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url('data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 4 5"%3E%3Cpath fill="%23AAAAAA" d="M2 0L0 2h4zm0 5L0 3h4z"/%3E%3C/svg%3E');
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 8px 10px;
            width: 300px;
            padding: 14px 40px 14px 10px;
        }
        
        .form-submit {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: #FFFFFF;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }
        
        .form-submit:hover {
            background-color: #0069D9;
        }
    </style>
</head>
<body>
	<a href="{{route('blog.index')}}">首頁</a>
    <a href="{{route('blog.create')}}">發布頁面</a>
    <div class="container">
        @if(session('delete'))
            <div>{{session('delete')}}
            </div>
        @endif
        @if(session('success'))
            <div>{{session('success')}}
            </div>
        @endif
        <h1>文章修改</h1>
        @if(empty($blogs[0]))
        <h3>尚無文章</h3>
        @endif
        @foreach($blogs as $blog)
        <form method="post" action="{{route('blog.update',$blog)}}" > 
            @method("PUT")
            @csrf
            <div class="form-group">
                <label class="form-label" for="tittle">標題：</label>
                <input class="form-control" type="text" id="title" name="tittle" value="{{$blog->tittle}}">
            </div>
            <div class="form-group">
                <label class="form-label" for="content">內容：</label>
                <textarea class="form-control" id="content" name="content" rows="8" >{{$blog->content}}</textarea>
            </div>
            <div class="form-group">
                <label class="form-label" for="category">分類：</label>
                <select class="form-select" id="category" name="category_id">
                    <option value="{{$blog->category_id}}">{{$blog->category_id}}</option>
                    <option value="NBA">NBA</option>
                    <option value="PLG">PLG</option>
                    <option value="tech">tech</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="category">狀態：</label>
                <select class="form-select" id="category" name="status">
                    <option value="{{$blog->status}}">{{$blog->status}}</option>
                    <option value="隱藏">隱藏</option>
                    <option value="公開">公開</option>
                </select>
            </div>
            @include("common.error")
            <button class="form-submit" type="submit">修改文章</button>
        </form>
        <br/>
        <form method="post" action="{{route('blog.destroy',$blog)}}" >
            @method("DELETE")
            @csrf
            <button class="form-submit" type="submit">刪除文章</button>
        </form>
        <br/>
        <hr/>
        <br/>
        @endforeach
    </div>
</body>
</html>