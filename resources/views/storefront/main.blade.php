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
    @yield('banner')

    <!-- Alert section -->
    @if (session()->has('success'))
      <div x-data="{ show:true}" x-init="setTimeout(() => show = false, 4000)" x-show="show"
          class="fixed right-0 bg-purple-500 text-white py-2 px-4 rounded-xl font-bold text-m">
          <p>{{ session('success') }}</p>
      </div>
    @endif
    
    <section class="bg-white">
        <div class="container mx-auto flex items-center flex-wrap">
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src={{asset('js/cart.xhr')}}></script>
    <script src={{asset('js/ecommerce.js')}}></script>
    <script> 
        window.onload = function(){
            document.getElementById("downloadpdf").addEventListener("click", ()=>{
                const receipt = document.getElementById("receipt");
                console.log(receipt);

                var opt = {
                    margin : 1,
                    filename : 'Receipt.pdf',
                    html2canva:{
                        scale : 2
                    },
                    jsPDF : {
                        unit : 'in',
                        format : 'tabloid',
                        orientation : 'landscape'
                    }

                };

                html2pdf().from(receipt).set(opt).save();

            })
        }
        
    </script>

</body>
</html>
