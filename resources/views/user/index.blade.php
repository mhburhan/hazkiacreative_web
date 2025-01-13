<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User  Login') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Tabel untuk menampilkan pengguna -->
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Role
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        @if($users->isEmpty())
                        <tbody>
                            <tr>
                                <td colspan="5">
                                    <p class="text-center py-3">Kosong Tidak Ada User</p>
                                </td>
                            </tr>
                        </tbody>
                        @else
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($users as $user)
                                @if ($user->role !== 'admin') <!-- Hanya tampilkan pengguna yang bukan admin -->
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $user->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $user->email }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $user->role }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{ route('users.edit', $user->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                                            <button type="button" class="text-red-500 hover:text-red-700 ml-2 delete-user" data-id="{{ $user->id }}">Hapus</button>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            // Menggunakan SweetAlert2 untuk mengonfirmasi penghapusan
            $('.delete-user').click(function(e) {
                e.preventDefault();
                var userId = $(this).data('id');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda tidak akan dapat mengembalikan ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: '/users/' + userId + '/delete', // Ubah URL sesuai dengan route yang Anda gunakan
                            data: {
                                _token: '{{ csrf_token() }}' // Sertakan token CSRF
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Terhapus!',
                                    'Pengguna telah dihapus.',
 'success'
                                ).then(() => {
                                    location.reload(); // Reload halaman untuk memperbarui daftar pengguna
                                });
                            },
                            error: function(xhr) {
                                Swal.fire(
                                    'Gagal!',
                                    'Terjadi kesalahan saat menghapus pengguna.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>
</x-app-layout>