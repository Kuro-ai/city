<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shopping Cart') }}
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
                            <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm md:p-6">
                                <img src="{{ asset('menus/' . $item['menuItem']->image) }}"
                                    alt="{{ $item['menuItem']->name }}" class="w-full h-48 object-cover">
                                <h4 class="text-lg font-bold text-gray-900 mt-2">{{ $item['menuItem']->name }}</h4>
                                <div class="flex items-center">
                                    <input type="number" id="quantity-{{ $item['menuItem']->id }}"
                                        name="quantities[{{ $item['menuItem']->id }}]" min="1"
                                        value="{{ $item['quantity'] }}" />
                                </div>
                                <p class="text-base font-bold text-gray-900">${{ $item['menuItem']->price }}</p>
                                <button type="submit" name="remove" value="{{ $item['menuItem']->id }}"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    Remove
                                </button>
                            </div>
                        @endforeach
                        @if (empty($cartItems))
                        <a href="{{ route('admin.menus.index', ['reservation_id' => session()->get('reservation_id')]) }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Back to Menu</a>
                        @else
                            <a href="{{ route('admin.menus.index', ['reservation_id' => $reservation_id]) }}"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Back to
                                Menu</a>
                        @endif                    
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Update Cart
                        </button>
                    </form>
                    <form action="{{ route('admin.order.clearCart') }}" method="post">
                        @csrf
                        <button type="submit"
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Clear Cart
                        </button>
                    </form>
                    <form action="{{ route('admin.order.cartToCheckout') }}" method="post">
                        @csrf
                        <input type="hidden" name="reservation_id" value="{{ session()->get('reservation_id') }}">
                        @foreach (session()->get('cartItems', []) as $item)
                        <input type="hidden" name="cartItems[{{ $item['menuItem']->id }}][name]" value="{{ $item['menuItem']->name }}">
                        <input type="hidden" name="cartItems[{{ $item['menuItem']->id }}][price]" value="{{ $item['menuItem']->price }}">
                        <input type="hidden" name="cartItems[{{ $item['menuItem']->id }}][quantity]" value="{{ $item['quantity'] }}">
                        <input type="hidden" name="cartItems[{{ $item['menuItem']->id }}][total]" value="{{ $item['quantity'] * $item['menuItem']->price }}">
                        @endforeach
                        <input type="hidden" name="total" value="{{ $orderSummary->total }}">
                        <button type="submit">Checkout</button>
                    </form>
                </div>
            </div>

            <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">
                <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm sm:p-6">
                    <p class="text-xl font-semibold text-gray-900">Order summary</p>

                    <div class="space-y-4">
                        <div class="space-y-2">
                            <div class=" gap-4">
                                @foreach ($cartItems as $item)
                                    <div class="flex items-center justify-between">
                                        <p class="text-base font-normal text-gray-500 ">
                                            {{ $item['menuItem']->name }}</p>
                                        <p class="text-base font-medium text-gray-900">
                                            ${{ $item['quantity'] * $item['menuItem']->price }}</p>
                                    </div>
                                    <br>
                                @endforeach
                            </div>
                        </div>

                        <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2">
                            <dt class="text-base font-bold text-gray-900">Total</dt>
                            <dd class="text-base font-bold text-gray-900"> ${{ $orderSummary->total }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
