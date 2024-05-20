<div>
    <div class="flex justify-between">
        <div id="search-bar">
            <form class="d-flex" role="search">
                <input wire:model.live="search" class="form-control me-2" type="date" placeholder="Search"
                    aria-label="Search">
            </form>
        </div>
        <x-create-button href="{{ route('admin.expenses.create') }}">
            New Expense
        </x-create-button>  
    </div>
    
    <div class="h-[55rem] overflow-x-scroll relative shadow-md sm:rounded-lg">
        <table class="w-max text-sm rtl:text-right text-pale text-center m-auto mt-6">
            <thead class="text-xs text-bbyellow border-2 border-pale uppercase bg-bgcyan">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Quantity
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Total Price
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Remark
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @if (empty($expenses))
                    <tr>
                        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center">No categories found
                        </td>
                    </tr>
                @else
                    @foreach ($expenses as $expense)
                        <tr class="bg-bgcyan text-pale border-2 border-pale">
                            <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                {{ $expense->name }}
                            </td>
                            <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                {{ $expense->quantity }}
                            </td>
                            <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                {{ $expense->total_price }}
                            </td>
                            <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                {{ $expense->date }}
                            </td>
                            @if (empty($expense->remark))
                                <td></td>
                            @else
                                <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                    {{ $expense->remark }}
                                </td>
                            @endif
                            <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                <div class="flex space-x-2 justify-center items-center">
                                    <a href="{{ route('admin.expenses.edit', $expense->id) }}"
                                        class="px-3 py-3 hover:bg-green-200 rounded-lg text-white">
                                        <img src="{{ asset('others/edit.png') }}" class="w-8 h-8">
                                    </a>
                                    <form class="px-2 py-3  hover:bg-red-400 rounded-lg text-white"
                                        action="{{ route('admin.expenses.destroy', $expense->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"><img src="{{ asset('others/delete.png') }}"
                                                class="w-8 h-8"></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif

            </tbody>
        </table>
        <div class="p-6">{{ $expenses->links() }}</div>
    </div>
</div>

</div>
