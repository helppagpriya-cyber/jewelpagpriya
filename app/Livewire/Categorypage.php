<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;


class Categorypage extends Component
{

    public function render()

    {
        $category = Category::where('category_id', '!=', null)->get();

        return view('livewire.categorypage', [
            'category' => $category
        ]);
    }
}
