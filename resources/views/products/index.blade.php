@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Список товаров</h1>
    @if ($products->isEmpty())
        <p>Нет доступных товаров.</p>
    @else
        <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($products as $product)
                <li class="border rounded-lg p-4 shadow-md">
                    <h2 class="text-xl font-semibold">
                        <a href="{{ route('products.show', $product->id) }}"
                           class="text-blue-500 hover:underline">{{ $product->name }}</a>
                    </h2>
                    <p class="text-gray-700">Цена: {{ $product->price }} | Остаток: {{ $product->stock }}</p>
                </li>
            @endforeach
        </ul>

        <div class="mt-4">
            <nav aria-label="Page navigation">
                <ul class="flex justify-center space-x-2">
                    @if ($products->onFirstPage())
                        <li class="disabled"><span class="px-4 py-2 text-gray-400">« Предыдущая</span></li>
                    @else
                        <li><a href="{{ $products->previousPageUrl() }}"
                               class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">« Предыдущая</a></li>
                    @endif

                    @for ($i = 1; $i <= $products->lastPage(); $i++)
                        @if ($i == $products->currentPage())
                            <li><span class="px-4 py-2 bg-blue-500 text-white rounded">{{ $i }}</span></li>
                        @else
                            <li><a href="{{ $products->url($i) }}"
                                   class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">{{ $i }}</a></li>
                        @endif
                    @endfor
                    @if ($products->hasMorePages())
                        <li><a href="{{ $products->nextPageUrl() }}"
                               class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Следующая »</a></li>
                    @else
                        <li class="disabled"><span class="px-4 py-2 text-gray-400">Следующая »</span></li>
                    @endif
                </ul>
            </nav>
        </div>
    @endif
@endsection
