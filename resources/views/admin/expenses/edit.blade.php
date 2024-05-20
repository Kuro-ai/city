<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-bbyellow leading-tight">
            {{ __('Edit Expense') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div id="Expense" class="tabcontent mt-2">
                <form class="max-w-sm mx-auto bg-bgcyan border-2 border-pale p-6 rounded-md" method="POST" action="{{ route('admin.expenses.update', $expense->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="flex justify-end">
                        <x-create-button href="{{ route('admin.expenses.index') }}">
                            Expense List
                        </x-create-button>
                    </div>
                    <div class="mb-3">
                        <label class="block text-pale bg-bgcyan text-sm font-bold mb-2" for="name">Name</label>
                        <input
                            class="shadow appearance-none rounded w-full py-2 px-3 text-pale bg-bgcyan border-2 border-pale leading-tight focus:outline-none focus:shadow-outline"
                            id="name" type="text" name="name" value="{{ $expense->name }}">
                    </div>
                    <div class="mb-3">
                        <label class="block text-pale bg-bgcyan text-sm font-bold mb-2" for="quantity">Quantity</label>
                        <input
                            class="shadow appearance-none rounded w-full py-2 px-3 text-pale bg-bgcyan border-2 border-pale leading-tight focus:outline-none focus:shadow-outline"
                            id="quantity" type="number" name="quantity" min="1" step="1"
                            value="{{ $expense->quantity }}">
                    </div>
                    <div class="mb-3">
                        <label class="block text-pale bg-bgcyan text-sm font-bold mb-2" for="total_price">Total Price</label>
                        <input
                            class="shadow appearance-none rounded w-full py-2 px-3 text-pale bg-bgcyan border-2 border-pale leading-tight focus:outline-none focus:shadow-outline"
                            id="total_price" type="number" step="0.01" name="total_price"
                            value="{{ $expense->total_price }}">
                    </div>
                    <div class="mb-3">
                        <label class="block text-pale bg-bgcyan text-sm font-bold mb-2" for="date">Date</label>
                        <input
                            class="shadow appearance-none rounded w-full py-2 px-3 text-pale bg-bgcyan border-2 border-pale leading-tight focus:outline-none focus:shadow-outline"
                            id="date" type="date" name="date"
                            value="{{ \Carbon\Carbon::parse($expense->date)->format('Y-m-d') }}">
                    </div>
                    <div class="mb-3">
                        <label class="block text-pale bg-bgcyan text-sm font-bold mb-2" for="remark">Remark</label>
                        <textarea
                            class="shadow appearance-none rounded w-full py-2 px-3 text-pale bg-bgcyan border-2 border-pale leading-tight focus:outline-none focus:shadow-outline"
                            id="remark" name="remark">{{ $expense->remark }}</textarea>
                    </div>
                    <div class="mb-5 mx-auto">
                        <x-button>
                            Update
                        </x-button>
                    </div>
                </form>
            </div>
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
</script>
