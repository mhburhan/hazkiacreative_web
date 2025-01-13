<?php $__env->startSection('content'); ?>
   
 
 <div>
    <div class="flex justify-center space-x-4 items-center py-2 flex-wrap p-2 ">
        <a href="" class=" hover:text-blue-700 border border-blue-700 text-blue-700 px-4 py-2 rounded my-2">Samsung a35</a>
        <a href="" class=" hover:text-blue-700 border border-blue-700 text-blue-700 px-4 py-2 rounded my-2">Samsung zero</a>
        <a href="" class=" hover:text-blue-700 border border-blue-700 text-blue-700 px-4 py-2 rounded my-2">Tv Politron</a>
        <a href="" class=" hover:text-blue-700 border border-blue-700 text-blue-700 px-4 py-2 rounded my-2">Playstation 6</a>
    </div>
</div>
<div class="container mx-auto p-4">
    
    <?php echo $__env->make('app.components.Carausel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto p-6 text-center">
        <h1 class="text-2xl font-bold">Selamat datang di Toko Online!</h1>
        <p class="mt-4">Temukan produk terbaik untuk kebutuhan Anda.</p>
    </div>

    
    <div class="card bg-white rounded-md p-4 shadow-md">
        <h1 class="font-bold text-center py-3 bg-blue-700 p-3 text-white  " style="width: max-content "> Category Pilihan</h1>
         <p>Category yang kami miliki di sini Lihat Sekarang</p>
         <hr>
        <div class="flex flex-wrap justify-center space-x-4">
            <div class="card text-center bg-blue-200 rounded-md p-4 m-2">
                <i class="fas fa-laptop"></i>
                <h1>Laptop</h1>
            </div>
            <div class="card text-center bg-blue-200 rounded-md p-4 m-2">
                <i class="fas fa-book"></i>
                <h1>Atk</h1>
            </div>
            <div class="card text-center bg-blue-200 rounded-md p-4 m-2">
                <i class="fas fa-camera"></i>
                <h1>Kamera</h1>
            </div>
            <div class="card text-center bg-blue-200 rounded-md p-4 m-2">
                <i class="fas fa-desktop"></i>
                <h1>Hardware</h1>
            </div>
        </div>
    </div>

 
 <?php echo $__env->make('app.components.Card', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\USER\Downloads\Compressed\TOKO-ONLINE-master\resources\views/apps/index.blade.php ENDPATH**/ ?>