<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\ProductSize;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Product extends Component
{
    public $productSizes, $size, $productSize = '', $product, $quantity=1;
    public function mount($product)
    {
        $this->product = $product;
        $this->productSizes = $product->productSizes;
    }
    public function render()
    {
        if($this->size)
            $this->productSize = ProductSize::find($this->size);
        else
            $this->productSize = $this->productSizes[0];
        return view('livewire.product',['productSizes'=>$this->productSizes,'productSize'=>$this->productSize]);
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
                session()->flash('warning', 'This product is already in your cart.');
            }
            else {
                Auth::user()->carts()->create([
                    'product_id' => $this->product->id,
                    'product_size_id' => $this->productSize->id,
                    'quantity' => $this->quantity
                ]);
                session()->flash('success', 'Product added to cart successfully!');
            }
        } else {
            return redirect('login');
        }
    }

}
