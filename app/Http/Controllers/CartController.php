<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(private CartService $cartService) {}

    // Метод для отображения корзины
    public function show()
    {
        $cart = session()->get('cart', []);

        return view('cart.index', compact('cart'));
    }

    // Метод для добавления товара в корзину
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

        if (isset($cart[$$productId])) {
            unset($cart[$$productId]);
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
