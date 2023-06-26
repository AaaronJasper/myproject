@include("common.error")
@if(session('success'))
<div>{{session('success')}}
</div>
@endif
<img width="100" height='100' src='{{auth()->user()->avatar? asset("storage/".auth()->user()->avatar): asset("images/images.jpeg")}}'>
<div>目前帳號是:{{auth()->user()->name}}</div>
<form action="{{ route('avatar.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="avatar" class="form-label">上傳頭像</label>
        <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*">
    </div>
    <button type="submit" class="btn btn-primary">上傳</button>
</form>
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Dashboard') }}
</h2>
<a href="{{route('blog.index')}}">首頁</a>
<a href="{{route('blog.create')}}">發布頁面</a>
<a href="{{route('edit')}}">編輯頁面</a>
<a href="{{route('test.index')}}">登出</a>