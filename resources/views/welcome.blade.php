
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="white">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>City</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css">
        

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        {{-- <script src="{{ secure_asset('build/assets/app-DgbtYFve.js') }}"></script> --}} 
        {{-- <script src="{{asset('build/assets/app-tCqK36nS.js') }}"></script> --}}

        <!-- Styles -->
        {{-- <link href="{{ secure_asset('build/assets/app-BE0mZvCE.css') }}" rel="stylesheet"> --}}
        {{-- <link href="{{asset('build/assets/app-B7hUPDDa.css') }}" rel="stylesheet"> --}}
        @livewireStyles
       
    </head>
    <body class="antialiased  dark:bg-slate-900">
       
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-center bg-bgcyan dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            <section>
                @if (Route::has('login'))
                    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                            <a href="{{ route('login') }}" class="font-semibold text-bbyellow hover:text-slate-300 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 font-semibold text-bbyellow hover:text-slate-300 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                            @endif
                    </div>
                @endif
            </section>
            <div class="mt-16 justify-center px-4 md:mt-12 xl:mt-0 h-svh lg:h-full lg:w-full relative">     
                <div class="flex">
                    <img src="{{ asset('others/welcome.jpg') }}">
                </div>
                <div class="absolute top-0 left-0 ml-4 h-full bg-black bg-opacity-50 w-full flex items-center justify-center flex-col">
                    <h1 class="text-4xl font-bold text-center text-bbyellow mb-4">Welcome to Our Restaurant!</h1>
                    <p class="text-lg text-bbyellow mb-4">We are delighted to have you join us for a culinary experience like no other. At <span class="font-semibold">CITY Restaurant</span>, we pride ourselves on offering a warm and inviting atmosphere where you can relax and enjoy exceptional cuisine. Our team is dedicated to providing you with outstanding service and a menu that celebrates the finest ingredients, creativity, and flavors from around the world.</p>
                    <p class="text-lg text-bbyellow mb-4">Whether you're here for a special celebration, a casual meal with friends, or simply to indulge your taste buds, we promise to make your dining experience memorable. Our chefs have crafted a diverse menu that caters to all tastes, featuring both classic dishes and innovative creations.</p>
                    <p class="text-lg text-bbyellow">Thank you for choosing <span class="font-semibold">CITY Restaurant</span>. We look forward to serving you and making your visit truly special. Enjoy your meal!</p>
                </div>
            </div>
        </div>
    </body>
</html>


