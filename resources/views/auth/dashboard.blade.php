@extends('layout')

@section('title', 'ダッシュボード - Tech Blog')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>ダッシュボード</h1>
            <span class="text-muted">ようこそ、{{ $user->name }}さん</span>
        </div>
    </div>
</div>

<!-- 統計カード -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">総記事数</h5>
                <h2 class="text-primary">{{ $totalPosts }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">公開記事</h5>
                <h2 class="text-success">{{ $publishedPosts }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">下書き</h5>
                <h2 class="text-warning">{{ $draftPosts }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">役割</h5>
                <h6 class="text-info">{{ $user->role === 'admin' ? '管理者' : '一般ユーザー' }}</h6>
            </div>
        </div>
    </div>
</div>

<!-- クイックアクション -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">クイックアクション</h5>
            </div>
            <div class="card-body">
                <div class="d-flex gap-2 flex-wrap">
                    <a href="{{ route('posts.create') }}" class="btn btn-primary">新規記事作成</a>
                    <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">記事一覧</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 最近の記事 -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">最近の記事</h5>
            </div>
            <div class="card-body">
                @if($recentPosts->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>タイトル</th>
                                    <th>状態</th>
                                    <th>作成日</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentPosts as $post)
                                <tr>
                                    <td>
                                        <a href="{{ route('posts.show', $post->slug) }}" class="text-decoration-none">
                                            {{ $post->title }}
                                        </a>
                                    </td>
                                    <td>
                                        @if($post->published)
                                            <span class="badge bg-success">公開</span>
                                        @else
                                            <span class="badge bg-warning">下書き</span>
                                        @endif
                                    </td>
                                    <td>{{ $post->created_at->format('Y/m/d') }}</td>
                                    <td>
                                        <a href="{{ route('posts.edit', $post->slug) }}" class="btn btn-sm btn-outline-primary">編集</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted">まだ記事がありません。<a href="{{ route('posts.create') }}">最初の記事を作成</a>してみましょう。</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
