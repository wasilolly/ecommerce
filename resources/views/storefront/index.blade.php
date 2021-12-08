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
<div class="flex flex-col space-y-2">
    <div class="flex space-x-2">
        @foreach ($categories as $category)
        <a href="{{ route('singlecategory.show',['slug' => $category->slug])}}" style="padding-top: 0.1em; padding-bottom: 0.1rem" class="text-xs px-3 bg-gray-200 text-purple-800 rounded-full hover:grow hover:bg-purple-100">{{$category->name}}</a>        
        @endforeach
    </div>
</div>
@endsection

@section('content')
    @foreach ($products as $product)
    <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
        <a href="{{ route('singleproduct.show', ['slug' => $product->slug])}}">
            <img class="hover:grow hover:shadow-lg"
                src="{{asset('storage/'.$product->image)}}">
            <div class="pt-3 flex items-center justify-between">
                <a href="{{ route('singleproduct.show', ['slug' => $product->slug])}}">
                    <p class="">{{$product->name}}</p>
                </a>
                <button id="addOneToCart" class="mx-2 text-purple-600 border rounded-md p-2 hover:bg-gray-200 focus:outline-none" value="{{$product->id}}">
                    <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </button>
            </div>
            <p class="pt-1 text-gray-900">€{{$product->price}}</p>
        </a>
    </div> 
    @endforeach
@endsection