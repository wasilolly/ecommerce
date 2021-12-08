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
Orders
@endsection

@section('content')
   <!-- Table -->
   <div class="w-full overflow-hidden rounded-lg shadow-xs">
    <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Date Ordered</th>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Message</th>
                    <th class="px-4 py-3">Product count</th>
                    <th class="px-4 py-3">Total</th>
                    <th class="px-4 py-3">Receipt</th>
                </tr>
            </thead>
            
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach ($orders as $order)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-xs">
                            {{  ($order->created_at)->diffForHumans()  }}
                        </td>
                        
                        <td class="px-4 py-3 text-sm">
                            {{$order->name}}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{$order->email}}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{Str::limit($order->message, 5, '...')}}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $order->cart->totalQty }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $order->cart->totalPrice }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <a href="{{ route('order.show', ['id' => $order->id])}}">Show</a> 
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection