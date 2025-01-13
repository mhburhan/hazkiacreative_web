
<style>
    /* Custom styles for carousel */
    .carousel {
        position: relative;
        overflow: hidden;
    }

    .carousel-inner {
        display: flex;
        transition: transform 0.5s ease;
    }

    .carousel-item {
        min-width: 100%;
        box-sizing: border-box;
    }
</style>
</head>
<body class="bg-gray-100">

<!-- Carousel -->
<div class="carousel w-full">
    <div class="carousel-inner" id="carousel-inner">
        <div id="slide1" class="carousel-item relative w-full">
            <img src="https://img.daisyui.com/images/stock/photo-1625726411847-8cbb60cc71e6.webp" class="w-full  rounded-md" />
            <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
                <a href="#slide4" class="btn btn-circle">❮</a>
                <a href="#slide2" class="btn btn-circle">❯</a>
            </div>
        </div>
        <div id="slide2" class="carousel-item relative w-full">
            <img src="https://img.daisyui.com/images/stock/photo-1609621838510-5ad474b7d25d.webp" class="w-full  rounded-md" />
            <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
                <a href="#slide1" class="btn btn-circle">❮</a>
                <a href="#slide3" class="btn btn-circle">❯</a>
            </div>
        </div>
        <div id="slide3" class="carousel-item relative w-full">
            <img src="https://img.daisyui.com/images/stock/photo-1414694762283-acccc27bca85.webp" class="w-full  rounded-md" />
            <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
                <a href="#slide2" class="btn btn-circle">❮</a>
                <a href="#slide4" class="btn btn-circle">❯</a>
            </div>
        </div>
        <div id="slide4" class="carousel-item relative w-full">
            <img src="https://img.daisyui.com/images/stock/photo-1665553365602-b2fb8e5d1707.webp" class="w-full rounded-md" />
            <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
                <a href="#slide3" class="btn btn-circle">❮</a>
                <a href="#slide1" class="btn btn-circle">❯</a>
            </div>
        </div>
    </div>
</div>

<script>
    const carouselInner = document.getElementById('carousel-inner');
    const carouselItems = document.querySelectorAll('.carousel-item');
    const totalItems = carouselItems.length;
    let currentIndex = 0;

    function showSlide(index) {
        const offset = -index * 100; // Calculate offset
        carouselInner.style.transform = `translateX(${offset}%)`;
    }

    // Optional: Auto slide every 3 seconds
    setInterval(() => {
        currentIndex = (currentIndex + 1) % totalItems; // Loop back to first
        showSlide(currentIndex);
    }, 3000);
</script>