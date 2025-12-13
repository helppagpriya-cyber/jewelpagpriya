<?php

namespace App\Livewire\Vendor;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ProductList extends Component
{
    use WithPagination;

    public $products;
    public $selected = []; // [product_id => quantity]
    public $mode = 'amount'; // 'amount' or 'metal'
    public $minWeight = 100; // grams
    public $maxWeight = 10000; // grams
    public $silverRate = 200; // ₹ per gram
    public $labourRate = 65; // ₹ per gram

    public function mount()
    {
        $this->products = Product::where('status', 1)
            ->with('productSize') // Ensure relation name matches your model
            ->get();

        // Prefill quantities with 1 for each product
        foreach ($this->products as $product) {
            $this->selected[$product->id] = 1;
        }

        // Restore mode from session if exists
        $this->mode = Session::get('wholesale_mode', 'amount');
    }

    public function updatedSelected($quantity, $productId)
    {
        if ($quantity < 1) {
            unset($this->selected[$productId]);
        }
    }

    public function toggleMode()
    {
        $this->mode = $this->mode === 'amount' ? 'metal' : 'amount';
        Session::put('wholesale_mode', $this->mode);
    }

    public function addToCart()
    {
        $totalWeight = 0;
        $items = [];

        foreach ($this->selected as $productId => $quantity) {
            if ($quantity < 1) continue;

            $product = $this->products->find($productId);
            $productSize = $product->productSize->first();

            if (!$product || !$productSize || $quantity > $productSize->stock) {
                $this->addError('selected', "Insufficient stock for {$product?->name}");
                return;
            }

            $itemWeight = $productSize->metal_weight * $quantity;
            $totalWeight += $itemWeight;

            $subtotal = $this->mode === 'amount'
                ? (($this->silverRate + $this->labourRate) * $productSize->metal_weight) * $quantity
                : 0;

            $items[] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'image' => $product->images[0] ?? null,
                'weight_per_unit' => $productSize->metal_weight,
                'quantity' => $quantity,
                'item_total_weight' => $itemWeight,
                'labour_rate' => $this->labourRate,
                'silver_rate' => $this->silverRate,
                'subtotal' => $subtotal,
            ];
        }

        if ($totalWeight < $this->minWeight) {
            $this->addError('weight', "Minimum Order weight is {$this->minWeight} grams.");
            return;
        }

        if ($totalWeight > $this->maxWeight) {
            $this->addError('weight', "Maximum Order weight is {$this->maxWeight} grams.");
            return;
        }

        // Merge with existing cart
        $cart = Session::get('wholesale_cart', []);
        $cart['mode'] = $this->mode;
        $cart['total_weight'] = ($cart['total_weight'] ?? 0) + $totalWeight;
        $cart['items'] = array_merge($cart['items'] ?? [], $items);

        Session::put('wholesale_cart', $cart);

        $this->selected = [];
        $this->dispatch('cart-updated');
        $this->dispatch('notify', message: 'Items added to cart!', type: 'success');

        return redirect()->route('vendor.vendorcart');
    }

    public function getTotalAmountProperty()
    {
        $total = 0;

        foreach ($this->products as $product) {
            $quantity = $this->selected[$product->id] ?? 0;
            if ($quantity < 1) continue;

            $productSize = $product->productSize->first();
            if ($productSize && $this->mode === 'amount') {
                $total += (($this->silverRate + $this->labourRate) * $productSize->metal_weight) * $quantity;
            }
        }

        return $total;
    }

    public function render()
    {
        return view('livewire.vendor.product-list');
    }
}
