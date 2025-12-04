<?php

namespace App\Livewire\Vendor;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Support\Facades\Redirect;

class ProductList extends Component
{
    use WithPagination;

    public $category = [];
    public $minWeight = '';
    public $maxWeight = '';
    public $search = '';
    public $productsize = [];

    public $quantity = []; // per product qty input

    protected $queryString = [
        'category',
        'minWeight',
        'maxWeight',
        'search',
    ];

    public function mount()
    {
        $this->category = Category::where('status', 1)->get();
        $this->productsize = ProductSize::all();
    }
    public function updating($name)
    {
        $this->resetPage();
    }

    public function addToCart($productId)
    {
        $product = Product::findOrFail($productId);

        // SAFE quantity handling
        $qty = isset($this->quantity[$productId]) && $this->quantity[$productId] > 0
            ? (int) $this->quantity[$productId]
            : 1;

        $cart = session()->get('vendor_cart', []);

        if (isset($cart[$productId])) {
            // Always ensure quantity key exists
            $cart[$productId]['quantity'] =
                ($cart[$productId]['quantity'] ?? 1) + $qty;
        } else {
            $cart[$productId] = [
                'product_id'     => $productId,
                'name'           => $product->name,
                'weight'         => $product->metal_weight,
                'rate'           => $product->price_per_gram ?? 0,
                'making_charges' => $product->making_charges ?? 0,
                'quantity'       => $qty ?? 1, // ✅ CRITICAL FIX
                'image'          => $product->images[0] ?? null,
            ];
        }

        session()->put('vendor_cart', $cart);


        $this->dispatch('cart-added', name: $product->name);
    }

    public function render()
    {
        $products = Product::query()
            //->when($this->category, fn($q) => $q->where('category_id', $this->category))
            ->when($this->minWeight, fn($q) => $q->where('weight', '>=', $this->minWeight))
            ->when($this->maxWeight, fn($q) => $q->where('weight', '<=', $this->maxWeight))
            ->when($this->search, fn($q) => $q->where('name', 'like', '%' . $this->search . '%'))
            ->paginate(20);


        return view('livewire.vendor.product-list', compact('products'));
    }
}
