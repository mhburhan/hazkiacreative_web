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
            <?php echo e(__('Produk')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <?php if(session('success')): ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '<?php echo e(session('success')); ?>',
                showConfirmButton: false
            });
        </script>
    <?php endif; ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold mb-4">Daftar Produk</h3>

                    <button id="addProductBtn" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Produk</button>

                    <div class="overflow-x-auto mt-4">
                        <table class="table-auto w-full text-left border-collapse border border-gray-300 dark:border-gray-700">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">#</th>
                                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Nama Produk</th>
                                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Gambar</th>
                                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Kategori</th>
                                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Deskripsi</th>
                                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Harga</th>
                                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Stok</th>
                                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($products->isEmpty()): ?>
                                    <tr>
                                        <td colspan="8" class="text-center p-4">Tidak ada data</td>
                                    </tr>
                                <?php else: ?>
                                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                            <td class="px-4 py-2 border border-gray-300 dark:border-gray-600"><?php echo e($loop->iteration); ?></td>
                                            <td class="px-4 py-2 border border-gray-300 dark:border-gray-600"><?php echo e($product->name); ?></td>
                                            <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">
                                                <img src="<?php echo e(asset('images/products/' . $product->image)); ?>" alt="<?php echo e($product->name); ?>" class="w-20">
                                            </td>
                                            <td class="px-4 py-2 border border-gray-300 dark:border-gray-600"><?php echo e($product->category->name); ?></td>
                                            <td class="px-4 py-2 border border-gray-300 dark:border-gray-600"><?php echo e($product->description); ?></td>
                                            <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">Rp<?php echo e(number_format($product->price, 0, ',', '.')); ?></td>
                                            <td class="px-4 py-2 border border-gray-300 dark:border-gray-600"><?php echo e($product->stock); ?></td>
                                            <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">
                                                <button class="text-blue-500 hover:underline editProductBtn"
                                                    data-id="<?php echo e($product->id); ?>" 
                                                    data-name="<?php echo e($product->name); ?>"
                                                    data-category="<?php echo e($product->category_id); ?>"
                                                    data-description="<?php echo e($product->description); ?>"
                                                    data-price="<?php echo e($product->price); ?>" 
                                                    data-stock="<?php echo e($product->stock); ?>"
                                                    data-image="<?php echo e($product->image); ?>">
                                                    Edit
                                                </button>
                                                <form action="<?php echo e(route('products.destroy', $product->id)); ?>" method=" POST" class="inline-block delete-form">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="text-red-500 hover:underline delete-btn">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk Menambah dan Mengedit Produk -->
    <div id="productModal" class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-1/3">
            <div class="p-5 border-b">
                <h5 class="text-lg font-bold" id="modalTitle">Tambah Produk</h5>
                <button id="closeModal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">&times;</button>
            </div>
            <div class="p-5 modal-body">
                <form id="productForm" action="<?php echo e(route('products.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="_method" id="method" value="POST">
                    <input type="hidden" name="product_id" id="product_id" value="">
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                        <input type="text" id="name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" name="name" required>
                    </div>
                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-700">Gambar</label>
                        <input type="file" id="image" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" name="image">
                    </div>
                    <div class="mb-4">
                        <label for="category_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                        <select id="category_id" name="category_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" required>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea id="description" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" name="description"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="price" class="block text-sm font-medium text-gray-700">Harga</label>
                        <input type="number" id="price" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" name="price" required>
                    </div>
                    <div class="mb-4">
                        <label for="stock" class="block text-sm font-medium text-gray-700">Stok</label>
                        <input type="number" id="stock" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" name="stock" required>
                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
                    <button type="button" id="closeModal" class="close bg-blue-500 text-white px-4 py-2 rounded">Close</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('closeModal').addEventListener('click', function() {
            document.getElementById('productModal').classList.add('hidden');
        });

        document.getElementById('addProductBtn').addEventListener('click', function() {
            document.getElementById('productModal').classList.remove('hidden');
            document.getElementById('productForm').reset();
            document.getElementById('modalTitle').innerText = 'Tambah Produk';
 document.getElementById('method').value = 'POST';
            document.getElementById('product_id').value = '';
        });

        document.querySelectorAll('.editProductBtn').forEach(function(button) {
            button.addEventListener('click', function() {
                document.getElementById('productModal').classList.remove('hidden');
                document.getElementById('modalTitle').innerText = 'Edit Produk';
                document.getElementById('method').value = 'PUT';
                document.getElementById('product_id').value = this.getAttribute('data-id');
                document.getElementById('name').value = this.getAttribute('data-name');
                document.getElementById('category_id').value = this.getAttribute('data-category');
                document.getElementById('description').value = this.getAttribute('data-description');
                document.getElementById('price').value = this.getAttribute('data-price');
                document.getElementById('stock').value = this.getAttribute('data-stock');
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
<?php endif; ?><?php /**PATH C:\Users\USER\Downloads\Compressed\TOKO-ONLINE-master\resources\views/products/index.blade.php ENDPATH**/ ?>