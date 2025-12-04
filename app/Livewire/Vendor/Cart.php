<?php

namespace App\Livewire\Vendor;

use Livewire\Component;
use App\Models\VendorOrder;
use App\Models\VendorOrderItem;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\DB;

class Cart extends Component
{
    public $cart = [];

    public function mount()
    {
        $this->cart = session()->get('vendor_cart', []);
    }

    public function updateQty($productId, $qty)
    {
        if (isset($this->cart[$productId])) {
            $this->cart[$productId]['quantity'] = max(1, $qty);
            session()->put('vendor_cart', $this->cart);
        }
    }

    public function removeItem($productId)
    {
        unset($this->cart[$productId]);
        session()->put('vendor_cart', $this->cart);
    }

    public function getTotalProperty()
    {
        $total = 0;

        foreach ($this->cart as $item) {
            $weight = (float) ($item['weight'] ?? 0);
            $rate   = (float) ($item['rate'] ?? 0);
            $making = (float) ($item['making_charges'] ?? 0);
            $qty    = (int) ($item['quantity'] ?? 1);

            $total += ($weight * $rate * $qty) + ($making * $qty);
        }

        return round($total, 2);
    }

    public function submitOrder()
    {
        if (count($this->cart) == 0) {
            session()->flash('error', 'Cart is empty');
            return;
        }

        DB::transaction(function () {

            $order = VendorOrder::create([
                'user_id' => auth()->id(),
                'status' => 0, // pending
                'order_no' => 'VO' . time(),
            ]);

            foreach ($this->cart as $item) {

                $itemTotal = ($item['weight'] * $item['rate'] * $item['quantity'])
                    + ($item['making_charges'] * $item['quantity']);

                VendorOrderItem::create([
                    'vendor_order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'name' => $item['name'],
                    'weight' => $item['weight'],
                    'quantity' => $item['quantity'],
                    'rate_per_gram' => $item['rate'],
                    'making_charges' => $item['making_charges'],
                    'item_total' => $itemTotal,
                ]);
            }

            session()->forget('vendor_cart');
        });

        return redirect()->route('vendor.orders')->with('success', 'Order placed successfully!');
    }

    public function render()
    {
        return view('livewire.vendor.cart');
    }
}
