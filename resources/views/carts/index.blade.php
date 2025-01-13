<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Toko Online</title>
    @vite('resources/css/app.css')
    {{-- cdn icon  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>

    <!-- Navbar -->
    @include('app.components.Navbar')

    <div class="container mx-auto p-4">
        <h1 class="font-bold text-center text-white py-3 bg-blue-700 p-3 my-2" style="width: max-content">Keranjang</h1>

        <a href="/pesanan/detail" class=" mb-4 mt-4 inline-block bg-blue-700 text-white px-4 py-2 rounded-md hover:bg-blue-600">Lihat Detail Pesanan </a>
        
        @if($cartItems->isEmpty())
            <div class="text-center">
                <p class="text-lg">Keranjang Anda kosong.</p>
                <a href="{{ route('products.index') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Belanja Sekarang</a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr class="w-full bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Nama Produk</th>
                            <th class="py-3 px-6 text-left">Harga</th>
                            <th class="py-3 px-6 text-left">Jumlah</th>
                            <th class="py-3 px-6 text-left">Total</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        @foreach($cartItems as $item)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6">{{ $item->product->name }}</td>
                                <td class="py-3 px-6">Rp {{ number_format($item->product->price, 0, ',', '.') }}</td>
                                <td class="py-3 px-6">{{ $item->quantity }}</td>
                                <td class="py-3 px-6">Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

           
                <div class="mt-6">
                    <h2 class="text-lg font-bold">Informasi Pemesanan</h2>
                    
                    <form action="{{ route('checkout.process') }}" method="POST" class="mt-4" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700">Nama:</label>
                            <input type="text" id="name" name="name" required class="border border-gray-300 p-2 w-full">
                        </div>
                        <div class="mb-4">
                            <label for="phone" class="block text-gray-700">Nomor Telepon:</label>
                            <input type="tel" id="phone" name="phone" required class="border border-gray-300 p-2 w-full">
                        </div>
                        <div class="mb-4">
                            <label for="address" class="block text-gray-700">Alamat:</label>
                            <textarea id="address" name="address" required class="border border-gray-300 p-2 w-full"></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="payment_method" class="block text-gray-700">Metode Pembayaran:</label>
                            <select id="payment_method" name="payment_method" required class="border border-gray-300 p-2 w-full">
                                <option value="bank_transfer">Transfer Bank - No . Rekening: 1234567890</option>
                                <option value="credit_card">Kartu Kredit - No. Kartu: 1234567890123456</option>
                                <option value="ewallet">e-Wallet - No. E-Wallet: 1234567890</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="payment_proof" class="block text-gray-700">Bukti Pembayaran:</label>
                            <input type="file" id="payment_proof" name="payment_proof" accept="image/*" required class="border border-gray-300 p-2 w-full">
                        </div>
                        <div class="flex mx-2 ">
                            <button type="submit" class="btn bg-blue-700 text-white px-4 py-2 rounded-md hover:bg-blue-600">Proses Checkout</button>
                            <a href="/" class="btn bg-blue-700 text-white px-4 py-2 rounded-md hover:bg-blue-600">Kembali Belanja</a>
                        </div>
                    </form>
                    
                    @if(session('payment_proof'))
                        <div class="mt-6">
                            <h2 class="text-lg font-bold">Bukti Pembayaran</h2>
                            <img src="{{ asset('storage/' . session('payment_proof')) }}" alt="Bukti Pembayaran" class="mt-2 w-full max-w-md">
                        </div>
                    @endif
                </div>
                
           
            </div>
        @endif
    </div>

</body>

<script>
    function removeFromCart(itemId) {
        if (confirm('Apakah Anda yakin ingin menghapus item ini dari keranjang?')) {
            $.ajax({
                url: '/cart/remove/' + itemId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response){
                    location.reload();
                }
                });
                }
                }
                </script>
                