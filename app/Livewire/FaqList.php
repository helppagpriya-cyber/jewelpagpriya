<?php

namespace App\Livewire;

use App\Models\faq;

use Livewire\Component;

class FaqList extends Component
{
    public $openFaq = null; // track which FAQ is open

    public function toggle($faqId)
    {
        // If the same FAQ is clicked again, close it
        $this->openFaq = $this->openFaq === $faqId ? null : $faqId;
    }
    public function render()
    {
        return view('livewire.faq-list', [
            'faqs' => faq::all()
        ]);
    }
}
