<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <form method="POST" action="">
        @csrf
    
       
        <input type="hidden" name="total" value="{{ $total }}">
    
        @foreach ($cartItems as $item)
            <input type="hidden" name="cartItems[{{ $loop->index }}][name]" value="{{ $item['menuItem']->name }}">
            <input type="hidden" name="cartItems[{{ $loop->index }}][price]" value="{{ $item['price'] }}">
            <input type="hidden" name="cartItems[{{ $loop->index }}][quantity]" value="{{ $item['quantity'] }}">
            <input type="hidden" name="cartItems[{{ $loop->index }}][totalPrice]" value="{{ $item['totalPrice'] }}">
        @endforeach
    
        @if($reservation)
            <input type="text" id="first_name" name="first_name" value="{{ $reservation->first_name }}">
            <input type="text" id="last_name" name="last_name" value="{{ $reservation->last_name }}">
            <input type="text" id="phone" name="phone" value="{{ $reservation->tel_number }}">
            <input type="text" id="email" name="email" value="{{ $reservation->email }}">
        @else
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name"><br>
    
            <label for="phone">Phone:</label><br>
            <input type="text" id="phone" name="phone"><br>
    
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email"><br>
        @endif
    
        <label for="address">Address:</label><br>
        <input type="text" id="address" name="address"><br>
    
        <input type="submit" value="Submit">
    </form>
</x-app-layout>