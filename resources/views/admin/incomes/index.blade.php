<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Expense') }}
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
            {{ session('deletestatus') }}
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
            <div class="flex justify-end">
                <x-create-button href="{{ route('admin.incomes.create') }}">
                    New Income
                </x-create-button>

            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm rtl:text-right text-gray-500 text-center">
                    <thead class="text-xs text-gray-700 uppercase bg-slate-300">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Menu Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Quantity
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Total Price
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Grand Total
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
                        @if (empty($incomes))
                            <tr>
                                <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center">No list found
                                </td>
                            </tr>
                        @else
                            @foreach ($incomes as $income)
                                @php
                                    $totalPrice = array_reduce(
                                        $income->items,
                                        function ($carry, $item) {
                                            return $carry + $item['total_price'];
                                        },
                                        0,
                                    );
                                @endphp
                                @foreach ($income->items as $item)
                                    <tr class="odd:bg-white even:bg-gray-50">
                                        <td scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            {{ $item['menu_name'] }}
                                        </td>
                                        <td scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            {{ $item['quantity'] }}
                                        </td>
                                        <td scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            {{ $item['total_price'] }}
                                        </td>
                                        <td scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            @if ($loop->first)
                                                {{ $totalPrice }}
                                            @endif
                                        </td>
                                        <td scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            @if ($loop->first)
                                                {{ $income->date }}
                                            @endif
                                        </td>
                                        @if (empty($income->remark))
                                            <td></td>
                                        @else
                                            <td scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                @if ($loop->first)
                                                    {{ $income->remark }}
                                                @endif
                                            </td>
                                        @endif
                                        <td scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            <div class="flex space-x-2 justify-center items-center">
                                                @if ($loop->first)
                                                    <a href="{{ route('admin.incomes.edit', $income->id) }}"
                                                        class="px-3 py-3 hover:bg-green-200 rounded-lg text-white">
                                                        <img src="{{ asset('others/edit.png') }}" class="w-8 h-8">
                                                    </a>
                                                    <form class="px-2 py-3  hover:bg-red-400 rounded-lg text-white"
                                                        action="{{ route('admin.incomes.destroy', $income->id) }}"
                                                        method="POST" onsubmit="return confirm('Are you sure?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"><img
                                                                src="{{ asset('others/delete.png') }}"
                                                                class="w-8 h-8"></button>

                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <div class="p-6">{{ $incomes->links() }}</div>
            </div>

        </div>
    </div>
</x-app-layout>
