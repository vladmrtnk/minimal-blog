<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <a href="{{ route('dashboard.blog.posts.create') }}"
                           class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            {{ __('Add') }}
                        </a>
                    </div>
                    <div>
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    #
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{ __('Category') }}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{ __('Post') }}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{ __('Excerpt') }}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only">{{ __('Edit') }}</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($paginator as $item)
                                @php /** @var \App\Models\Blog\Post $item */ @endphp
                                <tr class="bg-white dark:bg-gray-800 @if(!$loop->last) border-b dark:border-gray-700 @endif">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                        {{ $item->id }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $item->category->title }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->title }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->excerpt }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="{{ route('dashboard.blog.posts.edit', $item->id) }}"
                                           class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div>
                        {{ $paginator->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>