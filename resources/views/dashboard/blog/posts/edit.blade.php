
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if($item->exists)
                {{ __("Edit \"{$item->title}\"") }}
            @else
                {{ __('Add new post') }}
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex">
                    <div class="w-2/3">
                        @php
                            /** @var \Illuminate\Support\ViewErrorBag $errors */
                        @endphp

                        @if(session('success'))
                            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                                {{ session()->get('success') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        @include('dashboard.blog.posts.includes.item-edit-main-col')
                    </div>
                    <div class="w-1/3 pl-6">
                        @include('dashboard.blog.posts.includes.item-edit-add-col')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>