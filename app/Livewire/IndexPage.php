<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Review;
use App\Models\Slider;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;
use Livewire\Component;

class IndexPage extends Component
{
    public $wishlist = [];

    public function mount()
    {
        $this->wishlist = Auth::check()
            ? Auth::user()->wishlists()->pluck('product_id')->toArray()
            : [];
    }

    public function toggleWishlist($productId = null)
    {
        if (!Auth::check()) {
            // Handle guest: Redirect to login or use session-based wishlist
            return redirect()->route('login');
        }

        $productId = $productId ?? $this->product->id;

        // Check if already in wishlist
        $exists = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->exists();

        if ($exists) {
            // Optional: Remove instead (toggle)
            $this->removeFromWishlist($productId);
            $this->dispatch('wishlist-updated'); // Optional event
            return;
        }


        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $productId,
        ]);

        $this->dispatch('wishlist-updated');
        session()->flash('message', 'Added to wishlist!');
    }

    public function removeFromWishlist($productId)
    {
        Wishlist::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->delete();

        $this->dispatch('wishlist-updated');
    }
    public function render()
    {
        $sliders = Slider::where('status', 1)->get();
        $latestProduct = Product::where('status', 1)->latest()->limit(4)->get();
        $highlyRated = Review::where('rating', '!=', null)->limit(4)->get();

        return view('livewire.index-page', [
            'sliders' => $sliders,
            'latestProduct' => $latestProduct,
            'highlyRated' => $highlyRated,
        ]);
    }
}
