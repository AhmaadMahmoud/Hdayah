<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const el = document.querySelector('.categories-swiper');
        if (!el || typeof Swiper === 'undefined') return;

        const count = Number(el.dataset.count || 0);
        const shouldAutoPlay = count >= 6; // يتحرك لوحده لو الفئات كتير

        new Swiper(el, {
            loop: shouldAutoPlay,
            spaceBetween: 16,
            centeredSlides: false,
            watchOverflow: true,
            autoplay: shouldAutoPlay ? {
                delay: 2200,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            } : false,
            pagination: {
                el: el.querySelector('.swiper-pagination'),
                clickable: true,
            },
            breakpoints: {
                0: { slidesPerView: 2.1 },
                576: { slidesPerView: 3.2 },
                992: { slidesPerView: 5 },
            },
        });
    });
</script>
