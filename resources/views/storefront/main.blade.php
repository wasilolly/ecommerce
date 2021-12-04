<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Nordic Shop </title>
    <meta name="description"
        content="Free open source laravel ecommerce website built with Tailwind CSS Store template">
    <meta name="keywords" content="ecommerce">

    <link href="https://unpkg.com/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
    <!--Replace with your tailwind.css once created-->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:200,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href={{asset('css/ecommerce.css')}}>

</head>

<body class="bg-white text-gray-600 work-sans leading-normal text-base tracking-normal">

    <!--Nav-->
    @include('layouts.nav')

    <!-- Banner section -->
    <a class="flex items-center justify-between p-4 mb-1 text-sm font-semibold text-purple-100      bg-purple-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple"
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

    <div class="alert">
       
    </div>

    <section class="bg-white">
        <div class="container mx-auto flex items-center flex-wrap pt-4">
            <!--Header section -->
            <nav id="store" class="w-full z-30 top-0 px-6 py-1">
                <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3">

                    <a class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl "
                        href="#">
                        @yield('Header')
                    </a>

                    <div class="flex items-center" id="store-nav-content">

                        <div class="relative mt-6 max-w-lg mx-auto">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                                <svg class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="none">
                                    <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                
                                <input class="w-full border rounded-md pl-10 pr-4 py-2 focus:border-blue-500 focus:outline-none focus:shadow-outline" type="text" placeholder="Search">
                        </div>
                    </div>
                </div>
            </nav>
            
            @yield('content')
        </div>
    </section>

    @include('layouts.about')

    @include('layouts.footer')

    
    <script src={{asset('js/ecommerce.js')}}></script>
    <script src={{asset('js/cart.js')}}></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#addToCart").click(function(){
                let id = $("#productId").val();
                let unit = $("#unit").text(); 
                $.get("/product/cart/add",
                {
                    id: id,
                    unit: unit
                },
                function(data,status){
                    if(data['product']){
                        console.log(data);
                        let product = data['product']['name'];
                        swal({
                            title: "Added to Cart!",
                            text: product,
                            icon: "success",
                            button: "Keep Shopping",
                            timer: 2000
                        }); 
                        //let qty = $("#cartqty").text();
                       // let cartqty = parseFloat(qty) + parseFloat(unit);
                        let qty = data['qty']
                        $("#cartqty").text(qty);
                    }         
                });
            });
        });
        
    </script>
    
    
</body>

</html>
