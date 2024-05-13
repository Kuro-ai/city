<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <form method="POST" action="{{route('customer.order.checkout.store')}}">
        @csrf

        @if ($reservation)
            <input type="text" id="" name="reservation_id" value="{{ $reservation->id }}">
            <input type="text" id="first_name" name="first_name" value="{{ $reservation->first_name }}">
            <input type="text" id="last_name" name="last_name" value="{{ $reservation->last_name }}">
            <input type="text" id="phone" name="phone" value="{{ $reservation->tel_number }}">
            <input type="text" id="email" name="email" value="{{ $reservation->email }}">
        @else
            <label for="name">First Name:</label><br>
            <input type="text" id="first_name" name="first_name"><br>

            <label for="name">Last Name:</label><br>
            <input type="text" id="last_name" name="last_name"><br>

            <label for="phone">Phone:</label><br>
            <input type="text" id="phone" name="phone"><br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email"><br>
        @endif

        <label for="address">Address:</label><br>
        <textarea id="address" name="address" rows="4" cols="50"></textarea><br>

        @foreach ($cartItems as $item)
            <input type="text" name="cartItems[{{ $loop->index }}][id]" value="{{ $item['menuItem']->id }}">
            <input type="text" name="cartItems[{{ $loop->index }}][name]" value="{{ $item['menuItem']->name }}">
            <input type="text" name="cartItems[{{ $loop->index }}][price]" value="{{ $item['price'] }}">
            <input type="text" name="cartItems[{{ $loop->index }}][quantity]" value="{{ $item['quantity'] }}">
            <input type="text" name="cartItems[{{ $loop->index }}][totalPrice]" value="{{ $item['totalPrice'] }}">
        @endforeach
        <input type="text" name="total" value="{{ $total }}">
        <div class="mb-5 sm:col-span-6">
            <input type="text" name="user_id" value="{{ \Illuminate\Support\Facades\Auth::id() }}">
        </div>
        <input type="submit" value="Submit">
    </form>
</x-app-layout>
