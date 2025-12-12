<?php

namespace App\Livewire;

use App\Models\Policy;
use Livewire\Component;

class PolicyPage extends Component
{
    public $policies;

    public function mount($slug)
    {
        $this->policies = Policy::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.policy-page');
    }
}
