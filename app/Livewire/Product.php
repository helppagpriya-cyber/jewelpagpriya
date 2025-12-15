<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\ProductSize;

use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Product extends Component
{
    public $productSize, $size, $productSize = '', $product, $quantity = 1;
    public function mount($product)
    {
        $this->product = $product;
        $this->productSize = $product->productSize;
    }
    public function render()
    {
        if ($this->size)
            $this->productSize = ProductSize::find($this->size);
        else
            $this->productSize = $this->productSize[0];
        return view('livewire.product', ['productSize' => $this->productSize, 'productSize' => $this->productSize]);
    }

    public function setSize($size)
    {
        $this->size = $size;
    }

    public function AddToCart()
    {
        if (Auth::user()) {
            $existingCart = Auth::user()->carts()->where('product_id', $this->product->id)
                ->where('product_size_id', $this->productSize->id)
                ->first();

            if ($existingCart) {

                Notification::make()
                    ->success()
                    ->title('Warning! This Product is already in your cart.')
                    ->send();
                session()->flash('warning', 'This product is already in your cart.');
            } else {
                Auth::user()->carts()->create([
                    'product_id' => $this->product->id,
                    'product_size_id' => $this->productSize->id,
                    'quantity' => $this->quantity
                ]);
                Notification::make()
                    ->success()
                    ->title('Product added to cart successfully!')
                    ->send();
                session()->flash('success', 'Product added to cart successfully!');
            }
        } else {
            return redirect('login');
        }
    }
}
