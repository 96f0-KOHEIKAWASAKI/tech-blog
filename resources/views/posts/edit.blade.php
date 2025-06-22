@extends('layout')

@section('title', '記事編集 - Tech Blog')

@section('content')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h2>記事編集</h2>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('posts.update', $post->slug) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">記事タイトル</label>
                            <input type="text" class="form-control" id="title" name="title"
                                value="{{ old('title', $post->title) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="excerpt" class="form-label">記事の抜粋</label>
                            <textarea class="form-control" id="excerpt" name="excerpt" rows="3" required>{{ old('excerpt', $post->excerpt) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">記事本文</label>
                            <textarea class="form-control" id="content" name="content" rows="10" required>{{ old('content', $post->content) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="published" name="published"
                                    value="1" {{ old('published', $post->published) ? 'checked' : '' }}>
                                <label class="form-check-label" for="published">公開する</label>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">記事を更新</button>
                            <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-secondary">キャンセル</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
