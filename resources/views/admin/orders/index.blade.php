<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
            {{-- <div class="relative overflow-x-auto shadow-md sm:rounded-lg" id="orderContent">
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
                            <th scope="col" class="px-6 py-3">
                                Action
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
                                    <td data-id="{{ $order->id }}" scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        <div class="email-form-delete flex space-x-2 justify-center items-center">
                                            <form class="px-2 py-3 hover:bg-red-400 rounded-lg text-white"
                                                action="{{ route('admin.orders.destroy', $order->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"><img src="{{ asset('others/delete.png') }}"
                                                        class="w-8 h-8"></button>
                                            </form>
                                            @if (!$order->email_sent)
                                                <div class="email-form flex space-x-2 justify-center items-center">
                                                    <form class="px-2 py-3 hover:bg-blue-400 rounded-lg text-white"
                                                        action="{{ route('admin.orders.orderemail', $order->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Are you sure you want to send an email to this customer?')">
                                                        @csrf
                                                        <button type="submit"><img
                                                                src="{{ asset('others/gmail.png') }}"
                                                                class="w-8 h-8"></button>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
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
            </div> --}}

            @livewire('order-search')
        </div>
    </div>
</x-app-layout>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var seenIds = {};
        var forms = document.querySelectorAll('.email-form');
        forms.forEach(function(form) {
            var id = form.closest('td').dataset.id;
            if (seenIds[id]) {
                form.style.display = 'none';
            } else {
                seenIds[id] = true;
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        var seenIds = {};
        var forms = document.querySelectorAll('.email-form-delete');
        forms.forEach(function(form) {
            var id = form.closest('td').dataset.id;
            if (seenIds[id]) {
                form.style.display = 'none';
            } else {
                seenIds[id] = true;
            }
        });
    });
</script>
