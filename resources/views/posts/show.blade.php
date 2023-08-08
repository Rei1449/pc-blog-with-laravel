<x-app-layout>
    <x-slot name="header">
        <div class='text-4xl'>記事詳細</div>
    </x-slot>
    <div class="py-12">
        <div class='max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6'>
            <div class="content">
                <div class="sm:flex sm:justify-center">
                    <div class='p-4 sm:p-8 bg-white shadow sm:rounded-lg mb-2 w-auto'>
                        <div class='text-4xl text-center font-bold break-words'>{{ $post->title }}</div>
                    </div>
                </div>
                <div class="sm:flex justify-between">
                    <div class='p-4 bg-white shadow sm:rounded-lg mb-2 w-auto'>
                        <div class='text-2xl text-center'>投稿者：{{ $post->user->name }}</div>
                    </div>
                    <div class='p-4 bg-white shadow sm:rounded-lg mb-2 w-auto'>
                        <div class='text-2xl text-center'>大学名 <i class="fa-solid fa-school"></i>：{{ $post->user->university_name }}{{ $post->user->faculty }}</div>
                    </div>
                </div>
                 <div class="sm:flex justify-between">
                    <div class='p-4 sm:p-8 bg-white shadow sm:rounded-lg mb-2 w-auto'>
                        <div class='text-2xl text-center'>おすすめ度：<i class="text-yellow-400 fa-solid fa-star"></i>×{{ $post->star_rating }}</div>
                    </div>
                    <div class='p-4 sm:p-8 bg-white shadow sm:rounded-lg mb-2 w-auto'>
                        <div class='text-2xl text-center'>OS <i class="fa-solid fa-desktop"></i>：{{ $post->os }}</div>
                    </div>
                </div>
                <div class="sm:flex justify-between">
                    <div class='p-4 sm:p-8 bg-white shadow sm:rounded-lg mb-2 w-auto'>
                        <div class='text-2xl text-center'>値段帯 <i class="text-yellow-400 fa-solid fa-sack-dollar"></i>：{{ $post->cost }}</div>
                    </div>
                    <div class='p-4 sm:p-8 bg-white shadow sm:rounded-lg mb-2 w-auto'>
                        <div class='text-2xl text-center'>重量 <i class="fa-solid fa-weight-hanging"></i>：{{ $post->weight }}</div>
                    </div>
                    <div class='p-4 sm:p-8 bg-white shadow sm:rounded-lg mb-2 w-auto'>
                        <div class='text-2xl text-center'>バッテリー駆動目安時間 <i class="text-green-400 fa-solid fa-battery-three-quarters"></i>：{{ $post->battery }}</div>
                    </div>
                </div>
                <div class='p-4 sm:p-8 bg-white shadow sm:rounded-lg mb-2'>
                    <p class='text-2xl text-center'>使った感想、お勧めできる点・できない点など</p>
                    <br>
                    <p class='text-lg break-words'>{{ $post->body }}</p>
                    @if ($post->purchase_path)
                        <br>
                        <div class=''><a href='{{ $post->purchase_path }}'>購入する<i class="fa-solid fa-arrow-up-right-from-square"></i></a><span class='text-red-600'><br>※URLが古い場合があります。また、在庫がない場合があります。　</span><a href='{{ $post->purchase_path }}'><i class="fa-solid fa-arrow-up-right-from-square"></i></a></div>
                    @endif
                </div>
                @if ($post->image_path)
                        <div class="sm:flex sm:justify-center">
                            <img class='h-custom' src="{{ $post->image_path }}" alt="記事の画像">
                        </div>
                        
                @endif
                <div class="sm:flex justify-end my-2">
                    <div class='p-4 bg-white shadow sm:rounded-lg mb-2 w-auto'>
                        <div class='text-lg text-center'>投稿日：{{ $post->created_at->format('Y-m-d') }}</div>
                    </div>
                </div>
                @auth
                    @if($post->user->name == Auth::user()->name)
                        <div class='flex justify-between'>
                            <div class="bg-blue-500 hover:bg-blue-800 text-white p-2 rounded my-2 ml-4 transition duration-500 ease-in-out"><a href="/posts/{{ $post->id }}/edit">編集</a></div>
                            <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="button" onclick="deletePost({{ $post->id }})" class="bg-red-500 hover:bg-red-800 text-white p-2 rounded my-2 mr-4 transition duration-500 ease-in-out">削除</button> 
                            </form>
                        </div>
                    @endif
                    <div class="flex">
                        <button id="commentButton" class="bg-gray-900 hover:bg-gray-500 text-white p-2 rounded mb-2 transition duration-500 ease-in-out">コメントする</button>
                        <div class="flex ml-auto text-4xl">
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
                            <div class="sm:flex sm:justify-center">
                                <div class='p-4 sm:p-8 bg-white shadow sm:rounded-lg mb-2 w-1/2'>
                                    <div class='text-lg text-center'>コメント内容</div>
                                    <br>
                                    <div class='flex justify-center'>
                                        <textarea name="comment[body]" placeholder="質問内容を入力してください。" class='w-full'></textarea>
                                    </div>
                                    
                                    <input type="hidden" name="comment[user_id]" value="{{ $user->id }}">
                                    <input type="hidden" name="comment[post_id]" value="{{ $post->id }}">
                                    <div class='flex justify-center'>
                                        <input type="submit" class="mt-3 px-4 py-2 bg-blue-300 hover:bg-blue-700 rounded transition duration-500 ease-in-out" value="送信"/>
                                    </div>
                                    
                                </div>
                            </div>
                        </form>
                    </div>
                @endauth
                <div class="py-12">
                    <div class='max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6'>
                        @if ($post->comments->count() > 0)
                            <div class='text-2xl'>コメント一覧</div>
                            @foreach ($post->comments as $comment)
                                <div class='p-4 sm:p-8 bg-white shadow sm:rounded-lg'>
                                    <p class='break-words'>{{ $comment->body }}</p>
                                    <div class="flex justify-between">
                                        <p>ユーザ名: {{ $comment->user->name }}</p>
                                        <span>投稿日：{{ $comment->created_at->format('Y-m-d') }}</span>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <a class="ml-2 px-4 py-2 bg-gray-300 hover:bg-gray-500 rounded transition duration-500 ease-in-out mb-2" href="/">戻る</a>
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