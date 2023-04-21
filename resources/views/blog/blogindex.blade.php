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
    </style>
</head>
<body>
    <div class="container">
    <a href="{{route('blog.index')}}">全部</a>
    @auth
    <a href="{{route('followblog')}}">追蹤中</a>
    <a href="{{route('follow.index')}}">追蹤名單</a>
    @endauth
    <a href="{{route('dashboard')}}">登錄頁面</a>
    <a href="{{route('blog.create')}}">發布頁面</a>
    <a href="{{route('edit')}}">編輯頁面</a>
    <form method="get" action="{{route('blog.index')}}">
        <br/>
            <div>
                <label for="keyword">關鍵字：</label>
                <input type="text" id="keyword" name="keyword" value="{{request()->input('keyword')}}">
            </div>
            <div>
                <label for="order">依照：</label>
                <select id="order" name="type">
                    <option value=""></option>
                    <option value="view" {{request()->input('type') == 'view' ? 'selected' : ''}}>觀看</option>
                    <option value="id" {{request()->input('type') == 'id' ? 'selected' : ''}}>時間</option>
                    <option value="like" {{request()->input('type') == 'like' ? 'selected' : ''}}>讚數</option>
                </select>
            </div>
            <div>
                <label for="order">排序：</label>
                <select id="order" name="order">
                    <option value=""></option>
                    <option value="asc" {{request()->input('order') == 'asc' ? 'selected' : ''}}>升冪</option>
                    <option value="desc" {{request()->input('order') == 'desc' ? 'selected' : ''}}>降冪</option>
                </select>
            </div>
            <div>
                <label for="category_id">文章類型：</label>
                <select id="category_id" name="category_id">
                    <option value="">全部</option>
                    <option value="NBA" {{request()->input('category_id') == 'NBA' ? 'selected' : ''}}>NBA</option>
                    <option value="PLG" {{request()->input('category_id') == 'PLG' ? 'selected' : ''}}>PLG</option>
                    <option value="tech" {{request()->input('category_id') == 'PLG' ? 'selected' : ''}}>tech</option>
                </select>
            </div>
        <button type="submit">搜尋</button>    
    </form> 
    </br>               
        <h1>文章列表</h1>
        <br/>
        @if(empty($blogs[0]))
            <h3>無相關文章</h3>
        @endif
        @php
        $num=0;
        @endphp
        @foreach ($blogs as $article)
            <div class="card">
                <div class="card-header">
                    <a  href="{{route ('blog.show',$article)}}"> {{$article->tittle}}</a>
                </div>
                <div class="card-body">
                <img width="60" height='60' 
                    src='{{ $article->user->avatar? asset("storage/".$article->user->avatar): asset("images/images.jpeg")}}'/>
                    <p><strong>作者：</strong><a href="{{route ('newown.fromContent',$article)}}">{{$article->user->name}}</a></p>
                    <p><strong>瀏覽量：</strong>{{$article->view}}</p>
                    <p><strong>按讚數：</strong>{{$article->like}}</p>
                    <p><strong>留言數：</strong>{{$counts[$num]}}</p>
                    <p><strong>類型：</strong>{{$article->category_id}}</p>
                </div>
                <div class="card-footer"><strong>創建時間：</strong>{{ $article->created_at}}</div>
            </div>
        </br>
        @php
        $num+=1
        @endphp
        @endforeach
    </div>
</body>
</html>