<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Metal;
use App\Models\Occasion;
use App\Models\Product;
use App\Models\ProductDiscount;
use App\Models\ProductSize;
use Filament\Notifications\Notification;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Product Page -PAGPRIYA')]


class AllProductsPage extends Component
{

    use WithPagination;
    #[Url]
    public $category = [];
    #[Url]
    public $occasion = [];
    #[Url]
    public $metal = [];
    #[Url]
    public $gender;
    #[Url]
    public $sort;


    #[Url]
    public $offer = false;

    public $wishlist = [];

    public function mount()
    {
        $this->wishlist = Auth::check()
            ? Auth::user()->wishlists()->pluck('product_id')->toArray()
            : [];
    }

    public function toggleWishlist($productId, $isWishlisted)
    {
        if (!Auth::check()) {
            Notification::make()
                ->warning()
                ->title('Login required')
                ->body('Please login to manage wishlist')
                ->send();
            return redirect()->route('login');
        }

        $user = Auth::user();

        if ($isWishlisted) {
            $user->wishlists()->create(['product_id' => $productId, 'user_id' => $user->id]);
            Notification::make()->success()->title('Added to wishlist')->send();
        } else {
            $user->wishlists()->delete($productId);
            Notification::make()->success()->title('Removed from wishlist')->send();
        }

        $this->wishlist = $user->wishlists()->pluck('product_id')->toArray();
    }



    public function render()

    {
        $productsQuery = Product::query()->where('status', 1);
        if ($this->category) {
            $productsQuery = Product::whereIn('category_id', $this->category);
        }
        if ($this->occasion) {
            $productsQuery = Product::whereIn('occasion_id', $this->occasion);
        }
        if ($this->metal) {
            $productsQuery = Product::whereIn('metal_id', $this->metal);
        }
        if ($this->gender == 'F') {
            $productsQuery = Product::where('gender', 'F');
        }
        if ($this->gender == 'M') {
            $productsQuery = Product::where('gender', 'M');
        }
        if ($this->sort == 'latest') {
            $productsQuery->latest();
        }
        if ($this->sort == 'price') {

            $productsQuery = Product::with('productsize');
        }



        $categories = Category::where('status', 1)->where('category_id', '!=', null)->get();
        $occasions = Occasion::where('status', 1)->get();
        $metals = Metal::where('status', 1)->get();


        return view('livewire.allproducts-page', [
            'categories' => $categories,
            'occasions' => $occasions,
            'metals' => $metals,
            'products' => $productsQuery->paginate(9),


        ]);
    }
}
