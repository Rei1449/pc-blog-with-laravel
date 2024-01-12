<x-guest-layout>
<section>
    <div class="flex flex-col justify-center min- py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-3xl font-extrabold text-center text-neutral-600">ユーザー登録</h2>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="px-4 py-8 sm:px-10">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700"> 名前 </label>
                        <div class="mt-1">
                            <input id="name" name="name" type="text" autocomplete="name" required class="block w-full px-5 py-3 text-base text-neutral-600 placeholder-gray-300 transition duration-500 ease-in-out transform border border-transparent rounded-lg bg-gray-50 focus:outline-none focus:border-transparent focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-300">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700"> メールアドレス </label>
                        <div class="mt-1">
                            <input id="email" name="email" type="email" autocomplete="email" required class="block w-full px-5 py-3 text-base text-neutral-600 placeholder-gray-300 transition duration-500 ease-in-out transform border border-transparent rounded-lg bg-gray-50 focus:outline-none focus:border-transparent focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-300">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700"> パスワード </label>
                        <div class="mt-1">
                            <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full px-5 py-3 text-base text-neutral-600 placeholder-gray-300 transition duration-500 ease-in-out transform border border-transparent rounded-lg bg-gray-50 focus:outline-none focus:border-transparent focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-300">
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                    </div>
                    
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700"> パスワード確認用 </label>
                        <div class="mt-1">
                            <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="current-password" required class="block w-full px-5 py-3 text-base text-neutral-600 placeholder-gray-300 transition duration-500 ease-in-out transform border border-transparent rounded-lg bg-gray-50 focus:outline-none focus:border-transparent focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-300">
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                    </div>
                    
                    <div class="mt-1">
                        <div class="block text-sm font-medium text-gray-700">大学かその他かを選択してください</div>
                    </div>
                    
                    <div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700">
                        <input id="radio-1" type="radio" value="university" name="grade" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="radio-1" class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">大学生</label>
                    </div>
                    <div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700">
                        <input checked id="radio-2" type="radio" value="other" name="grade" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="radio-2" class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">その他</label>
                    </div>
                    <x-input-error :messages="$errors->get('grade')" class="mt-2" />
                    
                    <div>
                        <label for="university_name" class="block text-sm font-medium text-gray-700"> 大学名・学部（大学を選択した方のみ） </label>
                        <div class="mt-1">
                            <input id="university_name" name="university_name" type="text" autocomplete="university_name" class="block w-full px-5 py-3 text-base text-neutral-600 placeholder-gray-300 transition duration-500 ease-in-out transform border border-transparent rounded-lg bg-gray-50 focus:outline-none focus:border-transparent focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-300">
                            <x-input-error :messages="$errors->get('university_name')" class="mt-2" />
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between">

                        <div class="text-sm">
                            <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500"> 登録済みの方はこちら </a>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="flex items-center justify-center w-full px-10 py-4 text-base font-medium text-center text-white transition duration-500 ease-in-out transform bg-blue-600 rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">登録</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
</x-guest-layout>