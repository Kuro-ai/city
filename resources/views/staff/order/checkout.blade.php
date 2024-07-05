<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-bbyellow leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="container w-full px-5 py-6 mx-auto ">
        <div class="flex items-center justify-center bg-bgcyan ">
            <div class="border-pale border-2 p-16">
                <form method="POST" action="{{ route('staff.order.checkout.store') }}">
                    @csrf

                    @if ($reservation)
                        <input type="text" id="" name="reservation_id" value="{{ $reservation->id }}">
                        <input type="text" id="first_name" name="first_name" value="{{ $reservation->first_name }}">
                        <input type="text" id="last_name" name="last_name" value="{{ $reservation->last_name }}">
                        <input type="text" id="phone" name="phone" value="{{ $reservation->tel_number }}">
                        <input type="text" id="email" name="email" value="{{ $reservation->email }}">
                    @else
                        <div class="my-3">
                            <label class="text-pale" for="name">First Name</label>
                            <input type="text"
                                class="bg-bgcyan text-pale w-full {{ $errors->has('first_name') ? 'border-red-500' : 'border-pale' }} "
                                id="first_name" name="first_name">
                        </div>
                        @error('first_name')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                        <div class="my-3">
                            <label class="text-pale" for="name">Last Name</label>
                            <input type="text"
                                class="bg-bgcyan text-pale w-full {{ $errors->has('last_name') ? 'border-red-500' : 'border-pale' }}"
                                id="last_name" name="last_name">
                        </div>
                        @error('last_name')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror

                        <div class="my-3">
                            <label class="text-pale" for="phone">Phone</label>
                            <input type="text"
                                class="bg-bgcyan text-pale w-full {{ $errors->has('phone') ? 'border-red-500' : 'border-pale' }}"
                                id="phone" name="phone">
                        </div>
                        @error('phone')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror

                        <div class="my-3">
                            <label class="text-pale" for="email">Email</label>
                            <input type="email"
                                class="bg-bgcyan text-pale w-full {{ $errors->has('email') ? 'border-red-500' : 'border-pale' }}"
                                id="email" name="email">
                        </div>
                        @error('email')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror

                        <div class="my-3">
                            <label class="text-pale" for="address">Address</label>
                            <textarea class="bg-bgcyan text-pale w-full {{ $errors->has('address') ? 'border-red-500' : 'border-pale' }}"
                                id="address" name="address" rows="4" cols="50"></textarea>
                            @error('address')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                            <small class="text-pale">Delivery is limited to Yangon</small>
                        </div>


                        <div class="mt-3 mb-5 sm:col-span-6">
                            <label class="text-pale" for="res_date"
                                class="block mb-2 text-sm font-medium text-gray-900 ">
                                Order Date & Time</label>
                            <input type="datetime-local"
                                class="bg-bgcyan text-pale w-full {{ $errors->has('res_date') ? 'border-red-500' : 'border-pale' }}"
                                id="res_date"
                                class="message shadow-sm bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('res_date') border-red-600 @enderror @error('table_id') border-red-600 @enderror"
                                placeholder="" name="order_date" aria-describedby="helper-text-explanation-table"
                                onchange="validateTime(this)" />
                            @error('res_date')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                            @error('table_id')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                            <p id="helper-text-explanation-table" class="mt-2 text-sm text-pale">Please
                                Choose the time
                                between 3pm to 9pm</p>
                            <div id="message" class="text-red-500 border-red-600"></div>
                        </div>
                        @error('res_date')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    @endif

                    @foreach ($cartItems as $item)
                        <input type="hidden" name="cartItems[{{ $loop->index }}][id]"
                            value="{{ $item['menuItem']->id }}">
                        <input type="hidden" name="cartItems[{{ $loop->index }}][name]"
                            value="{{ $item['menuItem']->name }}">
                        <input type="hidden" name="cartItems[{{ $loop->index }}][price]"
                            value="{{ $item['price'] }}">
                        <input type="hidden" name="cartItems[{{ $loop->index }}][quantity]"
                            value="{{ $item['quantity'] }}">
                        <input type="hidden" name="cartItems[{{ $loop->index }}][totalPrice]"
                            value="{{ $item['totalPrice'] }}">
                    @endforeach
                    <input type="hidden" name="total" value="{{ $total }}">
                    <div class="mb-5 sm:col-span-6">
                        <input type="hidden" name="user_id" value="{{ \Illuminate\Support\Facades\Auth::id() }}">
                    </div>
                    <div class="flex justify-center">
                        <input type="submit" value="Order"
                            class="bg-gradient-to-r from-bbyellow via-yellow-300 to-yellow-500 hover:bg-gradient-to-br text-bgcyan font-bold py-3 px-6 mt-2 rounded mx-auto text-lg">
                    </div>
                </form>
            </div>
        </div>
    </div>
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
