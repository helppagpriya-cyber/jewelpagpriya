<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Review;
use App\Models\Slider;
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

    public function toggleWishlist($productId, $isWishlisted)
    {
        if (!Auth::check()) {
            Notification::make()
                ->warning()
                ->title('Login required')
                ->body('Please login to manage wishlist')
                ->send();
            return redirect()->route('login');
        }

        $user = Auth::user();

        if ($isWishlisted) {
            $user->wishlists()->attach($productId);
            Notification::make()->success()->title('Added to wishlist')->send();
        } else {
            $user->wishlists()->detach($productId);
            Notification::make()->success()->title('Removed from wishlist')->send();
        }

        $this->wishlist = $user->wishlists()->pluck('product_id')->toArray();
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
