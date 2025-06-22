<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * ダッシュボード画面表示
     */
    public function index()
    {
        $user = auth()->user();
        
        // 統計情報を取得
        $totalPosts = Post::count();
        $publishedPosts = Post::published()->count();
        $draftPosts = Post::where('published', false)->count();
        $recentPosts = Post::latest()->take(5)->get();

        return view('auth.dashboard', compact(
            'user',
            'totalPosts', 
            'publishedPosts', 
            'draftPosts', 
            'recentPosts'
        ));
    }
}
