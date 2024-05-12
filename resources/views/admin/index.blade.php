<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
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
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                This is the admin page.
                (1) Dont forget to change the footer
                (1.1) Contact Page & Terms Page
                (2) Also search funciton for all tables.
                (2.1) Add edit or delete in admin.index
                (3) UI changes -> Also in shopping cart images and checkout form. Change every button.
                (4) Email notification for new reservation and order.
                (last) Seed category, menu and table. Chart in admin dashboard. Expense table for name, purchase date
                and
                price. If im in the mood i can calculate profit and income.
            </div>
        </div>
    </div>
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
                {{-- <li id="orderItemTab" class="w-full focus-within:z-10">
                    <a href="#" class="inline-block w-full p-4 border-r border-gray-200">Order</a>
                </li> --}}
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
            <div class="p-6">
                {{ $reservationList->links() }}
            </div>
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
                    @if (!empty($orderList))
                        @php
                            $lastOrderId = null;
                            $total = null;
                            $created_at = null;
                        @endphp
                        @foreach ($orderList as $order)
                            @if ($lastOrderId !== $order->id)
                                @php
                                    $total = $order->total;
                                    $created_at = $order->created_at;
                                @endphp
                            @endif
                            <tr class="odd:bg-white even:bg-gray-50">
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    @if ($lastOrderId !== $order->id)
                                        {{ $order->id }}
                                        @php
                                            $lastOrderId = $order->id;
                                        @endphp
                                    @endif
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $order->first_name }} {{ $order->last_name }}
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $order->phone }}
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $order->address }}
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $order->name }}
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $order->quantity }}
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $total }}
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $created_at }}
                                </td>
                            </tr>
                            @php
                                $total = null;
                                $created_at = null;
                            @endphp
                        @endforeach
                    @endif
                </tbody>
            </table>
            <div class="p-6">
                {{ $orderList->links() }}
            </div>
        </div>
        {{-- <div class="relative overflow-x-auto shadow-md sm:rounded-lg" id="orderItemContent" style="display: none;">
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
        </div> --}}
    </div>
</x-app-layout>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var reservationTab = document.getElementById('reservationTab');
        var orderTab = document.getElementById('orderTab');

        reservationTab.addEventListener('click', function() {
            document.getElementById('orderContent').style.display = 'none';
            // document.getElementById('orderItemContent').style.display = 'none';
            document.getElementById('reservationContent').style.display = 'block';
            reservationTab.classList.add('bg-slate-300', 'text-black');
            orderTab.classList.remove('bg-slate-300', 'text-black');
            // orderItemTab.classList.remove('bg-slate-300', 'text-black');
        });

        orderTab.addEventListener('click', function() {
            document.getElementById('reservationContent').style.display = 'none';
            // document.getElementById('orderItemContent').style.display = 'none';
            document.getElementById('orderContent').style.display = 'block';
            reservationTab.classList.remove('bg-slate-300', 'text-black');
            orderTab.classList.add('bg-slate-300', 'text-black');
            // orderItemTab.classList.remove('bg-slate-300', 'text-black');
        });

        // orderItemTab.addEventListener('click', function() {
        //     document.getElementById('reservationContent').style.display = 'none';
        //     document.getElementById('orderItemContent').style.display = 'block';
        //     document.getElementById('orderContent').style.display = 'none';
        //     reservationTab.classList.remove('bg-slate-300', 'text-black');
        //     orderTab.classList.remove('bg-slate-300', 'text-black');
        //     orderItemTab.classList.add('bg-slate-300', 'text-black');
        // });
    });
</script>
