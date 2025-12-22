<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Product;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ProductDetailPage extends Component
{
    public $productId;
    public $selectedSizeId;
    public $quantity = 1;



    public function mount($productId)
    {
        $this->productId = $productId;
        $product = Product::findOrFail($productId);
        $this->selectedSizeId = $product->productSize->first()?->id;
    }
    #[Computed]
    public function product()
    {
        return Product::with(['productsize', 'productDiscounts', 'review.user', 'occasion', 'metal', 'gemstone'])
            ->findOrFail($this->productId);
    }
    #[Computed]
    public function selectedSize()
    {
        return $this->product->productsize->where('id', $this->selectedSizeId)->first();
    }
    #[Computed]
    public function priceDetails()
    {
        $size = $this->selectedSize;
        if (!$size) return ['base' => 0, 'final' => 0, 'discount' => null];

        $basePrice = $size->metal_price + $size->gemstone_price + $size->making_charges + $size->gst;

        $activeDiscount = $this->product->productDiscounts->first(
            fn($d) => $d->start_date <= now() && $d->end_date >= now()
        );

        $finalPrice = $activeDiscount ? $basePrice - $activeDiscount->discount : $basePrice;

        return [
            'base' => $basePrice * $this->quantity,
            'final' => $finalPrice * $this->quantity,
            'discount' => $activeDiscount ? ($activeDiscount->discount * $this->quantity) : 0
        ];
    }
    public function addToCart()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $existingCart = Cart::where('user_id', Auth::id())
            ->where('product_id', $this->product->id)
            ->first();

        if ($existingCart) {
            Notification::make()
                ->warning()
                ->title('Warning')
                ->color('warning')
                ->title('This product is already added in your cart.')
                ->send();
        } else {
            Cart::create([
                'user_id'         => Auth::id(),
                'product_id'      => $this->product->id,
                'product_size_id' => $this->selectedSizeId,
                'quantity'        => $this->quantity,
            ]);

            Notification::make()
                ->title('Success')
                ->color('success')
                ->body($this->product->name . ' Added to you cart successfuly')
                ->success()
                ->send();
        }
    }
    public function buynow($productId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $product = Product::findOrFail($productId);
        session()->forget('buy_now_item');
        session()->put('buy_now_item', [
            'product_id' => $product->id,
            'name' => $product->name,
            'price' => $this->priceDetails,
            'quantity' => 1, // Default to 1 for Buy Now
            'image' => $product->images[0],
        ]);
        return redirect()->route('checkout.payment', ['type' => 'direct']);
    }

    public function render()
    {

        return view('livewire.product-detail-page');
    }
}
