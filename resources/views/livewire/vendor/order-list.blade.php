<div>
    <div class="p-4">
<h2 class="text-xl font-bold mb-4">My Orders</h2>

<table class="w-full border">
<tr>
 <th>Order No</th>
 <th>Status</th>
 <th>Total</th>
 <th>Created</th>
</tr>

@foreach($orders as $order)
<tr>
 <td>{{ $order->order_no }}</td>
 <td>{{ ['Pending','Approved','Processing','Completed','Cancelled'][$order->status] }}</td>
 <td>₹{{ $order->total_amount }}</td>
 <td>{{ $order->created_at }}</td>
</tr>
@endforeach
</table>
</div>

</div>
