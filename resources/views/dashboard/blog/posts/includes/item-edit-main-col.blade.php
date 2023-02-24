@php
    /** @var \App\Models\Blog\Post $item */
    /** @var Illuminate\Support\Collection $categoryList */
@endphp

<form method="post" id="edit-post-form"
      action="@if($item->exists) {{ route('dashboard.blog.posts.update', $item->id) }} @else {{ route('dashboard.blog.posts.store') }} @endif">
    @if($item->exists)
        @method('PATCH')
    @else
        @method('POST')
    @endif
    @csrf


    <div class="mb-6">
        <label for="title"
               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('Title') }}</label>
        <input name="title" value="{{ old('title', $item->title) }}" type="text" id="title"
               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
               placeholder="{{ __('Title') }}" required="">
    </div>
    <div class="mb-6">
        <label for="slug"
               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('Slug') }}</label>
        <input name="slug" value="{{ old('slug', $item->slug) }}" type="text" id="slug"
               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
               placeholder="{{ __('Slug') }}">
    </div>
    <div class="mb-6">
        <label for="category"
               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">{{ __('Category') }}</label>
        <select name="category_id" id="category"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            @foreach($categoryList as $categoryOption)
                <option value="{{ $categoryOption->id }}"
                        @if($categoryOption->id == $item->category_id) selected @endif>{{ $categoryOption->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-6">
        <label for="excerpt"
               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('Excerpt') }}</label>
        <input name="excerpt" value="{{ old('excerpt', $item->excerpt) }}" type="text" id="excerpt"
               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
               placeholder="{{ __('Excerpt') }}">
    </div>
    <div class="mb-6">
        <label for="content"
               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">{{ __('Content') }}</label>
        <textarea id="content" name="content">
            {{ old('content', $item->content) }}
        </textarea>
    </div>
</form>

