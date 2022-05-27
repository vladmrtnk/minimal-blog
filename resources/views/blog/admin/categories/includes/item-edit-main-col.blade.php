@php
    /** @var App\Models\BlogCategory $item */
    /** @var Illuminate\Support\Collection $categoryList */
@endphp
@if($item->exists)
<form method="post" id="edit-category-form" action="{{ route('blog.admin.categories.update', $item->id) }}">
    @method('PATCH')
@else
<form method="post" id="edit-category-form" action="{{ route('blog.admin.categories.store') }}">
    @method('post')
@endif
    @csrf
    <div class="mb-6">
        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Заголовок</label>
        <input name="title" value="{{ old('title', $item->title) }}" type="text" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Заголовок" required="">
    </div>
    <div class="mb-6">
        <label for="slug" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Ідентифікатор</label>
        <input name="slug" value="{{ old('slug', $item->slug) }}" type="text" id="slug" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ідентифікатор">
    </div>
    <div class="mb-6">
        <label for="parent-category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Батько</label>
        <select name="parent_id" id="parent-category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            @foreach($categoryList as $categoryOption)
                <option value="{{ $categoryOption->id }}" @if($categoryOption->id == $item->parent_id) selected @endif>{{ $categoryOption->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-6">
        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Опис</label>
        <textarea name="description" id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Введіть опис...">
            {{ old('description', $item->description) }}
        </textarea>
    </div>
</form>