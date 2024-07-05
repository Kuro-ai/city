<div>
    <div class="mb-6">
        <form class="d-flex" role="search">
            <input wire:model.live="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        </form>
    </div>

    <div class="h-[55rem] overflow-x-scroll relative shadow-md sm:rounded-lg" id="orderContent">
        <table class="w-max text-sm rtl:text-right text-pale text-center ">
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
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Address
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Menu 
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

                @if (!empty($orders))
                    @php
                        $lastOrderId = null;
                        $total = null;
                        $order_date = null;
                    @endphp
                    @foreach ($orders as $order)
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
                                {{ $order->email }}
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
                            <td data-id="{{ $order->id }}" scope="row"
                                class="px-6 py-4 font-medium whitespace-nowrap">
                                <div class="email-form-delete flex space-x-2 justify-center items-center">
                                    <form class="px-2 py-3 hover:bg-red-400 rounded-lg text-white"
                                        action="{{ route('manager.orders.destroy', $order->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"><img src="{{ asset('others/delete.png') }}"
                                                class="w-8 h-8"></button>
                                    </form>
                                    @if (!$order->email_sent)
                                        <div class="email-form flex space-x-2 justify-center items-center">
                                            <form class="px-2 py-3 hover:bg-blue-400 rounded-lg text-white"
                                                action="{{ route('manager.orders.orderemail', $order->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to send an email to this customer?')">
                                                @csrf
                                                <button type="submit"><img src="{{ asset('others/gmail.png') }}"
                                                        class="w-8 h-8"></button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
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
        <div class="p-7">
            {{ $orders->links() }}
        </div>
    </div>
</div>
