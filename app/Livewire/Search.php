<?php

namespace App\Livewire;

use Livewire\Component;
use \App\Models\Product;

class Search extends Component
{
    public $search,$products=[],$gender=NULL,$wishlist;

    public function mount()
    {
        $this->wishlist = auth()->user() ? auth()->user()->wishlists()->pluck('product_id')->toArray() : [];
    }

    public function render()
    {
        if ($this->search)
            $this->products = Product::where('name', 'like', '%' . $this->search . '%')->get();

        return view('livewire.search',[
            'products' => $this->products,
            'gender' => $this->gender,
        ]);
    }
}
