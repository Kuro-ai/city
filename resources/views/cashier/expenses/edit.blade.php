<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-bbyellow leading-tight">
            {{ __('Edit Expense') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form class="max-w-sm mx-auto bg-bgcyan border-2 border-pale p-6 rounded-md" id="expenseForm" method="POST"
                action="{{ route('cashier.expenses.update', $expense->id) }}">
                @csrf
                @method('PUT')
                <div class="flex justify-end">
                    <x-create-button href="{{ route('cashier.expenses.index') }}">
                        Expense List
                    </x-create-button>
                </div>
                <div id="expenseItems">
                    @foreach ($expense->items as $item)
                        <div class="expenseItem">
                            <div class="mb-5 mx-auto">
                                <label class="block text-pale text-sm font-bold mb-2" for="menu_name[]">Name</label>
                                <input
                                    class="shadow appearance-none rounded w-full py-2 px-3 text-pale bg-bgcyan border-2 border-pale leading-tight focus:outline-none focus:shadow-outline"
                                    id="menu_name[]" type="text" name="menu_name[]" value="{{ $item['menu_name'] }}">
                            </div>
                            <div class="mb-5 mx-auto">
                                <label class="block text-pale text-sm font-bold mb-2" for="quantity[]">Quantity</label>
                                <input
                                    class="shadow appearance-none rounded w-full py-2 px-3 text-pale bg-bgcyan border-2 border-pale leading-tight focus:outline-none focus:shadow-outline"
                                    id="quantity[]" type="number" name="quantity[]" class="quantity"
                                    value="{{ $item['quantity'] }}">
                            </div>
                            <div class="mb-5 mx-auto">
                                <label class="block text-pale text-sm font-bold mb-2" for="total_price[]">Total
                                    Price</label>
                                <input
                                    class="shadow appearance-none rounded w-full py-2 px-3 text-pale bg-bgcyan border-2 border-pale leading-tight focus:outline-none focus:shadow-outline"
                                    id="total_price[]" type="number" step="0.01" name="total_price[]"
                                    class="total_price" readonly value="{{ $item['total_price'] }}">
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="flex justify-">
                    <button type="button" id="addexpenseItem"
                        class="bg-gradient-to-r from-bbyellow via-yellow-300 to-yellow-500 hover:bg-gradient-to-br text-bgcyan font-bold py-2 px-4 my-4 rounded m-auto">Add
                        Another Item</button>
                </div>
                <div class="mb-3">
                    <label class="block text-pale text-sm font-bold mb-2"
                        class="block text-gray-700 text-sm font-bold mb-2" for="date">Date</label>
                    <input
                        class="shadow appearance-none rounded w-full py-2 px-3 text-pale bg-bgcyan border-2 border-pale leading-tight focus:outline-none focus:shadow-outline"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="date" type="date" name="date" value="{{ $expense->date }}">
                </div>
                <div class="mb-5 mx-auto">
                    <label class="block text-pale text-sm font-bold mb-2" for="remark">Remark</label>
                    <textarea
                        class="shadow appearance-none rounded w-full py-2 px-3 text-pale bg-bgcyan border-2 border-pale leading-tight focus:outline-none focus:shadow-outline"
                        rows="4" cols="50" id="remark" name="remark">{{ $expense->remark }}</textarea>
                </div>
                <input
                    class="shadow appearance-none rounded w-full py-2 px-3 text-pale bg-bgcyan border-2 border-pale leading-tight focus:outline-none focus:shadow-outline"
                    type="hidden" id="items" name="items">
                <div class="mb-5 mx-auto">
                    <x-button>
                        Update
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const dateInput = document.getElementById('date');
        const today = new Date();
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0'); // Months are 0-based, so we add 1
        const day = String(today.getDate()).padStart(2, '0');
        dateInput.value = `${year}-${month}-${day}`;
    });

    document.getElementById('addexpenseItem').addEventListener('click', function() {
        var expenseItems = document.getElementById('expenseItems');
        var newexpenseItem = document.createElement('div');
        newexpenseItem.innerHTML = `
        <div class="mb-5 mx-auto">
            <label class="block text-pale text-sm font-bold mb-2" for="menu_name[]">Name</label>
            <input class="shadow appearance-none rounded w-full py-2 px-3 text-pale bg-bgcyan border-2 border-pale leading-tight focus:outline-none focus:shadow-outline" id="menu_name[]" type="text" name="menu_name[]" value="{{ $item['menu_name'] }}">
        </div>
        <div class="mb-5 mx-auto">
            <label class="block text-pale text-sm font-bold mb-2" for="quantity[]">Quantity</label>
            <input class="shadow appearance-none rounded w-full py-2 px-3 text-pale bg-bgcyan border-2 border-pale leading-tight focus:outline-none focus:shadow-outline" id="quantity[]" type="number" name="quantity[]" min="1" step="1" class="quantity" onchange="calculateTotalPrice(event)">
        </div>
        <div class="mb-5 mx-auto">
            <label class="block text-pale text-sm font-bold mb-2" for="total_price[]">Total Price</label>
            <input class="shadow appearance-none rounded w-full py-2 px-3 text-pale bg-bgcyan border-2 border-pale leading-tight focus:outline-none focus:shadow-outline" id="total_price[]" type="number" step="0.01" name="total_price[]" class="total_price">
        </div>
        `;
        expenseItems.appendChild(newexpenseItem);
    });

    document.getElementById('expenseForm').addEventListener('submit', function(e) {
        var names = Array.from(document.getElementsByName('menu_name[]')).map(input => input.value);
        var quantities = Array.from(document.getElementsByName('quantity[]')).map(input => input.value);
        var totalPrices = Array.from(document.getElementsByName('total_price[]')).map(input => input.value);
        var expenseItems = names.map((name, index) => ({
            menu_name: name,
            quantity: quantities[index],
            total_price: totalPrices[index]
        }));
        document.getElementById('items').value = JSON.stringify(expenseItems);
    });
</script>
