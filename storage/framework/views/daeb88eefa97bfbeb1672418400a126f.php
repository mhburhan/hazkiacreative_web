<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <?php echo e(__('Pesanan')); ?>

        </h2>
     <?php $__env->endSlot(); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold">Daftar Pesanan</h3>
               

                    <?php if($orders->isEmpty()): ?>
                        <p>Tidak ada pesanan yang ditemukan.</p>
                    <?php else: ?>
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
                                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-6 text-left"><?php echo e($order->name); ?></td>
                                        <td class="py-3 px-6 text-left"><?php echo e($order->address); ?></td>
                                        <td class="py-3 px-6 text-left"><?php echo e($order->phone); ?></td>
                                        <td class="py-3 px-6 text-left"><?php echo e(number_format($order->total_amount, 2)); ?></td>
                                        <td class="py-3 px-6 text-left"><img  src="<?php echo e(asset('storage/' . $order->payment_proof)); ?>" style="width: 100px"></img></td>
                                        <td class="py-3 px-6 text-left">
                                            <select class="status-select" data-order-id="<?php echo e($order->id); ?>">
                                                <option value="pending" <?php echo e($order->status == 'pending' ? 'selected' : ''); ?>>Pending</option>
                                                <option value="completed" <?php echo e($order->status == 'completed' ? 'selected' : ''); ?>>Selesai</option>
                                                <option value="canceled" <?php echo e($order->status == 'canceled' ? 'selected' : ''); ?>>Dibatalkan</option>
                                            </select>
                                        </td>
                                        <td class="py-3 px-6 text-left">
                                            <button 
                                                onclick="document.getElementById('order-detail-<?php echo e($order->id); ?>').classList.toggle('hidden')"
                                                class="text-blue-500 hover:underline">
                                                Lihat Detail
                                            </button>
                                        </td>
                                    </tr>
                                    <tr id="order-detail-<?php echo e($order->id); ?>" class="hidden">
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
                                                    <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr class ="border-b border-gray-200 hover:bg-gray-100">
                                                            <td class="py-3 px-6 text-left"><?php echo e($item->product->name); ?></td>
                                                            <td class="py-3 px-6 text-left"><?php echo e(number_format($item->price, 2)); ?></td>
                                                            <td class="py-3 px-6 text-left"><?php echo e($item->quantity); ?></td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
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
                            _token: '<?php echo e(csrf_token()); ?>'
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
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\Users\USER\Downloads\Compressed\TOKO-ONLINE-master\resources\views/orders/index.blade.php ENDPATH**/ ?>