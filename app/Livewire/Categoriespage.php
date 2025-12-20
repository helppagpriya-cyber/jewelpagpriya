<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class Categoriespage extends Component
{

    public function render()
    {
        $parentCategoris = Category::where('category_id', null)->get();
        return view('livewire.categoriespage', [
            'parentCategories' => $parentCategoris
        ]);
    }
}
