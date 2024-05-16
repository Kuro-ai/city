<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Income') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form id="incomeForm" method="POST" action="{{ route('admin.incomes.update', $income->id) }}">
                @csrf
                @method('PUT')
                <div class="flex justify-end">
                    <x-create-button href="{{ route('admin.incomes.index') }}">
                        Income List
                    </x-create-button>
                </div>
                <div id="incomeItems">
                    @foreach ($income->items as $item)
                        <div class="incomeItem">
                            <div>
                                <label for="menu_name[]">Menu Name</label>
                                <select id="menu_name[]" name="menu_name[]" class="menu_name" onchange="calculateTotalPriceOG(event)">
                                    @foreach ($menus as $menu)
                                        <option value="{{ $menu->name }}" data-price="{{ $menu->price }}" {{ $item['menu_name'] == $menu->name ? 'selected' : '' }}>{{ $menu->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="quantity[]">Quantity</label>
                                <input id="quantity[]" type="number" name="quantity[]" class="quantity" onchange="calculateTotalPriceOG(event)" value="{{ $item['quantity'] }}">
                            </div>
                            <div>
                                <label for="total_price[]">Total Price</label>
                                <input id="total_price[]" type="number" step="0.01" name="total_price[]" class="total_price" readonly value="{{ $item['total_price'] }}">
                            </div>
                        </div>
                    @endforeach
                </div>
                <button type="button" id="addIncomeItem">Add Another Item</button>
                <div class="mb-3">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="date">Date</label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="date" type="date" name="date" value="{{ $income->date }}">
                </div>
                <div>
                    <label for="remark">Remark</label>
                    <textarea id="remark" name="remark">{{ $income->remark }}</textarea>
                </div>
                <input type="hidden" id="items" name="items">
                <div>
                    <button type="submit">Update</button>
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

    document.getElementById('addIncomeItem').addEventListener('click', function() {
        var incomeItems = document.getElementById('incomeItems');
        var newIncomeItem = document.createElement('div');
        newIncomeItem.innerHTML = `
        <div>
            <label for="menu_name[]">Menu Name</label>
            <select id="menu_name[]" name="menu_name[]" class="menu_name" onchange="calculateTotalPrice(event)">
                @foreach ($menus as $menu)
                    <option value="{{ $menu->name }}" data-price="{{ $menu->price }}">{{ $menu->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="quantity[]">Quantity</label>
            <input id="quantity[]" type="number" name="quantity[]" min="1" step="1" class="quantity" onchange="calculateTotalPrice(event)">
        </div>
        <div>
            <label for="total_price[]">Total Price</label>
            <input id="total_price[]" type="number" step="0.01" name="total_price[]" class="total_price" readonly>
        </div>
        `;
        incomeItems.appendChild(newIncomeItem);
    });

    document.getElementById('incomeForm').addEventListener('submit', function(e) {
        var menuNames = Array.from(document.getElementsByName('menu_name[]')).map(input => input.value);
        var quantities = Array.from(document.getElementsByName('quantity[]')).map(input => input.value);
        var totalPrices = Array.from(document.getElementsByName('total_price[]')).map(input => input.value);
        var incomeItems = menuNames.map((menuName, index) => ({
            menu_name: menuName,
            quantity: quantities[index],
            total_price: totalPrices[index]
        }));
        document.getElementById('items').value = JSON.stringify(incomeItems);
    });

    document.getElementById('incomeForm').addEventListener('submit', function(e) {
        var menuNames = Array.from(document.getElementsByName('menu_name[]')).map(input => input.value);
        var quantities = Array.from(document.getElementsByName('quantity[]')).map(input => input.value);
        var totalPrices = Array.from(document.getElementsByName('total_price[]')).map(input => input.value);
        var incomeItems = menuNames.map((menuName, index) => ({
            menu_name: menuName,
            quantity: quantities[index],
            total_price: totalPrices[index]
        })).filter(item => item.menu_name && item.quantity && item.total_price);
        document.getElementById('items').value = JSON.stringify(incomeItems);
    });

    function calculateTotalPriceOG(event) {
    var parentDiv = event.target.parentNode.parentNode;
    var menuSelect = parentDiv.querySelector('.menu_name');
    var quantityInput = parentDiv.querySelector('.quantity');
    var totalPriceInput = parentDiv.querySelector('.total_price');

    var selectedOption = menuSelect.options[menuSelect.selectedIndex];
    var menuPrice = parseFloat(selectedOption.getAttribute('data-price'));
    var quantity = parseFloat(quantityInput.value);

    if (!isNaN(menuPrice) && !isNaN(quantity)) {
        totalPriceInput.value = (menuPrice * quantity).toFixed(2);
    }
}

    function calculateTotalPrice(event) {
        var parentDiv = event.target.parentNode.parentNode;
        var menuSelect = parentDiv.querySelector('.menu_name');
        var quantityInput = parentDiv.querySelector('.quantity');
        var totalPriceInput = parentDiv.querySelector('.total_price');

        var selectedOption = menuSelect.options[menuSelect.selectedIndex];
        var menuPrice = parseFloat(selectedOption.getAttribute('data-price'));
        var quantity = parseFloat(quantityInput.value);

        if (!isNaN(menuPrice) && !isNaN(quantity)) {
            totalPriceInput.value = (menuPrice * quantity).toFixed(2);
        }
    }
</script>
