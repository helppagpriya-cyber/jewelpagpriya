<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Occasion;
use App\Models\policy;
use Livewire\Component;

class Footer extends Component
{
    public function render()
    {
        $categories = Category::where([
            ['status', 1],
            ['category_id', '!=', NULL]
        ])->get();
        $occasions = Occasion::where('status', 1)->get();
        $policies = Policy::where('title', '!=', null);

        return view(
            'livewire.footer',
            [
                'categories' => $categories,
                'occasions' => $occasions,
                'policies' => $policies,

            ]
        );
    }
}
