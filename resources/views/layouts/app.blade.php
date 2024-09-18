<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Интернет магазин</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="container mx-auto">
    <nav class="flex justify-between items-center py-4">
        <div>
            <a href="{{ route('products.index') }}" class="text-lg font-bold text-blue-500 hover:underline">
                Главная
            </a>
        </div>
        <div>
            <a href="{{ route('cart.index') }}" class="text-lg text-blue-500 hover:underline">
                Корзина
                @if(session('cart') && count(session('cart')) > 0)
                    ({{ count(session('cart')) }})
                @endif
            </a>
        </div>
    </nav>
    <div>
        @yield('content')
    </div>
</div>
</body>
</html>
