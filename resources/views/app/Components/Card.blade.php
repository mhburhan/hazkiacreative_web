{{-- Trending Produk --}}
<div class="card bg-white rounded-md mt-2 p-4 shadow-md">
    <div class="my-3">
        <h1 class="font-bold text-center text-white py-3 bg-blue-700 p-3" style="width: max-content">Trending Produk</h1>
        <p>Product Trending yang terbaik yang kami miliki di sini</p>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
        @foreach ($products as $product)
        <div class="card card-compact bg-base-100 shadow-xl"> <!-- Hapus lebar tetap, gunakan grid -->
            <figure>
                <img src="{{asset("images/products/$product->image")}}" alt="{{ $product->name }}" class="object-cover h-48 w-full" />
            </figure>
            <div class="card-body">
                <h2 class="card-title">{{ $product->name }}</h2>
                <p>{{ Str::limit($product->description, 50) }}</p>
                <p class="font-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                <p class="text-sm text-gray-600">Stock: {{ $product->stock }}</p>
                <div class="card-actions justify-end">
                    @guest
                    <button class="btn btn-primary" onclick="LoginPlease()">
                        <i class="fas fa-shopping-cart"></i>
                    </button>
                    @else
                    <button class="btn btn-primary" onclick="addToCart('{{ $product->id }}')">
                        <i class="fas fa-shopping-cart"></i>
                    </button>

                    @endguest
                    <button onclick="window.location.href='{{ route('product.detail', $product->id) }}'" class="btn btn-info"><i class="fas fa-info-circle"></i></button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
{{-- cdn toast --}}
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
            url: '{{ route("cart.add") }}',
            type: 'POST',
            data: {
                product_id: productId,
                _token: '{{ csrf_token() }}' // Token CSRF untuk keamanan
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
</script>