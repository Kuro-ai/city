<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reservation') }}
        </h2>
    </x-slot>
    <div class="container w-full px-5 py-6 mx-auto">
        <div class="flex items-center min-h-screen bg-gray-50">
            <div class="flex-1 h-full max-w-4xl mx-auto bg-white rounded-lg shadow-xl">
                <div class="flex flex-col md:flex-row">
                    <div class="h-32 md:h-auto md:w-1/2">
                        <img class="object-cover w-full h-full"
                        src="{{ asset('others/step-two.jpg') }}" alt="img" />
                    </div>
                    <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                        <div class="w-full">
                            <h3 class="mb-4 text-xl font-bold text-blue-600">Make Reservation</h3>

                            <div class="w-full bg-gray-200 rounded-full">
                                <div
                                    class="w-100 p-1 text-xs font-medium leading-none text-center text-blue-100 bg-blue-600 rounded-full">
                                    Step 2
                                </div>
                            </div>

                            {{-- <div class="w-full bg-gray-200 rounded-full">
                                <div
                                    class="w-48 p-1 text-xs font-medium leading-none text-center text-blue-100 bg-blue-600 rounded-full ml-auto">
                                    Step 2
                                </div>
                            </div> --}}

                            <form method="POST" action="{{ route('customer.reservations.store.step.two') }}">
                                @csrf
                                <div class="mb-5 sm:col-span-6">
                                    <label for="res_date" class="block mb-2 text-sm font-medium text-gray-900 ">
                                        Reservation Date</label>
                                    <input type="datetime-local" id="res_date"
                                        class="message shadow-sm bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('res_date') border-red-600 @enderror @error('table_id') border-red-600 @enderror"
                                        placeholder="" name="res_date" aria-describedby="helper-text-explanation-table"
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
                                <div class="mb-5 sm:col-span-6">
                                    <label for="guest_number" class="block mb-2 text-sm font-medium text-gray-900 ">
                                        Guest Number</label>
                                    <input type="number" id="guest_number"
                                        class="messages shadow-sm bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('guest_number') border-red-600 @enderror"
                                        placeholder="guest_number" name="guest_number" min="1" max="20"
                                        step="1" />
                                    @error('guest_number')
                                        <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                    <div id="messages" class="text-red-500 border-red-600"></div>
                                </div>
                                <div class="sm:col-span-6 pt-5">
                                    <label for="status" class="block text-sm font-medium text-gray-700">Table</label>
                                    <div class="mt-1">
                                        <select id="table_id" name="table_id"
                                            class="form-multiselect block w-full mt-1">
                                            @foreach ($tables as $table)
                                                <option value="{{ $table->id }}"
                                                    data-capacity="{{ $table->capacity }}" @selected($table->id == $reservation->table_id)>
                                                    {{ $table->name }}
                                                    ({{ $table->capacity }} Guests)
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('table_id')
                                        <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mt-6 p-4 flex justify-between">
                                    <a href="{{ route('customer.reservations.step.one') }}"
                                        class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Previous</a>
                                    <button type="submit" id="submit_button"
                                        class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">
                                        Reserve</button>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
<script>
    // Function to allow only numbers in the input field
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

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

    // Function to check if the selected number of guests is greater than the capacity of the selected table
    document.addEventListener('DOMContentLoaded', function() {
        var guestNumberInput = document.getElementById('guest_number');
        var tableSelect = document.getElementById('table_id');
        var messageDiv = document.getElementById('messages');
        var submitButton = document.getElementById(
            'submit_button'); 

        function checkCapacity() {
            var guestNumber = Number(guestNumberInput.value);
            var selectedTableCapacity = Number(tableSelect.options[tableSelect.selectedIndex].dataset.capacity);

            if (guestNumber > selectedTableCapacity) {
                messageDiv.textContent =
                    'The selected number of guests is greater than the capacity of the selected table.';
                guestNumberInput.classList.add('message', 'border-red-600');
                submitButton.disabled = true; // Disable the submit button
            } else {
                messageDiv.textContent = '';
                guestNumberInput.classList.remove('message', 'border-red-600');
                submitButton.disabled = false; // Enable the submit button
            }
        }

        guestNumberInput.addEventListener('change', checkCapacity);
        tableSelect.addEventListener('change', checkCapacity);
    });
</script>
