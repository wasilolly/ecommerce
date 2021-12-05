@extends('admin.dashboard')

@section('content')
    <main class="h-full overflow-y-auto">
        <div class="container px-6 mx-auto grid">
            <div class="flex flex-row">
                <!--Header -->
                <h2 class="px-4 py-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                    Orders
                </h2>
            </div>

            <!-- Cards -->
            <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
                <!-- Card -->
                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                    <div
                        class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            No. of  orders
                        </p>
                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                            {{$orders->count()}}
                        </p>
                    </div>
                </div>               
            </div>

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
            </div>
        </div>
    </main>
@endsection
