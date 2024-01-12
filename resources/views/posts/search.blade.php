<x-app-layout>
    <div class="bg-white py-6 sm:py-8 lg:py-12">
      <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
        <!-- text - start -->
        <div class="mb-10 md:mb-16">
            <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-6 lg:text-3xl">投稿一覧</h2>
            <p class="mx-auto max-w-screen-md text-center text-gray-500 md:text-lg">PC名or大学名で検索できます</p>
            <form action="{{ route('search') }}" method="GET" class="mx-auto grid max-w-screen-md gap-4 sm:grid-cols-2">
                <x-text-input id="search" name="keyword" type="text" class="mt-1 block w-full flex-shrink-0" placeholder="大学名または記事のタイトルを入力してください" />
                
                <div class="flex items-center text-center justify-center"> <!-- flexを追加 -->
                    <button type="submit" class="ml-2 px-4 py-2 bg-black text-white rounded">検索</button>
                </div>
            </form>

        </div>
        <!-- text - end -->
    
        <div class="grid gap-4 sm:grid-cols-2 md:gap-6 lg:grid-cols-3 xl:grid-cols-4 xl:gap-8">
            @foreach ($posts as $post)
          <!-- article - start -->
                <div class="flex flex-col overflow-hidden rounded-lg border bg-white">
                    <a href="/posts/{{ $post->id }}" class="group relative block h-48 overflow-hidden bg-gray-100 md:h-64">
                        <img src="{{ $post->image_path }}" loading="lazy" alt="Photo by Minh Pham" class="absolute inset-0 h-full w-full object-cover object-center transition duration-200 group-hover:scale-110" />
                    </a>
    
                    <div class="flex flex-1 flex-col p-4 sm:p-6">
                        <h2 class="mb-2 text-lg font-semibold text-gray-800">
                            <a href="/posts/{{ $post->id }}" class="transition duration-100 hover:text-indigo-500 active:text-indigo-600">{{ $post->title }}</a>
                        </h2>
    
              <!--<p class="mb-8 text-gray-500">This is a section of some simple filler text, also known as placeholder text. It shares some characteristics of a real written text.</p>-->
    
              <div class="mt-auto flex items-end justify-between">
                <div class="flex items-center gap-2">
                  <div>
                    <span class="block text-indigo-500">{{ $post->user->name }}</span>
                    <span class="block text-sm text-gray-400">{{ $post->user->university_name }}</span>
                    <span class="block text-sm text-gray-400">投稿日:{{ $post->created_at->format('Y-m-d') }}</span>
                  </div>
                </div>
    
                <span class="rounded border px-2 py-1 text-sm text-gray-500">
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
                </span>
              </div>
            </div>
          </div>
          <!-- article - end -->
          @endforeach
        </div>
        
        <div class="my-4">
            {{ $posts->links() }}
        </div>

      </div>
    </div>
</x-app-layout>