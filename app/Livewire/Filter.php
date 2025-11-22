<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Gemstone;
use App\Models\Metal;
use App\Models\Occasion;
use App\Models\Product;
use Livewire\Component;

class Filter extends Component
{
    public $wishlist,$products,$gender,$providedProducts, $category=[], $occasion=[], $metal=[], $gemstone=[], $offer=false;
    protected $queryString = ['category','occasion','metal','gemstone','offer'];
    public function mount($products,$gender)
    {
        $this->products = $products; // get the products
        $this->providedProducts = $products;
        $this->gender = $gender ?? NULL;
        $this->wishlist = auth()->user() ? auth()->user()->wishlists()->pluck('product_id')->toArray() : [];
    }
    public function render()
    {
        // get filtered products
        if($this->category || $this->metal || $this->gemstone || $this->occasion) {
            $this->products = Product::where('status', 1)
                ->when($this->category, function ($q) {
                    $q->whereIn('category_id', $this->category);
                })
                ->when($this->occasion, function ($q) {
                    $q->whereIn('occasion_id', $this->occasion);
                })
                ->when($this->metal, function ($q) {
                    $q->whereIn('metal_id', $this->metal);
                })
                ->when($this->gemstone, function ($q) {
                    $q->whereIn('gemstone_id', $this->gemstone);
                })
                ->when($this->gender, function ($q) {
                    $q->where('gender', $this->gender);
                })
//                ->whereHas('productDiscounts', function ($query) {
//                    $query->where('start_date', '<=', now())
//                        ->where('end_date', '>=', now());
//                })
                ->get();
        }
        else if ($this->gender){
            if($this->gender == 'F')
                $this->products = Product::where('status', 1)->where('gender','F')->get();
            else if($this->gender == 'M')
                $this->products = Product::where('status', 1)->where('gender','M')->get();
        }
        else
            $this->products = $this->providedProducts;

        $categories = Category::where('status',1)->where('category_id','!=',NULL)->get();
        $occasions = Occasion::where('status',1)->get();
        $metals = Metal::where('status',1)->get();
        $gemstones = Gemstone::where('status',1)->get();
        return view('livewire.filter',
            [   'products'=>$this->products,
                'categories'=>$categories,
                'occasions'=>$occasions,
                'metals'=>$metals,
                'gemstones'=>$gemstones
            ]);
    }
}
