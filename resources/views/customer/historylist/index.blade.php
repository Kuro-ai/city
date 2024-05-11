<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('History') }}
        </h2>
    </x-slot>
    <div>
        <div class="mb-5">
            <ul class="text-sm font-medium text-center bg-slate-100 rounded-lg shadow flex">
                <li id="reservationTab" class="w-full focus-within:z-10">
                    <a href="#" class="inline-block w-full p-4 sborder-r border-gray-200 rounded-s-lg"
                        aria-current="page">Reservation</a>
                </li>
                <li id="orderTab" class="w-full focus-within:z-10">
                    <a href="#" class="inline-block w-full p-4 border-r border-gray-200">Order</a>
                </li>
            </ul>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg" id="reservationContent">
            <table class="w-full text-sm rtl:text-right text-gray-500 text-center">
                <thead class="text-xs text-gray-700 uppercase bg-slate-300">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Phone Number
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Table Number
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Reservation Date
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if (empty($reservationList))
                        <tr>
                            <td colspan="5" class="px-6 py-4 whitespace-nowrap text-center">No List Available
                            </td>
                        </tr>
                    @else
                        @foreach ($reservationList as $reservation)
                            <tr class="odd:bg-white even:bg-gray-50">
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $reservation->first_name }} {{ $reservation->last_name }}
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $reservation->email }}
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $reservation->tel_number }}
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $reservation->table ? $reservation->table->name : 'No table' }}
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $reservation->res_date }}
                                </td>
                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg" id="orderContent" style="display: none;">
            <table class="w-full text-sm rtl:text-right text-gray-500 text-center">
                <thead class="text-xs text-gray-700 uppercase bg-slate-300">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Order ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Phone Number
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Address
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Menu Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Quantity
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Grand Total
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Order Date
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if (empty($orderList))
                        <tr>
                            <td colspan="5" class="px-6 py-4 whitespace-nowrap text-center">No List Available
                            </td>
                        </tr>
                    @else
                    @foreach ($orderList as $orderId => $orderItems)
                    @foreach ($orderItems as $index => $orderItem)
                        <tr class="odd:bg-white even:bg-gray-50">
                            @if ($index === 0)
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $orderId }}
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $orderItems->first()->first_name }} {{ $orderItems->first()->last_name }}
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $orderItems->first()->phone }}
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $orderItems->first()->address }}
                                </td> <!-- Here is the corrected part -->
                            @else
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            @endif
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $orderItem->name }}
                            </td>
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $orderItem->quantity }}
                            </td>
                            @if ($index === 0)
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $orderItems->first()->total }}
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $orderItems->first()->created_at }}
                                </td>
                            @else
                                <td></td>
                                <td></td>
                            @endif
                        </tr>
                    @endforeach
                @endforeach
                    @endif

                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var reservationTab = document.getElementById('reservationTab');
        var orderTab = document.getElementById('orderTab');

        reservationTab.addEventListener('click', function() {
            document.getElementById('orderContent').style.display = 'none';
            document.getElementById('reservationContent').style.display = 'block';
            reservationTab.classList.add('bg-slate-300', 'text-black');
            orderTab.classList.remove('bg-slate-300', 'text-black');
        });

        orderTab.addEventListener('click', function() {
            document.getElementById('reservationContent').style.display = 'none';
            document.getElementById('orderContent').style.display = 'block';
            reservationTab.classList.remove('bg-slate-300', 'text-black');
            orderTab.classList.add('bg-slate-300', 'text-black');
        });
    });
</script>
