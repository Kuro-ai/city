<!DOCTYPE html>
<html>
<head>
    <title>Purchase List</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 py-10 px-5">
    <div class="max-w-2xl mx-auto bg-white p-8 shadow rounded">
        <h1 class="text-2xl font-bold mb-6 text-center">CITY Restaurant</h1>
        <h1 class="text-2xl font-bold mb-6">List</h1>

        <p class="mb-6">Date: <span class="font-semibold">{{ $expense->date }}</span></p>

        <table class="w-full mb-6">
            <thead>
                <tr class="text-left font-bold">
                    <th class="pb-2">Item</th>
                    <th class="pb-2 text-center">Quantity</th>
                    <th class="pb-2 text-right">Price</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $grandTotal = 0;
                @endphp
                @foreach($expense->items as $item)
                    <tr class="border-t">
                        <td class="py-2">{{ $item['menu_name'] }}</td>
                        <td class="py-2 text-center">{{ $item['quantity'] }}</td>
                        <td class="py-2 text-right">{{ $item['total_price'] }}</td>
                    </tr>
                    @php
                        $grandTotal += $item['total_price'];
                    @endphp
                    
                @endforeach
     
            </tbody>
        </table>

        <p class="text-right">Grand Total: <span class="font-semibold">{{ $grandTotal }}</span></p>
        <p class="mt-6"> <span class="font-semibold">Remark: {{ $expense->remark }}</span></p>
    </div>
</body>
</html>
