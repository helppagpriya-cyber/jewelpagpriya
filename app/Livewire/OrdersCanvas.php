<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order; // Assuming your Order model exists
use Illuminate\Support\Facades\Auth;

class OrdersCanvas extends Component
{
    public bool $open = false;
    public $orders = []; // Will hold the collection

    protected $listeners = [
        'open-orders-canvas' => 'show',
        'close-orders-canvas' => 'hide',
    ];

    public function mount()
    {
        $this->loadOrders();
    }

    public function show()
    {
        $this->open = true;
        $this->loadOrders(); // Refresh on open
    }

    public function hide()
    {
        $this->open = false;
    }

    public function close()
    {
        $this->hide();
    }

    public function loadOrders()
    {
        if (Auth::check()) {
            $this->orders = Order::where('user_id', Auth::id())
                ->with(['orderDetails.product.productSize'])
                ->latest() // Show most recent orders first
                ->get();
        } else {
            $this->orders = collect();
        }
    }

    public function render()
    {
        return view('livewire.orders-canvas');
    }
}
