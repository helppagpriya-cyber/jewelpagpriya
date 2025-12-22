<?php

namespace App\Helpers;

use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Support\Facades\Cookie;

class CartManagement
{
    //add Item to Cart
    static public function addItemsToCart($product_id)
    {
        $cart_items = self::getCartItemsFromCookie();

        $existing_item = null;

        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                $existing_item = $key;
                break;
            }
        }
        if ($existing_item !== null) {
            $cart_items[$existing_item]['quantity']++;
            $cart_items[$existing_item]['total_amount'] = $cart_items[$existing_item]['quantity'] * $cart_items[$existing_item]['unit_amount'];
        } else {
            $product = Product::where('id', $product_id)->first(['id', 'name', 'images']);
            $price = ProductSize::select('metal_price', 'gemstone_price', 'making_charges', 'gst')->where('product_id', $product_id)->first();
            $price = $price ? $price : (object)[
                'metal_price' => 0,
                'gemstone_price' => 0,
                'making_charges' => 0,
                'gst' => 0
            ];
            if ($product) {
                $cart_items[] = [
                    'product_id' => $product_id,
                    'name' => $product->name,
                    'image' => $product->images[0],
                    'quantity' => 1,
                    'unit_amount' => $price->metal_price + $price->gemstone_price + $price->making_charges + $price->gst,
                    'total_amount' => $price->metal_price + $price->gemstone_price + $price->making_charges + $price->gst,

                ];
            }
        }
        self::addCartItemsToCookie($cart_items);
        return count($cart_items);
    }

    //add item to cart with quantity
    static public function addItemsToCartWithQty($product_id, $qty = 1)
    {
        $cart_items = self::getCartItemsFromCookie();

        $existing_item = null;

        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                $existing_item = $key;
                break;
            }
        }
        if ($existing_item !== null) {
            $cart_items[$existing_item]['quantity'] = $qty;
            $cart_items[$existing_item]['total_amount'] = $cart_items[$existing_item]['quantity'] * $cart_items[$existing_item]['unit_amount'];
        } else {
            $product = Product::where('id', $product_id)->first(['id', 'name', 'price', 'images']);
            $price = ProductSize::select('metal_price', 'gemstone_price', 'making_charges', 'gst')->where('product_id', $product_id)->first();
            $price = $price ? $price : (object)[
                'metal_price' => 0,
                'gemstone_price' => 0,
                'making_charges' => 0,
                'gst' => 0
            ];
            if ($product) {
                $cart_items[] = [
                    'product_id' => $product_id,
                    'name' => $product->name,
                    'image' => $product->images[0],
                    'quantity' => $qty,
                    'unit_amount' => $price->metal_price + $price->gemstone_price + $price->making_charges + $price->gst,
                    'total_amount' => $price->metal_price + $price->gemstone_price + $price->making_charges + $price->gst,

                ];
            }
        }
        self::addCartItemsToCookie($cart_items);
        return count($cart_items);
    }


    //Remove Item from Cart
    static public function removeCartItem($product_id)
    {
        $cart_items = self::getCartItemsFromCookie();

        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                unset($cart_items[$key]);
            }
        }
        self::addCartItemsToCookie($cart_items);
        return $cart_items;
    }

    //add Item to cookie
    static public function addCartItemsToCookie($cart_items)
    {
        Cookie::queue('cart_items', json_encode($cart_items), 60 * 24 * 30);
    }
    //clear Item from cookie
    static public function clearCartItems()
    {
        Cookie::queue(Cookie::forget('cart_items'));
    }

    //get all item from cookie
    static public function getCartItemsFromCookie()
    {
        $cart_items = json_decode(Cookie::get('cart_items'), true);
        if (!$cart_items) {
            $cart_items = [];
        }
        return $cart_items;
    }
    //increment item quantity
    static public function incrementQuantityToCartItem($product_id)
    {
        $cart_items = self::getCartItemsFromCookie();
        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                $cart_items[$key]['quantity']++;
                $cart_items[$key]['total_amount']  = $cart_items[$key]['quantity'] * $cart_items[$key]['unit_amount'];
            }
        }
        self::addCartItemsToCookie($cart_items);
        return $cart_items;
    }
    //decrement item quantity
    static public function decrementQuantityFromCartItem($product_id)
    {
        $cart_items = self::getCartItemsFromCookie();
        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                if ($cart_items[$key]['quantity'] > 1) {
                    $cart_items[$key]['quantity']--;
                    $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity'] * $cart_items[$key]['unit_amount'];
                }
            }
        }
        self::addCartItemsToCookie($cart_items);
        return $cart_items;
    }
    //calculate grand total
    static public function calculateGrandtotal($items)
    {
        return array_sum(array_column($items, 'total_amount'));
    }
}
