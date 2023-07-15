<x-app-layout>
    <x-slot name="header">
        <a href='/posts/create'>記事作成</a>
        <form action="{{ route('search') }}" method="GET">
            <x-text-input id="search" name="keyword" type="text" class="mt-1 block w-full" placeholder="大学名または記事のタイトルを入力してください" />
            <button type="submit">検索</button>
        </form>
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
                    <div class="post-control">
                        @if (!Auth::user()->is_bookmark($post->id))
                        <form action="{{ route('bookmark.store', $post) }}" method="post">
                            @csrf
                            <button><i class="fa-regular fa-bookmark"></i>お気に入り登録</button>
                        </form>
                        @else
                        <form action="{{ route('bookmark.destroy', $post) }}" method="post">
                            @csrf
                            @method('delete')
                            <button><i class="fa-solid fa-bookmark"></i>お気に入り解除</button>
                        </form>
                        @endif
                        @if (!Auth::user()->is_like($post->id))
                        <form action="{{ route('like.store', $post) }}" method="post">
                            @csrf
                            <button><i class="fa-regular fa-heart"></i>いいね登録</button>
                        </form>
                        @else
                        <form action="{{ route('like.destroy', $post) }}" method="post">
                            @csrf
                            @method('delete')
                            <button><i class="fa-solid fa-heart"></i>いいね解除</button>
                        </form>
                        @endif
                    </div>
                    <p>いいね数: {{ $post->likeCount() }}</p>
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