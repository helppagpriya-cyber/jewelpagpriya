<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cart;

use Illuminate\Support\Facades\Auth;

class CartComponent extends Component
{
    public $cart = [];

    public function mount()
    {
        // Initialize cart data
        $this->cart = Auth::check() ? Auth::user()->carts->toArray() : [];
    }

    public function removeFromCart($productId)
    {
        if (!Auth::check()) {
            $this->dispatchBrowserEvent('show-alert', ['message' => 'Please log in to manage your cart']);
            return;
        }

        $cart = Auth::user()->carts()->where('product_id', $productId)->first();
        if ($cart) {
            $cart->delete();
            $this->cart = Auth::user()->carts->toArray();
            $this->emit('cartUpdated');
            $this->dispatchBrowserEvent('show-alert', ['message' => 'Item removed from cart']);
        } else {
            $this->dispatchBrowserEvent('show-alert', ['message' => 'Item not found in cart']);
        }
    }

    public function removeFromWishlist($productId)
    {
        if (!Auth::check()) {
            $this->dispatchBrowserEvent('show-alert', ['message' => 'Please log in to manage your wishlist']);
            return;
        }

        $wishlist = Auth::user()->wishlists()->where('product_id', $productId)->first();
        if ($wishlist) {
            $wishlist->delete();
            $this->emit('wishlistUpdated');
            $this->dispatchBrowserEvent('show-alert', ['message' => 'Item removed from wishlist']);
        } else {
            $this->dispatchBrowserEvent('show-alert', ['message' => 'Item not found in wishlist']);
        }
    }

    public function updateQuantity($productId, $quantity)
    {
        if (!Auth::check()) {
            $this->dispatchBrowserEvent('show-alert', ['message' => 'Please log in to manage your cart']);
            return;
        }

        $cart = Auth::user()->carts()->where('product_id', $productId)->first();
        if ($cart && $quantity >= 1) {
            $cart->update(['quantity' => $quantity]);
            $this->cart = Auth::user()->carts->toArray();
            $this->emit('cartUpdated');
            $this->dispatchBrowserEvent('show-alert', ['message' => 'Cart quantity updated']);
        } else {
            $this->dispatchBrowserEvent('show-alert', ['message' => 'Invalid cart item or quantity']);
        }
    }

    public function render()
    {
        return view('livewire.cart-component', ['cart' => $this->cart]);
    }
}