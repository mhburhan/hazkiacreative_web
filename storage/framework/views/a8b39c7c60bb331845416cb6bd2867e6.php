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
            <?php echo e(__('Category')); ?>

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
                    <h3 class="text-lg font-bold mb-4">Daftar Category</h3>

                    <!-- Tombol untuk menambah kategori -->
                    <button id="addCategoryBtn" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Kategori</button>

                    <div class="overflow-x-auto mt-4">
                        <table class="table-auto w-full text-left border-collapse border border-gray-300 dark:border-gray-700">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">#</th>
                                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Nama Kategori</th>
                                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Slug</th>
                                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Deskripsi</th>
                                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(count($categories) == 0): ?>
                                    <tr>
                                        <td colspan="5" class="text-center p-4">Tidak ada data</td>
                                    </tr>
                                <?php endif; ?>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <td class="px-4 py-2 border border-gray-300 dark:border-gray-600"><?php echo e($loop->iteration); ?></td>
                                        <td class="px-4 py-2 border border-gray-300 dark:border-gray-600"><?php echo e($category->name); ?></td>
                                        <td class="px-4 py-2 border border-gray-300 dark:border-gray-600"><?php echo e($category->slug); ?></td>
                                        <td class="px-4 py-2 border border-gray-300 dark:border-gray-600"><?php echo e($category->description); ?></td>
                                        <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">
                                            <button class="text-blue-500 hover:underline editCategoryBtn" data-id="<?php echo e($category->id); ?>" data-name="<?php echo e($category->name); ?>" data-slug="<?php echo e($category->slug); ?>" data-description="<?php echo e($category->description); ?>">Edit</button>
                                            <form action="<?php echo e(route('categories.destroy', $category->id)); ?>" method="POST" class="inline-block delete-form">
                                                <?php echo csrf_field(); ?>
                                                <button type="submit" class="text-red-500 hover:underline delete-btn">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk Menambah dan Mengedit Kategori -->
    <div id="categoryModal" class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-1/3">
            <div class="p-5 border-b">
                <h5 class="text-lg font-bold" id="modalTitle">Tambah Kategori</h5>
                <button id="closeModal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">&times;</button>
            </div>
            <div class="p-5">
                <form id="categoryForm">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id" id="categoryId">
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Kategori</label>
                        <input type="text" class=" mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" name="name" id="name" required>
                    </div>
                    <div class="mb-4">
                        <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                        <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" name="slug" id="slug" required>
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" name="description" id="description"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            // Menampilkan modal untuk menambah kategori
            $('#addCategoryBtn').click(function() {
                $('#categoryModal').removeClass('hidden');
                $('#categoryForm')[0].reset();
                $('#categoryId').val('');
                $('#modalTitle').text('Tambah Kategori');
            });

            // Menangani pengiriman form
            $('#categoryForm').submit(function(e) {
                e.preventDefault();
                let id = $('#categoryId').val();
                let url = id ? `/categories/${id}` : '/categories';
                let method = id ? 'PUT' : 'POST';

                $.ajax({
                    url: url,
                    method: method,
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#categoryModal').addClass('hidden');
                        Swal.fire({
                            title: id ? 'Kategori berhasil diperbarui' : 'Kategori berhasil ditambahkan',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: 'Terjadi kesalahan',
                            text: 'Silakan coba lagi.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });

            // Menangani klik tombol edit
            $(document).on('click', '.editCategoryBtn', function() {
                let id = $(this).data('id');
                let name = $(this).data('name');
                let slug = $(this).data('slug');
                let description = $(this).data('description');

                $('#categoryId').val(id);
                $('#name').val(name);
                $('#slug').val(slug);
                $('#description').val(description);
                $('#modalTitle').text('Edit Kategori');
                $('#categoryModal').removeClass('hidden');
            });

            // Menangani penghapusan kategori dengan SweetAlert
            $(document).on('click', '.delete-btn', function(e) {
                e.preventDefault();
                const form = $(this).closest('.delete-form');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda tidak dapat mengembalikan ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

            // Menutup modal
            $('#closeModal').click(function() {
                $('#categoryModal').addClass('hidden');
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
<?php endif; ?><?php /**PATH C:\Users\USER\Downloads\Compressed\TOKO-ONLINE-master\resources\views/categories/index.blade.php ENDPATH**/ ?>