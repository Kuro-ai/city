<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('customer.order.checkout.store') }}">
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

            <label for="address">Address:</label><br>
            <textarea id="address" name="address" rows="4" cols="50"></textarea><br>
            <small>Delivery is limited to Yangon</small>

            <div class="mb-5 sm:col-span-6">
                <label for="res_date" class="block mb-2 text-sm font-medium text-gray-900 ">
                    Order Date & Time</label>
                <input type="datetime-local" id="res_date"
                    class="message shadow-sm bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('res_date') border-red-600 @enderror @error('table_id') border-red-600 @enderror"
                    placeholder="" name="order_date" aria-describedby="helper-text-explanation-table"
                    onchange="validateTime(this)" />
                @error('res_date')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
                @error('table_id')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
                <p id="helper-text-explanation-table" class="mt-2 text-sm text-gray-500">Please
                    Choose the time
                    between 3pm to 9pm</p>
                <div id="message" class="text-red-500 border-red-600"></div>
            </div>
        @endif

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
<script>
    // Function to validate the selected time
    function validateTime(input) {
        var dateTime = new Date(input.value);
        var hours = dateTime.getHours();

        if (hours < 15 || hours > 20) {
            alert("Please select a time between 3 PM and 8:59 PM.");
            input.value = "";
        }
    }

    // Function to check if the selected date and time is valid
    window.onload = function() {
        var now = new Date(),
            minDateTime,
            month, date, hours, minutes,
            resDate = document.getElementById('res_date');

        month = (now.getMonth() + 1).toString().padStart(2, '0');
        date = now.getDate().toString().padStart(2, '0');
        hours = now.getHours().toString().padStart(2, '0');
        minutes = now.getMinutes().toString().padStart(2, '0');

        minDateTime = now.getFullYear() + '-' + month + '-' + date + 'T' + hours + ':' + minutes;

        resDate.min = minDateTime;
    }
</script>

