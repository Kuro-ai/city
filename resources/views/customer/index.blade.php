<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-bbyellow leading-tight flex justify-between">
            {{ __('Home') }}
            <a href="{{ route('customer.order.shoppingcart', ['reservation_id' => request('reservation_id')]) }}"
                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-bbyellow hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <div class="flex items-center">
                    <span class="text-bgcyan bg-pale rounded-full h-4 w-4 flex items-center justify-center text-sm mr-2">
                        {{ count(session()->get('cartItems', [])) }}
                    </span>
                    <svg fill="#000000" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" width="30px" height="30px"
                        viewBox="0 0 902.86 902.86" xml:space="preserve">
                        <g>
                            <g>
                                <path d="M671.504,577.829l110.485-432.609H902.86v-68H729.174L703.128,179.2L0,178.697l74.753,399.129h596.751V577.829z
                 M685.766,247.188l-67.077,262.64H131.199L81.928,246.756L685.766,247.188z" />
                                <path d="M578.418,825.641c59.961,0,108.743-48.783,108.743-108.744s-48.782-108.742-108.743-108.742H168.717
                 c-59.961,0-108.744,48.781-108.744,108.742s48.782,108.744,108.744,108.744c59.962,0,108.743-48.783,108.743-108.744
                 c0-14.4-2.821-28.152-7.927-40.742h208.069c-5.107,12.59-7.928,26.342-7.928,40.742
                 C469.675,776.858,518.457,825.641,578.418,825.641z M209.46,716.897c0,22.467-18.277,40.744-40.743,40.744
                 c-22.466,0-40.744-18.277-40.744-40.744c0-22.465,18.277-40.742,40.744-40.742C191.183,676.155,209.46,694.432,209.46,716.897z
                 M619.162,716.897c0,22.467-18.277,40.744-40.743,40.744s-40.743-18.277-40.743-40.744c0-22.465,18.277-40.742,40.743-40.742
                 S619.162,694.432,619.162,716.897z" />
                            </g>
                        </g>
                    </svg>
                </div>
            </a>
        </h2>
    </x-slot>
    @if (session('status'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-3 mb-3 text-center"
            role="alert">
            {{ session('status') }}
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3 close-alert">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <title>Close</title>
                    <path
                        d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                </svg>
            </span>
        </div>
    @endif
    <!-- Main Hero Content -->
    <div class="container max-w-lg px-4 py-32 mx-auto text-left bg-center bg-no-repeat bg-cover md:max-w-none md:text-center"
        style="background-image: url('https://d7fcfvvxwoz9e.cloudfront.net/dom43635/wp-content/uploads/2020/08/7-Restaurant-Interior-Design-Trends-for-2024.jpg')">
        <h1
            class="font-mono text-3xl font-extrabold text-transparent text-center bg-clip-text bg-gradient-to-r from-green-400 to-blue-500 md:text-center sm:leading-none lg:text-5xl">
            <span class="inline md:block">Welcome To City Restaurant</span>
        </h1>
        <div class="relative">
            <div class="absolute inset-0 bg-bgcyan blur-lg"></div>
            <div class="mx-auto mt-2 md:text-center lg:text-lg text-yellow-300 p-4 relative">
                where every dish tells a story of flavors crafted with passion and expertise. Whether you're craving a
                comforting
                classic or seeking culinary adventure, our team is dedicated to serving you excellence in every bite.
            </div>
        </div>
        <div class="flex flex-col items-center mt-12 text-center">
            <span class="relative inline-flex w-full md:w-auto">
                <a href="{{ route('customer.reservations.step.one') }}" type="button"
                    class="inline-flex items-center justify-center px-6 py-2 text-base font-bold leading-6 text-bgcyan  bg-gradient-to-r from-bbyellow via-yellow-300 to-yellow-500 hover:bg-gradient-to-br  rounded-full lg:w-full md:w-auto focus:outline-none">
                    Make your Reservation
                </a>
        </div>
    </div>
    <!-- End Main Hero Content -->
    <section class="px-2 py-32 bg-bgcyan md:px-0 border-t border-pale">
        <div class="container items-center max-w-6xl px-8 mx-auto xl:px-5">
            <div class="flex flex-wrap items-center sm:-mx-3">
                <div class="w-full md:w-1/2 md:px-3">
                    <div class="w-full pb-6 space-y-4 sm:max-w-md lg:max-w-lg lg:space-y-4 lg:pr-0 md:pb-0">
                        <h3 class="text-xl text-bbyellow">OUR STORY
                        </h3>
                        <!-- </h1> -->
                        <p class="mx-auto text-base text-textpale sm:max-w-md lg:text-xl md:max-w-3xl text-pale">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus nemo incidunt
                            praesentium, ipsum
                            culpa minus eveniet, id nesciunt excepturi sit voluptate repudiandae. Explicabo, incidunt
                            quia.
                            Repellendus mollitia quaerat est voluptas!
                        </p>
                        <div class="relative flex">
                            <a href="#_"
                                class="flex items-center px-6 py-3 mb-3 text-lg text-bgcyan bg-gradient-to-r from-bbyellow via-yellow-300 to-yellow-500 rounded-md ">
                                Read More
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-1" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2">
                    <div class="w-full h-auto overflow-hidden rounded-md shadow-xl sm:rounded-xl">
                        <img src="https://cdn.pixabay.com/photo/2017/08/03/13/30/people-2576336_960_720.jpg" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-20 bg-bgcyan border-t border-pale">
        <div class="container items-center max-w-6xl px-4 mx-auto sm:px-20 md:px-32 lg:px-16">
            <div class="flex flex-wrap items-center -mx-3">
                <div class="order-1 w-full px-3 lg:w-1/2 lg:order-0">
                    <div class="w-full lg:max-w-md">
                        <h2 class="mb-4 text-2xl font-bold text-bbyellow">About Us</h2>
                        <h2
                            class="mb-4 text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500">
                            WHY CHOOSE US?</h2>

                        <p class="mb-4 font-medium tracking-tight text-pale xl:mb-6">Lorem ipsum dolor sit amet
                            consectetur
                            adipisicing elit. Natus hic atque magni minus aliquam, eos quam incidunt nam iusto sunt
                            voluptates
                            inventore a veritatis doloremque corrupti. Veritatis est expedita cupiditate!</p>
                        <ul>
                            <li class="flex items-center py-2 space-x-4 xl:py-3">
                                <svg class="w-8 h-8 text-pale" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z">
                                    </path>
                                </svg>
                                <span class="font-medium text-pale">Faster Processing and Delivery</span>
                            </li>
                            <li class="flex items-center py-2 space-x-4 xl:py-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-pale" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="font-medium text-pale">Easy Payments</span>
                            </li>
                            <li class="flex items-center py-2 space-x-4 xl:py-3">
                                <svg class="w-8 h-8 text-pale" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                    </path>
                                </svg>
                                <span class="font-medium text-pale">100% Protection and Security for Your App</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="w-full px-3 mb-12 lg:w-1/2 order-0 lg:order-1 lg:mb-0"><iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15274.092030577182!2d96.1836934!3d16.8500032!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c19308d51d69b9%3A0x1f8d7644967edd7f!2sCITY%20-%20Sports%20Bar!5e0!3m2!1sen!2smm!4v1721044011598!5m2!1sen!2smm"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe></div>
            </div>
        </div>
    </section>
    <button onclick="topFunction()" id="myBtn" title="Go to top"
        class="fixed right-4 bottom-20 z-50 bg-black bg-opacity-50 text-white p-3 rounded-lg cursor-pointer hover:bg-opacity-80">&#8679;</button>
</x-app-layout>
<script>
    window.onscroll = function() {
        scrollFunction()
    };

    function scrollFunction() {
        var mybutton = document.getElementById("myBtn");
        if (document.body.scrollTop > window.innerHeight / 2 || document.documentElement.scrollTop > window
            .innerHeight / 2) {
            mybutton.classList.remove('invisible');
        } else {
            mybutton.classList.add('invisible');
        }
    }

    function topFunction() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }
</script>
