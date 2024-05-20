<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-bbyellow leading-tight">
            {{ __('Shopping Cart') }}
        </h2>
    </x-slot>

    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
            <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
                <div class="space-y-6">
                    <form action="{{ route('customer.order.updateCart') }}" method="post">
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
                                <a href="{{ route('customer.menus.index', ['reservation_id' => session()->get('reservation_id')]) }}"
                                    class="bg-gradient-to-r from-bbyellow via-yellow-300 to-yellow-500 hover:bg-gradient-to-br text-bgcyan font-bold py-2 px-4 mt-4 rounded mx-2">Menu</a>
                            @else
                                <a href="{{ route('customer.menus.index', ['reservation_id' => $reservation_id]) }}"
                                    class="bg-gradient-to-r from-bbyellow via-yellow-300 to-yellow-500 hover:bg-gradient-to-br text-bgcyan font-bold py-2 px-4 mt-4 rounded mx-2">Menu</a>
                            @endif
                                </form>
                            <form action="{{ route('customer.order.clearCart') }}" method="post" class="mx-2">
                                @csrf
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-700 text-bgcyan font-bold py-2 px-4 mt-4 rounded">
                                    Clear Cart
                                </button>
                            </form>
                        </div>
                    <div class="flex justify-center">
                        <form action="{{ route('customer.order.cartToCheckout') }}" method="post" class="mx-2">
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
