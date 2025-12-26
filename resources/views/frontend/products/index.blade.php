@extends('layouts.master')













@section('content')
    <div class="container-fluid py-4" style="max-width:1440px;">
    <!-- Main -->
        <div class="container-fluid py-4 py-md-5" style="max-width:1440px;">

            <!-- Breadcrumb -->
            <div class="d-flex flex-wrap align-items-center gap-2 mb-4 fw-semibold small">
                <a class="text-decoration-none text-muted-custom" href="#">الرئيسية</a>
                <span class="material-symbols-outlined text-muted-custom" style="font-size:18px;">chevron_left</span>
                <a class="text-decoration-none text-muted-custom" href="#">هدايا نسائية</a>
                <span class="material-symbols-outlined text-muted-custom" style="font-size:18px;">chevron_left</span>
                <span class="fw-bold">مجموعة العناية الفاخرة</span>
            </div>

            <div class="row g-4 g-lg-5">
                <!-- Gallery -->
                <div class="col-12 col-lg-7">
                    <div class="d-flex flex-column gap-3">
                        <div class="hero-media rounded-2xl">
                            <div class="badge-float">الأكثر مبيعاً</div>
                            <div class="hero-bg"
                                style="background-image:url('https://lh3.googleusercontent.com/aida-public/AB6AXuCx8IUxsvrReaxxeSeR1X5gzqTCzfxs1PN3wqrT4d3mZYyiTeV0IWEP0oeZFDJKSQqKIgbYksyZnuKsMvQ9StkngeRCzZ4lvw9WGm4wwchwedDxspzoxa3chWMoM0E1eONp3osbsKBYUhmicN2NQRXYLsVzUGhJjK9zufUb4O3TULAYQqzNnG0GdeK7j_R89s1sqMFtEFe9P8JR4t2JYlurKbnz8aZkBH4sfxCdfCM3hzjIoEhPSitrbH79f1jEShnSgvJ8fZeLVOc');">
                            </div>
                        </div>

                        <!-- thumbs -->
                        <div class="row g-3 g-md-4 row-cols-4">
                            <div class="col">
                                <button class="thumb-btn active w-100">
                                    <div class="thumb-bg"
                                        style="background-image:url('https://lh3.googleusercontent.com/aida-public/AB6AXuDvrJyqugyy2SEdp3-DTvw5QfkOcABvGa7HPE8D4jJAMulQP0PF55sDZgogTCtW6AwUnRa-FRNPFQF6t9GaziuehXU5I099DBVuMkVv9m8Q52M7ihb-h9DHd90GRizg-cdBh3Jkz3tiMEalaN48fH4G67hW5PuPz_b0ZUgqifdTIC5BdV-lYhVMPkW3Ev1zSTLrA6YnFOQrdwwRqwahdg-ZizMSOHtG0ROy1fuCymnmNyEbAYNjhlbfFku7T3nYJ7FBRY63diu6ME8');">
                                    </div>
                                </button>
                            </div>
                            <div class="col">
                                <button class="thumb-btn w-100">
                                    <div class="thumb-bg"
                                        style="background-image:url('https://lh3.googleusercontent.com/aida-public/AB6AXuDab0cqLlO4h28SvsiiAuI0xEzAlbDfZxixySkfSkX--6VHhoFjYWjKhI8EkoPhCOtVYXv-Z4otjyrSgX_OMK7XPrPwKrlntiuJbg2bqiYjWmDBSimlkO4VEocdqf8NRENBwblskkB5inm2s7HTWg9mnaOOWajUjCcEDRH2juAFmxn4_fu7EgSBgYAYRHv-D3RBxiRbmR5qmLMYDehaqHa_NGIy8gOhLjViGGB8UuZk2dsJMoH0Lvz2bv30FIm6JFS1EgLRyMRlhZI');">
                                    </div>
                                </button>
                            </div>
                            <div class="col">
                                <button class="thumb-btn w-100">
                                    <div class="thumb-bg"
                                        style="background-image:url('https://lh3.googleusercontent.com/aida-public/AB6AXuBI_18d6pJ0QcV5SsxYAQFcfLtuiVWypugR2GkHmT5bWg1KcEKiXZoFsFsAu_7Zr2tkNMUxXu2afXq91SQcmhQ6PqN1JWkgqlXG1LdVqMF5lup1jTgAnPp1M62BFmodTJ9J5E_hbjVMty4nYxcaKdh08VyzA9CcfN1IUswB0cobjItmFx_oKv-OdIlQOf-4-GUsyW30yx22OLgXx_ao5_I7i9SFBFrxpl5n5dZ3GUkLRouh7dcxAWLlrCEUp-4-ZeYr6pUweyI0ozg');">
                                    </div>
                                </button>
                            </div>
                            <div class="col">
                                <button class="thumb-btn w-100">
                                    <div class="thumb-bg"
                                        style="background-image:url('https://lh3.googleusercontent.com/aida-public/AB6AXuDUs2UFHzohIQ997FC05-w3ERJ01SDrSLf4bG1nz9G5--eD_FKtP6j0XxazH1m2I7sVClELVqswK7Abv5YMarjFs6j1NYfMBobDQY9YRgTavYf9xPozteFvv7PbfawTiFXvBSKAvGfDmYwg6lHklycKlDCzWXbyT05wJWYApoBxWuuXZonmFZNPDeQsfDo32nHQIgkXrGLxat5fIjZgEuaAD2A1yBGd7ZuW-aw0RTxrbAhuWWPPBYdv8_t7eZol57A9BWldMbmRsic');">
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right / Details -->
                <div class="col-12 col-lg-5">
                    <div class="sticky-card d-flex flex-column gap-4">

                        <div class="divider-soft pb-4">
                            <div class="d-flex align-items-start justify-content-between gap-2 mb-2">
                                <h1 class="m-0 fw-extrabold"
                                    style="font-weight:900; font-size:clamp(1.75rem,2.6vw,2.4rem);">
                                    مجموعة العناية الفاخرة
                                </h1>
                                <button class="btn p-1 text-muted-custom" type="button" aria-label="Favorite">
                                    <span class="material-symbols-outlined" style="font-size:28px;">favorite</span>
                                </button>
                            </div>

                            <div class="d-flex align-items-center gap-2 mb-3">
                                <div class="stars d-flex">
                                    <span class="material-symbols-outlined" style="font-size:20px;">star</span>
                                    <span class="material-symbols-outlined" style="font-size:20px;">star</span>
                                    <span class="material-symbols-outlined" style="font-size:20px;">star</span>
                                    <span class="material-symbols-outlined" style="font-size:20px;">star</span>
                                    <span class="material-symbols-outlined" style="font-size:20px;">star_half</span>
                                </div>
                                <span class="small text-muted-custom fw-semibold">(٤٥ تقييم)</span>
                            </div>

                            <div class="fw-bold text-primary-custom" style="font-size:1.9rem; letter-spacing:-.02em;">
                                ٢٥٠ ر.س
                            </div>
                        </div>

                        <p class="mb-0" style="color: rgba(27,13,17,.80); line-height:1.9;">
                            هدية مثالية للأحباب، تحتوي على تشكيلة فاخرة من منتجات العناية الشخصية المختارة بعناية لتناسب
                            جميع الأذواق.
                            تأتي مغلفة بعناية فائقة لتصنع لحظة لا تنسى.
                        </p>
                        <style>
                            html[data-bs-theme="dark"] .sticky-card p {
                                color: rgba(255, 255, 255, .78) !important;
                            }
                        </style>

                        <div class="surface-box rounded-2xl p-3">
                            <h3 class="fw-bold mb-3" style="font-size:.95rem;">محتويات المجموعة:</h3>
                            <ul class="list-unstyled m-0 vstack gap-2">
                                <li class="d-flex align-items-center gap-2" style="color: rgba(27,13,17,.80);">
                                    <span class="material-symbols-outlined text-primary-custom"
                                        style="font-size:18px;">check_circle</span>
                                    <span class="small fw-semibold">عطر زهري مركز (٥٠ مل)</span>
                                </li>
                                <li class="d-flex align-items-center gap-2" style="color: rgba(27,13,17,.80);">
                                    <span class="material-symbols-outlined text-primary-custom"
                                        style="font-size:18px;">check_circle</span>
                                    <span class="small fw-semibold">لوشن للجسم برائحة المسك</span>
                                </li>
                                <li class="d-flex align-items-center gap-2" style="color: rgba(27,13,17,.80);">
                                    <span class="material-symbols-outlined text-primary-custom"
                                        style="font-size:18px;">check_circle</span>
                                    <span class="small fw-semibold">شمعة معطرة فاخرة</span>
                                </li>
                            </ul>
                            <style>
                                html[data-bs-theme="dark"] .surface-box li {
                                    color: rgba(255, 255, 255, .78) !important;
                                }
                            </style>
                        </div>

                        <div class="pt-1">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <span class="small fw-bold">الكمية:</span>
                                <div class="qty-pill">
                                    <button class="qty-btn" type="button">
                                        <span class="material-symbols-outlined" style="font-size:18px;">add</span>
                                    </button>
                                    <input class="qty-input" value="١" readonly />
                                    <button class="qty-btn" type="button">
                                        <span class="material-symbols-outlined" style="font-size:18px;">remove</span>
                                    </button>
                                </div>
                            </div>

                            <button
                                class="btn btn-outline-primary w-100 rounded-pill fw-bold py-3 d-flex align-items-center justify-content-center gap-2">
                                <span class="material-symbols-outlined">add_box</span>
                                <span>إضافة إلى البوكس</span>
                            </button>

                            <button
                                class="btn btn-primary w-100 rounded-pill fw-bold py-3 mt-3 d-flex align-items-center justify-content-center gap-2"
                                style="box-shadow: 0 14px 30px rgba(238,43,91,.25);">
                                <span>انتقل لاختيار التغليف</span>
                                <span class="material-symbols-outlined">arrow_right_alt</span>
                            </button>

                            <p class="text-center small text-muted-custom mt-2 mb-0">
                                شحن مجاني للطلبات فوق ٣٠٠ ر.س
                            </p>
                        </div>

                        <div class="mini-acc accordion" id="miniAccordion">
                            <div class="accordion-item mb-2">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#ship" aria-expanded="false"
                                        aria-controls="ship">
                                        تفاصيل الشحن والتوصيل
                                    </button>
                                </h2>
                                <div id="ship" class="accordion-collapse collapse"
                                    data-bs-parent="#miniAccordion">
                                    <div class="accordion-body small text-muted-custom">
                                        توصيل داخل المدن خلال 24-48 ساعة، وخارج المدن خلال 2-4 أيام عمل (حسب شركة
                                        الشحن).
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#return" aria-expanded="false"
                                        aria-controls="return">
                                        سياسة الاسترجاع
                                    </button>
                                </h2>
                                <div id="return" class="accordion-collapse collapse"
                                    data-bs-parent="#miniAccordion">
                                    <div class="accordion-body small text-muted-custom">
                                        يمكن الاسترجاع خلال 7 أيام بشرط سلامة المنتج وعدم فتح التغليف.
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Related -->
            <div class="mt-5 mt-md-6" style="margin-top: 5rem;">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h2 class="fw-extrabold m-0" style="font-weight:900; font-size:clamp(1.4rem,2vw,2rem);">
                        قد يعجبك أيضاً
                    </h2>
                    <a class="text-decoration-none fw-bold d-inline-flex align-items-center gap-2"
                        style="color:var(--primary);" href="#">
                        عرض الكل
                        <span class="material-symbols-outlined" style="font-size:18px;">arrow_right_alt</span>
                    </a>
                </div>

                <div class="row g-3 g-md-4 row-cols-2 row-cols-md-4">
                    <!-- 1 -->
                    <div class="col">
                        <div class="rel-card">
                            <div class="rel-media mb-3">
                                <div class="rel-bg"
                                    style="background-image:url('https://lh3.googleusercontent.com/aida-public/AB6AXuBCowioC5zPh3R4wu9F5EfVa9Ws9CwdMO1cAVVhBXVJWSvCQAMFV8pHnQfRb6pqxA_DOhhY6EDajMxAW7rWwdWAVakNOKHCq_U12kwnP0zFF-p7_hyZtZ2IoJpbosN2pyK8HtEPmHMsGRRqkGEdQ-FtU5AuJrqYFrb5FFuwtgC8aT5PG00qxTXIXMAgsY9mowSxjKdg3u9lD4XeH1_Kz84SfRF1XR5R1-B6NOsILcyJmsZvK1Z22UYRiAsZfOoITiEIZOJ3SZ5hFw8');">
                                </div>
                                <button class="bag-btn" type="button">
                                    <span class="material-symbols-outlined">shopping_bag</span>
                                </button>
                            </div>
                            <h3 class="fw-bold m-0">باقة الزهور الربيعية</h3>
                            <p class="text-muted-custom fw-semibold mt-1 mb-0">١٨٠ ر.س</p>
                        </div>
                    </div>
                    <!-- 2 -->
                    <div class="col">
                        <div class="rel-card">
                            <div class="rel-media mb-3">
                                <div class="rel-bg"
                                    style="background-image:url('https://lh3.googleusercontent.com/aida-public/AB6AXuC0gnZwSV0cLj8V95Qksb3y7ursla8vIZA-euHmiWtSw1VFZw7dqyVIxaWL6tcBNWzTqXlrnoH8eunDuSwU7IEB3_gjTLJ6dSK9Mywxig6ZIvOTxQkQsOGZw0d3FwBR2ynK6OwxIgWeMXAWmss3bU4_cpCKTnTuTUCYegSgVUMBle5FsAKxS8RF1HD7inHxn-M_TkBp39pmBjrh8rUmB5zZjONO_235hZC-CRs_XmiH0qHhJMe-aQRJ5rKy1lY_8TOGEBT_al7ClQI');">
                                </div>
                                <button class="bag-btn" type="button">
                                    <span class="material-symbols-outlined">shopping_bag</span>
                                </button>
                            </div>
                            <h3 class="fw-bold m-0">صندوق الشوكولاتة الفاخر</h3>
                            <p class="text-muted-custom fw-semibold mt-1 mb-0">١٢٠ ر.س</p>
                        </div>
                    </div>
                    <!-- 3 -->
                    <div class="col">
                        <div class="rel-card">
                            <div class="rel-media mb-3">
                                <div class="badge text-bg-primary position-absolute"
                                    style="top:12px; right:12px; font-size:10px; border-radius:999px; padding:.25rem .5rem; z-index:2;">
                                    جديد</div>
                                <div class="rel-bg"
                                    style="background-image:url('https://lh3.googleusercontent.com/aida-public/AB6AXuDpNxAAdcOkr-EOc_qYEGb9vZP1Sx7fduks32W6MHNl6eWex4vXg_6eQ9HWaksE2rMsxsXlnKQ52D3AIjBuCFsghjvbJ3abOs1uDaGZM44iUgahZjHU3q1CmacDxCI8GDs0pXUkoT-x6rVPCL4XPdQ0IYa5Q5UU0M_p31ZKEcq-IUoI2AGfHEi2-PJ2-CcW7PTW7zUGC8k25j1OKXryIxKcaAE3r2X4sHHDvafl4PWzj0l8PNKfdntTaJjaad-phiPZQvDjduw3dQE');">
                                </div>
                                <button class="bag-btn" type="button">
                                    <span class="material-symbols-outlined">shopping_bag</span>
                                </button>
                            </div>
                            <h3 class="fw-bold m-0">قلادة ذهبية ناعمة</h3>
                            <p class="text-muted-custom fw-semibold mt-1 mb-0">٤٥٠ ر.س</p>
                        </div>
                    </div>
                    <!-- 4 -->
                    <div class="col">
                        <div class="rel-card">
                            <div class="rel-media mb-3">
                                <div class="rel-bg"
                                    style="background-image:url('https://lh3.googleusercontent.com/aida-public/AB6AXuAOKo2F7DXEyh6L7blBWnZkRhZhWWRcmT24l-d7spNq3g9cxvCkNSARpC-ND5O9ZWq_INhLakmIXQ2Rhvlxn2l4e5s9tI5ZkiOQIHSUXyW9PTgIMMNOIRVvE2zDJ3FimForTElTay5qPmF4JinnwF9rmTUC9tHK6MU8SrdXt_3TQ8yaHJQAtu3TXL36-AmqO73S7twbBECIEazJ8cd_sWdrd8B6e3CUkULSmf2naG6kGUs_OpZqlNK9z4Gwa4KUf30cu07KQnUOjvg');">
                                </div>
                                <button class="bag-btn" type="button">
                                    <span class="material-symbols-outlined">shopping_bag</span>
                                </button>
                            </div>
                            <h3 class="fw-bold m-0">مجموعة الشموع العطرية</h3>
                            <p class="text-muted-custom fw-semibold mt-1 mb-0">٩٥ ر.س</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
@endsection
