<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pesanan') }}
        </h2>
    </x-slot>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold">Daftar Pesanan</h3>
               

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
                                        <td class="py-3 px-6 text-left"><img  src="{{ asset('storage/' . $order->payment_proof) }}" style="width: 100px"></img></td>
                                        <td class="py-3 px-6 text-left">
                                            <select class="status-select" data-order-id="{{ $order->id }}">
                                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                                                <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Dibatalkan</option>
                                            </select>
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
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.status-select').change(function() {
            var orderId = $(this).data('order-id');
            var newStatus = $(this).val();
    
            Swal.fire({
                title: 'Konfirmasi',
                text: "Apakah Anda yakin ingin mengubah status pesanan ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, ubah!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/orders/' + orderId + '/status',
                        type: 'PATCH',
                        data: {
                            status: newStatus,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire(
                                'Berhasil!',
                                'Status pesanan telah diubah.',
                                'success'
                            );
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan saat mengubah status pesanan.',
                                'error'
                            );
                        }
                    });
                } else {
                    // Reset the select to the previous value if the user cancels
                    $(this).val($(this).find('option:selected').val());
                }
            });
        });
    });
    </script>
</x-app-layout>