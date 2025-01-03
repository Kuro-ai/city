<div>
    <div class="flex justify-between">
        <div id="search-bar">
            <form class="d-flex" role="search">
                <input wire:model.live="search" class="form-control me-2" type="date" placeholder="Search"
                    aria-label="Search">
            </form>
        </div>
        <x-create-button href="{{ route('admin.incomes.create') }}">
            New Income
        </x-create-button>
    </div>
    
    <div class="h-[55rem] overflow-x-scroll relative shadow-md sm:rounded-lg">
        <table class="w-max text-sm rtl:text-right text-pale text-center m-auto mt-6">
            <thead class="text-xs text-bbyellow uppercase bg-bgcyan border-2 border-pale">
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
                            $items = is_array($income->items) ? $income->items : json_decode($income->items, true);
                        @endphp
                        @foreach ($items as $item)
                            <tr class="border-2 border-pale text-pale bg-bgcyan">
                                <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                    {{ $item['menu_name'] }}
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                    {{ $item['quantity'] }}
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                    {{ $item['total_price'] }}
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                    @if ($loop->first)
                                        @php
                                            $rowTotalPrice = 0;
                                            foreach ($items as $item) {
                                                $rowTotalPrice += (float) $item['total_price'];
                                            }
                                        @endphp

                                        {{ $rowTotalPrice }}
                                    @endif
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                    @if ($loop->first)
                                        {{ $income->date }}
                                    @endif
                                </td>
                                @if (empty($income->remark))
                                    <td></td>
                                @else
                                    <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                        @if ($loop->first)
                                            {{ $income->remark }}
                                        @endif
                                    </td>
                                @endif
                                <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
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
                                                <button type="submit"><img src="{{ asset('others/delete.png') }}"
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
<script></script>
