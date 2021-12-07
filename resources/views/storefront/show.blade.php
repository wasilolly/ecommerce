@extends('storefront.main')

@section('banner')
    <!-- Banner section -->
    <div class="flex items-center justify-between p-4 mb-1 text-sm font-semibold text-purple-100      bg-purple-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                </path>
            </svg>
            <span>{{$setting->banner}} {{$setting->coupon}}</span>
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                </path>
            </svg>
        </div>
    </div>
@endsection

@section('Header')
<div class="tags ml-8 pl-4 ">
    @foreach ($categories as $category)        
      | <a href="{{route('singlecategory.show', ['slug' => $category->slug ])}}" class="font-bold text-lg hover:grow hover:shadow-md  hover:bg-purple-200 rounded-md">{{$category->name}}</a> |
    @endforeach
</div>
@endsection

@section('content')
<div class="container mx-auto px-6">

    <!-- Single Product Card -->
    <div class="md:flex md:items-center">
        
        <div class="w-full h-64 md:w-1/2 lg:h-96">
            <img class="h-full w-full rounded-md object-cover max-w-lg mx-auto" src="{{asset('storage/'.$product->image)}}" alt="{{$product->name}}">
        </div>
        <div class="w-full max-w-lg mx-auto mt-5 md:ml-8 md:mt-0 md:w-1/2">
            <h3 class="text-gray-700 uppercase text-lg font-bold">{{$product->name}}</h3>
            <span class="text-gray-500 mt-3">€{{ $product->price}}</span>
            <hr class="my-3">
            <div class="mt-2">
                <label class="text-gray-700 text-sm font-bold" for="quantity">Quantity:</label>
                <div class="flex items-center mt-1">
                    <button id="plus" class="text-gray-500 focus:outline-none focus:text-gray-600">
                        <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </button>
                    <span class="text-gray-700 text-lg mx-2" id="unit">1</span>
                    <input type="hidden" id="productId" value="{{$product->id}}">
                    <button id="minus" class="text-gray-500 focus:outline-none focus:text-gray-600">
                        <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </button>
                </div>
            </div>
            <hr class="my-3">
            <div class="mt-3">
                <label class="text-gray-700 text-m font-bold">Description</label>
                <div class="flex items-center mt-1">
                   {{$product->description}}
                </div>
            </div>
            <div class="flex items-center mt-6">
                <button id="addToCart" class="px-8 py-2 bg-purple-600 text-white text-sm font-medium rounded hover:bg-purple-500 focus:outline-nonefocus:bg-purple-500">
                    <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </button>
            </div>
        </div>
    </div>

    <!--More Products Section-->
    <div class="mt-16">
        <h3 class="text-gray-600 text-2xl font-medium">Similar Products</h3>
        <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">

            @foreach ($similarProducts as $product)                
                <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">
                    <div class="flex items-end justify-end h-56 w-full ">
                        <img src="{{asset('storage/'.$product->image)}}" alt="" class="w-full">               
                    </div>
                    
                    <div class="px-5 py-3">
                        <div class="row">
                            <button class="float-right p-2 rounded-full bg-purple-600 text-white mx-5 -mb-4 hover:bg-purple-500 focus:outline-none focus:bg-purple-500">
                                <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </button> 
                            <a href="{{route('singleproduct.show', ['slug' => $product->slug])}}"><h3 class="text-gray-700 uppercase">{{ $product->name }}</h3></a>
                        </div>
                        <hr>
                        <span class="text-gray-500 mt-2">€{{ $product->price}}</span>

                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>

@endsection