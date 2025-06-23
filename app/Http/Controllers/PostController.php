<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    /**
     * 記事一覧表示
     */
    public function index()
    {
        // 公開済み記事を新しい順で取得
        $posts = Post::published()
            ->latest()
            ->paginate(10);

        return view('posts.index', compact('posts'));
    }

    /**
     * 記事詳細表示
     */
    public function show($slug)
    {
        // 認証済みの場合は下書きも表示、未認証の場合は公開記事のみ
        if (Auth::check()) {
            $post = Post::where('slug', $slug)->firstOrFail();
        } else {
            $post = Post::where('slug', $slug)
                ->published()
                ->firstOrFail();
        }

        // 閲覧数をインクリメント（公開記事の場合のみ）
        if ($post->published) {
            $post->incrementViewCount();
        }

        return view('posts.show', compact('post'));
    }


    /**
     * 記事作成フォーム表示
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * 記事保存処理
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'excerpt' => 'required|max:500',
            'content' => 'required',
            'meta_description' => 'nullable|max:160',
        ]);

        // スラッグ自動生成（日本語対応）
        $slug = Str::slug($validated['title']);
        if (empty($slug)) {
            $slug = 'post-' . time();
        }

        // 重複チェック
        $originalSlug = $slug;
        $count = 1;
        while (Post::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        $validated['slug'] = $slug;
        $validated['published'] = $request->has('published') ? 1 : 0;

        $post = Post::create($validated);

        // 公開記事の場合は詳細ページ、下書きの場合は編集ページにリダイレクト
        if ($post->published) {
            return redirect()->route('posts.show', $post->slug)
                ->with('success', '記事を公開しました');
        } else {
            return redirect()->route('posts.edit', $post->slug)
                ->with('success', '記事を下書きとして保存しました');
        }
    }

    /**
     * 記事編集フォーム表示
     */
    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('posts.edit', compact('post'));
    }

    /**
     * 記事更新処理
     */
    public function update(Request $request, $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'title' => 'required|max:255',
            'excerpt' => 'required|max:500',
            'content' => 'required',
            'meta_description' => 'nullable|max:160',
        ]);

        $validated['published'] = $request->has('published') ? 1 : 0;

        // タイトルが変更された場合はスラッグも更新
        if ($post->title !== $validated['title']) {
            $newSlug = Str::slug($validated['title']);

            // 日本語などでslugが空になる場合は既存slugを保持
            if (empty($newSlug)) {
                $validated['slug'] = $post->slug;
            } else {
                // 同じスラッグが存在する場合は数字を追加（自分以外）
                $originalSlug = $newSlug;
                $count = 1;
                while (Post::where('slug', $newSlug)->where('id', '!=', $post->id)->exists()) {
                    $newSlug = $originalSlug . '-' . $count;
                    $count++;
                }
                $validated['slug'] = $newSlug;
            }
        } else {
            // タイトルが変更されていない場合は既存slugを保持
            $validated['slug'] = $post->slug;
        }

        $post->update($validated);

        return redirect()->route('posts.show', $post->slug)
            ->with('success', '記事を更新しました');
    }

    /**
     * 記事削除処理
     */
    public function destroy($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', '記事を削除しました');
    }

    /**
     * 管理者用：全記事一覧（公開・非公開含む）
     */
    public function admin()
    {
        $posts = Post::latest()->paginate(10);

        return view('posts.admin', compact('posts'));
    }
}
