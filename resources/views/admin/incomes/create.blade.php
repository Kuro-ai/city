<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-bbyellow leading-tight">
            {{ __('Calculate Income') }}
        </h2>
    </x-slot>
    @if (session('status'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-3 text-center"
            role="alert">
            {{ session('status') }}
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3 close-alert">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <title>Close</title>
                    <path
                        d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                </svg>
            </span>
        </div>
    @endif
    @if (session('deletestatus'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-3 text-center"
            role="alert">
            {{ session('status') }}
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3 close-alert">
                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <title>Close</title>
                    <path
                        d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                </svg>
            </span>
        </div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form class="max-w-sm mx-auto bg-bgcyan border-2 border-pale p-6 rounded-md" id="incomeForm" method="POST" action="{{ route('admin.incomes.store') }}">
                @csrf
                <div class="flex justify-end">
                    <x-create-button href="{{ route('admin.incomes.index') }}">
                        Income List
                    </x-create-button>
                </div>
                <div id="incomeItems">
                    <div class="incomeItem">
                        <div class="mb-5 mx-auto">
                            <label class="block text-pale text-sm font-bold mb-2" for="menu_name[]">Menu Name</label>
                            <select  class="shadow appearance-none rounded w-full py-2 px-3 text-pale bg-bgcyan border-2 border-pale leading-tight focus:outline-none focus:shadow-outline" id="menu_name[]" name="menu_name[]" class="menu_name" onchange="calculateTotalPriceOG()">
                                @foreach ($menus as $menu)
                                    <option value="{{ $menu->name }}" data-price="{{ $menu->price }}">{{ $menu->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-5 mx-auto">
                            <label class="block text-pale text-sm font-bold mb-2" for="quantity[]">Quantity</label>
                            <input class="shadow appearance-none rounded w-full py-2 px-3 text-pale bg-bgcyan border-2 border-pale leading-tight focus:outline-none focus:shadow-outline" id="quantity[]" type="number" name="quantity[]" class="quantity" onchange="calculateTotalPriceOG()">
                        </div>
                        <div class="mb-5 mx-auto">
                            <label class="block text-pale text-sm font-bold mb-2" for="total_price[]">Total Price</label>
                            <input  class="shadow appearance-none rounded w-full py-2 px-3 text-pale bg-bgcyan border-2 border-pale leading-tight focus:outline-none focus:shadow-outline" id="total_price[]" type="number" step="0.01" name="total_price[]" class="total_price" readonly>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center">
                    <button type="button" id="addIncomeItem"  class="bg-gradient-to-r from-bbyellow via-yellow-300 to-yellow-500 hover:bg-gradient-to-br text-bgcyan font-bold py-2 px-4 my-4 rounded m-auto">Add Another Item</button>
                </div>
                <div class="mb-3">
                    <label class="block text-pale text-sm font-bold mb-2" for="date">Date</label>
                    <input 
                    class="shadow appearance-none rounded w-full py-2 px-3 text-pale bg-bgcyan border-2 border-pale leading-tight focus:outline-none focus:shadow-outline"
                        id="date" type="date" name="date">
                </div>
                <div class="mb-5 mx-auto">
                    <label class="block text-pale text-sm font-bold mb-2" for="remark">Remark</label>
                    <textarea class="bg-bgcyan text-pale w-full border-pale id="remark' name="remark" rows="4" cols="50"></textarea>
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

    document.getElementById('addIncomeItem').addEventListener('click', function() {
    var incomeItems = document.getElementById('incomeItems');
    var newIncomeItem = document.createElement('div');
    newIncomeItem.innerHTML = `
        <div class="mb-5 mx-auto">
            <label class="block text-pale text-sm font-bold mb-2" for="menu_name[]">Menu Name</label>
            <select class="shadow appearance-none rounded w-full py-2 px-3 text-pale bg-bgcyan border-2 border-pale leading-tight focus:outline-none focus:shadow-outline" id="menu_name[]" name="menu_name[]" class="menu_name" onchange="calculateTotalPrice(event)">
                @foreach ($menus as $menu)
                    <option value="{{ $menu->name }}" data-price="{{ $menu->price }}">{{ $menu->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-5 mx-auto">
            <label class="block text-pale text-sm font-bold mb-2" for="quantity[]">Quantity</label>
            <input class="shadow appearance-none rounded w-full py-2 px-3 text-pale bg-bgcyan border-2 border-pale leading-tight focus:outline-none focus:shadow-outline" id="quantity[]" type="number" name="quantity[]" min="1" step="1" class="quantity" onchange="calculateTotalPrice(event)">
        </div>
        <div class="mb-5 mx-auto">
            <label class="block text-pale text-sm font-bold mb-2" for="total_price[]">Total Price</label>
            <input class="shadow appearance-none rounded w-full py-2 px-3 text-pale bg-bgcyan border-2 border-pale leading-tight focus:outline-none focus:shadow-outline" id="total_price[]" type="number" step="0.01" name="total_price[]" class="total_price" readonly>
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

    function calculateTotalPriceOG() {
    var menuSelect = document.querySelector('.menu_name');
    var quantityInput = document.querySelector('.quantity');
    var totalPriceInput = document.querySelector('.total_price');

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
