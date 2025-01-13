<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Category') }}
        </h2>
    </x-slot>

    @if (session('success'))
    {{-- SWEET ALERT --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',   
            text: '{{ session('success') }}',
            showConfirmButton: false
        });
    </script>
    @endif

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
                                @if (count($categories) == 0)
                                    <tr>
                                        <td colspan="5" class="text-center p-4">Tidak ada data</td>
                                    </tr>
                                @endif
                                @foreach ($categories as $category)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">{{ $category->name }}</td>
                                        <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">{{ $category->slug }}</td>
                                        <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">{{ $category->description }}</td>
                                        <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">
                                            <button class="text-blue-500 hover:underline editCategoryBtn" data-id="{{ $category->id }}" data-name="{{ $category->name }}" data-slug="{{ $category->slug }}" data-description="{{ $category->description }}">Edit</button>
                                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline-block delete-form">
                                                @csrf
                                                <button type="submit" class="text-red-500 hover:underline delete-btn">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
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
                    @csrf
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
</x-app-layout>