<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    // データベースに保存可能なカラムを指定
    protected $fillable = [
        'title',
        'excerpt',
        'content',
        'slug',
        'meta_description',
        'published',
        'view_count'
    ];

    // boolean型として扱うカラム
    protected $casts = [
        'published' => 'boolean',
    ];

    // モデルイベント：作成・更新時に自動でslugを生成
    protected static function boot()
    {
        parent::boot();

        // 作成時
        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = static::generateUniqueSlug($post->title);
            }
        });

        // 更新時（タイトルが変更された場合のみ）
        static::updating(function ($post) {
            if ($post->isDirty('title') && empty($post->slug)) {
                $post->slug = static::generateUniqueSlug($post->title);
            }
        });
    }

    // 一意なslugを生成するメソッド
    protected static function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        
        // 日本語などでslugが空の場合はタイムスタンプベース
        if (empty($slug)) {
            $slug = 'post-' . time();
        }

        // 重複チェック
        $originalSlug = $slug;
        $count = 1;
        while (static::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }

    // 公開済み記事のみ取得するスコープ
    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    // 観覧数をインクリメント
    public function incrementViewCount()
    {
        $this->increment('view_count');
    }
}