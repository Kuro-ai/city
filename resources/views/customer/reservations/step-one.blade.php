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
                            src="{{ asset('others/step-one.jpg') }}" alt="img" />
                    </div>
                    <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                        <div class="w-full">
                            <h3 class="mb-4 text-xl font-bold text-blue-600">Make Reservation</h3>

                            <div class="w-full bg-gray-200 rounded-full">
                                <div
                                    class="w-48 p-1 text-xs font-medium leading-none text-center text-blue-100 bg-blue-600 rounded-full">
                                    Step1
                                </div>
                            </div>

                            <form method="POST" action="{{ route('customer.reservations.store.step.one') }}">
                                @csrf 
                                <div class="mb-5 sm:col-span-6">
                                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 ">First
                                        Name</label>
                                    <input type="text" id="first_name"
                                        class="shadow-sm bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('first_name') border-red-600 @enderror"
                                        placeholder="First Name" name="first_name" />
                                    @error('first_name')
                                        <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-5 sm:col-span-6">
                                    <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 ">Last
                                        Name</label>
                                    <input type="text" id="last_name"
                                        class="shadow-sm bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('last_name') border-red-600 @enderror"
                                        placeholder="Last Name" name="last_name" />
                                    @error('last_name')
                                        <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-5 sm:col-span-6">
                                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
                                    <input type="email" id="email"
                                        class="shadow-sm bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('email') border-red-600 @enderror"
                                        placeholder="example@gmail.com" name="email" />
                                    @error('email')
                                        <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-5 sm:col-span-6">
                                    <label for="tel_number" class="block mb-2 text-sm font-medium text-gray-900 ">Phone
                                        Number</label>
                                    <input type="text" id="tel_number"
                                        class="shadow-sm bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('tel_number') border-red-600 @enderror"
                                        placeholder="09-xxx xxxxxx" name="tel_number"onkeypress="return isNumberKey(event)" />
                                    @error('tel_number')
                                        <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-5 sm:col-span-6">
                                    <input type="hidden" name="user_id" value="{{ \Illuminate\Support\Facades\Auth::id() }}">
                                </div>
                               
                                <div class="mt-6 p-4 flex justify-end">
                                    <button type="submit"
                                        class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Next</button>
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

        function checkCapacity() {
            var guestNumber = Number(guestNumberInput.value);
            var selectedTableCapacity = Number(tableSelect.options[tableSelect.selectedIndex].dataset.capacity);

            if (guestNumber > selectedTableCapacity) {
                messageDiv.textContent =
                    'The selected number of guests is greater than the capacity of the selected table.';
                guestNumberInput.classList.add('message', 'border-red-600');
            } else {
                messageDiv.textContent = '';
                guestNumberInput.classList.remove('message', 'border-red-600');
            }
        }

        guestNumberInput.addEventListener('change', checkCapacity);
        tableSelect.addEventListener('change', checkCapacity);
    });
</script>
