<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-bbyellow leading-tight">
            {{ __('Reservation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">

            <form class="max-w-sm mx-auto bg-bgcyan border-2 border-pale p-6 rounded-md"
                action="{{ route('admin.reservations.update', $reservation->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="flex justify-end">
                    <x-create-button href="{{ route('admin.reservations.index') }}">
                        Reservation List
                    </x-create-button>
                </div>
                <div class="mb-5">
                    <label for="first_name" class="block mb-2 text-sm font-medium text-pale ">First
                        Name</label>
                    <input type="text" id="first_name"
                        class="shadow-sm bg-bgcyan border-2 border-pale text-pale text-sm rounded-lg block w-full p-2.5 @error('first_name') border-red-600 @enderror"
                        placeholder="First Name" name="first_name" value="{{ $reservation->first_name }}" />
                    @error('first_name')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="last_name" class="block mb-2 text-sm font-medium text-pale ">Last
                        Name</label>
                    <input type="text" id="last_name"
                        class="shadow-sm bg-bgcyan border-2 border-pale text-pale text-sm rounded-lg block w-full p-2.5 @error('last_name') border-red-600 @enderror"
                        placeholder="Last Name" name="last_name" value="{{ $reservation->last_name }}" />
                    @error('last_name')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="email" class="block mb-2 text-sm font-medium text-pale ">Email</label>
                    <input type="email" id="email"
                        class="shadow-sm bg-bgcyan border-2 border-pale text-pale text-sm rounded-lg block w-full p-2.5 @error('email') border-red-600 @enderror"
                        placeholder="example@gmail.com" name="email" value="{{ $reservation->email }}" />
                    @error('email')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="tel_number" class="block mb-2 text-sm font-medium text-pale ">Phone
                        Number</label>
                    <input type="text" id="tel_number"
                        class="shadow-sm bg-bgcyan border-2 border-pale text-pale text-sm rounded-lg block w-full p-2.5 @error('tel_number') border-red-600 @enderror"
                        placeholder="09-xxx xxxxxx" name="tel_number" value="{{ $reservation->tel_number }}"
                        onkeypress="return isNumberKey(event)" />
                    @error('tel_number')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="res_date" class="block mb-2 text-sm font-medium text-pale ">
                        Reservation Date</label>
                    <input type="datetime-local" id="res_date"
                        class="message shadow-sm bg-bgcyan border-2 border-pale text-pale text-sm rounded-lg block w-full p-2.5 @error('res_date') border-red-600 @enderror @error('table_id') border-red-600 @enderror"
                        placeholder="" name="res_date" value="{{ $reservation->res_date }}"
                        aria-describedby="helper-text-explanation-table" onchange="validateTime(this)" />
                    @error('res_date')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                    @error('table_id')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                    <p id="helper-text-explanation-table" class="mt-2 text-sm text-pale">Please Choose the time
                        between 2pm to 9pm</p>
                    <div id="message" class="text-red-500 border-red-600"></div>
                </div>
                <div class="mb-5">
                    <label for="guest_number" class="block mb-2 text-sm font-medium text-pale ">
                        Guest Number</label>
                    <input type="number" id="guest_number"
                        class="messages shadow-sm bg-bgcyan border-2 border-pale text-pale text-sm rounded-lg block w-full p-2.5 @error('guest_number') border-red-600 @enderror"
                        placeholder="guest_number" name="guest_number" value="{{ $reservation->guest_number }}"  aria-describedby="helper-text-explanation-guest"
                        min="1" max="20" step="1" />
                    @error('guest_number')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                    <div id="messages" class="text-red-500 border-red-600"></div>
                    <p id="helper-text-explanation-guest" class="mt-2 text-sm text-pale">You can contact the restaurant if your party is larger than 20</p>
                </div>
                <div class="mb-5">
                    <label for="table" class="block mb-2 text-sm font-medium text-pale ">
                        Table</label>
                    @if ($tables->isEmpty())
                        <select name="table_id" id="table" class="bg-bgcyan text-pale border-2 border-pale w-full"
                            aria-describedby="helper-text-explanation-table">
                            <option value="">No tables available</option>
                        </select>
                        <p id="helper-text-explanation-table" class="mt-2 text-sm text-pale">Each table can be added
                            extra chairs for children</p>
                    @else
                        <select name="table_id" id="table" class="bg-bgcyan text-pale border-2 border-pale w-full"
                            aria-describedby="helper-text-explanation-table">
                            
                            @foreach ($tables as $table)
                            <option value="{{ $table->id }}" data-capacity="{{ $table->capacity }}">{{ $table->name }} ( Capacity -
                                {{ $table->capacity }} ) (Location - {{ $table->location }})</option>
                        @endforeach
                        </select>
                        <p id="helper-text-explanation-table" class="mt-2 text-sm text-pale">Each table can be added
                            extra chairs for children</p>
                    @endif
                </div>

                <div class="mb-5 mx-auto">
                    <x-button id="submit_button">
                        Save
                    </x-button>
                </div>
            </form>
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

        if (hours < 14 || hours > 20) {
            alert("Please select a time between 2 PM and 8:59 PM.");
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
        var tableSelect = document.getElementById('table');
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
