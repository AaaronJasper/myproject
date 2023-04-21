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
        .profile-box {
            background-color: #FFFFFF;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .profile-box h2 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333333;
        }

        .profile-box p {
            font-size: 14px;
            margin-bottom: 5px;
            color: #555555;
        }

        .profile-box .created-at {
            font-size: 12px;
            color: #777777;
            margin-bottom: 10px;
        }    
    </style>
</head>
<body>
    <div class="container">
    <div>
    <a href="{{route('blog.index')}}">首頁</a>
    <a href="{{route('blog.create')}}">發布頁面</a>
    <a href="{{route('edit')}}">編輯頁面</a>
    </div>
    <br/>
    <h1>追蹤列表</h1>
    <br/>
    @foreach($authors as $author)
    <div class="profile-box">
    <img width="100" height='100' 
        src='{{$author->avatar? asset("storage/".$author->avatar): asset("images/images.jpeg")}}'>
        <h2><a href="{{route ('newown.fromFollow',$author)}}">{{ $author->name }}</a></h2>
        <p>加入時間：{{ $author->created_at->format('Y/m/d') }}</p>
        <p>追蹤數：{{$author->follow}}</p>
        <p>文章總數：{{$author->blogs_count}}</p>
    </div>
    @endforeach