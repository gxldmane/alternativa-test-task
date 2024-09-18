<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;

class OrderService
{
    public function createOrder(array $data, $cart): void
    {
        $order = new Order;
        $order->customer_name = $data['name'];
        $order->customer_email = $data['email'];
        $order->total = array_sum(array_map(fn ($item) => $item['price'] * $item['quantity'], $cart));
        $order->save();

        foreach ($cart as $id => $item) {
            $orderProduct = new OrderProduct;
            $orderProduct->order_id = $order->id;
            $orderProduct->product_id = $id;
            $orderProduct->quantity = $item['quantity'];
            $orderProduct->price = $item['price'];
            $orderProduct->save();

            $product = Product::find($id);
            if ($product) {
                if ($product->stock >= $item['quantity']) {
                    $product->stock -= $item['quantity'];
                    $product->save();
                }
            }
        }
    }
}
