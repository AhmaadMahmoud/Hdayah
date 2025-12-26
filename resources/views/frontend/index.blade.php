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
                                    <span class="badge-hero">🎁 نصنع لحظات لا تنسى</span>

                                    <h1 class="mt-3 fw-black"
                                        style="font-weight:900; font-size: clamp(2rem, 4vw, 3.5rem); line-height:1.15;">
                                        هديتك جاهزة… <br>
                                        <span style="color:var(--primary);">وإحنا نهتم بالباقي</span>
                                    </h1>

                                    <p class="mt-3 mb-4"
                                        style="max-width:520px; color: rgba(255,255,255,.80); font-weight:600; font-size:1.1rem;">
                                        نساعدك في اختيار وتغليف وإرسال الهدية المثالية لمن تحب. دعنا نعتني بالتفاصيل
                                        الدقيقة بينما تستمتع أنت بلحظة الإهداء.
                                    </p>

                                    <div class="d-flex flex-wrap gap-3 justify-content-end">
                                        <a href="#" class="btn btn-primary btn-lg rounded-pill px-4"
                                            style="box-shadow:0 12px 30px rgba(238,43,91,.30); font-weight:800;">
                                            ابدأ تجهيز هديتك
                                        </a>
                                        <a href="#" class="btn btn-outline-light btn-lg rounded-pill px-4"
                                            style="background:rgba(255,255,255,.10); border-color:rgba(255,255,255,.20); font-weight:800;">
                                            تصفح الكتالوج
                                        </a>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 d-none d-md-block">
                                    <!-- مساحة للصورة/عنصر ديكور لو حبيت -->
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Categories -->
            <section class="py-5">
                <div class="container" style="max-width:1280px;">
                    <div class="mb-4 text-end">
                        <h2 class="fw-black" style="font-weight:900; font-size: clamp(1.8rem, 3vw, 2.4rem);">تسوق حسب
                            الفئة</h2>
                        <p class="text-sub fs-5 m-0">اختر الهدية المثالية لكل شخص عزيز عليك</p>
                    </div>

                    <div class="row g-3 g-md-4 row-cols-2 row-cols-md-3 row-cols-lg-5">

                        <!-- Category 1 -->
                        <div class="col">
                            <a href="{{ route('cat.index') }}" class="text-decoration-none">
                                <div class="cat-thumb">
                                    <div class="cat-bg"
                                        style="background-image:url('https://lh3.googleusercontent.com/aida-public/AB6AXuD3ojTonWjcQvIahwT_GSbrdE_0IbsJHFPyy9mNJiRLhtYygIimaPQyKjBEKuw8gCTZ0wdxbYXk-Ul61VotjAlduFWIJHgzBRKQrKN0kFEeJAyYrOQ9EFvhGAayGvu8wy5NtdiF1zez2vSA2vo_7gB0JU73oq3AIxesqUcxumzL819cn0dwUBPzjhR2LJXcx7R6r3K5V2_QygZI9JcVe6UamgSnNc6Ym7J-Aadlb5Qh8iqjzEXCL6bz_-rK5_5KCWD85hhaA0pKa1s');">
                                    </div>
                                    <div class="cat-overlay"></div>
                                    <div class="cat-icon">
                                        <span class="material-symbols-outlined">filter_vintage</span>
                                    </div>
                                </div>
                                <div class="text-end mt-3">
                                    <h3 class="fs-5 fw-bold mb-1" style="color:inherit;">هدايا النساء</h3>
                                    <p class="text-sub small m-0">اكسسوارات ومجوهرات</p>
                                </div>
                            </a>
                        </div>

                        <!-- Category 2 -->
                        <div class="col">
                            <a href="{{ route('cat.index') }}" class="text-decoration-none">
                                <div class="cat-thumb">
                                    <div class="cat-bg"
                                        style="background-image:url('https://lh3.googleusercontent.com/aida-public/AB6AXuABK_YINy7aVOqvW716P-6Xup9LDMBZIjTo5hjSNDeusZrSjAJJx8nonrONySJ5o2VEME77GwjbqOBSGqX5G1anuZwwG_u4ZzRFEZLJuUc3NoK4P306Lz4l95ETaiZB5coO4lMeXkWsCO5VpUYSsY8pPytHpeS32nSX45L3It8uJqBaGoCeBmYlz8rjkt8Me26edqThoCbhqmINlo13fSzfgEZtCa8zO2UKMp_s3rWWbBfpomWBbTfwhJG9QWqfqgrRuLmeKN-Akvo');">
                                    </div>
                                    <div class="cat-overlay"></div>
                                    <div class="cat-icon">
                                        <span class="material-symbols-outlined">watch</span>
                                    </div>
                                </div>
                                <div class="text-end mt-3">
                                    <h3 class="fs-5 fw-bold mb-1" style="color:inherit;">هدايا الرجال</h3>
                                    <p class="text-sub small m-0">ساعات وعطور</p>
                                </div>
                            </a>
                        </div>

                        <!-- Category 3 -->
                        <div class="col">
                            <a href="{{ route('cat.index') }}" class="text-decoration-none">
                                <div class="cat-thumb">
                                    <div class="cat-bg"
                                        style="background-image:url('https://lh3.googleusercontent.com/aida-public/AB6AXuDPAEheqy-rF3Uj8OJ1WolEFtEQbEZt68grMZR8rx2nJbzVBX6aDxEevIOQoBvx49IS2viDh6u30o-HKApYK9BuT5BLqSH19E1pUInLivYun1hYW2pqvDzFSopttidjCeGFFg3ke4GpTpD0Q-LzrE1qUv9lEiWxU5gAJqumB_MM79FTG2eeNF1_EYGvdL9mWC8RQ5_k_2G1VlkDClVCDAPCBD9ZN8W0Vh-TCs-QXn92yp5oxh9rAkjqWAQBoVFMByrWP73fI3TNK3s');">
                                    </div>
                                    <div class="cat-overlay"></div>
                                    <div class="cat-icon">
                                        <span class="material-symbols-outlined">toys</span>
                                    </div>
                                </div>
                                <div class="text-end mt-3">
                                    <h3 class="fs-5 fw-bold mb-1" style="color:inherit;">ألعاب الأطفال</h3>
                                    <p class="text-sub small m-0">ألعاب تعليمية وترفيهية</p>
                                </div>
                            </a>
                        </div>

                        <!-- Category 4 -->
                        <div class="col">
                            <a href="{{ route('cat.index') }}" class="text-decoration-none">
                                <div class="cat-thumb">
                                    <div class="cat-bg"
                                        style="background-image:url('https://lh3.googleusercontent.com/aida-public/AB6AXuAlFMULmsyjE0bcJp8izOqbqgXEHQP3_YJSw9hyVToXC_MJTD1LLhCS00IKCUYXBxgvqNC1SJ1Ity8IFLcOsYVh64ETntYiu0aIV5RNb7XaSsE9v4jt0FTmeg0gtYglZYVleGiTVZX-SrbDHWitif3P6wqGeU6j89WjGw6zfKMxgYYpc8G7GyAZ9PNyZ1x8k15Qm9_GPyMBkqEUb9jPb7pfKmKp5qlSLZ0kr8xWijuf71e5WYqR-nP5iFLOFPXoe6EoyqkOBIQgYJE');">
                                    </div>
                                    <div class="cat-overlay"></div>
                                    <div class="cat-icon">
                                        <span class="material-symbols-outlined">favorite</span>
                                    </div>
                                </div>
                                <div class="text-end mt-3">
                                    <h3 class="fs-5 fw-bold mb-1" style="color:inherit;">هدايا الأمهات</h3>
                                    <p class="text-sub small m-0">أدوات منزلية وعناية</p>
                                </div>
                            </a>
                        </div>

                        <!-- Category 5 -->
                        <div class="col">
                            <a href="{{ route('cat.index') }}" class="text-decoration-none">
                                <div class="cat-thumb">
                                    <div class="cat-bg"
                                        style="background-image:url('https://lh3.googleusercontent.com/aida-public/AB6AXuDPrkHw8sDeRYj92VvTXX5u9GBe8HO0H-kXMRglbicLUj5hUAp9Da3JM8paGsyB5k39ds6dCZmjeiKiQMT9mcjkXvuHTzZtC12ZGkEInAVaCc0ikiOYm9x75sfPaJX3K3yfO5v_nxXm0chwm01gcyV1QCMJyxGpxxbbk3dIHXSWgT5b2wMS3sE0hix11MAjL9b58InqXeLlaJKcJlF_atB0dSq_oON4EgSPd0E6wWfpphweedllVw1saL-LlscLOdwiW82r8oPnT6g');">
                                    </div>
                                    <div class="cat-overlay"></div>
                                    <div class="cat-icon">
                                        <span class="material-symbols-outlined">coffee</span>
                                    </div>
                                </div>
                                <div class="text-end mt-3">
                                    <h3 class="fs-5 fw-bold mb-1" style="color:inherit;">هدايا الآباء</h3>
                                    <p class="text-sub small m-0">مستلزمات شخصية</p>
                                </div>
                            </a>
                        </div>

                    </div>
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
                                    <h3 class="m-0 fw-bold">هل تبحث عن هدية محددة؟</h3>
                                    <p class="m-0 text-sub fw-semibold">تواصل معنا لإضافة منتج غير موجود بالمتجر</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-auto">
                                <button class="btn rounded-pill fw-bold px-4 py-2"
                                    style="border:1px solid rgba(238,43,91,.30); color:var(--primary); background: rgba(255,255,255,.60);">
                                    <span class="material-symbols-outlined align-middle me-1"
                                        style="font-size:20px;">chat</span>
                                    تواصل معنا
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
                        <h2 class="m-0 fw-black" style="font-weight:900;">باقات مختارة لك</h2>
                        <a href="#" class="fw-bold text-decoration-none" style="color:var(--primary);">عرض
                            الكل</a>
                    </div>

                    <div class="d-flex gap-3 hide-scrollbar pb-3">

                        <!-- Product 1 -->
                        <div class="p-card p-3">
                            <div class="p-img">
                                <div class="p-img-bg"
                                    style="background-image:url('https://lh3.googleusercontent.com/aida-public/AB6AXuDR3OgXIS-x1qzXZlK_g0vVASlZzm2YdcTojCqd7bQrXtZcKJKGmPAMSkferwQLxrXTm3pdq9d8XHvZWngR_8TNwwhBJSdSy02wfG7Zge2acx5mYIiITX-aThBBD7LsYc2zk9bWuh17ot0X5_ZeRTChLxVLCY8xfR7CwAs6gLKqnxkls3yD7MGT2QCw7bS4ANHSHXTjvlHQTvmTNtTWhj-0ROoDYmhNeZBPbiRl5k5vRgfNTUxa9thw1IpH3fXvUa2UFkshxOfEcIU');">
                                </div>
                                <div class="tag">جديد</div>
                            </div>

                            <div class="mt-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <h3 class="fs-5 fw-bold m-0">باقة السعادة</h3>
                                    <div class="fw-bold" style="color:var(--primary);">250 ر.س</div>
                                </div>
                                <p class="text-sub small mt-2 mb-3">تشكيلة مميزة من الشوكولاتة الفاخرة مع باقة ورد
                                    صغيرة.</p>
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
                                    <h3 class="fs-5 fw-bold m-0">صندوق المفاجآت</h3>
                                    <div class="fw-bold" style="color:var(--primary);">300 ر.س</div>
                                </div>
                                <p class="text-sub small mt-2 mb-3">صندوق غامض يحتوي على 5 منتجات مختارة بعناية لتفاجئ
                                    من تحب.</p>
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
                                <div class="tag primary">الأكثر مبيعاً</div>
                            </div>

                            <div class="mt-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <h3 class="fs-5 fw-bold m-0">هدية الفخامة</h3>
                                    <div class="fw-bold" style="color:var(--primary);">500 ر.س</div>
                                </div>
                                <p class="text-sub small mt-2 mb-3">طقم عطور فاخر مع ساعة كلاسيكية أنيقة.</p>
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
                                    <h3 class="fs-5 fw-bold m-0">باقة الورود</h3>
                                    <div class="fw-bold" style="color:var(--primary);">150 ر.س</div>
                                </div>
                                <p class="text-sub small mt-2 mb-3">باقة من الورود الطبيعية الطازجة بتنسيق احترافي.</p>
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
                        <h2 class="fw-black mb-2" style="font-weight:900;">لماذا تختارنا؟</h2>
                        <p class="text-sub mx-auto" style="max-width:720px;">
                            نحن نؤمن بأن الهدية ليست مجرد غرض، بل هي تعبير عن مشاعر صادقة. لذلك نهتم بكل التفاصيل.
                        </p>
                    </div>

                    <div class="row g-4">
                        <div class="col-12 col-md-4">
                            <div class="h-100 text-center p-4 rounded-4 border gc-border" style="background:#fff;">
                                <div class="mx-auto mb-3 icon-pill" style="width:64px;height:64px;">
                                    <span class="material-symbols-outlined fs-2">local_shipping</span>
                                </div>
                                <h3 class="fs-4 fw-bold mb-2">توصيل سريع</h3>
                                <p class="text-sub small m-0">نصلك أينما كنت وفي الوقت المحدد، سواء كان توصيل فوري أو
                                    مجدول لمناسبة خاصة.</p>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="h-100 text-center p-4 rounded-4 border gc-border" style="background:#fff;">
                                <div class="mx-auto mb-3 icon-pill" style="width:64px;height:64px;">
                                    <span class="material-symbols-outlined fs-2">redeem</span>
                                </div>
                                <h3 class="fs-4 fw-bold mb-2">تغليف فاخر</h3>
                                <p class="text-sub small m-0">نستخدم أجود أنواع الورق والشرائط والاكسسوارات لنجعل هديتك
                                    تبدو كتحفة فنية.</p>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="h-100 text-center p-4 rounded-4 border gc-border" style="background:#fff;">
                                <div class="mx-auto mb-3 icon-pill" style="width:64px;height:64px;">
                                    <span class="material-symbols-outlined fs-2">verified_user</span>
                                </div>
                                <h3 class="fs-4 fw-bold mb-2">دفع آمن</h3>
                                <p class="text-sub small m-0">نوفر طرق دفع متعددة ومحمية بالكامل، بما في ذلك أبل باي
                                    ومدى والبطاقات الائتمانية.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

@endsection
