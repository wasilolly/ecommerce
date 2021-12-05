@extends('storefront.main')

@section('Header')
<button type="button" id="downloadpdf" class="ml-5 font-bold underline">Download</button>

@endsection
@section('content')

<!-- component -->
<div class="flex justify-center my-6" id="receipt">
    <div class="flex flex-col w-full p-8 text-gray-800 bg-white shadow-lg pin-r pin-y md:w-4/5 lg:w-4/5">
       
        <!--Logo and customer metadate -->
        <div class="row">
             <!--logo -->
            <div class="order-1 md:order-2  float-right">
                <a class="flex items-center tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl"
                    href="/">
                    <svg class="fill-current text-gray-800 mr-2" xmlns="http://www.w3.org/2000/svg" width="100" height="100"
                        viewBox="0 0 24 24">
                        <path
                            d="M5,22h14c1.103,0,2-0.897,2-2V9c0-0.553-0.447-1-1-1h-3V7c0-2.757-2.243-5-5-5S7,4.243,7,7v1H4C3.447,8,3,8.447,3,9v11 C3,21.103,3.897,22,5,22z M9,7c0-1.654,1.346-3,3-3s3,1.346,3,3v1H9V7z M5,10h2v2h2v-2h6v2h2v-2h2l0.002,10H5V10z" />
                    </svg>
                    NORDICS
                </a>
            </div>
            
            <!--customer details -->
            <div class="p-4 bg-gray-100 w-1/3 rounded">
                <p class="ml-2 font-bold uppercase">{{ $order->name}}</p>
                <p class="ml-2 font-bold uppercase">{{ $order->email}}</p>
                <p class="ml-2 font-bold uppercase">{{ $order->address}}</p>
            </div> 
             
           
        </div>      

        <div class="flex-1">
            <!--Products Table -->
            <table class="w-full text-sm lg:text-base" cellspacing="0">
                <thead>
                    <tr class="h-12 uppercase">
                    <th class="hidden md:table-cell"></th>
                    <th class="text-left">Product</th>
                    <th class="lg:text-right text-left pl-5 lg:pl-0">
                        <span class="lg:hidden" title="Quantity">Qtd</span>
                        <span class="hidden lg:inline">Quantity</span>
                    </th>
                    <th class="hidden text-right md:table-cell">Unit price</th>
                    <th class="text-right">Total price</th>
                    </tr>
                </thead>
                                  
                <tbody>
                    @foreach($order->cart->products as $product)
                        <tr>
                            <!-- Product profile-->
                            <td class="hidden pb-4 md:table-cell">
                                <a href="{{route('singleproduct.show', ['slug' => $product['product']['slug']])}}">
                                <img src="{{asset('storage/'.$product['product']['image'])}}" class="w-20 rounded" alt="Thumbnail">
                                </a>
                            </td>

                            <!--Remove Product-->
                            <td>
                                <a href="{{route('singleproduct.show', ['slug' => $product['product']['slug']])}}"><p class="mb-2 md:ml-4">{{$product['product']['name']}}</p>
                                </a>
                                <form action="{{ route('cart.remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" id="productId" name="id" value="{{$product['product']['id']}}">
                                    <button type="submit"  class="text-gray-700 md:ml-4">
                                        <small>(Remove item)</small>
                                    </button>
                                </form>                               
                            </td>

                            <!--Quantity -->
                            <td class="justify-center md:justify-end md:flex mt-6">
                                <div class="w-20 h-10">
                                    <div class="relative flex flex-row w-full h-8">
                                        <span class="w-full font-semibold text-center text-gray-700 bg-gray-200 outline-none focus:outline-none hover:text-black focus:text-black" >{{$product['units']}}</span>
                                    </div>
                                </div>
                            </td>

                            <!--price-->
                            <td class="hidden text-right md:table-cell">
                                <span class="text-sm lg:text-base font-medium">
                                    {{$product['product']['price']}}
                                </span>
                            </td>

                            <!--total qty price -->
                            <td class="text-right">
                                <span id="unitsTotal" class="text-sm lg:text-base font-medium">
                                {{$product['unitsTotal']}}
                                </span>
                            </td>
                        </tr> 
                    @endforeach
                </tbody>                                    
            </table>

            <hr class="pb-6 mt-6">

            <!--Order metadata -->
            <div class="my-4 mt-6 -mx-2 lg:flex">
                <div class="lg:px-2 lg:w-1/2">
                    <div class="p-4 mt-6 bg-gray-100 rounded-full">
                        <h1 class="ml-2 font-bold uppercase">Instruction for seller</h1>
                    </div>
                    <div class="p-4">
                        <p class="mb-4 italic">information for the seller you can leave them in the box below</p>
                        <textarea class="w-full h-24 p-2 bg-gray-100 rounded">{{$order->message }}</textarea>
                    </div>
                </div>
                <div class="lg:px-2 lg:w-1/2">
                    <div class="p-4 bg-gray-100 rounded-full">
                        <h1 class="ml-2 font-bold uppercase">Order Details</h1>
                    </div>
                    <div class="p-4">
                        <p class="mb-6 italic">Shipping and additionnal costs are calculated based on values you have entered</p>
                        <div class="flex justify-between border-b">
                            <div class="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800">
                                Subtotal
                            </div>
                            <div id="cartTotal" class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">
                                {{$order->cart->totalPrice}}
                            </div>
                        </div>
                        <div class="flex justify-between pt-4 border-b">
                            <div class="flex lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-gray-800">
                                <form action="" method="POST">
                                    <button type="submit" class="mr-2 mt-1 lg:mt-2">
                                    <svg aria-hidden="true" data-prefix="far" data-icon="trash-alt" class="w-4 text-red-600 hover:text-red-800" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M268 416h24a12 12 0 0012-12V188a12 12 0 00-12-12h-24a12 12 0 00-12 12v216a12 12 0 0012 12zM432 80h-82.41l-34-56.7A48 48 0 00274.41 0H173.59a48 48 0 00-41.16 23.3L98.41 80H16A16 16 0 000 96v16a16 16 0 0016 16h16v336a48 48 0 0048 48h288a48 48 0 0048-48V128h16a16 16 0 0016-16V96a16 16 0 00-16-16zM171.84 50.91A6 6 0 01177 48h94a6 6 0 015.15 2.91L293.61 80H154.39zM368 464H80V128h288zm-212-48h24a12 12 0 0012-12V188a12 12 0 00-12-12h-24a12 12 0 00-12 12v216a12 12 0 0012 12z"/></svg>
                                    </button>
                                </form>
                                Coupon {{$setting->coupon}}
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
                                €{{$order->cart->totalPrice}}
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
                           €{{$order->cart->totalPrice}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>     
        </div>

    </div>        
</div>
@endsection
