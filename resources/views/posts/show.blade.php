<x-app-layout>
    <x-slot name="header">
        <div class='text-4xl'>{{ $post->title }}</div>
    </x-slot>
    <div class="py-12">
        <div class='max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6'>
            <div class="content">
                <div class='p-4 sm:p-8 bg-white shadow sm:rounded-lg mb-2'>
                    <h2 class='title'>{{ $post->title }}</h2>
                    <p class='title'>{{ $post->body }}</p>
                    @if ($post->image_path)
                        <img src="{{ $post->image_path }}" alt="記事の画像">
                    @endif
                    <p class='user_name'>{{ $post->user->name }}</p>
                    <p class='os'>{{ $post->os }}</p>
                    <p class='cost'>{{ $post->cost }}</p>
                    <p class='weight'>{{ $post->weight }}</p>
                    <p class='battery'>{{ $post->battery }}</p>
                    <span class='created_at'>{{ $post->created_at }}</span>
                    @auth
                        @if($post->user->name == Auth::user()->name)
                            <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="button" onclick="deletePost({{ $post->id }})">削除</button> 
                            </form>
                            <div class="edit"><a href="/posts/{{ $post->id }}/edit">編集</a></div>
                        @endif
                    @endauth
                </div>
                @auth
                    <div class="flex">
                        <button id="commentButton" class="bg-black text-white p-2 rounded">コメントする</button>
                        <div class="flex ml-auto text-3xl">
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
                            <p class="text-red-400">：{{ $post->likeCount() }}</p>
                        </div>
                    </div>
                    <div id="commentForm" class="hidden">
                        <form action="/comments" method="POST">
                            @csrf
                            <div class="body">
                                <h2>Body</h2>
                                <textarea name="comment[body]" placeholder="質問内容を入力してください。"></textarea>
                            </div>
                            <input type="hidden" name="comment[user_id]" value="{{ $user->id }}">
                            <input type="hidden" name="comment[post_id]" value="{{ $post->id }}">
                            <input type="submit" value="store"/>
                        </form>
                    </div>
                @endauth
                <div class="py-12">
                    <div class='max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6'>
                        <h3>コメント一覧</h3>
                        @foreach ($post->comments as $comment)
                            <div class='p-4 sm:p-8 bg-white shadow sm:rounded-lg'>
                                <p>{{ $comment->body }}</p>
                                <div class="flex justify-between">
                                    <p>ユーザ名: {{ $comment->user->name }}</p>
                                    <span class='created_at'>{{ $comment->created_at }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <a href="/">戻る</a>
    </div>
    <script>
        function deletePost(id) {
            'use strict'
    
            if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                document.getElementById(`form_${id}`).submit();
            }
        }
    </script>
</x-app-layout>