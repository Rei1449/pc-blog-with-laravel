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
        <h1>Blog Name</h1>
        @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                    @endif
                @endauth
            </div>
        @endif
        <a href='/posts/create'>create</a>
        <div class='posts'>
            @foreach ($posts as $post)
                <div class='p-4 m-4 border bg-gray-100 '>
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
        <div class='paginate'>
            {{ $posts->links() }}
        </div>
    </body>
</html>