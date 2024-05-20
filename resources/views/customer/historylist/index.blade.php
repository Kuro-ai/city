<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-bbyellow leading-tight">
            {{ __('History') }}
        </h2>
    </x-slot>
    <div>
        <div class="mb-5">
            <ul class="text-sm font-medium text-center bg-pale rounded-lg shadow flex text-bgcyan">
                <li id="reservationTab" class="w-full focus-within:z-10">
                    <a href="#" class="inline-block w-full p-4 sborder-r border-pale   rounded-s-lg"
                        aria-current="page">Reservation</a>
                </li>
                <li id="orderTab" class="w-full focus-within:z-10">
                    <a href="#" class="inline-block w-full p-4 border-r border-pale  ">Order</a>
                </li>
            </ul>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg" id="reservationContent">
            <table class="w-full text-sm rtl:text-right text-gray-500 text-center">
                <thead class="text-xs text-bbyellow uppercase bg-bgcyan border-2 border-pale">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            ID Number
                        </th>
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
                            <tr class="bg-bgcyan text-pale border-2 border-pale">
                                <td scope="row" class="px-6 py-4 font-medium  whitespace-nowrap">
                                    {{ $reservation->id }}
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium  whitespace-nowrap">
                                    {{ $reservation->first_name }} {{ $reservation->last_name }}
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium  whitespace-nowrap">
                                    {{ $reservation->email }}
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium  whitespace-nowrap">
                                    {{ $reservation->tel_number }}
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium  whitespace-nowrap">
                                    {{ $reservation->table ? $reservation->table->name : 'No table' }}
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium  whitespace-nowrap">
                                    {{ $reservation->res_date }}
                                </td>
                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
            <div class="p-6">
                {{ $reservationList->links() }}
            </div>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg" id="orderContent" style="display: none;">
            <table class="w-full text-sm rtl:text-right text-gray-500 text-center">
                <thead class="text-xs text-bbyellow uppercase bg-bgcyan border-2 border-pale">
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
                    @if (!empty($orderList))
                        @php
                            $lastOrderId = null;
                            $total = null;
                            $order_date = null;
                        @endphp
                        @foreach ($orderList as $order)
                            @if ($lastOrderId !== $order->id)
                                @php
                                    $total = $order->total;
                                    $order_date = $order->order_date;
                                @endphp
                            @endif
                            <tr class="bg-bgcyan text-pale border-2 border-pale">
                                <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                    @if ($lastOrderId !== $order->id)
                                        {{ $order->id }}
                                        @php
                                            $lastOrderId = $order->id;
                                        @endphp
                                    @endif
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                    {{ $order->first_name }} {{ $order->last_name }}
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                    {{ $order->phone }}
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                    {{ $order->address }}
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                    {{ $order->name }}
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                    {{ $order->quantity }}
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                    {{ $total }}
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                    {{ $order_date }}
                                </td>
                            </tr>
                            @php
                                $total = null;
                                $order_date = null;
                            @endphp
                        @endforeach
                    @endif
                </tbody>
            </table>
            <div class="p-6">
                {{ $orderList->links() }}
            </div>
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
            reservationTab.classList.add('bg-bgcyan', 'text-bbyellow', 'border-2', 'border-pale');
            orderTab.classList.remove('bg-bgcyan', 'text-bbyellow', 'border-2', 'border-pale');
        });

        orderTab.addEventListener('click', function() {
            document.getElementById('reservationContent').style.display = 'none';
            document.getElementById('orderContent').style.display = 'block';
            reservationTab.classList.remove('bg-bgcyan', 'text-bbyellow', 'border-2', 'border-pale');
            orderTab.classList.add('bg-bgcyan', 'text-bbyellow', 'border-2', 'border-pale');
        });
    });
</script>
