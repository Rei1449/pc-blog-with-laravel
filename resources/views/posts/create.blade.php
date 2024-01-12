<x-app-layout>
<div class="bg-white py-6 sm:py-8 lg:py-12">
    <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
    <!-- text - start -->
        <div class="mb-10 md:mb-16">
            <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-6 lg:text-3xl">記事を投稿する</h2>

            <p class="mx-auto max-w-screen-md text-center text-gray-500 md:text-lg">記事を投稿して自分のパソコンを紹介しましょう！</p>
        </div>
    <!-- text - end -->

    <!-- form - start -->
        <form action="/posts" method="POST" enctype="multipart/form-data" class="mx-auto grid max-w-screen-md gap-4 sm:grid-cols-2">
            @csrf
            <!-- pc-name -->
            <div class="sm:col-span-2">
                <label for="title" class="mb-2 inline-block text-sm text-gray-800 sm:text-base"><span class="text-red-600">*</span>PC名</label>
                <input required name="post[title]" id=title class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" />
            </div>
            <!-- image -->
            <label class="sm:col-span-2 block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="imageInput"><span class="text-red-600">*</span>パソコンの写真ををアップロードしてください</label>
            <input required class="sm:col-span-2 block w-full mb-2 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="imageInput" type="file" name="image" accept="image/png, image/jpeg, image/jpg">
            <p class="sm:col-span-2 mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNGかJPGかJPEGをアップロードしてください。</p>
            <img id="imagePreview" alt="プレビュー画像" style="display:none; max-width: 300px; max-height: 300px;" class="sm:col-span-2">
            <!-- os -->
            <h3 class="sm:col-span-2 mb-4 text-sm text-gray-800 sm:text-base"><span class="text-red-600">*</span>os</h3>
            <ul class="sm:col-span-2 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                    <div class="flex items-center ps-3">
                        <input required id="windows" type="radio" value="Windows" name="post[os]" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="windows" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Windows</label>
                    </div>
                </li>
                <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                    <div class="flex items-center ps-3">
                        <input id="mac" type="radio" value="MAC" name="post[os]" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="mac" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">MAC</label>
                    </div>
                </li>
            </ul>
            <!-- cost -->
            <h3 class="sm:col-span-2 mb-4 text-sm text-gray-800 sm:text-base"><span class="text-red-600">*</span>価格帯</h3>
            <ul class="sm:col-span-2 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                    <div class="flex items-center ps-3">
                        <input required id="cost1" type="radio" value="10万円以下" name="post[cost]" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="cost1" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">10万円以下</label>
                    </div>
                </li>
                <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                    <div class="flex items-center ps-3">
                        <input id="cost2" type="radio" value="10万円～15万円" name="post[cost]" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="cost2" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">10万円～15万円</label>
                    </div>
                </li>
                <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                    <div class="flex items-center ps-3">
                        <input id="cost3" type="radio" value="15万円～20万円" name="post[cost]" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="cost3" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">15万円～20万円</label>
                    </div>
                </li>
                <li class="w-full dark:border-gray-600">
                    <div class="flex items-center ps-3">
                        <input id="cost4" type="radio" value="20万円以上" name="post[cost]" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="cost4" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">20万円以上</label>
                    </div>
                </li>
            </ul>

            <div class="sm:col-span-2">
                <label for="body" class="mb-2 inline-block text-sm text-gray-800 sm:text-base"><span class="text-red-600">*</span>おすすめポイントや使用感など（300字以内）</label>
                <textarea required id="body" name="post[body]" class="h-64 w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring"></textarea>
            </div>
            
            <h3 class="sm:col-span-2 mb-4 text-sm text-gray-800 sm:text-base"><span class="text-red-600">*</span>レビュー</h3>
            <ul class="sm:col-span-2 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                    <div class="flex items-center ps-3">
                        <input required id="star_rating1" type="radio" value="1" name="post[star_rating]" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="star_rating1" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"><i class="text-yellow-400 fa-solid fa-star"></i><span class ="mr-2">1</span></label>
                    </div>
                </li>
                <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                    <div class="flex items-center ps-3">
                        <input id="star_rating2" type="radio" value="2" name="post[star_rating]" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="star_rating2" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"><i class="text-yellow-400 fa-solid fa-star"></i><span class ="mr-2">2</span></label>
                    </div>
                </li>
                <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                    <div class="flex items-center ps-3">
                        <input id="star_rating3" type="radio" value="3" name="post[star_rating]" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="star_rating3" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"><i class="text-yellow-400 fa-solid fa-star"></i><span class ="mr-2">3</span></label>
                    </div>
                </li>
                <li class="w-full dark:border-gray-600">
                    <div class="flex items-center ps-3">
                        <input id="star_rating4" type="radio" value="4" name="post[star_rating]" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="star_rating4" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"><i class="text-yellow-400 fa-solid fa-star"></i><span class ="mr-2">4</span></label>
                    </div>
                </li>
                <li class="w-full dark:border-gray-600">
                    <div class="flex items-center ps-3">
                        <input id="star_rating5" type="radio" value="5" name="post[star_rating]" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="star_rating5" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"><i class="text-yellow-400 fa-solid fa-star"></i><span class ="mr-2">5</span></label>
                    </div>
                </li>
            </ul>
      

            <div class="flex items-center justify-between sm:col-span-2">
                <input class="inline-block rounded-lg bg-indigo-500 px-8 py-3 text-center text-sm font-semibold text-white outline-none ring-indigo-300 transition duration-100 hover:bg-indigo-600 focus-visible:ring active:bg-indigo-700 md:text-base" type="submit" value="投稿"/>
                <span class="text-sm text-gray-500"><span class="text-red-600">*</span>必須</span>
            </div>
            
            <input type="hidden" name="post[user_id]" value="{{ $user->id }}">

        </form>
    </div>
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