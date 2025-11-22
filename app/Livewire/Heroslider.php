<?php

namespace App\Livewire;

use App\Models\Slider;
use Livewire\Component;

class Heroslider extends Component
{

    public $slides = [];
    public $currentIndex = 0;

    public function mount()
    {
        // Load only active slides
        $this->slides = Slider::where('status', 1)->get();
    }

    public function nextSlide()
    {
        if (count($this->slides) > 0) {
            $this->currentIndex = ($this->currentIndex + 1) % count($this->slides);
        }
    }

    public function prevSlide()
    {
        if (count($this->slides) > 0) {
            $this->currentIndex = ($this->currentIndex - 1 + count($this->slides)) % count($this->slides);
        }
    }

    public function render()
    {
        return view('livewire.heroslider');
    }
}
