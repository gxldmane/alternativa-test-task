@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-4">Оформление заказа</h1>
    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 mb-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('checkout.place') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-lg">Имя:</label>
            <input type="text" id="name" name="name" class="w-full border rounded p-2" value="{{ old('name') }}"
                   required>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-lg">Email:</label>
            <input type="email" id="email" name="email" class="w-full border rounded p-2" value="{{ old('email') }}"
                   required>
        </div>

        <h2 class="text-2xl font-bold mb-4">Ваши товары:</h2>
        <ul class="mb-4">
            @foreach($cart as $item)
                <li class="mb-2">{{ $item['name'] }} — {{ $item['quantity'] }} шт. x {{ $item['price'] }} руб.</li>
            @endforeach
        </ul>

        <button type="submit" class="mt-4 bg-green-500 text-white px-4 py-2 rounded">Оформить заказ</button>
    </form>
@endsection
