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
            Notification::make()
                ->warning()
                ->title('Login required')
                ->body('Please login to manage wishlist')
                ->send();
            return redirect()->route('login');
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
