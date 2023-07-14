<style>
    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        margin-top: 50px;
    }

    .profile-section {
        margin-bottom: 20px;
    }

    .avatar {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 10px;
    }

    .avatar img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
    }

    .profile-info {
        margin-bottom: 10px;
    }

    .username {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .dashboard-title {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .button-group {
        margin-top: 20px;
    }

    .button-group a {
        margin-right: 10px;
    }
</style>

<div class="container">
    @include("common.error")

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="profile-section">
        <div class="avatar">
            <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('images/images.jpeg') }}" alt="頭像">
        </div>
        <div class="profile-info">
            <div class="username">目前帳號：{{ auth()->user()->name }}</div>
            <form action="{{ route('avatar.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="avatar" class="form-label">上傳頭像</label>
                    <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*">
                </div>
                <button type="submit" class="btn btn-primary">上傳</button>
            </form>
        </div>
    </div>

    <h2 class="dashboard-title">{{ __('主控台') }}</h2>

    <div class="button-group">
        <a href="{{ route('blog.index') }}" class="btn btn-primary">首頁</a>
        <a href="{{ route('subscribe') }}" class="btn btn-primary">訂閱</a>
        <a href="{{ route('blog.create') }}" class="btn btn-primary">發布頁面</a>
        <a href="{{ route('edit') }}" class="btn btn-primary">編輯頁面</a>
        <a href="{{ route('/auth/google/logout') }}" class="btn btn-primary">登出</a>
    </div>
</div>


