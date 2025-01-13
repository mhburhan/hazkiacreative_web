<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Produk') }}
        </h2>
    </x-slot>

    @if (session('success'))
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
                                @if ($products->isEmpty())
                                    <tr>
                                        <td colspan="8" class="text-center p-4">Tidak ada data</td>
                                    </tr>
                                @else
                                    @foreach ($products as $product)
                                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                            <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">{{ $loop->iteration }}</td>
                                            <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">{{ $product->name }}</td>
                                            <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">
                                                <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}" class="w-20">
                                            </td>
                                            <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">{{ $product->category->name }}</td>
                                            <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">{{ $product->description }}</td>
                                            <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                                            <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">{{ $product->stock }}</td>
                                            <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">
                                                <button class="text-blue-500 hover:underline editProductBtn"
                                                    data-id="{{ $product->id }}" 
                                                    data-name="{{ $product->name }}"
                                                    data-category="{{ $product->category_id }}"
                                                    data-description="{{ $product->description }}"
                                                    data-price="{{ $product->price }}" 
                                                    data-stock="{{ $product->stock }}"
                                                    data-image="{{ $product->image }}">
                                                    Edit
                                                </button>
                                                <form action="{{ route('products.destroy', $product->id) }}" method=" POST" class="inline-block delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:underline delete-btn">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
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
                <form id="productForm" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
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
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
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
</x-app-layout>