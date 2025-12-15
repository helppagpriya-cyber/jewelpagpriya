<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistCanvas extends Component
{
    public bool $open = false;
    public $wishlists = []; // Will hold the collection

    protected $listeners = [
        'open-wishlist-canvas' => 'show',
        'close-wishlist-canvas' => 'hide',
    ];

    public function mount()
    {
        $this->loadWishlists();
    }

    public function show()
    {
        $this->open = true;
        $this->loadWishlists(); // Refresh on open
    }

    public function hide()
    {
        $this->open = false;
    }

    public function close()
    {
        $this->hide();
    }

    public function loadWishlists()
    {
        if (Auth::check()) {
            $this->wishlists = Wishlist::where('user_id', Auth::id())
                ->with(['product', 'productsize'])
                ->get();
        } else {
            $this->wishlists = collect();
        }
    }

    public function removeFromWishlist($productId)
    {
        if (Auth::check()) {
            Wishlist::where('user_id', Auth::id())
                ->where('product_id', $productId)
                ->delete();
        }
        $this->loadWishlists(); // Re-query to update UI
    }

    public function render()
    {
        return view('livewire.wishlist-canvas');
    }
}
