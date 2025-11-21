<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class OrdersIndex extends Component
{
    public function render()
    {
        $orders = Auth::user()->orders()->orderBy('created_at', 'desc')->paginate(10);

        return view('livewire.orders-index', [
            'orders' => $orders,
        ]);
    }
}
