<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <div class="flex">
                <x-input-label for="name" :value="__('名前（表示名）')" />
                <span class="text-red-600">*</span>
            </div>
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="ほかの人に見えるため、常識的な名前でお願いします"/>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <div class="flex">
                <x-input-label for="email" :value="__('メールアドレス')" />
                <span class="text-red-600">*</span>
            </div>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="例)abc@gmail.com"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <div class="flex">
                <x-input-label for="password" :value="__('パスワード(8文字以上)')" />
                <span class="text-red-600">*</span>
            </div>

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <div class="flex">
                <x-input-label for="password_confirmation" :value="__('パスワード確認用')" />
                <span class="text-red-600">*</span>
            </div>

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Grade -->
        <div class="mt-4">
            <div class="flex">
                <x-input-label :value="__('学年')" />
                <span class="text-red-600">*</span>
            </div>
            <div>
                <label class="inline-flex items-center">
                    <input type="radio" class="form-radio" name="grade" value="high_school" {{ old('grade') === 'high_school' ? 'checked' : '' }}>
                    <span class="ml-2">{{ __('高校') }}</span>
                </label>
                <label class="inline-flex items-center ml-4">
                    <input type="radio" class="form-radio" name="grade" value="university" {{ old('grade') === 'university' ? 'checked' : '' }}>
                    <span class="ml-2">{{ __('大学') }}</span>
                </label>
            </div>
            <x-input-error :messages="$errors->get('grade')" class="mt-2" />
        </div>
        
        <div class="mt-4 text-red-500">
            以下は大学を選択した方のみ
        </div>
        <!-- University Name -->
        <div class="mt-4">
            <div class="flex">
                <x-input-label for="university_name" :value="__('学校名')" />
                <span class="text-red-600">*</span>
            </div>
            <x-text-input id="university_name" class="block mt-1 w-full" type="text" name="university_name" :value="old('university_name')" placeholder="正式名称を入力してください！"/>
            <x-input-error :messages="$errors->get('university_name')" class="mt-2" />
        </div>

        <!-- Humanities or Science -->
        <div class="mt-4">
            <div class="flex">
                <x-input-label :value="__('文理選択')" />
                <span class="text-red-600">*</span>
            </div>
            <div>
                <label class="inline-flex items-center">
                    <input type="radio" class="form-radio" name="humanities_or_science" value="humanities" {{ old('humanities_or_science') === 'humanities' ? 'checked' : '' }}>
                    <span class="ml-2">{{ __('文系') }}</span>
                </label>
                <label class="inline-flex items-center ml-4">
                    <input type="radio" class="form-radio" name="humanities_or_science" value="science" {{ old('humanities_or_science') === 'science' ? 'checked' : '' }}>
                    <span class="ml-2">{{ __('理系') }}</span>
                </label>
                <label class="inline-flex items-center ml-4">
                    <input type="radio" class="form-radio" name="humanities_or_science" value="speciality" {{ old('humanities_or_science') === 'speciality' ? 'checked' : '' }}>
                    <span class="ml-2">{{ __('専門') }}</span>
                </label>
            </div>
            <x-input-error :messages="$errors->get('humanities_or_science')" class="mt-2" />
        </div>

        <!-- Faculty -->
        <div class="mt-4">
            <x-input-label for="faculty" :value="__('学部')" />
            <x-text-input id="faculty" class="block mt-1 w-full" type="text" name="faculty" :value="old('faculty')" />
            <x-input-error :messages="$errors->get('faculty')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
