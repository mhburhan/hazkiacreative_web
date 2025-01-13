<?php $__env->startSection('content'); ?>
   
 
 <div>
    <div class="flex justify-center space-x-4 items-center py-2 flex-wrap p-2 ">
        <a href="" class=" hover:text-blue-700 border border-blue-700 text-blue-700 px-4 py-2 rounded my-2">Elektronik</a>
        <a href="" class=" hover:text-blue-700 border border-blue-700 text-blue-700 px-4 py-2 rounded my-2">Alat Kesehatan</a>
        <a href="" class=" hover:text-blue-700 border border-blue-700 text-blue-700 px-4 py-2 rounded my-2">Aksesoris</a>
        <a href="" class=" hover:text-blue-700 border border-blue-700 text-blue-700 px-4 py-2 rounded my-2">Lainnya</a>
    </div>
</div>
<div class="container mx-auto p-4">
    
    <?php echo $__env->make('app.components.Carausel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto p-6 text-center">
        <h1 class="text-2xl font-bold">Selamat datang di Hazkia Creative!</h1>
        <p class="mt-4">Temukan produk terbaik untuk kebutuhan Anda.</p>
    </div>

    
    <div class="card bg-white rounded-md p-4 shadow-md">
        <h1 class="font-bold text-center py-3 bg-blue-700 p-3 text-white  " style="width: max-content "> Category Pilihan</h1>
         <p>Category yang kami miliki di sini Lihat Sekarang</p>
         <hr>
        <div class="flex flex-wrap justify-center space-x-4">
            <div class="card text-center bg-blue-200 rounded-md p-4 m-2">
                <i class="fas fa-laptop"></i>
                <h1>Cauter</h1>
            </div>
            <div class="card text-center bg-blue-200 rounded-md p-4 m-2">
                <i class="fas fa-book"></i>
                <h1>Alat Kesehatan</h1>
            </div>
            <div class="card text-center bg-blue-200 rounded-md p-4 m-2">
                <i class="fas fa-camera"></i>
                <h1>Aksesoris</h1>
            </div>
            <div class="card text-center bg-blue-200 rounded-md p-4 m-2">
                <i class="fas fa-desktop"></i>
                <h1>Lainnya</h1>
            </div>
        </div>
    </div>

 
 <?php echo $__env->make('app.components.Card', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Hazkia Creative_Web\resources\views/apps/index.blade.php ENDPATH**/ ?>