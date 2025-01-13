<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pesanan Selesai</title>
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
</head>
<body>

    <!-- Navbar -->
    <?php echo $__env->make('app.components.Navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="container mx-auto p-4">
        <h1 class="font-bold text-center text-green-700 py-3">Pesanan Anda Telah Diproses!</h1>
        <p class="text-center">Terima kasih telah berbelanja di Toko Online kami.</p>
        <p class="text-center">Kami akan segera memproses pesanan Anda.</p>
        <div class="text-center mt-4">

        </div>
    </div>

</body>
</html><?php /**PATH C:\Users\USER\Downloads\Compressed\TOKO-ONLINE-master\resources\views/checkout/complete.blade.php ENDPATH**/ ?>