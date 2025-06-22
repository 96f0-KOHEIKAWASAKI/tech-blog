@extends('layout')

@section('title', $post->title . ' - Tech Blog')

@section('content')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <!-- 記事ヘッダー -->
            <div class="mb-4">
                <h1 class="display-6">{{ $post->title }}</h1>
                <div class="text-muted mb-3">
                    <small>
                        投稿日: {{ $post->created_at->format('Y年m月d日') }}
                        @if ($post->updated_at != $post->created_at)
                            | 更新日: {{ $post->updated_at->format('Y年m月d日') }}
                        @endif
                    </small>
                </div>
            </div>

            <!-- 記事本文 -->
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <h5 class="text-muted">概要</h5>
                        <p class="lead">{{ $post->excerpt }}</p>
                    </div>

                    <hr>

                    <div class="content">
                        {!! nl2br(e($post->content)) !!}
                    </div>
                </div>
            </div>

            <!-- 管理者用ボタン -->
            <div class="mt-4 d-flex gap-2">
                <a href="{{ route('posts.edit', $post->slug) }}" class="btn btn-warning">編集</a>
                <form action="{{ route('posts.destroy', $post->slug) }}" method="POST"
                    onsubmit="return confirm('この記事を削除してもよろしいですか？')" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">削除</button>
                </form>
                <a href="{{ route('posts.index') }}" class="btn btn-secondary">一覧に戻る</a>
            </div>
        </div>
    </div>
@endsection
