@extends('welcome')

@section('content')
  <div class="container mx-auto mt-8">
    <h1 class="text-3xl font-bold text-center mb-6">{{ $product->name }}</h1>
    
    <div class="flex flex-col md:flex-row">
      <div class="md:w-1/2">
        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="object-cover w-full h-96 rounded-lg shadow-lg" />
      </div>
      <div class="md:w-1/2 md:pl-6">
        <h2 class="text-2xl font-semibold">Deskripsi</h2>
        <p class="mt-2">{{ $product->description }}</p>
        <p class="mt-4 text-lg font-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
        <p class="text-sm text-gray-600">Stock: {{ $product->stock }}</p>
        
        <div class="mt-6">
          @guest
            <button class="btn btn-primary" onclick="LoginPlease()">
              <i class="fas fa-shopping-cart"></i> Tambah ke Keranjang
            </button>
          @else
            <button class="btn btn-primary" onclick="addToCart('{{ $product->id }}')">
              <i class="fas fa-shopping-cart"></i> Tambah ke Keranjang
            </button>
          @endguest
        </div>
      </div>
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
@endsection