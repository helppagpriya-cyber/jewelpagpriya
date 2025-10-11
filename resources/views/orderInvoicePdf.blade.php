<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>LUXORA by Ojas Jewel</title>
    <!-- Ensure Tailwind CSS is included, e.g., via CDN or your build process -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="font-sans">
<div class="container mx-auto">
    <table class="w-full border-collapse mb-0">
        <thead>
        <tr>
            <th class="w-1/2 text-left" colspan="2">
                <h2 class="text-2xl font-bold text-[#5C3422]">LUXORA by Ojas Jewel</h2>
            </th>
            <th class="w-1/2 text-right text-sm font-normal" colspan="2">
                <span class="block mb-1">Invoice Id: #ORD{{ $order->id }}</span>
                <span class="block mb-1">Date: {{ date('d / m / Y') }}</span>
                <span class="block mb-1">Pin code: 360001</span>
                <span class="block mb-1">Address: "LUXORA by Ojas Jewel Jewellers", 125, Subhash Nagar,<br> Near Jubilee Garden, Rajkot, Gujarat</span>
            </th>
        </tr>
        <tr class="bg-[#5C3422] text-white">
            <th class="p-2 w-1/2" colspan="2">Order Details</th>
            <th class="p-2 w-1/2" colspan="2">User Details</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="p-2 border border-gray-300 w-1/5">Order Id:</td>
            <td class="p-2 border border-gray-300">#ORD{{ $order->id }}</td>
            <td class="p-2 border border-gray-300 w-1/5">Full Name:</td>
            <td class="p-2 border border-gray-300">{{ \Illuminate\Support\Facades\Auth::user()->name }}</td>
        </tr>
        <tr>
            <td class="p-2 border border-gray-300">Ordered Date:</td>
            <td class="p-2 border border-gray-300">{{ $order->created_at }}</td>
            <td class="p-2 border border-gray-300">Email Id:</td>
            <td class="p-2 border border-gray-300">{{ \Illuminate\Support\Facades\Auth::user()->email }}</td>
        </tr>
        <tr>
            <td class="p-2 border border-gray-300">Delivered On:</td>
            <td class="p-2 border border-gray-300 capitalize">{{ $order->updated_at->format('d / m / y') }}</td>
            <td class="p-2 border border-gray-300">Phone:</td>
            <td class="p-2 border border-gray-300">{{ $order->userAddress->phone }}</td>
        </tr>
        <tr>
            <td class="p-2 border border-gray-300">Payment Mode:</td>
            <td class="p-2 border border-gray-300">{{ $order->payment_mode }}</td>
            <td class="p-2 border border-gray-300">Address:</td>
            <td class="p-2 border border-gray-300">{{ $order->userAddress->address }}</td>
        </tr>
        <tr>
            <td class="p-2 border border-gray-300">Payment Status:</td>
            <td class="p-2 border border-gray-300">Done</td>
            <td class="p-2 border border-gray-300">Pin code:</td>
            <td class="p-2 border border-gray-300">{{ $order->userAddress->pin }}</td>
        </tr>
        </tbody>
    </table>

    <table class="w-full border-collapse">
        <thead>
        <tr>
            <th class="text-left text-2xl font-bold text-[#5C3422] py-3 border border-white" colspan="5">
                Order Items
            </th>
        </tr>
        <tr class="bg-[#5C3422] text-white">
            <th class="p-2">Sn.</th>
            <th class="p-2">Product</th>
            <th class="p-2">Price</th>
            <th class="p-2">Delivery Charge</th>
            <th class="p-2">Express Delivery Charge</th>
            <th class="p-2">Quantity</th>
            <th class="p-2">Total</th>
        </tr>
        </thead>
        <tbody>
        @php
            $totalAmount = 0;
            $sn = 1;
        @endphp
        @foreach($order->orderDetails as $orderItem)
        <tr>
            <td class="p-2 border border-gray-300 w-[10%]">{{ $sn++ }}</td>
            <td class="p-2 border border-gray-300">{{ $orderItem->product->name }}</td>
            <td class="p-2 border border-gray-300 w-[10%]">
                Rs. {{ $orderItem->price }}
            </td>
            <td class="p-2 border border-gray-300">
                Rs. {{ $orderItem->delivary_charges ?? 0 }}
            </td>
            <td class="p-2 border border-gray-300">
                Rs. {{ $orderItem->product->express_delivary_charge ?? 0 }}
            </td>
            <td class="p-2 border border-gray-300 w-[10%]">{{ $orderItem->quantity }}</td>
            <td class="p-2 border border-gray-300 w-[15%] font-bold">
                &#8377; Rs. {{ $orderItem->delivary_charges + $orderItem->quantity * $orderItem->price }}
                @php
                    $totalAmount += ($orderItem->quantity * $orderItem->price) + $orderItem->delivary_charges;
                @endphp
            </td>
        </tr>
        @endforeach
        <tr>
            <td class="p-2 border border-gray-300 text-base font-bold" colspan="6">
                Total Amount - <small class="font-normal">Inc. all tax</small>
            </td>
            <td class="p-2 border border-gray-300 text-base font-bold" colspan="1">
                Rs. {{ $totalAmount }}
            </td>
        </tr>
        </tbody>
    </table>

    <p class="text-center mt-4">
        Thank you for shopping with LUXORA by Ojas Jewel
    </p>
</div>
</body>
</html>