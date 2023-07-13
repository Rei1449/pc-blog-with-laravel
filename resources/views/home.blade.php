<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <x-app-layout>
            <x-slot name="header">
                <a href='/posts/create'>記事作成</a>
                <x-text-input id="search" name="search" type="text" class="mt-1 block w-full" placeholder="パソコン名を入力してください"/>
            </x-slot>
            <div class="py-12">
                <div class='max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6'>
                    @foreach ($posts as $post)
                        <div class='p-4 sm:p-8 bg-white shadow sm:rounded-lg'>
                            <h2 class='title'>
                                <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                            </h2>
                            <p class='user_name'>{{ $post->user->name }}</p>
                            <p class='user_name'>{{ $post->user->university_name }}</p>
                            <p class='os'>{{ $post->os }}</p>
                            <p class='cost'>{{ $post->cost }}</p>
                            <p class='weight'>{{ $post->weight }}</p>
                            <p class='battery'>{{ $post->battery }}</p>
                            <p class='body'>{{ $post->body }}</p>
                            <a href='/posts/{{ $post->id }}/comment'>コメント</a>
                            <br>
                            <span class='created_at'>{{ $post->created_at }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class='paginate'>
                {{ $posts->links() }}
            </div>
        </x-app-layout>
    </body>
</html>
