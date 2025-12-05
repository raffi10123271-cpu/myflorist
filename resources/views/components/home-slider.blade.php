<!-- TOKOPEDIA STYLE PROMO SLIDER -->
<div class="relative w-full overflow-hidden rounded-xl shadow-lg mb-6">

    <div class="carousel w-full h-[260px] md:h-[320px] overflow-hidden rounded-xl" id="promoSlider">

        <!-- SLIDE 1 -->
        <div class="carousel-item relative w-full h-[260px] md:h-[320px]">
            <img src="https://images.unsplash.com/photo-1607082348824-0a9c94c0c7a5"
                 class="w-full object-cover" />
            
            <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-r from-green-700/70 to-green-500/60 flex flex-col justify-center px-10">
                <h2 class="text-white text-3xl md:text-5xl font-extrabold mb-3">
                    Promo Guncang 12.12
                </h2>
                <p class="text-white text-xl md:text-3xl font-bold">
                    Clearance Sale s.d. <span class="text-yellow-300">90%</span>
                </p>
                <p class="text-white text-lg font-semibold mt-2">
                    GRATIS ONGKIR <span class="text-yellow-300">Rp0</span>
                </p>
                <a href="#" class="mt-4 btn btn-sm bg-white text-green-700 rounded-full">
                    Lihat Promo Lainnya
                </a>
            </div>
        </div>

        <!-- SLIDE 2 -->
        <div class="carousel-item relative w-full h-[260px] md:h-[320px]">
            <img src="https://images.unsplash.com/photo-1519682337058-a94d519337bc"
                 class="w-full object-cover" />

            <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-r from-green-700/70 to-green-500/60 flex flex-col justify-center px-10">
                <h2 class="text-white text-3xl md:text-5xl font-extrabold mb-3">
                    Promo Bunga Segar Hari Ini
                </h2>
                <p class="text-white text-xl md:text-3xl font-bold">
                    Diskon <span class="text-yellow-300">50%</span> untuk buket terlaris
                </p>
                <a href="#" class="mt-4 btn btn-sm bg-white text-green-700 rounded-full">
                    Belanja Sekarang
                </a>
            </div>
        </div>

        <!-- SLIDE 3 -->
       <div class="carousel-item relative w-full h-[260px] md:h-[320px]">
            <img src="https://images.unsplash.com/photo-1526045612212-70caf35c14df"
                 class="w-full object-cover" />

            <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-r from-green-700/70 to-green-500/60 flex flex-col justify-center px-10">
                <h2 class="text-white text-3xl md:text-5xl font-extrabold mb-3">
                    Flash Sale Bunga Jam 12
                </h2>
                <p class="text-white text-xl md:text-3xl font-bold">
                    Harga mulai <span class="text-yellow-300">Rp 15.000</span>
                </p>
                <a href="#" class="mt-4 btn btn-sm bg-white text-green-700 rounded-full">
                    Lihat Semua
                </a>
            </div>
        </div>

    </div>

    <!-- NAVIGATION LEFT/RIGHT -->
    <button id="prevBtn"
            class="absolute left-2 top-1/2 btn btn-circle">
        ❮
    </button>

    <button id="nextBtn"
            class="absolute right-2 top-1/2 btn btn-circle">
        ❯
    </button>

</div>

<!-- DOT INDICATORS -->
<div class="flex justify-center space-x-2 mb-6">
    <button class="w-3 h-3 bg-gray-400 rounded-full" onclick="goToSlide(0)"></button>
    <button class="w-3 h-3 bg-gray-400 rounded-full" onclick="goToSlide(1)"></button>
    <button class="w-3 h-3 bg-gray-400 rounded-full" onclick="goToSlide(2)"></button>
</div>

<script>
let currentSlide = 0;
const slider = document.getElementById("promoSlider");
const slides = slider.children;

document.getElementById("nextBtn").addEventListener("click", () => {
    currentSlide = (currentSlide + 1) % slides.length;
    slider.scrollTo({ left: currentSlide * slider.clientWidth, behavior: "smooth" });
});

document.getElementById("prevBtn").addEventListener("click", () => {
    currentSlide = (currentSlide - 1 + slides.length) % slides.length;
    slider.scrollTo({ left: currentSlide * slider.clientWidth, behavior: "smooth" });
});

function goToSlide(n) {
    currentSlide = n;
    slider.scrollTo({ left: currentSlide * slider.clientWidth, behavior: "smooth" });
}
</script>
