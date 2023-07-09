<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <h1>Blog Name</h1>
        <div>
            <h2 class='title'>
                <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
            </h2>
            <p class='title'>{{ $post->body }}</p>
            <p class='user_name'>{{ $post->user_id }}</p>
            <p class='os'>{{ $post->os }}</p>
            <p class='cost'>{{ $post->cost }}</p>
            <p class='weight'>{{ $post->weight }}</p>
            <p class='battery'>{{ $post->battery }}</p>
            <p class='body'>{{ $post->body }}</p>
            <span class='created_at'>{{ $post->created_at }}</span>
        </div>
        <form action="/posts" method="POST">
            @csrf
            <div class="body">
                <h2>Body</h2>
                <textarea name="comment[body]" placeholder="質問内容を入力してください。"></textarea>
            </div>
            
            <input type="hidden" name="post[user_id]" value="{{ $user->id }}">
            <input type="hidden" name="post[post_id]" value="{{ $post->id }}">
            
            <input type="submit" value="store"/>
        </form>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
</html>