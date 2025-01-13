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
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold">Detail Pesanan</h3>
               

                    @if($orders->isEmpty())
                        <p>Tidak ada pesanan yang ditemukan.</p>
                    @else
                        <table class="min-w-full bg-white border border-gray-200 mt-4">
                            <thead>
                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-left">Nama</th>
                                    <th class="py-3 px-6 text-left">Alamat</th>
                                    <th class="py-3 px-6 text-left">Telepon</th>
                                    <th class="py-3 px-6 text-left">Total</th>
                                    <th class="py-3 px-6 text-left">Metde Pembayaran</th>
                                    <th class="py-3 px-6 text-left">Bukti Pembayaran</th>
                                    <th class="py-3 px-6 text-left">Status</th>
                                    <th class="py-3 px-6 text-left">Detail</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light">
                                @foreach($orders as $order)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-6 text-left">{{ $order->name }}</td>
                                        <td class="py-3 px-6 text-left">{{ $order->address }}</td>
                                        <td class="py-3 px-6 text-left">{{ $order->phone }}</td>
                                        <td class="py-3 px-6 text-left">{{ number_format($order->total_amount, 2) }}</td>
                                        <td class="py-3 px-6 text-left">{{ $order->payment_method }}</td>
                                        <td class="py-3 px-6 text-left"><img  src="{{ asset('storage/' . $order->payment_proof) }}" style="width: 100px"></img></td>
                                        <td class="py-3 px-6 text-left 
                                        @if($order->status == 'completed') 
                                            text-green-500 
                                        @else 
                                            text-red-500 
                                        @endif">
                                        {{ $order->status }}
                                    </td>
                                        <td class="py-3 px-6 text-left">
                                            <button 
                                                onclick="document.getElementById('order-detail-{{ $order->id }}').classList.toggle('hidden')"
                                                class="text-blue-500 hover:underline">
                                                Lihat Detail
                                            </button>
                                        </td>
                                    </tr>
                                    <tr id="order-detail-{{ $order->id }}" class="hidden">
                                        <td colspan="6">
                                            <table class="min-w-full bg-gray-100 border border-gray-200 mt-2">
                                                <thead>
                                                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                                        <th class="py-3 px-6 text-left">Nama Produk</th>
                                                        <th class="py-3 px-6 text-left">Harga</th>
                                                        <th class="py-3 px-6 text-left">Jumlah</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($order->items as $item)
                                                        <tr class ="border-b border-gray-200 hover:bg-gray-100">
                                                            <td class="py-3 px-6 text-left">{{ $item->product->name }}</td>
                                                            <td class="py-3 px-6 text-left">{{ number_format($item->price, 2) }}</td>
                                                            <td class="py-3 px-6 text-left">{{ $item->quantity }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                    <a href="/" class="btn btn-primary mt-2">Kembali ke halaman utama</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
</html>
