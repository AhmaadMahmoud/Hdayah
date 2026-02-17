@extends('frontend.layouts.master')

@section('content')
                <!-- Hero -->
            <section class="py-4 py-md-5">
                <div class="container" style="max-width:1280px;">
                    <div class="hero">
                        <div class="hero-bg"
                            style="background-image:url('https://lh3.googleusercontent.com/aida-public/AB6AXuDpfpizR8__eU41RPrrRJL_uJovfrGncjYjxFpx1B4l2BCdZtBXpoYDMKNYJUUDN0xRpn8jyRCVm6iBpBgcTsLdGrvm9h21i7Kvn95fGVksnIDckig6i9WAOSvF576uDKziM1HPqAHj4NSqn5-BoAbnjAeJCDE_PPzWxjdvKayydUVZ9bV2cQOwUHFDcOhZbIUmEX4bkLIzcVMGQZQQt43SQ-8LNxQDTuojQtT_D8Srx9UL8cakiCN4ACMIjCjPLUc6mVTRBC2XXIY');">
                        </div>

                        <div class="hero-content p-4 p-md-5 p-lg-5">
                            <div class="row align-items-center g-4 g-md-5">

                                <div class="col-12 col-md-6 text-end">
                                    <span class="badge-hero">خصومات حقيقية على هدايا مختارة</span>

                                    <h1 class="mt-3 fw-black"
                                        style="font-weight:900; font-size: clamp(2rem, 4vw, 3.5rem); line-height:1.15;">
                                        اكتشف هدايا تناسب كل مناسبة<br>
                                        <span style="color:var(--primary);">توصيل سريع وتغليف أنيق</span>
                                    </h1>

                                    <p class="mt-3 mb-4"
                                        style="max-width:520px; color: rgba(255,255,255,.80); font-weight:600; font-size:1.1rem;">
                                        نختار لك منتجات عالية الجودة بلمسات عصرية، مع خيارات دفع آمنة وشحن سريع لجميع المدن.
                                        اجعل هديتك مميزة مع تغليف احترافي ورسالة إهداء مجانية.
                                    </p>

                                    <div class="d-flex flex-wrap gap-3 justify-content-end">
                                        <a href="#" class="btn btn-primary btn-lg rounded-pill px-4"
                                            style="box-shadow:0 12px 30px rgba(238,43,91,.30); font-weight:800;">
                                            تسوق الآن
                                        </a>
                                        <a href="#" class="btn btn-outline-light btn-lg rounded-pill px-4"
                                            style="background:rgba(255,255,255,.10); border-color:rgba(255,255,255,.20); font-weight:800;">
                                            تصفح العروض
                                        </a>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 d-none d-md-block">
                                    <!-- مساحة للصور أو السلايدر -->
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>

<!-- Categories -->
@php
    use App\Models\Category;
    $cats = isset($categories) ? $categories : Category::latest()->get();
@endphp
<section class="py-5">
    <div class="container" style="max-width:1280px;">
        <div class="mb-4 text-start">
            <h2 class="fw-black" style="font-weight:900; font-size: clamp(1.8rem, 3vw, 2.4rem);">تسوق حسب الفئة</h2>
            <p class="text-sub fs-5 m-0">تصفح أقسامنا المميزة واختر ما يناسبك.</p>
        </div>

        @if ($cats->count())
            <div class="swiper categories-swiper" data-count="{{ $cats->count() }}" dir="rtl">
                <div class="swiper-wrapper">
                    @foreach ($cats as $cat)
                        @php
                            $img = $cat->image;
                            $imageUrl = $img
                                ? (preg_match('/^https?:\/\//', $img)
                                    ? $img
                                    : asset('storage/' . ltrim($img, '/')))
                                : null;
                        @endphp
                        <div class="swiper-slide h-auto">
                            <a href="{{ route('categories.show', $cat->id) }}" class="text-decoration-none d-block h-100">
                                <div class="cat-thumb">
                                    <div class="cat-bg"
                                        style="background-image: {{ $imageUrl ? "url('" . $imageUrl . "')" : 'linear-gradient(135deg, #fef3c7, #ffe4e6)' }};">
                                    </div>
                                    <div class="cat-overlay"></div>
                                    <div class="cat-icon">
                                        <span class="material-symbols-outlined">category</span>
                                    </div>
                                </div>
                                <div class="text-start mt-3">
                                    <h3 class="fs-5 fw-bold mb-1" style="color:inherit;">{{ $cat->name }}</h3>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        @else
            <div class="text-center text-secondary-custom">لا توجد أقسام متاحة حالياً.</div>
        @endif
    </div>
