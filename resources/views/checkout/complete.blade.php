<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pesanan Selesai</title>
    @vite('resources/css/app.css')
</head>
<body>

    <!-- Navbar -->
    @include('app.components.Navbar')

    <div class="container mx-auto p-4">
        <h1 class="font-bold text-center text-green-700 py-3">Pesanan Anda Telah Diproses!</h1>
        <p class="text-center">Terima kasih telah berbelanja di Toko Online kami.</p>
        <p class="text-center">Kami akan segera memproses pesanan Anda.</p>
        <div class="text-center mt-4">

        </div>
    </div>

</body>
</html>