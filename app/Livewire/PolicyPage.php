<?php

namespace App\Livewire;

use App\Models\Policy;
use Livewire\Component;

class PolicyPage extends Component
{
    public $policy;

    public function mount($slug)
    {
        $this->policy = Policy::where('slug', $slug)->firstOrFail();
    }
    public function render()
    {
        return view('livewire.policy-page');
    }
}
