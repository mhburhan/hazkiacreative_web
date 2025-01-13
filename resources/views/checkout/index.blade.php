<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout</title>
    @vite('resources/css/app.css')
</head>

<body>

    <!-- Navbar -->
    @include('app.components.Navbar')

    <div class="container mx-auto p-4">
        <h1 class="font-bold text-center text-white py-3 bg-blue-700 p-3 my-2" style="width: max-content">Checkout</h1>

        <!-- Menampilkan pesan kesalahan validasi jika ada -->
        @if ($errors->any())
            <div class="bg-red-500 text-white p-3 rounded-md mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Nama Lengkap</label>
                <input type="text" id="name" name="name" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('name') }}">
            </div>
            <div class="mb-4">
                <label for="address" class="block text-gray-700">Alamat</label>
                <textarea id="address" name="address" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('address') }}</textarea>
            </div>
            <div class="mb-4">
                <label for="phone" class="block text-gray-700">Nomor Telepon</label>
                <input type="text" id="phone" name="phone" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('phone') }}">
            </div>
            <div class="mb-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Konfirmasi Pembelian</button>
            </div>
        </form>
    </div>

</body>
</html>