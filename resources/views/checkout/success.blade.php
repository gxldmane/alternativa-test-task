@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-4">Спасибо за ваш заказ!</h1>
    <p class="text-lg">Ваш заказ был успешно оформлен. Мы свяжемся с вами для подтверждения.</p>

    <a href="{{ route('products.index') }}" class="text-blue-500 hover:underline mt-4 inline-block">Вернуться на
        главную</a>
@endsection
