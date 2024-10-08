<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(private CartService $cartService) {}

    public function show()
    {
        $cart = session()->get('cart', []);

        return view('cart.index', compact('cart'));
    }

    public function addToCart(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        if ($product->stock <= 0) {
            return redirect()->back()->with('error', 'Товар отсутствует на складе.');
        }

        $cart = session()->get('cart', []);

        $this->cartService->addToCart($product, $productId, $cart);

        return redirect()->back()->with('success', 'Товар добавлен в корзину.');
    }

    public function update(Request $request, $productId)
    {
        $quantity = $request->input('quantity');
        $product = Product::find($productId);

        if (! $product) {
            return redirect()->route('cart.index')->with('error', 'Товар не найден.');
        }

        if ($quantity > $product->stock) {
            return redirect()->route('cart.index')->with('error', 'Недостаточно товара в наличии.');
        }

        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            $this->cartService->updateCart($productId, $cart, $request);

            return redirect()->back()->with('success', 'Корзина обновлена.');
        }

        return redirect()->back()->with('error', 'Товар не найден в корзине.');
    }

    public function removeFromCart($productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Товар удален из корзины.');
        }

        return redirect()->back()->with('error', 'Товар не найден в корзине.');
    }

    public function clear()
    {
        session()->forget('cart');

        return redirect()->back()->with('success', 'Корзина очищена.');
    }
}
