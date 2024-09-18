@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
    <p class="text-lg">Цена: {{ $product->price }} руб.</p>
    <p class="text-lg">Остаток на складе: {{ $product->stock }}</p>

    @if ($product->stock > 0)
        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-4">
            @csrf
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Добавить в корзину
            </button>
        </form>
    @else
        <p class="text-red-500 mt-4">Товар отсутствует на складе</p>
    @endif

    <a href="{{ route('products.index') }}" class="text-blue-500 hover:underline mt-4 inline-block">
        Назад к списку товаров
    </a>
@endsection
