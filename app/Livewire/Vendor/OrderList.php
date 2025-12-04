<?php

namespace App\Livewire\Vendor;

use Livewire\Component;
use App\Models\VendorOrder;

class OrderList extends Component
{
    public function render()
    {
        $orders = VendorOrder::where('user_id', auth()->id())
            ->latest()->get();

        return view('livewire.vendor.orders', compact('orders'));
    }
}
