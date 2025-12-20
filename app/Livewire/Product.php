<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\ProductSize;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Product extends Component
{
    public $product;
    public $size;           // Selected size ID
    public $quantity = 1;   // Quantity to add to cart

    public $productSize;    // Currently selected ProductSize model
    public $productSizes;   // Collection of all sizes for this product

    public function mount($product)
    {
        $this->product = $product;
        $this->productSizes = $product->productSize;

        // Set default size (first available)
        $this->size = $this->productSizes->first()->id ?? null;
        $this->updateSelectedProductSize();
    }

    public function updatedSize()
    {
        $this->updateSelectedProductSize();
    }

    private function updateSelectedProductSize()
    {
        $this->productSize = $this->productSizes->firstWhere('id', $this->size)
            ?? $this->productSizes->first();
    }

    public function setSize($sizeId)
    {
        $this->size = $sizeId;
        $this->updateSelectedProductSize();
    }

    public function addToCart()
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // use named route if you have one
        }

        $existingCart = Cart::where('user_id', Auth::id())
            ->where('product_id', $this->product->id)
            ->where('product_size_id', $this->productSize->id)
            ->first();

        if ($existingCart) {
            Notification::make()
                ->warning()
                ->title('This product (with selected size) is already in your cart.')
                ->send();
        } else {
            Cart::create([
                'user_id'         => Auth::id(),
                'product_id'      => $this->product->id,
                'product_size_id' => $this->productSize->id,
                'quantity'        => $this->quantity,
            ]);

            Notification::make()
                ->success()
                ->title('Product added to cart successfully!')
                ->send();

            $this->dispatch('cart-updated'); // optional: emit event to update cart counter
        }
    }

    public function render()
    {
        return view('livewire.product', [
            'productSizes' => $this->productSizes,
            'selectedSize' => $this->productSize,
        ]);
    }
}
