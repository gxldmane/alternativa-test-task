<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()->paginate(12);

        return view('products.index', compact('products'));
    }

    public function show(int $id)
    {
        $product = Product::query()->findOrFail($id);

        return view('products.show', compact('product'));
    }
}
