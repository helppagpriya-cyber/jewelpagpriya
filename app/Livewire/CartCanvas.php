<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart; // Assuming your Cart model exists
use Illuminate\Support\Facades\Auth;

class CartCanvas extends Component
{
    public bool $open = false;
    public $carts = []; // Will hold the collection
    public $quantities = [];
    public float $tprice = 0;
    public float $tdelivery = 50; // Assuming a fixed delivery charge; adjust as needed (e.g., from config)

    protected $listeners = [
        'open-cart-canvas' => 'show',
        'close-cart-canvas' => 'hide',
    ];

    public function mount()
    {
        $this->loadCarts();
    }

    public function show()
    {
        $this->open = true;
        $this->loadCarts(); // Refresh on open
    }

    public function hide()
    {
        $this->open = false;
    }

    public function close()
    {
        $this->hide();
    }

    public function loadCarts()
    {
        if (Auth::check()) {
            $this->carts = Cart::where('user_id', Auth::id())
                ->with(['product', 'productsize'])
                ->get();
            $this->quantities = $this->carts->pluck('quantity', 'product_id')->toArray();
            $this->tprice = $this->carts->sum(function ($cart) {
                $price = 0;
                if ($cart->productSize) {
                    $price = $cart->productSize->metal_price +
                        $cart->productSize->gemstone_price +
                        $cart->productSize->making_charges +
                        $cart->productSize->gst;
                }
                return $cart->quantity * $price;
            });
        } else {
            $this->carts = collect();
            $this->quantities = [];
            $this->tprice = 0;
        }
    }

    public function updateQuantity($productId, $quantity)
    {
        if (Auth::check() && is_numeric($quantity) && $quantity >= 1) {
            Cart::where('user_id', Auth::id())
                ->where('product_id', $productId)
                ->update(['quantity' => $quantity]);
        }
        $this->loadCarts(); // Re-query to update UI and totals
    }

    public function removeFromCart($productId)
    {
        if (Auth::check()) {
            Cart::where('user_id', Auth::id())
                ->where('product_id', $productId)
                ->delete();
        }
        $this->loadCarts(); // Re-query to update UI
    }

    public function render()
    {
        return view('livewire.cart-canvas');
    }
}
