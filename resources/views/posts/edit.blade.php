<x-app-layout>
    <x-slot name="header">
        <div class='text-4xl'>編集画面</div>
    </x-slot>
    <div class="py-12">
        <div class='max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6'>
            <div class='p-4 sm:p-8 bg-white shadow sm:rounded-lg'>
                <form action="/posts/{{ $post->id }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="title">
                        <div class="">タイトル</div>
                        <input type="text" name="post[title]" class="w-full" placeholder="タイトル" value="{{ $post->title }}"/>
                    </div>
                    <div class="body">
                        <h2>Body</h2>
                        <textarea name="post[body]" class="w-full" placeholder="・どの講義でも必ずパソコンを使うため、バッテリーの持ちが悪くて大変">{{ $post->body }}</textarea>
                    </div>
                    <div>
                        @if ($post->image_path)
                            <div>編集前の画像</div>
                            <img src="{{ $post->image_path }}" alt="記事の画像">
                            <input type="checkbox" name="image_delete">編集前の画像を削除しますか？
                            <div class="text-red-400">*新しい画像を入れる場合、チェックをしていなくても編集前の画像は削除されます</div>
                        @endif
                        <input type="file" name="image" id="imageInput">
                        <img id="imagePreview" src="#" alt="プレビュー画像" style="display:none; max-width: 200px; max-height: 200px;">
                    </div>
                    <div class='flex-none sm:flex'>
                        <div class='p-4 mb-2 bg-gray-50 shadow sm:rounded-lg'>
                            <h2>osを選択してください <i class="fa-solid fa-desktop"></i></i></h2>
                            <input type="radio" name="post[os]" value="Mac" id="mac" {{ $post->os === 'Mac' ? 'checked' : '' }}>
                            <label for="option1">Mac</label>
                            <input type="radio" name="post[os]" value="Windows" id="Windows" {{ $post->os === 'Windows' ? 'checked' : '' }}>
                            <label for="option2">Windows</label>
                        </div>
                        <div class='p-4 mb-2 bg-gray-50 shadow sm:rounded-lg'>
                            <h2>値段を選択してください <i class="text-yellow-400 fa-solid fa-sack-dollar"></i></h2>
                            <input type="radio" name="post[cost]" value="8万円以下" id="cost1" {{ $post->cost === '8万円以下' ? 'checked' : '' }}>
                            <label for="option1">8万円以下</label>
                            <input type="radio" name="post[cost]" value="8万円~12万円" id="cost2" {{ $post->cost === '8万円~12万円' ? 'checked' : '' }}>
                            <label for="option2">8~12万円</label>
                            <input type="radio" name="post[cost]" value="12万円以上" id="cost3" {{ $post->cost === '12万円以上' ? 'checked' : '' }}>
                            <label for="option3">12万円以上</label>
                        </div>
                    </div>
                    <div class='flex-none sm:flex'>
                        <div class='p-4 mb-2 bg-gray-50 shadow sm:rounded-lg'>
                            <h2>重さを選択してください <i class="fa-solid fa-weight-hanging"></i></h2>
                            <input type="radio" name="post[weight]" value="1.5kg以下" id="weight1" {{ $post->weight === '1.5kg以下' ? 'checked' : '' }}>
                            <label for="option1">1.5kg以下</label>
                            <input type="radio" name="post[weight]" value="1.5~2kg" id="weight2" {{ $post->weight === '1.5~2kg' ? 'checked' : '' }}>
                            <label for="option2">1.5~2kg</label>
                            <input type="radio" name="post[weight]" value="2kg以上" id="weight3" {{ $post->weight === '2kg以上' ? 'checked' : '' }}>
                            <label for="option3">2kg以上</label>
                        </div>
                        <div class='p-4 mb-2 bg-gray-50 shadow sm:rounded-lg'>
                            <h2>バッテリーの持続時間を選択してください <i class="text-green-400 fa-solid fa-battery-three-quarters"></i></h2>
                            <input type="radio" name="post[battery]" value="3時間以下" id="battery1" {{ $post->battery === '3時間以下' ? 'checked' : '' }}>
                            <label for="option1">3時間以下</label>
                            <input type="radio" name="post[battery]" value="3時間~6時間" id="battery2" {{ $post->battery === '3時間~6時間' ? 'checked' : '' }}>
                            <label for="option2">3時間~6時間</label>
                            <input type="radio" name="post[battery]" value="6時間以上" id="battery3" {{ $post->battery === '6時間以上' ? 'checked' : '' }}>
                            <label for="option3">6時間以上</label>
                        </div>
                    </div>
                    <input type="hidden" name="post[user_id]" value="{{ $user->id }}">
                    
                    <input type="submit" value="store"/>
                </form>
            </div>
        </div>
    </div>
    <div class="footer">
        <a class="ml-2 px-4 py-2 bg-gray-200 rounded" href="/">戻る</a>
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