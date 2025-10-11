<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShopNowFormRequest;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\Review;
use App\Models\Slider;
use App\Models\UserAddress;
use App\Models\Wishlist;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status',1)->get();
        $latestProduct = Product::where('status',1)->latest()->limit(4)->get();
        $highlyRated = Review::where('rating','!=',NULL)->limit(4)->get();
        $wishlist = auth()->user() ? auth()->user()->wishlists()->pluck('product_id')->toArray() : [];
        return view('index',compact('sliders','latestProduct','highlyRated','wishlist'));
    }

    public function allProducts()
    {
        $products = Product::where('status',1)->latest()->get();
        $gender = NULL;
        return view('all-products',compact('products','gender'));
    }
    public function women()
    {
        $products = Product::where('status',1)->where('gender','F')->latest()->get();
        $gender = 'F';
        return view('women',compact('products','gender'));
    }
    public function men()
    {
        $products = Product::where('status',1)->where('gender','M')->latest()->get();
        $gender = 'M';
        return view('men',compact('products','gender'));
    }
    public function search()
    {
        return view('search');
    }

    public function categories()
    {
        $parentCategories = Category::where('category_id',NULL)->get();
        return view('categories',compact('parentCategories'));
    }

    public function category(Category $category)
    {
        return view('category',compact('category'));
    }

    public function products(Category $category)
    {
        $products = $category->products()->get();
        $gender = NULL;
        return view('products',compact('products','gender'));
    }

    public function product($product_id)
    {
        $product = Product::find($product_id);
        $productSizes = $product->productSizes();
        return view('product',compact('product','productSizes'));
    }

    public function wishlist($product_id)
    {
        $count = Wishlist::where('user_id',Auth::user()->id)->where('product_id',$product_id)->count();
        if($count) {
            $wishlist = Wishlist::where('user_id',Auth::user()->id)->where('product_id',$product_id)->first();
            $wishlist->delete();
            return response()->json('remove');
        }
        else{
            Auth::user()->wishlists()->create([
                'product_id' => $product_id,
            ]);
            return response()->json('add');
        }
    }

    public function cartRemove($product_id)
    {
        $cart = Cart::where('user_id', Auth::user()->id)->where('product_id', $product_id)->first();
        $cart->delete();
        return response()->json('remove');
    }

    public function shopNow(Product $product)
    {
        return view('shop-now',compact('product'));
    }
    public function shopAllView()
    {
        return view('shop-all');
    }
    public function getPrice($product_id,$size_name)
    {
        $size = ProductSize::where('product_id',$product_id)->where('size',$size_name)->first();
        $price = $size->metal_price + $size->gemstone_price + $size->gst + $size->making_charges;
        return response()->json($price);
    }

    public function shopProduct(ShopNowFormRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = Auth::user()->id;
        $validatedData['quantity'] = $request->quantity;
        $validatedData['user_address_id'] = $request->address;
        $order = Order::create($validatedData);
        $size = ProductSize::where('product_id',$request->product_id)->where('size',$request->product_size)->first();
        $product = Product::find($request->product_id);
        $discount =  $product->productDiscounts()
            ->whereDate('start_date', '<=', Carbon::now())
            ->whereDate('end_date', '>=', Carbon::now())
            ->first();
        $price = $size->metal_price + $size->gemstone_price + $size->gst + $size->making_charges;
        $ifFirstOrder = Order::where('user_id',Auth::id())->count(); // first order discount
        if($ifFirstOrder == 0)
            $price -= 5000;
        $userItem = OrderDetail::create([
            'order_id' => $order->id,
            'product_id' => $request->product_id,
            'product_size_id' => $size->id,
            'product_discount_id' => $discount->id ?? NULL,
            'quantity' => $validatedData['quantity'],
            'price' => $price,
            'delivery_charges' => $product->delivery_charge ?? NULL,
            'is_express_delivery' => $request->is_express_delivery==true ? 1 : 0,
            'is_gifted' => $request->is_gifted==true ? 1 : 0,
        ]);
        return redirect('/')->with('success','Order Placed Successfully !!');
    }

    public function shopAll(ShopNowFormRequest $request)
    {
//        $validatedData = $request->validated();
        $validatedData['user_id'] = Auth::user()->id;
        $validatedData['user_address_id'] = $request->address;
        $order = Order::create([
            'user_id' => $validatedData['user_id'],
            'user_address_id' => $validatedData['user_address_id']
        ]);

        foreach (auth()->user()->carts()->get() as $k => $cartItem) {
            $size = ProductSize::where('product_id', $cartItem->product_id)->where('id', $cartItem->product_size_id)->first();
            $product = Product::find($cartItem->product_id);
            $discount = $product->productDiscounts()
                ->whereDate('start_date', '<=', Carbon::now())
                ->whereDate('end_date', '>=', Carbon::now())
                ->first();
            $price = $size->metal_price + $size->gemstone_price + $size->gst + $size->making_charges;

//            // First order discount
            $ifFirstOrder = Order::where('user_id', auth()->user()->id)->count();
            if ($ifFirstOrder == 0 && $k == 0) { // minus from first item only
                $price -= 5000;
            }

            $isExpressDelivery = request()->has('is_express_delivery') && isset(request('is_express_delivery')[$k]) ? 1 : 0;
            $isGifted = request()->has('is_gifted') && isset(request('is_gifted')[$k]) ? 1 : 0;

            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'product_size_id' => $cartItem->product_size_id,
                'product_discount_id' => $discount->id ?? NULL,
                'quantity' => $cartItem->quantity,
                'price' => $price,
                'delivery_charges' => $product->delivery_charge ?? NULL,
                'is_express_delivery' => $isExpressDelivery ?? 0,
                'is_gifted' => $isGifted ?? 0,
            ]);
        }
        Cart::where('user_id', auth()->user()->id)->delete();

        return redirect('/')->with('success','Order Placed Successfully !!');
    }

    public function profile()
    {
        return view('profile');
    }

    public function review($product_id)
    {
        $product = Product::find($product_id);
        return view('review',compact('product'));
    }

    public function addReview(Request $request)
    {
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('storage/reviews', 'public'); // Store image in 'public/reviews' folder
            $validatedData['image'] = $imagePath; // Save the image path to database
        }
        $review = Review::create([
            'user_id' => Auth::id(), // Get the authenticated user's ID
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'comment' => $request->comment ?? null, // If no comment is provided, store null
            'image' => $request->image ?? null, // If no image, store null
        ]);
        return redirect('/')->with('success','Product Reviewed Successfully !!!');
    }

    public function downloadOrderInvoicePdf(Order $order)
    {
        $data = ['order'=>$order];
        $pdf = Pdf::loadView('orderInvoicePdf',$data);
        $today = Carbon::now()->format('d-m-y');
        return $pdf->download('invoice-#ORD'.$order->id.$today.'.pdf');

//        return view('orderInvoicePdf',compact('order'));
    }
}
