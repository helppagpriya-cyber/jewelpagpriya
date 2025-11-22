<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class OrdersCanvas extends Component
{
    public function render()
    {
        $orders = Auth::user()?->orders ?? collect();
        return view('livewire.orders-canvas', compact('orders'));
    }
}
