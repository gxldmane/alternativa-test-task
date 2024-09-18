<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Services\OrderService;

class OrderController extends Controller
{
    public function __construct(private OrderService $orderService) {}

    public function store(StoreOrderRequest $request)
    {
        $validatedData = $request->validated();

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Ваша корзина пуста.');
        }

        $this->orderService->createOrder($validatedData, $cart);

        session()->forget('cart');

        return redirect()->route('order.success')->with('success', 'Ваш заказ успешно оформлен!');
    }

    public function show()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Ваша корзина пуста.');
        }

        return view('checkout.index', compact('cart'));
    }
}
