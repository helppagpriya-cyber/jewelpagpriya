<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class WishlistCanvas extends Component
{
    public function removeFromWishlist($productId)
    {
        Auth::user()->wishlists()->where('product_id', $productId)->delete();
    }

    public function render()
    {
        $wishlists = Auth::user()?->wishlists ?? collect();
        return view('livewire.wishlist-canvas', compact('wishlists'));
    }
}
