<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Posts</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1 class="title">
            {{ $post->title }}
        </h1>
        <div class="content">
            <div class="content__post">
                <h2 class='title'>{{ $post->title }}</h2>
                <p class='title'>{{ $post->body }}</p>
                <p class='user_name'>{{ $post->user->name }}</p>
                <p class='os'>{{ $post->os }}</p>
                <p class='cost'>{{ $post->cost }}</p>
                <p class='weight'>{{ $post->weight }}</p>
                <p class='battery'>{{ $post->battery }}</p>
                <p class='body'>{{ $post->body }}</p>
                <span class='created_at'>{{ $post->created_at }}</span>  
            </div>
        </div>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
</html>