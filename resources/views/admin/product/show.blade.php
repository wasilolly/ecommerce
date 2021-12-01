@extends('admin.dashboard')

@section('content')
    <main class="h-full overflow-y-auto">
        <div class="container px-6 mx-auto grid">
            <!--Header -->
            <h2 class="px-4 py-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Product: {{$product->name}}
                <form action="{{ route('product.destroy',['product'=>$product])}}" method="post"  onclick="return confirm('confirm to  delete this product?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                    class="float-right mt-5 text-xs font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-purple">
                    Delete
                    </button>
                </form>               
            </h2>
                                        
            <!-- Alert section -->
            <a class="flex items-center justify-between p-4 mb-8 text-sm font-semibold text-purple-100      bg-purple-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple"
                href="https://github.com/estevanmaito/windmill-dashboard">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                        </path>
                    </svg>
                    <span>Star this project on GitHub</span>
                </div>
                <span>View more &RightArrow;</span>
            </a>

            <!-- General elements -->
            <div class="px-4 py-3 mb-8 rounded-lg shadow-md">
                <form action="{{ route('product.update',['product' => $product])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div>
                        <x-label for="name" :value="__('Name')" />   
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$product->name" required autofocus />
                    </div>
                    <div class="flex flex-row mt-3">
                        <div>
                            <x-label for="quantity" :value="__('Quantity')" />   
                            <x-input id="quantity" class="block mt-1 w-full" type="text" name="quantity" :value="$product->quantity" required autofocus />
                        </div>
                        <div class="ml-5">
                            <x-label for="price" :value="__('Price')" />   
                            <x-input id="price" class="block mt-1 w-full" type="text" name="price" :value="$product->price" required autofocus />
                        </div>
                        <div class="ml-5">
                            <x-label for="image" :value="__('Image')" />   
                            <x-input id="image" class="block mt-1 w-full" type="file" name="image" autofocus />  
                        </div>
                        <img src="{{ asset('storage/'.$product->image)}}" alt="" width="70">    

                    </div>

                    <label class="block mt-4 mb-5 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                          Select Categories <span class="text-xs text-red-500"><p>Hold down the Ctrl (windows) or Command (Mac) button to select multiple options.</p></span>
                        </span>
                        <select name="categories[]"
                          class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-multiselect focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                          multiple
                        >
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                          
                        </select>
                    </label>
    
                    <x-label for="description" :value="__('Description')" class="text-gray-700 dark:text-gray-400"/>   
                    <textarea
                        class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" cols="30"
                        rows="10" name="description"
                        placeholder="Describe the product....."
                    >{{$product->description}}</textarea>

                    <button type="submit"
                        class="float-right px-4 py-2 mt-5 text-m font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Update
                    </button>
                </form>
 
            </div>         
        </div>
    </main>
   
@endsection
