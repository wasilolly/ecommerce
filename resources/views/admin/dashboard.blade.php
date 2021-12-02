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
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="js/focus-trap.js"></script>
    <script src="js/init-alpine.js"></script>
</head>

<body class="text-gray-600 work-sans leading-normal text-base tracking-normal" x-data="data()">

    <!--Nav-->
    @include('layouts.nav')
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
                    <li>Users</li>
                    <hr>
                    <li>Order</li>
                </ul>
            </div>
            <div class="content col-span-3 ... ">
                @yield('content')
            </div>
        </div>
        
        @include('layouts.about')
        <!--footer-->
        @include('layouts.footer')
    </div>
   
</body>
</html>
