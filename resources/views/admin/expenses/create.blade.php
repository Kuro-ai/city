<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-bbyellow leading-tight">
            {{ __('Calculate Expense') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form class="max-w-sm mx-auto bg-bgcyan border-2 border-pale p-6 rounded-md" id="ExpenseForm" method="POST"
                action="{{ route('admin.expenses.store') }}">
                @csrf
                <div class="flex justify-end">
                    <x-create-button href="{{ route('admin.expenses.index') }}">
                        Expense List
                    </x-create-button>
                </div>
                <div id="expenseItems">
                    <div class="expenseItem">
                        <div class="mb-3">
                            <label class="block text-pale bg-bgcyan text-sm font-bold mb-2" for="menu_name[]">Name</label>
                            <input
                                class="shadow appearance-none rounded w-full py-2 px-3 text-pale bg-bgcyan {{ $errors->has('name') ? 'border-red-500' : 'border-pale' }} leading-tight focus:outline-none focus:shadow-outline"
                                id="menu_name[]" type="text" name="menu_name[]">
                            @error('name')
                                <p class="text-red-500 text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="block text-pale bg-bgcyan text-sm font-bold mb-2" for="quantity">Quantity</label>
                            <input
                                class="shadow appearance-none rounded w-full py-2 px-3 text-pale bg-bgcyan border-2 {{ $errors->has('quantity') ? 'border-red-500' : 'border-pale' }} leading-tight focus:outline-none focus:shadow-outline"
                                id="quantity[]" type="number" name="quantity[]" min="1" step="1">
                            @error('quantity')
                                <p class="text-red-500 text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="block text-pale bg-bgcyan text-sm font-bold mb-2" for="total_price">Total
                                Price</label>
                            <input
                                class="shadow appearance-none rounded w-full py-2 px-3 text-pale bg-bgcyan border-2 {{ $errors->has('total_price') ? 'border-red-500' : 'border-pale' }} leading-tight focus:outline-none focus:shadow-outline"
                                id="total_price[]" type="number" min="0" step="0.01" name="total_price[]">
                            @error('total_price')
                                <p class="text-red-500 text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="flex justify-center">
                    <button type="button" id="addExpenseItem"
                        class="bg-gradient-to-r from-bbyellow via-yellow-300 to-yellow-500 hover:bg-gradient-to-br text-bgcyan font-bold py-2 px-4 my-4 rounded m-auto">Add
                        Another Item</button>
                </div>
                <div class="mb-3">
                    <label class="block text-pale bg-bgcyan text-sm font-bold mb-2" for="date">Date</label>
                    <input
                        class="shadow appearance-none rounded w-full py-2 px-3 text-pale bg-bgcyan border-2 leading-tight focus:outline-none focus:shadow-outline"
                        id="date" type="date" name="date">
                </div>
                <div class="mb-3">
                    <label class="block text-pale bg-bgcyan text-sm font-bold mb-2" for="remark">Remark</label>
                    <textarea
                        class="shadow appearance-none rounded w-full py-2 px-3 text-pale bg-bgcyan border-2 leading-tight focus:outline-none focus:shadow-outline"
                        id="remark" name="remark"></textarea>
                </div>
                <input type="hidden" id="items" name="items">
                <div class="mb-5 mx-auto">
                    <x-button>
                        Save
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

    document.getElementById('addExpenseItem').addEventListener('click', function() {
        var expenseItems = document.getElementById('expenseItems');
        var newExpenseItem = document.createElement('div');
        newExpenseItem.innerHTML = `
       <div class="mb-3">
                            <label class="block text-pale bg-bgcyan text-sm font-bold mb-2" for="menu_name[]">Name</label>
                            <input
                                class="shadow appearance-none rounded w-full py-2 px-3 text-pale bg-bgcyan {{ $errors->has('name') ? 'border-red-500' : 'border-pale' }} leading-tight focus:outline-none focus:shadow-outline"
                                id="menu_name[]" type="text" name="menu_name[]">
                            @error('name')
                                <p class="text-red-500 text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="block text-pale bg-bgcyan text-sm font-bold mb-2" for="quantity">Quantity</label>
                            <input
                                class="shadow appearance-none rounded w-full py-2 px-3 text-pale bg-bgcyan border-2 {{ $errors->has('quantity') ? 'border-red-500' : 'border-pale' }} leading-tight focus:outline-none focus:shadow-outline"
                                id="quantity[]" type="number" name="quantity[]" min="1" step="1">
                            @error('quantity')
                                <p class="text-red-500 text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="block text-pale bg-bgcyan text-sm font-bold mb-2" for="total_price">Total
                                Price</label>
                            <input
                                class="shadow appearance-none rounded w-full py-2 px-3 text-pale bg-bgcyan border-2 {{ $errors->has('total_price') ? 'border-red-500' : 'border-pale' }} leading-tight focus:outline-none focus:shadow-outline"
                                id="total_price[]" type="number" min="0" step="0.01" name="total_price[]">
                            @error('total_price')
                                <p class="text-red-500 text-xs">{{ $message }}</p>
                            @enderror
                        </div>
    `;
        expenseItems.appendChild(newExpenseItem);
    });

    document.getElementById('ExpenseForm').addEventListener('submit', function(e) {
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
