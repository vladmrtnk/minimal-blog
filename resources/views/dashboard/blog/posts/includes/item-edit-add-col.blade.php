@php
    /** @var \App\Models\Blog\Post $item */
    /** @var Illuminate\Support\Collection $categoryList */
@endphp

<div class="mb-6 p-4 border border-gray-300 rounded-lg">
    <button type="submit" form="edit-post-form"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        {{ __('Save') }}
    </button>
</div>

@if($item->exists)
    <div class="mb-6 p-4 border border-gray-300 rounded-lg">
        <p>ID: {{ $item->id }}</p>
    </div>
    <div class="mb-6 p-4 border border-gray-300 rounded-lg">
        <div class="mb-6">
            <label for="created_at"
                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">{{ __('Created at') }}</label>
            <input type="text" id="created_at"
                   class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   value="{{ $item->created_at }}" disabled="" readonly="">
        </div>
        <div class="mb-6">
            <label for="updated_at"
                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">{{ __('Updated at') }}</label>
            <input type="text" id="updated_at"
                   class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   value="{{ $item->updated_at }}" disabled="" readonly="">
        </div>
        <div class="mb-6">
            <label for="deleted_at"
                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">{{ __('Deleted at') }}</label>
            <input type="text" id="deleted_at"
                   class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   value="{{ $item->deleted_at }}" disabled="" readonly="">
        </div>
    </div>
@endif