@extends('frontend.layouts.master')
@section('content')
    <div class="container-fluid py-4" style="max-width:1440px;">
        <div class="container-fluid py-4 py-md-5" style="max-width:1440px;">

            <div class="d-flex flex-wrap align-items-center gap-2 mb-4 fw-semibold small">
                <a class="text-decoration-none text-muted-custom" href="{{ route('home') }}">الرئيسية</a>
                <span class="material-symbols-outlined text-muted-custom" style="font-size:18px;">chevron_left</span>
                <a class="text-decoration-none text-muted-custom" href="{{ route('products.index') }}">المنتجات</a>
                @if ($product->category)
                    <span class="material-symbols-outlined text-muted-custom" style="font-size:18px;">chevron_left</span>
                    <span class="fw-bold">{{ $product->category->name }}</span>
                @endif
                <span class="material-symbols-outlined text-muted-custom" style="font-size:18px;">chevron_left</span>
                <span class="fw-bold">{{ $product->name }}</span>
            </div>

            <div class="row g-4 g-lg-5">
                <div class="col-12 col-lg-7">
                    @php
                        $images = $product->images;
                        $primary = $images->first();
                        $hero = $primary ? asset('storage/' . ltrim($primary->path, '/')) : 'https://via.placeholder.com/900x700/eee/aaa?text=No+Image';
                    @endphp
                    <div class="d-flex flex-column gap-3">
                        <div class="hero-media rounded-2xl" id="heroMedia" data-active="{{ $hero }}">
                            <div class="badge-float">{{ $product->category->name ?? 'منتج' }}</div>
                            <div class="hero-bg" id="heroBg" style="background-image:url('{{ $hero }}');"></div>
                        </div>

                        <div class="row g-3 g-md-4 row-cols-4" id="thumbGrid">
                            @forelse ($images->take(8) as $image)
                                @php
                                    $thumbUrl = asset('storage/' . ltrim($image->path, '/'));
                                @endphp
                                <div class="col">
                                    <button class="thumb-btn w-100 {{ $loop->first ? 'active' : '' }}" type="button"
                                        data-bg="{{ $thumbUrl }}">
                                        <div class="thumb-bg" style="background-image:url('{{ $thumbUrl }}');"></div>
                                    </button>
                                </div>
                            @empty
                                <div class="text-secondary-custom small">لا توجد صور إضافية.</div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-5">
                    <div class="sticky-card d-flex flex-column gap-4">
                        <div class="divider-soft pb-4">
                            <div class="d-flex align-items-start justify-content-between gap-2 mb-2">
                                <h1 class="m-0 fw-extrabold" style="font-weight:900; font-size:clamp(1.75rem,2.6vw,2.4rem);">
                                    {{ $product->name }}
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
                                <span class="small text-muted-custom fw-semibold">(تقييم افتراضي)</span>
                            </div>

                            <div class="fw-bold text-primary-custom" style="font-size:1.9rem; letter-spacing:-.02em;">
                                {{ number_format($product->price, 2) }} ر.س
                            </div>
                        </div>

                        <p class="mb-0" style="color: rgba(27,13,17,.80); line-height:1.9;">
                            {{ $product->description ?? 'لا يوجد وصف للمنتج حالياً.' }}
                        </p>
                        <style>
                            html[data-bs-theme="dark"] .sticky-card p {
                                color: rgba(255, 255, 255, .78) !important;
                            }
                        </style>

                        <div class="surface-box rounded-2xl p-3">
                            <h3 class="fw-bold mb-3" style="font-size:.95rem;">تفاصيل المنتج:</h3>
                            <ul class="list-unstyled m-0 vstack gap-2">
                                <li class="d-flex align-items-center gap-2" style="color: rgba(27,13,17,.80);">
                                    <span class="material-symbols-outlined text-primary-custom" style="font-size:18px;">check_circle</span>
                                    <span class="small fw-semibold">القسم: {{ $product->category->name ?? 'غير مصنف' }}</span>
                                </li>
                                <li class="d-flex align-items-center gap-2" style="color: rgba(27,13,17,.80);">
                                    <span class="material-symbols-outlined text-primary-custom" style="font-size:18px;">check_circle</span>
                                    <span class="small fw-semibold">المخزون: {{ $product->stock }}</span>
                                </li>
                                <li class="d-flex align-items-center gap-2" style="color: rgba(27,13,17,.80);">
                                    <span class="material-symbols-outlined text-primary-custom" style="font-size:18px;">check_circle</span>
                                    <span class="small fw-semibold">الحالة: {{ $product->is_published ? 'منشور' : 'مسودة' }}</span>
                                </li>
                            </ul>
                        </div>

                        <div class="pt-1">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <span class="small fw-bold">الكمية:</span>
                                <div class="qty-pill">
                                    <button class="qty-btn" type="button">
                                        <span class="material-symbols-outlined" style="font-size:18px;">add</span>
                                    </button>
                                    <input class="qty-input" value="1" readonly />
                                    <button class="qty-btn" type="button">
                                        <span class="material-symbols-outlined" style="font-size:18px;">remove</span>
                                    </button>
                                </div>
                            </div>

                            <button class="btn btn-outline-primary w-100 rounded-pill fw-bold py-3 d-flex align-items-center justify-content-center gap-2">
                                <span class="material-symbols-outlined">add_box</span>
                                <span>أضف إلى السلة</span>
                            </button>

                            <a href="{{ route('gifts.index', $product) }}" class="btn btn-primary w-100 rounded-pill fw-bold py-3 mt-3 d-flex align-items-center justify-content-center gap-2" style="box-shadow: 0 14px 30px rgba(238,43,91,.25);">
                                <span>انتقل لأختيار التغليف</span>
                                <span class="material-symbols-outlined">arrow_right_alt</span>
                            </a>

                            <p class="text-center small text-muted-custom mt-2 mb-0">
                                الدفع الآمن متوفر عبر كل وسائل الدفع المدعومة لدينا
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            @if ($related->count())
                <div class="mt-5 mt-md-6" style="margin-top: 5rem;">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h2 class="fw-extrabold m-0" style="font-weight:900; font-size:clamp(1.4rem,2vw,2rem);">
                            منتجات مشابهة قد تعجبك</h2>
                        <a class="text-decoration-none fw-bold d-inline-flex align-items-center gap-2" style="color:var(--primary);" href="{{ route('products.index') }}">
                            عرض الكل
                            <span class="material-symbols-outlined" style="font-size:18px;">arrow_right_alt</span>
                        </a>
                    </div>

                    <div class="row g-3 g-md-4 row-cols-2 row-cols-md-4">
                        @foreach ($related as $item)
                            @php
                                $img = $item->primary_image;
                                $relUrl = $img ? asset('storage/' . ltrim($img->path, '/')) : 'https://via.placeholder.com/300x300/eee/aaa?text=No+Image';
                            @endphp
                            <div class="col">
                                <a href="{{ route('products.show', $item) }}" class="text-decoration-none text-reset">
                                    <div class="rel-card h-100 d-flex flex-column">
                                        <div class="rel-media mb-3">
                                            <div class="rel-bg" style="background-image:url('{{ $relUrl }}');"></div>
                                            <button class="bag-btn" type="button">
                                                <span class="material-symbols-outlined">shopping_bag</span>
                                            </button>
                                        </div>
                                        <h3 class="fw-bold m-0">{{ $item->name }}</h3>
                                        <p class="text-muted-custom fw-semibold mt-1 mb-0">{{ number_format($item->price, 2) }} ر.س </p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const heroBg = document.getElementById('heroBg');
            const buttons = document.querySelectorAll('#thumbGrid .thumb-btn');

            buttons.forEach((btn) => {
                btn.addEventListener('click', () => {
                    const bg = btn.dataset.bg;
                    if (bg) {
                        heroBg.style.backgroundImage = `url('${bg}')`;
                    }
                    buttons.forEach((b) => b.classList.remove('active'));
                    btn.classList.add('active');
                });
            });
        });
    </script>
@endsection
