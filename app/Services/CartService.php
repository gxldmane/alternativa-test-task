<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\Request;

class CartService
{
    public function addToCart(Product $product, int $productId, $cart)
    {
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'name' => $product->name,
                'quantity' => 1,
                'price' => $product->price,
                'stock' => $product->stock,
            ];
        }
        session()->put('cart', $cart);
    }

    public function updateCart(int $productId, $cart, Request $request)
    {
        $cart[$productId]['quantity'] = $request->quantity;

        if ($request->quantity <= 0) {
            unset($cart[$productId]);
        }
        session()->put('cart', $cart);
    }
}
