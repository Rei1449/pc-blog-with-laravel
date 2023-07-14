<x-app-layout>
    <x-slot name="header">
        <a href='/posts/create'>記事作成</a>
    </x-slot>
    <div class="py-12">
        <div class='max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6'>
            <div class="content">
                <div class='p-4 sm:p-8 bg-white shadow sm:rounded-lg'>
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
                <div class="py-12">
                    <div class='max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6'>
                        <h3>コメント一覧</h3>
                        <div class='p-4 sm:p-8 bg-white shadow sm:rounded-lg'>
                            @foreach ($post->comments as $comment)
                                <p>ユーザ名: {{ $comment->user->name }}</p>
                                <p>{{ $comment->body }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <a href="/">戻る</a>
    </div>
</x-app-layout>