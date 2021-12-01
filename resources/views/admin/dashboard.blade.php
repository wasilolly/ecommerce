<!DOCTYPE html>
<html lang="en" x-data="data()">

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
    <link rel="stylesheet" href="css/ecommerce.css">
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="js/focus-trap.js"></script>
    <script src="js/init-alpine.js"></script>
</head>

<body class="text-gray-600 work-sans leading-normal text-base tracking-normal">

    <!--Nav-->
    @include('layouts.nav')
    <div class="h-screen ml-8">
        <div class="grid grid-cols-4 gap-4">
            <div class="col-span-1 ... w-full">
                <ul class="settings-list">
                    <li>Settings</li>
                    <li>Meta Data</li>
                    <hr>
                    <li>Footer</li>
                    <hr>
                    <li><a href="{{ route('category.index') }}">Categories</a></li>
                    <hr>
                    <li>Products</li>
                    <hr>
                    <li>Users</li>

                </ul>
            </div>
            <div class=" content col-span-3 ... ">
                @yield('content')
            </div>
        </div>
        
    </div>

    @include('layouts.about')

    <!--footer-->
    @include('layouts.footer')
</body>

</html>
