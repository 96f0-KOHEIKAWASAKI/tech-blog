<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // テスト記事データを作成
        Post::create([
            'title' => 'Laravel入門：基礎から学ぶWebアプリケーション開発',
            'slug' => 'laravel-tutorial-basics',
            'excerpt' => 'Laravelフレームワークの基本的な概念から実践的な開発手法まで、初心者向けに分かりやすく解説します。',
            'content' => '
# Laravel入門

## Laravelとは？
LaravelはPHPのWebアプリケーションフレームワークです。

## 主な特徴
- **Eloquent ORM**: データベース操作が簡単
- **Blade テンプレート**: 美しいビューの作成
- **Artisan コマンド**: 開発効率の向上
- **セキュリティ**: 標準でXSS、CSRF対策

## 基本的な使い方

### 1. ルート定義
```php
Route::get("/", function() {
    return view("welcome");
});
```

### 2. コントローラー作成
```bash
php artisan make:controller PostController
```

### 3. モデル作成
```bash
php artisan make:model Post -m
```

## まとめ
Laravelは現代的で効率的なWeb開発を可能にする優れたフレームワークです。
            ',
            'meta_description' => 'Laravel入門者向けの完全ガイド。基本概念から実践まで詳しく解説。',
            'published' => true,
            'view_count' => 150,
        ]);

        Post::create([
            'title' => 'PHP 8の新機能解説：Named Argumentsとは？',
            'slug' => 'php8-named-arguments',
            'excerpt' => 'PHP 8で追加された Named Arguments の使い方と実践的な活用例を紹介します。',
            'content' => '
# PHP 8の新機能：Named Arguments

PHP 8で追加された Named Arguments について詳しく解説します。

## Named Argumentsとは？

関数の引数を名前で指定できる機能です。

## 従来の方法
```php
function createUser($name, $email, $age = null, $active = true) {
    // 処理
}

// 従来の呼び出し方
createUser("田中太郎", "tanaka@example.com", null, false);
```

## Named Argumentsを使った方法
```php
// 名前で指定
createUser(
    name: "田中太郎",
    email: "tanaka@example.com", 
    active: false
);
```

## メリット
1. **可読性の向上**: 何の値かが明確
2. **引数の順序自由**: 順番を気にしなくて良い
3. **デフォルト値のスキップ**: 必要な引数のみ指定

## 実際の活用例
```php
// Laravelでのクエリビルダー
Post::where(
    column: "published", 
    operator: "=", 
    value: true
)->get();
```

PHP 8の Named Arguments で、より読みやすいコードを書きましょう！
            ',
            'meta_description' => 'PHP 8の新機能 Named Arguments の使い方と実践例を詳しく解説します。',
            'published' => true,
            'view_count' => 89,
        ]);

        Post::create([
            'title' => 'AWS EC2でLaravelアプリケーションをデプロイする方法',
            'slug' => 'laravel-deploy-aws-ec2',
            'excerpt' => 'AWS EC2インスタンスにLaravelアプリケーションをデプロイする手順を詳しく解説します。',
            'content' => '
# AWS EC2でLaravelデプロイ

## 前提条件
- AWSアカウント
- Laravelアプリケーション
- 基本的なLinuxコマンドの知識

## デプロイ手順

### 1. EC2インスタンスの作成
- Ubuntu 22.04 LTS を選択
- t2.micro（無料枠）
- セキュリティグループでHTTP(80)、HTTPS(443)、SSH(22)を許可

### 2. 必要なソフトウェアのインストール
```bash
# PHP 8.3 インストール
sudo add-apt-repository ppa:ondrej/php
sudo apt update
sudo apt install php8.3 php8.3-fpm php8.3-mysql php8.3-xml php8.3-curl

# Composer インストール
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Nginx インストール
sudo apt install nginx
```

### 3. アプリケーションのデプロイ
```bash
# アプリケーションを配置
cd /var/www
sudo git clone your-repository
cd your-app
sudo composer install --optimize-autoloader --no-dev
```

### 4. 環境設定
```bash
# .env ファイル設定
sudo cp .env.example .env
sudo php artisan key:generate
sudo php artisan migrate --force
```

### 5. Nginx設定
```nginx
server {
    listen 80;
    server_name your-domain.com;
    root /var/www/your-app/public;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

## セキュリティ対策
- SSL証明書の設定
- ファイアウォールの設定
- 定期的なセキュリティアップデート

AWS EC2でのLaravelデプロイが完了です！
            ',
            'meta_description' => 'AWS EC2でLaravelアプリをデプロイする完全ガイド。初心者向けに詳しく解説。',
            'published' => true,
            'view_count' => 234,
        ]);

        Post::create([
            'title' => '【下書き】Bootstrap 5の新機能まとめ',
            'slug' => 'bootstrap5-new-features-draft',
            'excerpt' => 'Bootstrap 5で追加された新機能と変更点について詳しく解説します。',
            'content' => '
# Bootstrap 5の新機能

## 主な変更点
- jQuery依存の削除
- CSS Custom Properties対応
- 新しいUtilityクラス

この記事は執筆中です...
            ',
            'meta_description' => 'Bootstrap 5の新機能と変更点を詳しく解説。',
            'published' => false,  // 下書き記事
            'view_count' => 0,
        ]);
    }
}