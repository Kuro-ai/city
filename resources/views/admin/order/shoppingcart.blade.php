<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-bbyellow leading-tight">
            {{ __('Shopping Cart') }}
            <a href="{{ route('admin.order.shoppingcart', ['reservation_id' => request('reservation_id')]) }}"
                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-bbyellow hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                 <div class="flex items-center">
                     <span class="text-bgcyan bg-pale rounded-full h-4 w-4 flex items-center justify-center text-sm mr-2">
                         {{ count(session()->get('cartItems', [])) }}
                     </span>
                     <svg fill="#000000" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                          xmlns:xlink="http://www.w3.org/1999/xlink" width="30px" height="30px" viewBox="0 0 902.86 902.86"
                          xml:space="preserve">
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

    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
            <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
                <div class="space-y-6">
                    <form action="{{ route('admin.order.updateCart') }}" method="post">
                        @csrf
                        <input type="hidden" name="reservation_id" value="{{ session()->get('reservation_id') }}">
                        @foreach ($cartItems as $item)
                        <div class="rounded-lg border border-pale bg-bgcyan p-4 shadow-sm md:p-6">
                            <img src="{{ asset('menus/' . $item['menuItem']->image) }}"
                                alt="{{ $item['menuItem']->name }}" class="w-full h-48 object-cover">
                                <div class="flex justify-center items-center mt-2">
                                    <h4 class="text-lg font-bold text-pale mr-16">{{ $item['menuItem']->name }}</h4>
                                    <p class="text-base font-bold text-pale ml-16">${{ $item['menuItem']->price }}</p>
                                </div>
                            <div class="flex items-center justify-center">
                                <input type="number" id="quantity-{{ $item['menuItem']->id }}"
                                    name="quantities[{{ $item['menuItem']->id }}]" min="1"
                                    value="{{ $item['quantity'] }}" class='bg-bgcyan text-pale' />
                            </div>
                            <div class="flex justify-center mt-2">
                                <button type="submit" name="remove" value="{{ $item['menuItem']->id }}"
                                    class="bg-red-500 hover:bg-red-700 text-bgcyan font-bold py-2 px-4 mt-2 rounded mx-2">
                                    Remove
                                </button>
                                <button type="submit"
                                    class="bg-gradient-to-r from-bbyellow via-yellow-300 to-yellow-500 hover:bg-gradient-to-br text-bgcyan font-bold py-2 px-4 mt-2 rounded mx-2">
                                    Update
                                </button>
                            </div>
                        </div>
                        @endforeach
                        <div class="flex justify-center">
                            @if (empty($cartItems))
                                <a href="{{ route('admin.menus.index', ['reservation_id' => session()->get('reservation_id')]) }}"
                                    class="bg-gradient-to-r from-bbyellow via-yellow-300 to-yellow-500 hover:bg-gradient-to-br text-bgcyan font-bold py-2 px-4 mt-4 rounded mx-2">Menu</a>
                            @else
                                <a href="{{ route('admin.menus.index', ['reservation_id' => $reservation_id]) }}"
                                    class="bg-gradient-to-r from-bbyellow via-yellow-300 to-yellow-500 hover:bg-gradient-to-br text-bgcyan font-bold py-2 px-4 mt-4 rounded mx-2">Menu</a>
                            @endif
                                </form>
                            <form action="{{ route('admin.order.clearCart') }}" method="post" class="mx-2">
                                @csrf
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-700 text-bgcyan font-bold py-2 px-4 mt-4 rounded">
                                    Clear Cart
                                </button>
                            </form>
                        </div>
                    <div class="flex justify-center">
                        <form action="{{ route('admin.order.cartToCheckout') }}" method="post" class="mx-2">
                            @csrf
                            <input type="hidden" name="reservation_id" value="{{ session()->get('reservation_id') }}">
                            @foreach (session()->get('cartItems', []) as $item)
                            <input type="hidden" name="cartItems[{{ $item['menuItem']->id }}][name]" value="{{ $item['menuItem']->name }}">
                            <input type="hidden" name="cartItems[{{ $item['menuItem']->id }}][price]" value="{{ $item['menuItem']->price }}">
                            <input type="hidden" name="cartItems[{{ $item['menuItem']->id }}][quantity]" value="{{ $item['quantity'] }}">
                            <input type="hidden" name="cartItems[{{ $item['menuItem']->id }}][total]" value="{{ $item['quantity'] * $item['menuItem']->price }}">
                            @endforeach
                            <input type="hidden" name="total" value="{{ $orderSummary->total }}">
                            <button type="submit" class="bg-gradient-to-r from-bbyellow via-yellow-300 to-yellow-500 hover:bg-gradient-to-br text-bgcyan font-bold py-2 px-4 w-60 rounded">Checkout</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">
                <div class="space-y-4 rounded-lg border border-pale bg-bgcyan p-4 shadow-sm sm:p-6">
                    <p class="text-xl font-semibold text-pale">Order summary</p>

                    <div class="space-y-4">
                        <div class="space-y-2">
                            <div class=" gap-4">
                                @foreach ($cartItems as $item)
                                    <div class="flex items-center justify-between">
                                        <p class="text-base font-normal text-pale ">
                                            {{ $item['menuItem']->name }}</p>
                                        <p class="text-base font-medium text-pale">
                                            ${{ $item['quantity'] * $item['menuItem']->price }}</p>
                                    </div>
                                    <br>
                                @endforeach
                            </div>
                        </div>

                        <dl class="flex items-center justify-between gap-4 border-t border-pale pt-2">
                            <dt class="text-base font-bold text-pale">Total</dt>
                            <dd class="text-base font-bold text-pale"> ${{ $orderSummary->total }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
