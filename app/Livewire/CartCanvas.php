<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CartCanvas extends Component
{
    public $quantities = [];

    public function mount()
    {
        $this->refreshQuantities();
    }

    public function refreshQuantities()
    {

        $this->quantities = Auth::user()?->carts->pluck('quantity', 'product_id')->toArray();
    }

    public function updateQuantity($productId, $qty)
    {
        $qty = max(1, (int)$qty);
        Auth::user()->carts()->where('product_id', $productId)->update(['quantity' => $qty]);
        $this->refreshQuantities();
    }

    public function removeFromCart($productId)
    {
        Auth::user()->carts()->where('product_id', $productId)->delete();
        $this->refreshQuantities();
    }

    public function render()
    {
        $carts   = Auth::user()?->carts ?? collect();
        $tprice  = 0;
        $tdelivery = 0;

        foreach ($carts as $cart) {
            $price = $cart->productSize?->metal_price
                + $cart->productSize?->gemstone_price
                + $cart->productSize?->making_charges
                + $cart->productSize?->gst ?? 0;

            $tprice   += $price * $cart->quantity;
            $tdelivery += $cart->product?->delivery_charge ?? 0;
        }

        return view('livewire.cart-canvas', compact('carts', 'tprice', 'tdelivery'));
    }
}
