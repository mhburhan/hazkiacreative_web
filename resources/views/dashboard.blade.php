<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
 

    <div class="py-12">
        @if (session('success'))
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        <script>
            $(document).ready(function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',   
                    text: '{{ session('success') }}', // Ubah ini
                    showConfirmButton: false,
                    timer: 3000 // Menambahkan timer untuk otomatis menutup
                });
            });
        </script>
    @endif     
  
    
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
</x-app-layout>
