<x-app-layout>
    <x-slot name="header">
        <div class='text-4xl'>記事編集</div>
    </x-slot>
    <div class="py-12">
        <div class='max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6'>
            <div class='p-4 sm:p-8 bg-white shadow sm:rounded-lg'>
                <form action="/posts/{{ $post->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="title">
                        <div class="text-2xl">PC名<span class="text-red-600">*</span></div>
                        <input type="text" name="post[title]" class="w-full" placeholder="PC名を入れてください" value="{{ $post->title }}"/>
                    </div>
                    <div class="body">
                        <div class="text-2xl">記事内容<span class="text-red-600">*</span></div>
                        <textarea name="post[body]" class="w-full" placeholder="バッテリーの持ちが悪い！,講義では問題なく利用できる！,軽くて持ち運びが楽！など">{{ $post->body }}</textarea>
                    </div>
                    <div>
                        @if ($post->image_path)
                            <div class="text-2xl">編集前の画像</div>
                            <img src="{{ $post->image_path }}" alt="記事の画像">
                            <input type="checkbox" name="image_delete">編集前の画像を削除しますか？
                            <div class="text-red-400">※新しい画像を入れる場合、チェックをしていなくても編集前の画像は削除されます</div>
                        @endif
                        <input type="file" name="image" id="imageInput">
                        <img id="imagePreview" src="#" alt="プレビュー画像" style="display:none; max-width: 200px; max-height: 200px;">
                    </div>
                    <div class="xl:flex">
                        <div class="flex-none sm:flex sm:justify-between">
                            <div class="p-4 mb-2 bg-gray-50 shadow sm:rounded-lg sm:m-0 lg:m-0 xl:m-0">
                                <div>osを選択してください <i class="fa-solid fa-desktop"></i><span class="text-red-600">*</span></div>
                                <input type="radio" name="post[os]" value="Mac" id="mac" {{ $post->os === 'Mac' ? 'checked' : '' }}>
                                <label for="option1">Mac</label>
                                <input type="radio" name="post[os]" value="Windows" id="Windows" {{ $post->os === 'Windows' ? 'checked' : '' }}>
                                <label for="option2">Windows</label>
                            </div>
                            <div class='p-4 mb-2 bg-gray-50 shadow sm:rounded-lg sm:m-0 lg:mr-28 xl:m-0'>
                                <div>値段を選択してください <i class="text-yellow-400 fa-solid fa-sack-dollar"></i><span class="text-red-600">*</span></div>
                                <input type="radio" name="post[cost]" value="8万円以下" id="cost1" {{ $post->cost === '8万円以下' ? 'checked' : '' }}>
                                <label for="option1">8万円以下</label>
                                <input type="radio" name="post[cost]" value="8万円~12万円" id="cost2" {{ $post->cost === '8万円~12万円' ? 'checked' : '' }}>
                                <label for="option2">8~12万円</label>
                                <input type="radio" name="post[cost]" value="12万円以上" id="cost3" {{ $post->cost === '12万円以上' ? 'checked' : '' }}>
                                <label for="option3">12万円以上</label>
                            </div>
                        </div>
                        <div class='flex-none sm:flex sm:justify-between'>
                            <div class='p-4 mb-2 bg-gray-50 shadow sm:rounded-lg sm:m-0 lg:m-0 xl:m-0'>
                                <div>重さを選択してください <i class="fa-solid fa-weight-hanging"></i><span class="text-red-600">*</span></div>
                                <input type="radio" name="post[weight]" value="1.5kg以下" id="weight1" {{ $post->weight === '1.5kg以下' ? 'checked' : '' }}>
                                <label for="option1">1.5kg以下</label>
                                <input type="radio" name="post[weight]" value="1.5~2kg" id="weight2" {{ $post->weight === '1.5~2kg' ? 'checked' : '' }}>
                                <label for="option2">1.5~2kg</label>
                                <input type="radio" name="post[weight]" value="2kg以上" id="weight3" {{ $post->weight === '2kg以上' ? 'checked' : '' }}>
                                <label for="option3">2kg以上</label>
                            </div>
                            <div class='p-4 mb-2 bg-gray-50 shadow sm:rounded-lg sm:m-0 lg:mr-28 xl:m-0'>
                                <div>バッテリーの持続時間を選択してください <i class="text-green-400 fa-solid fa-battery-three-quarters"></i><span class="text-red-600">*</span></div>
                                <input type="radio" name="post[battery]" value="3時間以下" id="battery1" {{ $post->battery === '3時間以下' ? 'checked' : '' }}>
                                <label for="option1">3時間以下</label>
                                <input type="radio" name="post[battery]" value="3時間~6時間" id="battery2" {{ $post->battery === '3時間~6時間' ? 'checked' : '' }}>
                                <label for="option2">3時間~6時間</label>
                                <input type="radio" name="post[battery]" value="6時間以上" id="battery3" {{ $post->battery === '6時間以上' ? 'checked' : '' }}>
                                <label for="option3">6時間以上</label>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="mt-3">購入用URL</div>
                        <input type="text" name="post[purchase_path]" class="w-full" placeholder="PCが購入できるURLを入れてください(公式サイト、Amazonなど)" value="{{ $post->purchase_path }}"/>
                    </div>
                    <div class="flex justify-center sm:justify-start">
                        <div class='p-4 my-2 bg-gray-100 shadow sm:rounded-lg w-custom'>
                            <div>おすすめ度を選択してください(5が高く、1が小さい評価です)<i class="text-yellow-400 fa-solid fa-star"></i><span class="text-red-600">*</span></div>
                            <input type="radio" name="post[star_rating]" value="1" id="star_rating1" {{ $post->star_rating === '星1' ? 'checked' : '' }}>
                            <label for="option1"><i class="text-yellow-400 fa-solid fa-star"></i><span class ="mr-2">1</span></label>
                            <input type="radio" name="post[star_rating]" value="2" id="star_rating2" {{ $post->star_rating === '星2' ? 'checked' : '' }}>
                            <label for="option2"><i class="text-yellow-400 fa-solid fa-star"></i><span class ="mr-2">2</span></label>
                            <input type="radio" name="post[star_rating]" value="3" id="star_rating3" {{ $post->star_rating === '星3' ? 'checked' : '' }}>
                            <label for="option3"><i class="text-yellow-400 fa-solid fa-star"></i><span class ="mr-2">3</span></label>
                            <input type="radio" name="post[star_rating]" value="4" id="star_rating4" {{ $post->star_rating === '星4' ? 'checked' : '' }}>
                            <label for="option4"><i class="text-yellow-400 fa-solid fa-star"></i><span class ="mr-2">4</span></label>
                            <input type="radio" name="post[star_rating]" value="5" id="star_rating5" {{ $post->star_rating === '星5' ? 'checked' : '' }}>
                            <label for="option5"><i class="text-yellow-400 fa-solid fa-star"></i><span class ="mr-2">5</span></label>
                        </div>
                    </div>
                    <div class="text-red-400">「<span class="text-red-600">*</span>」がついているものは必ず記入or選択してください！</div>
                    <input type="hidden" name="post[user_id]" value="{{ $user->id }}">
                    
                    <input class="mt-3 px-4 py-2 bg-blue-300 hover:bg-blue-700 rounded w-full transition duration-500 ease-in-out" type="submit" value="保存"/>
                </form>
            </div>
        </div>
    </div>
    <div class="footer">
        <a class="ml-2 px-4 py-2 bg-gray-300 hover:bg-gray-500 rounded transition duration-500 ease-in-out" href="/">戻る</a>
    </div>
    <script>
        document.getElementById('imageInput').addEventListener('change', function () {
            const fileInput = this;
            const imgPreview = document.getElementById('imagePreview');
    
            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();
    
                reader.onload = function (e) {
                    imgPreview.src = e.target.result;
                    imgPreview.style.display = 'block';
                }
    
                reader.readAsDataURL(fileInput.files[0]);
            } else {
                imgPreview.src = '#';
                imgPreview.style.display = 'none';
            }
        });
    </script>
</x-app-layout>