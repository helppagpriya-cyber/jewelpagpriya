<?php

namespace App\Livewire;

use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Reviews extends Component
{
    use WithFileUploads;

    public $productId;

    public Product $product;

    public int $rating = 5;         // Default to "Very Good"
    public ?string $comment = null;
    public $image = null;           // TemporaryUploadedFile or null
    public ?string $imagePreview = null; // For previewing uploaded image

    public function mount($productId)
    {
        $this->productId = $productId;
        $this->product = Product::findOrFail($productId);

        // Optional: pre-calculate price if you want to display it in component
    }

    protected function rules()
    {
        return [
            'rating'  => 'required|integer|between:1,5',
            'comment' => 'nullable|string|max:1000',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust rules as needed
        ];
    }

    public function updatedImage()
    {
        $this->validateOnly('image');

        // Generate preview URL if it's an image
        if ($this->image) {
            $this->imagePreview = $this->image->temporaryUrl();
        }
    }

    public function submitReview()
    {
        $this->validate();

        $imagePath = null;

        if ($this->image) {
            $imagePath = $this->image->store('reviews', 'public'); // Stores in storage/app/public/reviews
        }

        Review::create([
            'user_id'    => Auth::id(),
            'product_id' => $this->product->id,
            'rating'     => $this->rating,
            'comment'    => $this->comment,
            'image'      => $imagePath,
        ]);

        session()->flash('success', 'Product Reviewed Successfully !!!');

        return redirect()->to('/');
    }

    public function render()
    {
        // Calculate price dynamically (same logic as in original Blade)
        $price = $this->product->productSize->first()?->metal_price +
            $this->product->productSize->first()?->gemstone_price +
            $this->product->productSize->first()?->making_charges +
            $this->product->productSize->first()?->gst ?? 0;

        return view('livewire.review-product', [
            'price' => $price,
        ]);
    }
}
