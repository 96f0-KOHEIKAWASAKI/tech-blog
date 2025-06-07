<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    // データベースに保存可能なカラムを指定
    protected $fillable = [
        'title',
        'exerpt',
        'content',
        'slug',
        'meta_description',
        'published',
        'view_count'
    ];

    // boolean型として扱うカラム
    protected $casts = [
        'published' => 'boolean', // 0/1 → true/false
    ];

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




