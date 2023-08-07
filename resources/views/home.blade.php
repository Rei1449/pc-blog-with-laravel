<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-center">
            <form action="{{ route('search') }}" method="GET" class="flex">
                <x-text-input id="search" name="keyword" type="text" class="mt-1 block w-full flex-shrink-0" placeholder="大学名または記事のタイトルを入力してください" />
                <button type="submit" class="ml-2 px-4 py-2 bg-black text-white rounded">検索</button>
            </form>
        </div>
    </x-slot>
    <div class="py-12">
        <div class='max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6'>
            @foreach ($posts as $post)
                <div class='p-4 sm:p-8 
                    @if ($post->user->humanities_or_science === 'science')
                        bg-blue-100
                    @elseif ($post->user->humanities_or_science === 'humanities')
                        bg-red-100
                    @elseif ($post->user->humanities_or_science === 'speciality')
                        bg-green-100
                    @endif 
                    shadow sm:rounded-lg'>
                    <h2 class='text-4xl border-b-4 border-gray-100 flex'>
                        <a class="font-bold" href="/posts/{{ $post->id }}">{{ Str::limit($post->title, 20) }}</a>
                        @auth
                            <div class="ml-auto flex">
                                <div class="text-blue-700 mr-2">
                                    @if (!Auth::user()->is_bookmark($post->id))
                                    <form action="{{ route('bookmark.store', $post) }}" method="post">
                                        @csrf
                                        <button><i class="fa-regular fa-bookmark"></i></button>
                                    </form>
                                    @else
                                    <form action="{{ route('bookmark.destroy', $post) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button><i class="fa-solid fa-bookmark"></i></button>
                                    </form>
                                    @endif
                                </div>
                                <div class="text-red-400">
                                    @if (!Auth::user()->is_like($post->id))
                                    <form action="{{ route('like.store', $post) }}" method="post">
                                        @csrf
                                        <button><i class="fa-regular fa-heart"></i></button>
                                    </form>
                                    @else
                                    <form action="{{ route('like.destroy', $post) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button><i class="fa-solid fa-heart"></i></button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                            <p class="text-red-400">：{{ $post->likeCount() }}</p>
                        @else
                            <div class="ml-auto text-red-400"><i class="fa-regular fa-heart"></i></div>
                            <p class="text-red-400">：{{ $post->likeCount() }}</p>
                        @endauth
                    </h2>
                    <div class="flex">
                        <p class="text-2xl">{{ $post->user->name }}</p>
                        <p class='text-2xl ml-auto mr-2'>大学名:{{ $post->user->university_name }}</p>
                        <p class='text-2xl'>{{ $post->user->faculty }}</p>
                    </div>
                    <div class="flex">
                        <p class='os'>{{ $post->os }}</p>
                        <span class='ml-auto'>投稿日:{{ $post->created_at->format('Y-m-d') }}</span>
                    </div>
                    <div>
                        おすすめ度<i class="text-yellow-400 fa-solid fa-star"></i>×{{ $post->star_rating }}
                    </div>
                    <div class="flex justify-center">
                        <a class="p-4 bg-white hover:bg-gray-300 rounded transition duration-500 ease-in-out" href="/posts/{{ $post->id }}">記事の詳細を見る</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class='flex justify-center'>
        {{ $posts->links() }}
    </div>
</x-app-layout>
