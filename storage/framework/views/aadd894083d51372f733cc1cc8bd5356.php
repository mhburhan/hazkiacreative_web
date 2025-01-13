
<div class="card bg-white rounded-md mt-2 p-4 shadow-md">
    <div class="my-3">
        <h1 class="font-bold text-center text-white py-3 bg-blue-700 p-3" style="width: max-content">Trending Produk</h1>
        <p>Product Trending yang terbaik yang kami miliki di sini</p>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card card-compact bg-base-100 shadow-xl"> <!-- Hapus lebar tetap, gunakan grid -->
            <figure>
                <img src="<?php echo e(asset("images/products/$product->image")); ?>" alt="<?php echo e($product->name); ?>" class="object-cover h-48 w-full" />
            </figure>
            <div class="card-body">
                <h2 class="card-title"><?php echo e($product->name); ?></h2>
                <p><?php echo e(Str::limit($product->description, 50)); ?></p>
                <p class="font-bold">Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?></p>
                <p class="text-sm text-gray-600">Stock: <?php echo e($product->stock); ?></p>
                <div class="card-actions justify-end">
                    <?php if(auth()->guard()->guest()): ?>
                    <button class="btn btn-primary" onclick="LoginPlease()">
                        <i class="fas fa-shopping-cart"></i>
                    </button>
                    <?php else: ?>
                    <button class="btn btn-primary" onclick="addToCart('<?php echo e($product->id); ?>')">
                        <i class="fas fa-shopping-cart"></i>
                    </button>

                    <?php endif; ?>
                    <button onclick="window.location.href='<?php echo e(route('product.detail', $product->id)); ?>'" class="btn btn-info"><i class="fas fa-info-circle"></i></button>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>


function LoginPlease(){
    Swal.fire({
        title: 'Oops!',
        text: 'Anda harus login terlebih dahulu',
        icon: 'warning',
        confirmButtonText: 'OK'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location = '/login';
        }
    })
}
    function addToCart(productId) {
        $.ajax({
            url: '<?php echo e(route("cart.add")); ?>',
            type: 'POST',
            data: {
                product_id: productId,
                _token: '<?php echo e(csrf_token()); ?>' // Token CSRF untuk keamanan
            },
            success: function(response) {
                swal.fire({
                    title: 'Berhasil!',
                    text: 'Produk berhasil ditambahkan ke keranjang.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = '/cart'; // Muat ulang halaman untuk memperbarui keranjang
                    }
                });
            },
            error: function(xhr) {
                alert('Terjadi kesalahan saat menambahkan produk ke keranjang.');
            }
        });
    }
</script><?php /**PATH C:\xampp\htdocs\Hazkia Creative_Web\resources\views/app/components/Card.blade.php ENDPATH**/ ?>