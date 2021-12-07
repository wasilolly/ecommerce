@extends('admin.dashboard')

@section('content')
    <main class="h-full overflow-y-auto">
        <div class="container px-6 mx-auto grid mb-5">
            
            <!--Update Form -->
            <form action="{{ route('category.update', ['category' => $category]) }}" method="post">
                @csrf
                @method('PATCH')
                <div class="flex flex-row">
                    <div>
                        <x-label for="name" :value="__('Name')" />
                        <x-input class="block mt-1 w-full" type="text" name="name" :value="$category->name" required
                            autofocus />
                    </div>
                    <div class="ml-5">
                        <x-label for="description" :value="__('Description')" />
                        <textarea class="block mt-1 w-full" name="description" cols="60" rows="5" required
                            autofocus />{{ $category->description }}</textarea>
                    </div>
                    <div class="ml-5">
                        <button
                            class="float-right px-4 py-2 mt-5 text-m font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            Update
                        </button>
                    </div>
                </div>
            </form>

            <!--Delete Category Button -->
            <div class="ml-5">
                <form action="{{ route('category.destroy', ['category' => $category]) }}" method="post"
                    onsubmit="return confirm('Please confirm to delete this category');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-4 py-2 text-m font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-purple">
                        Delete
                    </button>
                </form>
            </div>

            <!-- Cards -->
            <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
                <!-- Card -->
                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                    <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            No. of Products
                        </p>
                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                            {{ count($category->getCategoryProducts())}}
                        </p>
                    </div>
                </div>
                <!-- Card -->
                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                    <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th class="px-4 py-3">Product</th>
                                <th class="px-4 py-3">Qty</th>
                                <th class="px-4 py-3">Sold</th>
                                <th class="px-4 py-3">Edit</th>
                                <th class="px-4 py-3">Remove Tag</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            @foreach($category->getCategoryProducts() as $product)
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3 underline">
                                         <a href="{{route('singleproduct.show', ['slug'=> $product->slug]) }}">{{ $product->name }}</a>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{$product->quantity}}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{$product->sold}}
                                    </td>
                                    <td class="px-4 py-3 text-xs">
                                        <a href="{{route('product.show', ['product' => $product ])}}">Edit Product</a>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <form action="{{ route('admin.categoryuntag', ['id' => $product->id])}}" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="categoryId" value="{{$category->id}}">
                                            <button type="submit">Untag</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

@endsection
