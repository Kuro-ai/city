<x-app-layout>
    <!-- Page Content -->
    <div class="flex items-center justify-center h-screen text-center ">
        <div class="block max-w p-10 bg-white border border-gray-200 rounded-lg shadow">
            <h1 class="mb-6 text-2xl font-bold tracking-tight text-gray-900 bg-gray-200 p-4 rounded-t-lg">Thank you</h1>
            <p class="font-normal text-gray-700 mb-3">Your reservation is ready.</p>
            {{-- <a href="{{ route('customer.index') }}" class="inline-block px-6 py-2 text-xs font-medium leading-6 text-center text-white uppercase transition bg-blue-600 rounded shadow ripple hover:shadow-lg hover:bg-blue-800 focus:outline-none">
                Go back to Home
            </a> --}}

            <form id="orderForm">
                <div class="mb-5 sm:col-span-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900 ">
                        Do you want to order food with your reservation?
                    </label>
                    <div class="mt-2">
                        <div>
                            <label class="inline-flex items-center">
                                <input type="radio" class="form-radio" name="order_food" value="yes">
                                <span class="ml-2">Yes</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" class="form-radio" name="order_food" value="no">
                                <span class="ml-2">No</span>
                            </label>
                        </div>
                    </div>
                </div>
                <x-button class="ms-4" type="submit">
                    Submit
                </x-button>
            </form>
        </div>

    </div>
</x-app-layout>
<script>
    document.getElementById('orderForm').addEventListener('submit', function(event) {
        event.preventDefault();

        var orderFood = document.querySelector('input[name="order_food"]:checked').value;

        if (orderFood === 'yes') {
            window.location.href =
            "{{ route('customer.menus.index') }}"; 
        } else {
            window.location.href =
            "{{ route('customer.index') }}";
        }
    });
</script>
