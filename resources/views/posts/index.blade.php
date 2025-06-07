@extends('layout')

@section('title', '記事一覧 - Tech Blog')

@section('content')
<div class="row">
    <div class="col-md-8">
        <h1>記事一覧</h1>
        
        @if($posts->count() > 0)
            @foreach($posts as $post)
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="{{ route('posts.show', $post->slug) }}" class="text-decoration-none">
                            {{ $post->title }}
                        </a>
                    </h5>
                    <p class="card-text">{{ $post->excerpt }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">
                            {{ $post->created_at->format('Y年m月d日') }} 
                            | 閲覧数: {{ number_format($post->view_count) }}回
                        </small>
                        <div>
                            @if($post->published)
                                <span class="badge bg-success">公開中</span>
                            @else
                                <span class="badge bg-secondary">下書き</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            
            <!-- ページネーション -->
            {{ $posts->links() }}
        @else
            <div class="alert alert-info">
                <h4>記事がまだありません</h4>
                <p>最初の記事を作成してみましょう！</p>
                <a href="{{ route('posts.create') }}" class="btn btn-primary">記事を作成</a>
            </div>
        @endif
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>クイックアクション</h5>
            </div>
            <div class="card-body">
                <a href="{{ route('posts.create') }}" class="btn btn-primary w-100 mb-2">新しい記事を作成</a>
                <a href="{{ route('posts.admin') }}" class="btn btn-outline-secondary w-100">管理画面</a>
            </div>
        </div>
    </div>
</div>
@endsection