@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-4">Корзина</h1>

    @if(session('error'))
        <div class="bg-red-500 text-white p-4 mb-4 rounded">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="bg-green-500 text-white p-4 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if(session('cart') && count(session('cart')) > 0)
        <table class="table-auto w-full border-collapse border border-gray-200">
            <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2 text-left">Товар</th>
                <th class="border border-gray-300 px-4 py-2 text-right">Цена</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Количество</th>
                <th class="border border-gray-300 px-4 py-2 text-right">Итого</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cart as $id => $details)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $details['name'] }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-right">{{ $details['price'] }} руб.</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">
                        <form action="{{ route('cart.update', $id) }}" method="POST">
                            @csrf
                            <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1"
                                   class="w-20 text-center border border-gray-300 rounded">
                            <button type="submit" class="ml-2 bg-blue-500 text-white px-2 py-1 rounded">Обновить
                            </button>
                        </form>
                    </td>
                    <td class="border border-gray-300 px-4 py-2 text-right">{{ $details['price'] * $details['quantity'] }}
                        руб.
                    </td>
                    <td class="border border-gray-300 px-4 py-2 text-center">
                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            <p class="text-lg font-bold">Общая
                сумма: {{ array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)) }} руб.</p>
        </div>

        <div class="mt-4 flex items-center">
            <a href="{{ route('checkout') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Перейти
                к оформлению</a>
            <form action="{{ route('cart.clear') }}" method="POST" class="inline-block ml-4">
                @csrf
                <button type="submit" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Очистить
                    корзину
                </button>
            </form>
        </div>
    @else
        <p class="text-lg">Ваша корзина пуста.</p>
    @endif

    <a href="{{ route('products.index') }}" class="text-blue-500 hover:underline mt-4 inline-block">Назад к списку
        товаров</a>
@endsection
