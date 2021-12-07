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
 CHECKOUT
@endsection

@section('content')

<!-- component -->
<div class="row">
    <div class="my-4 mt-6 -mx-2 lg:flex">
        <!--Payment section-->
        <div class="lg:px-2 lg:w-1/2">
            <div class="p-4 bg-gray-100 rounded-full">
                <h1 class="ml-2 font-bold uppercase">Payment</h1>
            </div>

            <!--Payment Details-->
            <div class="p-4 w-full">
                <div class="leading-loose">
                    <form action="{{ route('order')}}" method="POST" class="max-w-xl bg-gray rounded shadow-xl w-full">
                        @csrf
                        <p class="text-gray-800 font-medium">Customer information</p>
                        @guest
                            <div class="">
                                <label class="block text-sm text-gray-00" for="name">Name</label>
                                <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="name" name="name" type="text" required="" placeholder="Your Name" aria-label="Name">
                            </div>
                            <div class="mt-2">
                                <label class="block text-sm text-gray-600" for="email">Email</label>
                                <input class="w-full px-5  py-4 text-gray-700 bg-gray-200 rounded" id="email" name="email" type="text" required="" placeholder="Your Email" aria-label="Email">
                            </div>
                        @endguest
                        <div class="p-4">
                            <p class="mb-4 italic">If you have some information for the seller you can leave them in the box below</p>
                            <textarea class="w-full h-20 p-2 bg-gray-100 rounded" name="message"></textarea>
                        </div>
                        <div class="mt-2">
                            <label class=" block text-sm text-gray-600" for="address">Address</label>
                            <textarea class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="address" name="address" type="text" required="" placeholder="Your Address" aria-label="address"></textarea>
                        </div>
                        <p class="mt-4 text-gray-800 font-medium">Payment information</p>
                        <div class="">
                            <label class="block text-sm text-gray-600" for="card">Card</label>
                            <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="card" name="card" type="text" required="" placeholder="Card Number MM/YY CVC" aria-label="Name">
                        </div>
                        <div class="mt-4">
                            <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded align-center" type="submit">€{{$cart->totalPrice}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--Order Metadata -->
        <div class="lg:px-2 lg:w-1/2">
            <div class="p-4 bg-gray-100 rounded-full">
                <h1 class="ml-2 font-bold uppercase">Order Details</h1>
            </div>
            <div class="p-4">
                <p class="mb-6 italic">Shipping and additionnal costs were calculated based on values you have entered</p>
                <div class="flex justify-between border-b">
                    <div class="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800">
                        Subtotal
                    </div>
                    <div id="cartTotal" class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">
                        €{{$cart->totalPrice}}
                    </div>
                </div>
                <div class="flex justify-between pt-4 border-b">
                    <div class="flex lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-gray-800">
                        Coupon
                    </div>
                    <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-green-700">
                     {{$setting->coupon}}
                    </div>
                </div>
                
                <div class="flex justify-between pt-4 border-b">
                    <div class="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800">
                    New Subtotal
                    </div>
                    <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">
                        €{{$cart->totalPrice}}
                    </div>
                </div>
                <div class="flex justify-between pt-4 border-b">
                    <div class="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800">
                    Tax
                    </div>
                    <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">
                    {{$setting->tax}}%
                    </div>
                </div>
                <div class="flex justify-between pt-4 border-b">
                    <div class="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800">
                    Total
                    </div>
                    <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">
                   €{{$cart->totalPrice}}
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>
@endsection
