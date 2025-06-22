<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Tech Blog')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- ナビゲーション -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('posts.index') }}">Tech Blog</a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav me-auto">
                    <a class="nav-link" href="{{ route('posts.index') }}">記事一覧</a>
                    @auth
                        <a class="nav-link" href="{{ route('posts.create') }}">記事作成</a>
                        <a class="nav-link" href="{{ route('dashboard') }}">ダッシュボード</a>
                    @endauth
                </div>
                
                <div class="navbar-nav ms-auto">
                    @auth
                        <span class="navbar-text me-3">
                            ようこそ、{{ auth()->user()->name }}さん
                        </span>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-light btn-sm">ログアウト</button>
                        </form>
                    @else
                        <a class="nav-link" href="{{ route('login') }}">ログイン</a>
                        <a class="nav-link" href="{{ route('register') }}">登録</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- フラッシュメッセージ -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- メインコンテンツ -->
    <main class="container mt-4">
        @yield('content')
    </main>

    <!-- フッター -->
    <footer class="bg-dark text-light mt-5 py-4">
        <div class="container text-center">
            <p>&copy; 2025 Tech Blog. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
