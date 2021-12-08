<!DOCTYPE html>
<html lang="en" >

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Nordic Shop </title>
    <meta name="description"
        content="Free open source laravel ecommerce website built with Tailwind CSS Store template">
    <meta name="keywords" content="ecommerce">

    <link href="https://unpkg.com/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:200,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href={{asset('css/ecommerce.css')}}>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="js/focus-trap.js"></script>
    <script src="js/init-alpine.js"></script>
</head>

<body class="text-gray-600 work-sans leading-normal text-base tracking-normal static" x-data="data()">

    <!--Nav-->
    @include('layouts.nav')

    <!-- Alert section -->
    @if (session()->has('success'))
        <div x-data="{ show:true}" x-init="setTimeout(() => show = false, 4000)" x-show="show"
            class="fixed right-0 bg-purple-500 text-white py-2 px-4 rounded-xl font-bold text-m">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="h-screen ml-8">
        <div class="grid grid-cols-4 gap-4">
            <div class="col-span-1 ... w-full">
                <ul class="settings-list">
                    <li><a href="{{ route('admin.settings') }}">Settings</a></li>
                    <hr>
                    <li><a href="{{ route('category.index') }}">Categories</a></li>
                    <hr>
                    <li><a href="{{ route('product.index') }}">Products</a></li>
                    <hr>
                    <li><a href="{{ route('admin.users') }}">Users</a></li>
                    <hr>
                    <li><a href="{{ route('admin.orders') }}">Orders</a></li>
                </ul>
            </div>
            <div class="content col-span-3 ... ">
                @yield('content')
            </div>
        </div>
        
    </div>
   
</body>
</html>
