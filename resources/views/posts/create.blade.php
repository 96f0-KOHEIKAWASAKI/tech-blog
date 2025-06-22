@extends('layout')

@section('title', '記事作成 - Tech Blog')

@section('content')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h2>新規記事作成</h2>
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

                    <form action="{{ route('posts.store') }}" method="POST">
                        @csrf

                        <!-- タイトル -->
                        <div class="mb-3">
                            <label for="title" class="form-label">記事タイトル</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                                name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- 抜粋 -->
                        <div class="mb-3">
                            <label for="excerpt" class="form-label">記事の抜粋</label>
                            <textarea class="form-control @error('excerpt') is-invalid @enderror" id="excerpt" name="excerpt" rows="3"
                                required>{{ old('excerpt') }}</textarea>
                            @error('excerpt')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- 本文 -->
                        <div class="mb-3">
                            <label for="content" class="form-label">記事本文</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="10"
                                required>{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- 公開状態 -->
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="published" name="published"
                                    value="1" {{ old('published') ? 'checked' : '' }}>
                                <label class="form-check-label" for="published">
                                    公開する
                                </label>
                            </div>
                        </div>

                        <!-- ボタン -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">記事を保存</button>
                            <a href="{{ route('posts.index') }}" class="btn btn-secondary">キャンセル</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
