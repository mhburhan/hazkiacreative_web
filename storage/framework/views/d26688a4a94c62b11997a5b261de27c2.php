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
            <?php echo e(__('Dashboard')); ?>

        </h2>
     <?php $__env->endSlot(); ?>
 

    <div class="py-12">
        <?php if(session('success')): ?>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        <script>
            $(document).ready(function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',   
                    text: '<?php echo e(session('success')); ?>', // Ubah ini
                    showConfirmButton: false,
                    timer: 3000 // Menambahkan timer untuk otomatis menutup
                });
            });
        </script>
    <?php endif; ?>     
  
    
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Card 1: Total Produk -->
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="bg-blue-500 text-white rounded-full h-12 w-12 flex items-center justify-center">
                            <i class="fas fa-box"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Total Produk</h3>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">120</p>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Pesanan Baru -->
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="bg-green-500 text-white rounded-full h-12 w-12 flex items-center justify-center">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Pesanan Baru</h3>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">45</p>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Pengguna Terdaftar -->
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="bg-yellow-500 text-white rounded-full h-12 w-12 flex items-center justify-center">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Pengguna</h3>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">350</p>
                        </div>
                    </div>
                </div>

                <!-- Card 4: Total Penjualan -->
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="bg-red-500 text-white rounded-full h-12 w-12 flex items-center justify-center">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Total Penjualan</h3>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">Rp 12,000,000</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\Users\USER\Downloads\Compressed\TOKO-ONLINE-master\resources\views/dashboard.blade.php ENDPATH**/ ?>