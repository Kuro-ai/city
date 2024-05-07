<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex justify-between">
            {{ __('Menu') }}
            <a href="{{ route('customer.order.shoppingcart', ['reservation_id' => request('reservation_id')]) }}">Shopping Cart</a>
        </h2>
    </x-slot>
    <div class="container w-full px-5 py-6 mx-auto">
        <div class="grid lg:grid-cols-4 gap-y-6">
            <form action="{{ route('customer.order.addToCart') }}" method="post" onsubmit="return checkSelection()">
                <input type="text" name="reservation_id" value="{{ session()->get('reservation_id') }}">
                @csrf
                @foreach ($menus as $menu)
                    <div class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg">
                        <img class="w-full h-48" src="{{ asset('menus/' . $menu->image) }}" alt="Image" />
                        <div class="px-6 py-4">
                            <h4 class="mb-3 text-xl font-semibold tracking-tight text-green-600 uppercase">
                                {{ $menu->name }}</h4>
                            <p class="leading-normal text-gray-700">{{ $menu->description }}.</p>
                        </div>
                        <div class="px-6 py-4">
                            <span class="text-xl text-green-600">${{ $menu->price }}</span>
                            <input type="checkbox" name="menus[]" value="{{ $menu->id }}">
                            <input type="number" name="quantities[{{ $menu->id }}]" min="1" value="1">
                        </div>
                    </div>
                @endforeach
                <button type="submit" onclick="checkSelection()">Add to Cart</button>
            </form>
        </div>
    </div>
</x-app-layout>
<script>
    function checkSelection(event) {
        // Get all checkboxes
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');

        // Check if at least one checkbox is checked
        var isAnyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);

        if (!isAnyChecked) {
            alert('Please select an item before adding to cart');
            return false;      
        }

        // Check if reservation_id is present
        var reservationId = document.getElementById('reservation_id').value;
        if (!reservationId) {
            alert('No reservation ID found');
        }
    }
</script>
