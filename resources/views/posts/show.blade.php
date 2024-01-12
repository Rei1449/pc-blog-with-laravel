<x-app-layout>
    <div class="bg-white py-6 sm:py-8 lg:py-12">
        <div class="mx-auto max-w-screen-xl px-4 md:px-8">
            <div class="grid gap-8 md:grid-cols-2 lg:gap-12">
                <div>
                    <div class="h-64 overflow-hidden rounded-lg bg-gray-100 shadow-lg md:h-auto">
                        <img src="{{ $post->image_path }}" loading="lazy" alt="Photo by Martin Sanchez" class="h-full w-full object-cover object-center" />
                    </div>
                </div>
    
                <div class="md:pt-8">
                    <p class="text-center font-bold text-indigo-500 md:text-left"></p>
    
                    <h1 class="mb-4 text-center text-2xl font-bold text-gray-800 sm:text-3xl md:mb-6 md:text-left">{{ $post->title }}</h1>
                    @auth
                        @if (Auth::user()->id == $post->user->id)
                            <div class="grid grid-cols-2">
                                <button class="my-8 py-1.5 px-4 transition-colors bg-gray-50 border active:bg-green-800 font-medium border-gray-200 hover:text-white text-green-600 hover:border-green-700 rounded-lg hover:bg-green-600 disabled:opacity-50">
                                    <a href="/posts/{{ $post->id }}/edit">編集</a>
                                </button>
                                <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post" class="text-center">
                                    @csrf
                                    @method('delete')
                                    <button onclick="deletePost({{ $post->id }})" class="my-8 py-1.5 px-4 transition-colors bg-gray-50 border active:bg-red-800 font-medium border-gray-200 hover:text-white text-red-600 hover:border-red-700 rounded-lg hover:bg-red-600 disabled:opacity-50">
                                        削除する
                                    </button>
                                </form>
                            </div>
                        @else
                        <div class="text-center">
                            @if (!Auth::user()->is_like($post->id))
                            <form action="{{ route('like.store', $post) }}" method="post">
                                @csrf
                                <button class="my-8 py-1.5 px-4 transition-colors bg-gray-50 border font-medium border-gray-200 hover:text-white text-pink-300 hover:border-pink-400 rounded-lg hover:bg-pink-400 disabled:opacity-50"><i class="fa-regular fa-heart"></i>：{{ $post->likeCount() }}</button>
                            </form>
                            @else
                            <form action="{{ route('like.destroy', $post) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="my-8 py-1.5 px-4 transition-colors bg-pink-400 border font-mediumborder-pink-400 hover:text-pink-300 text-white hover:border-gray-200 rounded-lg hover:bg-gray-50 disabled:opacity-50"><i class="fa-solid fa-heart"></i>：{{ $post->likeCount() }}</button>
                            </form>
                            @endif
                        </div>
                        @endif
                    @endauth
            
                    <table class="border-collapse table-auto w-full text-sm my-5">
                        <thead>
                            <tr>
                                <th>価格帯</th>
                                <th>OS</th>
                                <th>レビュー数</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td>{{ $post->cost }}</td>
                                <td>{{ $post->os }}</td>
                                <td><i class="text-yellow-400 fa-solid fa-star"></i>{{ $post->star_rating }}</td>
                            </tr>
                        </tbody>
                    </table>
            
                    <p class="mb-6 text-gray-500 sm:text-lg md:mb-8">{{ $post->body }}</p>
            
                    <h2 class="mb-2 text-center text-xl font-semibold text-gray-800 sm:text-2xl md:mb-4 md:text-left">コメント</h2>
                    @auth
                    <button id="commentButton" class="my-8 py-1.5 px-4 transition-colors bg-gray-50 border active:bg-blue-800 font-medium border-gray-200 hover:text-white text-blue-600 hover:border-blue-700 rounded-lg hover:bg-blue-600 disabled:opacity-50">
                        コメントする
                    </button>
            
                    <div id="commentForm" class="hidden">
                        <form action="/comments" method="POST">
                            @csrf
                            <div class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                                <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
                                    <textarea id="comment" rows="4" name="comment[body]" class="w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400" placeholder="質問したい内容を送ってください" required></textarea>
                                </div>
                                <input type="hidden" name="comment[user_id]" value="{{ $user->id }}">
                                <input type="hidden" name="comment[post_id]" value="{{ $post->id }}">
                                <div class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600">
                                    <button type="submit" class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                                        コメントを送る
                                    </button>
                                   
                                </div>
                            </div>
                        </form>
                    </div>
                    @endauth
                    @if ($post->comments->count() > 0)
                        @foreach ($post->comments as $comment)
                            <p class="mb-6 text-gray-500 sm:text-lg md:mb-8">{{ $comment->body }}</p>
                            <div class="flex justify-between">
                                <p class="mb-6 text-gray-400 sm:text-lg md:mb-8">ユーザ名: {{ $comment->user->name }}</p>
                                <span class="mb-6 text-gray-400 sm:text-lg md:mb-8">投稿日：{{ $comment->created_at->format('Y-m-d') }}</span>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="my-8 ml-5">
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