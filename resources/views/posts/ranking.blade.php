<x-app-layout>
    @php
        $counter = 1;
    @endphp
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
                        <span class="font-bold">{{ $counter }}位：</span>
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
                        <span class='created_at ml-auto'>投稿日:{{ $post->created_at->format('Y-m-d') }}</span>
                    </div>
                    <a href='/posts/{{ $post->id }}/comment'>コメント</a>
                    @php
                        $counter++;
                    @endphp
                </div>
            @endforeach
        </div>
    </div>
    <div class='flex justify-center'>
        {{ $posts->links() }}
    </div>
</x-app-layout>