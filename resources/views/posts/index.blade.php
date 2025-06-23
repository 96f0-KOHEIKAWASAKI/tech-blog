@extends('layout')

@section('title', 'Tech Blog - 記事一覧')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h1 class="mb-4">記事一覧</h1>
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

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
                            </small>
                            <div>
                                @if($post->published)
                                    <span class="badge bg-success">公開中</span>
                                @else
                                    <span class="badge bg-secondary">下書き</span>
                                @endif
                                
                                @auth
                                    <a href="{{ route('posts.edit', $post->slug) }}" class="btn btn-sm btn-outline-primary ms-2">編集</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                <!-- ページネーション -->
                <div class="d-flex justify-content-center">
                    {{ $posts->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <h5 class="text-muted">記事がありません</h5>
                    @auth
                        <a href="{{ route('posts.create') }}" class="btn btn-primary mt-3">最初の記事を投稿する</a>
                    @endauth
                </div>
            @endif
        </div>
    </div>
</div>
@endsection