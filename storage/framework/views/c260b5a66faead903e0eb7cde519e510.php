 <!-- Navbar -->
 <nav class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <div class="flex items-center">
                <a href="#" class="text-2xl font-bold text-blue-600">Hazkia<span class="text-black">Creative</span></a>
            </div>
            <div class="hidden md:flex space-x-4 items-center">
                <a href="/" class="text-gray-600 hover:text-blue-700">Beranda</a>
                <form action="" method="get">
                    <input type="search" name="search" placeholder="Cari Produk" class="py-2 pl-10 text-sm text-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 border border-gray-300 w-64">
                </form>
                <?php if(Auth::check()): ?>
                <a href="/cart" class="text-gray-600 hover:text-blue-700"><i class="fas fa-shopping-cart"></i></a>
                
                <form action="/logout" method="post">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="text-gray-600 hover:text-blue-700"><i class="fas fa-sign-out-alt"></i></button>
                </form>
                    <a href="/dashboard" class="text-gray-600 hover:text-blue-700"><i class="fas fa-user"></i></a>
                  <?php else: ?>
                  <a href="/login" class="bg-white border border-blue-700 text-blue-700 px-4 py-2 rounded">Masuk</a>
                  <a href="/register" class="bg-blue-700 hover:bg-blue-600 text-white px-4 py-2 rounded">Daftar</a>
                    <?php endif; ?>
            </div>
            <div class="md:hidden">
                <button id="menu-toggle" class="text-gray-600 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="#" class="block text-gray-600 hover:text-blue-700">Beranda</a>
            <a href="#" class="block text-gray-600 hover:text-blue-700">Kategori</a>
            <a href="#" class="block text-gray-600 hover:text-blue-700">Promo</a>
            <a href="#" class="block text-gray-600 hover:text-blue-700">Kontak</a>
            <a href="#" class="block text-gray-600 hover:text-blue-700">Keranjang</a>
            <a href="/login" class="block text-gray-600 hover:text-blue-700">Masuk</a>
            <a href="/register" class="block text-gray-600 hover:text-blue-700">Daftar</a>
            <form action="" method="get" class="mt-2">
                <input type="search" name="search" placeholder="Cari Produk" class="py-2 pl-10 text-sm text-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 border border-gray-300 w-full">
            </form>
        </div>
    </div>
</nav><?php /**PATH C:\xampp\htdocs\Hazkia Creative_Web\resources\views/app/components/Navbar.blade.php ENDPATH**/ ?>