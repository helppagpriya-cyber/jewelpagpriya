<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Wishlist;

class ProductWishlist extends Component
{
    public Product $product;
    public bool $isWishlisted = false;

    protected $listeners = ['wishlist-updated' => 'refreshStatus'];

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->refreshStatus();
    }

    public function toggleWishlist()
    {
        if (!Auth::check()) {
            $this->dispatch('notify', message: 'Please login first!');
            return redirect()->route('login');
        }

        $userId = Auth::id();
        $productId = $this->product->id;

        if ($this->isWishlisted) {
            Wishlist::where('user_id', $userId)->where('product_id', $productId)->delete();
            $this->isWishlisted = false;
            $this->dispatch('notify', message: 'Removed from wishlist');
        } else {
            Wishlist::create([
                'user_id' => $userId,
                'product_id' => $productId,
            ]);
            $this->isWishlisted = true;
            $this->dispatch('notify', message: 'Added to wishlist ❤️');
        }

        $this->dispatch('wishlist-updated');
    }

    public function refreshStatus()
    {
        $this->isWishlisted = Auth::check() && Wishlist::where('user_id', Auth::id())
            ->where('product_id', $this->product->id)
            ->exists();
    }

    public function render()
    {
        return view('livewire.product-wishlist');
    }
}
