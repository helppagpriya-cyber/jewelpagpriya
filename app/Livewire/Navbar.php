<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Navbar extends Component
{
    // Mobile menu state
    public bool $mobileMenuOpen = false;

    // User dropdown state
    public bool $userDropdownOpen = false;

    // Canvas states (wishlist, cart, orders)
    public bool $wishlistOpen = false;
    public bool $cartOpen = false;
    public bool $ordersOpen = false;

    // Toggle methods
    public function toggleMobileMenu()
    {
        $this->mobileMenuOpen = !$this->mobileMenuOpen;
    }

    public function toggleUserDropdown()
    {
        $this->userDropdownOpen = !$this->userDropdownOpen;
    }

    public function openWishlist()
    {
        $this->wishlistOpen = true;
        $this->dispatch('open-wishlist-canvas');
    }

    public function openCart()
    {
        $this->cartOpen = true;
        $this->dispatch('open-cart-canvas');
    }

    public function openOrders()
    {
        $this->ordersOpen = true;
        $this->dispatch('open-orders-canvas');
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        session()->invalidate();
        session()->regenerateToken();

        return $this->redirect(route('home'), navigate: true);
    }

    public function render()
    {
        return view('livewire.navbar');
    }
}
