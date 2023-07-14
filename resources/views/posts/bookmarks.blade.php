<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mr-2">
                {{ __('プロフィール') }}
            </h2>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <a href="{{ route('bookmarks') }}">{{ __('ブックマーク') }}</a>
            </h2>
        </div>
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
                    <div class="article-control">
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
                    </div>
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