</section>

            <!-- CTA -->
            <section class="py-3">
                <div class="container" style="max-width:1280px;">
                    <div class="bg-soft rounded-4 p-4 p-md-4 position-relative overflow-hidden">
                        <div class="row align-items-center g-3">
                            <div
                                class="col-12 col-md d-flex align-items-center gap-3 justify-content-center justify-content-md-start">
                                <div class="d-none d-md-flex icon-pill" style="width:56px;height:56px;">
                                    <span class="material-symbols-outlined fs-2">post_add</span>
                                </div>
                                <div class="text-center text-md-end w-100">
                                    <h3 class="m-0 fw-bold">أضف لمستك الخاصة على هديتك</h3>
                                    <p class="m-0 text-sub fw-semibold">تواصل معنا لاختيار تغليف مخصص وبطاقة إهداء مكتوبة
                                        بخط جميل لتصل هديتك جاهزة.</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-auto">
                                <button class="btn rounded-pill fw-bold px-4 py-2"
                                    style="border:1px solid rgba(238,43,91,.30); color:var(--primary); background: rgba(255,255,255,.60);">
                                    <span class="material-symbols-outlined align-middle me-1"
                                        style="font-size:20px;">chat</span>
                                    تحدث معنا
                                </button>
                            </div>
                        </div>

                        <div class="position-absolute top-0 end-0 translate-middle-y"
                            style="width:96px;height:96px;border-radius:999px;background:rgba(238,43,91,.06);"></div>
                        <div class="position-absolute bottom-0 start-0 translate-middle-y"
                            style="width:96px;height:96px;border-radius:999px;background:rgba(238,43,91,.06);"></div>
                    </div>
                </div>
            </section>

            <!-- Featured -->
            <section class="py-5">
                <div class="container" style="max-width:1280px;">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h2 class="m-0 fw-black" style="font-weight:900;">منتجات مميزة اخترناها لك</h2>
                        <a href="#" class="fw-bold text-decoration-none" style="color:var(--primary);">عرض الكل</a>
                    </div>

                    <div class="d-flex gap-3 hide-scrollbar pb-3">

                        <!-- Product 1 -->
                        <div class="p-card p-3">
                            <div class="p-img">
                                <div class="p-img-bg"
                                    style="background-image:url('https://lh3.googleusercontent.com/aida-public/AB6AXuDR3OgXIS-x1qzXZlK_g0vVASlZzm2YdcTojCqd7bQrXtZcKJKGmPAMSkferwQLxrXTm3pdq9d8XHvZWngR_8TNwwhBJSdSy02wfG7Zge2acx5mYIiITX-aThBBD7LsYc2zk9bWuh17ot0X5_ZeRTChLxVLCY8xfR7CwAs6gLKqnxkls3yD7MGT2QCw7bS4ANHSHXTjvlHQTvmTNtTWhj-0ROoDYmhNeZBPbiRl5k5vRgfNTUxa9thw1IpH3fXvUa2UFkshxOfEcIU');">
                                </div>
                                <div class="tag">حصري</div>
                            </div>

                            <div class="mt-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <h3 class="fs-5 fw-bold m-0">صندوق هدايا فاخر</h3>
                                    <div class="fw-bold" style="color:var(--primary);">250 ر.س</div>
                                </div>
                                <p class="text-sub small mt-2 mb-3">مزيج من اكسسوارات أنيقة مع تغليف جاهز للإهداء ورسالة
                                    خاصة.</p>
                                <button class="btn btn-dark-soft w-100">
                                    <span class="material-symbols-outlined align-middle me-1"
                                        style="font-size:18px;">add_shopping_cart</span>
                                    أضف للسلة
                                </button>
                            </div>
                        </div>

                        <!-- Product 2 -->
                        <div class="p-card p-3">
                            <div class="p-img">
                                <div class="p-img-bg"
                                    style="background-image:url('https://lh3.googleusercontent.com/aida-public/AB6AXuD9hKv6l542hPsopEqrQHCTBOq_FLEkmPL7-JptSbFA4PNNIu_8odQZBQpeWq-yfmbML0Tq76BnvB9kXINo_6DIbqZBe3ZdjMWUh_TXdH1pfEBp0qRB6zRB4dwhbpLUwFU0PGOuutLwBjbAJ1ocxsptdbUDV627pJGod6BW53FZKThnHfgrXtKx7G7BUrvcqT4KWEnqhoQlKH-HpZI8b52o6KWwoXGrdtz881uCCAQdaXqqS9CYkbHWelITOn-XqMwM1CyXh5aO4qU');">
                                </div>
                            </div>

                            <div class="mt-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <h3 class="fs-5 fw-bold m-0">سلة قهوة فاخرة</h3>
                                    <div class="fw-bold" style="color:var(--primary);">300 ر.س</div>
                                </div>
                                <p class="text-sub small mt-2 mb-3">حبوب قهوة مختارة مع أدوات تحضير وهدايا صغيرة لمحبي
                                    القهوة.</p>
                                <button class="btn btn-dark-soft w-100">
                                    <span class="material-symbols-outlined align-middle me-1"
                                        style="font-size:18px;">add_shopping_cart</span>
                                    أضف للسلة
                                </button>
                            </div>
                        </div>

                        <!-- Product 3 -->
                        <div class="p-card p-3">
                            <div class="p-img">
                                <div class="p-img-bg"
                                    style="background-image:url('https://lh3.googleusercontent.com/aida-public/AB6AXuCYHUybphPn4pLQ-SY6CBsONpiLHdzIbX7vwB98Xz0kefd1Nn9ajreoV6D5OdjzarhpW3MEs1RR_RUb1QilnK2R2Br-zlClnyP3dB9dDRd-FYFuO9pBPVKAL9ra-0qiiD3o7G1Sd2NAvdhEvhmMjqsRtI-IA2w-F-sGmuji0HWw-ZIedhiqogf4v9BzNtBBxzJzhxYui2LGXEdVQLGgK3QzyzRd5_JQWSMf345SWXkBlptSmjEmQTO08p2SkXC2nn1Ye2v5yCM5mvY');">
                                </div>
                                <div class="tag primary">عرض اليوم</div>
                            </div>

                            <div class="mt-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <h3 class="fs-5 fw-bold m-0">مجموعة عناية شخصية</h3>
                                    <div class="fw-bold" style="color:var(--primary);">500 ر.س</div>
                                </div>
                                <p class="text-sub small mt-2 mb-3">منتجات عناية مختارة بعناية لتجربة رفاهية متكاملة.</p>
                                <button class="btn btn-dark-soft w-100">
                                    <span class="material-symbols-outlined align-middle me-1"
                                        style="font-size:18px;">add_shopping_cart</span>
                                    أضف للسلة
                                </button>
                            </div>
                        </div>

                        <!-- Product 4 -->
                        <div class="p-card p-3">
                            <div class="p-img">
                                <div class="p-img-bg"
                                    style="background-image:url('https://lh3.googleusercontent.com/aida-public/AB6AXuDKKg-rIi-I5BM22QkLV9-ir7Q45WezLHnSrqNCVmEU82lMs-Itf8ukdRCgCUDiNqRNXIMQ9-Rtvh9ADI2piy6YrOKO8gys7ICoXw6FTiy_FEgsI1F3vvGXSPBlw-D6amQ5qQMlUyfL-U6Lups-2szo-9b-qWpJPHp02ICVbF-PoBUZRD1ulDZxcMrsiCHdD8K4IhfwDdftXHBYy7j7w-W2Nb3ZYhUDegEIKmxjiJdwrEq5WlflQ3eO0iP6tsPiDsw5cr16p4o9h60');">
                                </div>
                            </div>

                            <div class="mt-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <h3 class="fs-5 fw-bold m-0">هدية بسيطة وأنيقة</h3>
                                    <div class="fw-bold" style="color:var(--primary);">150 ر.س</div>
                                </div>
                                <p class="text-sub small mt-2 mb-3">خيار مثالي للإهداء السريع مع تغليف أنيق.</p>
                                <button class="btn btn-dark-soft w-100">
                                    <span class="material-symbols-outlined align-middle me-1"
                                        style="font-size:18px;">add_shopping_cart</span>
                                    أضف للسلة
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <!-- Why us -->
            <section class="py-5">
                <div class="container" style="max-width:1280px;">
                    <div class="text-center mb-4">
                        <h2 class="fw-black mb-2" style="font-weight:900;">ليش تختار هداياك؟</h2>
                        <p class="text-sub mx-auto" style="max-width:720px;">
                            نهتم بكل تفاصيل تجربتك: من اختيار المنتجات إلى التغليف والتسليم. هدفنا أن تصل هديتك بأفضل شكل
                            وفي الوقت المناسب.
                        </p>
                    </div>

                    <div class="row g-4">
                        <div class="col-12 col-md-4">
                            <div class="h-100 text-center p-4 rounded-4 border gc-border" style="background:#fff;">
                                <div class="mx-auto mb-3 icon-pill" style="width:64px;height:64px;">
                                    <span class="material-symbols-outlined fs-2">local_shipping</span>
                                </div>
                                <h3 class="fs-4 fw-bold mb-2">شحن سريع وآمن</h3>
                                <p class="text-sub small m-0">توصيل خلال 24-48 ساعة عمل مع متابعة لحالة الطلب وتغليف يحمي
                                    المنتج.</p>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="h-100 text-center p-4 rounded-4 border gc-border" style="background:#fff;">
                                <div class="mx-auto mb-3 icon-pill" style="width:64px;height:64px;">
                                    <span class="material-symbols-outlined fs-2">redeem</span>
                                </div>
                                <h3 class="fs-4 fw-bold mb-2">خيارات إهداء مرنة</h3>
                                <p class="text-sub small m-0">بطاقات إهداء، تغليف مخصص، ورسالة شخصية بدون أي تكلفة إضافية.
                                </p>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="h-100 text-center p-4 rounded-4 border gc-border" style="background:#fff;">
                                <div class="mx-auto mb-3 icon-pill" style="width:64px;height:64px;">
                                    <span class="material-symbols-outlined fs-2">verified_user</span>
                                </div>
                                <h3 class="fs-4 fw-bold mb-2">دفع آمن ودعم سريع</h3>
                                <p class="text-sub small m-0">بوابات دفع موثوقة، وسياسة استبدال مرنة، وفريق دعم جاهز لمساعدتك
                                    في أي وقت.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

@endsection
