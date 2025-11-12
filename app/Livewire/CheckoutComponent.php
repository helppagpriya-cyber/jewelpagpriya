<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CheckoutComponent extends Component
{
    /** @var string */
    public $paymentMode = 'ONLINE';

    /** @var string|null */
    public $selectedAddressId;

    /** @var array */
    public $cartItems = [];

    /** @var array */
    public $selectedSizes = [];      // size_id per cart index
    public $quantities   = [];       // quantity per cart index
    public $express      = [];       // bool per cart index
    public $gift         = [];       // bool per cart index

    /** @var bool */
    public $isFirstOrder = false;

    /** @var array */
    public $sizePrices = [];         // [index => price]

    protected $rules = [
        'paymentMode'       => 'required|in:ONLINE,COD',
        'selectedAddressId' => 'required|exists:user_addresses,id',
        'selectedSizes.*'   => 'required|exists:product_sizes,id',
        'quantities.*'      => 'required|integer|min:1',
    ];

    public function mount()
    {
        $user = Auth::user();

        // First-order discount flag
        $this->isFirstOrder = $user->orders()->count() === 0;

        // Pre-select first address
        $this->selectedAddressId = $user->userAddresses->first()?->id;

        // Load cart with current values
        foreach ($user->carts as $idx => $cart) {
            $this->cartItems[$idx] = $cart;

            $this->selectedSizes[$idx] = $cart->product_size_id;
            $this->quantities[$idx]    = $cart->quantity;
            $this->express[$idx]       = false;
            $this->gift[$idx]          = false;

            $this->calculateSizePrice($idx);
        }
    }

    /** Recalculate price when size or quantity changes */
    public function updated($property)
    {
        // $property format: selectedSizes.2  or  quantities.3
        $parts = explode('.', $property);
        if (count($parts) === 2 && is_numeric($parts[1])) {
            $index = (int) $parts[1];
            $this->calculateSizePrice($index);
        }
    }

    private function calculateSizePrice(int $index): void
    {
        $sizeId = $this->selectedSizes[$index] ?? null;
        if (!$sizeId) {
            $this->sizePrices[$index] = 0;
            return;
        }

        $size = \App\Models\ProductSize::find($sizeId);
        if (!$size) {
            $this->sizePrices[$index] = 0;
            return;
        }

        $price = $size->metal_price
            + $size->gemstone_price
            + $size->making_charges
            + $size->gst;

        // First-order discount
        if ($this->isFirstOrder) {
            $price -= 50;
        }

        $this->sizePrices[$index] = max($price, 0);
    }

    public function calculateTotal(): float
    {
        $total = 0;

        foreach ($this->cartItems as $index => $cart) {
            // Base item price (per unit, already discounted if first order)
            $unitPrice = $this->sizePrices[$index] ?? 0;
            $itemSubtotal = $unitPrice * ($this->quantities[$index] ?? 1);

            // Add express delivery charge (if enabled and available)
            if (($this->express[$index] ?? false) && $cart->product->express_delivery_available) {
                $itemSubtotal += $cart->product->express_delivery_charge * ($this->quantities[$index] ?? 1);
            }

            // Add gift charge (TODO: Define a fixed/variable gift charge, e.g., ₹50 per item)
            if ($this->gift[$index] ?? false) {
                $itemSubtotal += 50 * ($this->quantities[$index] ?? 1); // Example: ₹50 per item
            }

            $total += $itemSubtotal;
        }

        return round($total, 2); // Ensure 2 decimal places for rupees
    }

    public function placeOrder()
    {
        $this->validate();
        $totalAmount = $this->calculateTotal();
        if ($totalAmount <= 0) {
            $this->addError('general', 'Total amount must be greater than 0.');
            return;
        }
        // --- 1. Create Order ---
        $order = Order::create([
            'user_id'        => Auth::id(),
            'user_address_id'     => $this->selectedAddressId,
            'total_amount' => $totalAmount,
            'payment_mode'   => $this->paymentMode,
            'payment_status' => 'pending',
        ]);

        // --- 2. Create Order Items ---
        foreach ($this->cartItems as $idx => $cart) {
            OrderDetail::create([
                'order_id'        => $order->id,
                'product_id'      => $cart->product_id,
                'product_size_id' => $this->selectedSizes[$idx],
                'quantity'        => $this->quantities[$idx],
                'price'          => $this->sizePrices[$idx],
                'express_delivery' => $this->express[$idx] ?? false,
                'is_gifted'       => $this->gift[$idx] ?? false,
            ]);
        }



        // TODO: Save order, clear cart, redirect...
        session()->flash('message', 'Order placed successfully!');

        return redirect()->route('checkout.payment', $order);
    }


    public function render()
    {
        return view('livewire.checkout-component');
    }
}
