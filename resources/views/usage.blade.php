<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('使い方') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 sm:flex">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg sm:w-1/2">
                <div class="p-6 text-gray-900">
                    {{ __("高校生・その他（見る専）") }}
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg sm:ml-12 sm:w-1/2">
                <div class="p-6 text-gray-900">
                    {{ __("大学生（投稿者）") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>