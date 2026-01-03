@extends('frontend.layouts.master')

@section('content')
    @php
        // لو $products Pagination استخدم total() بدل count()
        $totalProducts = method_exists($products, 'total') ? $products->total() : $products->count();

        // قراءة الفلاتر من Query String
        $selectedPrices = (array) request()->input('price', []);
        $selectedOccasions = (array) request()->input('occasion', []);
        $selectedTypes = (array) request()->input('type', []);
        $sort = request()->input('sort', 'relevance');

        // خيارات ثابتة (تقدر تخليها ديناميكية من DB بعدين)
        $priceOptions = [
            'under-100' => 'أقل من ١٠٠ ر.س',
            '100-300' => '١٠٠ - ٣٠٠ ر.س',
            '300-500' => '٣٠٠ - ٥٠٠ ر.س',
            'over-500' => 'أكثر من ٥٠٠ ر.س',
        ];

        $occasionOptions = [
            'birthday' => 'أعياد الميلاد',
            'anniversary' => 'ذكرى زواج',
            'graduation' => 'تخرج',
            'newborn' => 'مولود جديد',
        ];

        $typeOptions = [
            'chocolate' => 'شوكولاتة',
            'perfume' => 'عطور',
            'teddy' => 'دمى',
            'watch' => 'ساعات',
        ];

        // عشان نعرض Chips بشكل لطيف
        $chipLabels = [];
        foreach ($selectedPrices as $v) {
            if (isset($priceOptions[$v])) {
                $chipLabels[] = ['key' => 'price', 'val' => $v, 'label' => $priceOptions[$v]];
            }
        }
        foreach ($selectedOccasions as $v) {
            if (isset($occasionOptions[$v])) {
                $chipLabels[] = ['key' => 'occasion', 'val' => $v, 'label' => $occasionOptions[$v]];
            }
        }
        foreach ($selectedTypes as $v) {
            if (isset($typeOptions[$v])) {
                $chipLabels[] = ['key' => 'type', 'val' => $v, 'label' => $typeOptions[$v]];
            }
        }

        // مساعد: يبني لينك يشيل Chip واحد
        $removeFilterUrl = function ($key, $val) {
            $q = request()->query();
            $arr = (array) data_get($q, $key, []);
            $arr = array_values(array_filter($arr, fn($x) => $x !== $val));
            if (count($arr)) {
                $q[$key] = $arr;
            } else {
                unset($q[$key]);
            }
            return url()->current() . '?' . http_build_query($q);
        };

        // مساعد: لينك مسح كل الفلاتر
        $clearAllUrl = url()->current();
    @endphp

    <style>
        :root {
            --primary: #ee2b5b;
            --primary-soft: #f3e7ea;
            --text-secondary: #9a4c5f;
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, .04);
            --shadow-hover: 0 8px 24px rgba(238, 43, 91, .12);
        }

        .text-secondary-2 {
            color: var(--text-secondary) !important;
        }

        .pill {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            height: 32px;
            padding: 0 12px;
            border-radius: 999px;
            background: rgba(238, 43, 91, .10);
            color: var(--primary);
            font-weight: 800;
            font-size: .9rem;
            text-decoration: none;
            transition: .2s ease;
        }

        .pill:hover {
            background: rgba(238, 43, 91, .16);
            color: var(--primary);
        }

        .sidebar-card {
            border-radius: 1.5rem;
            background: #fff;
            border: 1px solid #f1f5f9;
            box-shadow: 0 1px 2px rgba(0, 0, 0, .04);
        }

        .sidebar-section {
            border-top: 1px solid #f1f5f9;
            padding: 1rem 0;
        }

        .card-product {
            border-radius: 1rem;
            overflow: hidden;
            border: 1px solid transparent;
            box-shadow: var(--shadow-sm);
            transition: .3s ease;
            background: #fff;
        }

        .card-product:hover {
            border-color: rgba(238, 43, 91, .20);
            box-shadow: var(--shadow-hover);
            transform: translateY(-2px);
        }

        .product-media {
            position: relative;
            height: 180px;
            background: #f3f4f6;
            overflow: hidden;
            border-radius: 1rem;
        }

        .product-img {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            transition: transform .7s ease;
        }

        .card-product:hover .product-img {
            transform: scale(1.05);
        }

        .btn-choose {
            height: 40px;
            border-radius: 999px;
            font-weight: 900;
            background: var(--primary);
            border-color: var(--primary);
            color: #fff;
        }

        .btn-choose:hover {
            background: rgba(238, 43, 91, .9);
            border-color: rgba(238, 43, 91, .9);
            color: #fff;
        }
    </style>

    <div class="container-fluid py-5" style="max-width:1280px;">

        <!-- Heading -->
        <div class="d-flex flex-column flex-md-row align-items-md-end justify-content-between gap-3 mb-4">
            <div class="text-end">
                <h1 class="fw-bolder m-0" style="font-weight:900;">{{ $category->name }}</h1>
                <p class="text-secondary-2 fs-5 m-0">عدد المنتجات: {{ $totalProducts }}</p>
            </div>

            <!-- Sort -->
            <form method="GET" class="dropdown">
                @foreach (request()->except('sort') as $k => $v)
                    @if (is_array($v))
                        @foreach ($v as $vv)
                            <input type="hidden" name="{{ $k }}[]" value="{{ $vv }}">
                        @endforeach
                    @else
                        <input type="hidden" name="{{ $k }}" value="{{ $v }}">
                    @endif
                @endforeach

                <button class="btn bg-white d-inline-flex align-items-center gap-2 shadow-sm"
                    style="border-radius:999px;height:40px;border:1px solid #e5e7eb;" data-bs-toggle="dropdown"
                    type="button">
                    <span class="material-symbols-outlined" style="font-size:20px;">sort</span>
                    <span class="fw-medium">ترتيب حسب</span>
                    <span class="material-symbols-outlined" style="font-size:20px;">expand_more</span>
                </button>

                <ul class="dropdown-menu text-end">
                    <li><button class="dropdown-item" name="sort" value="relevance">الأكثر ملاءمة</button></li>
                    <li><button class="dropdown-item" name="sort" value="price_asc">الأقل سعراً</button></li>
                    <li><button class="dropdown-item" name="sort" value="price_desc">الأعلى سعراً</button></li>
                    <li><button class="dropdown-item" name="sort" value="latest">الأحدث</button></li>
                </ul>
            </form>
        </div>

        <div class="row g-4">
            <!-- Sidebar Filters -->
            <aside class="col-12 col-lg-3">

                <!-- Mobile Filter Button -->
                <button class="btn w-100 d-lg-none bg-white shadow-sm d-flex align-items-center justify-content-between"
                    style="border-radius:1rem;border:1px solid #e5e7eb;" data-bs-toggle="offcanvas"
                    data-bs-target="#filtersOffcanvas">
                    <span class="fw-bold d-inline-flex align-items-center gap-2">
                        <span class="material-symbols-outlined">filter_list</span> تصفية النتائج
                    </span>
                    <span class="material-symbols-outlined">expand_more</span>
                </button>

                <!-- Desktop Filters -->
                <div class="sidebar-card p-4 d-none d-lg-block">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h3 class="h5 fw-bold mb-0">تصفية النتائج</h3>
                        <a class="btn btn-link p-0 fw-bold text-decoration-none"
                            style="color:var(--primary);font-size:.8rem;" href="{{ $clearAllUrl }}">
                            مسح الكل
                        </a>
                    </div>

                    <form method="GET">
                        <!-- keep sort -->
                        @if ($sort)
                            <input type="hidden" name="sort" value="{{ $sort }}">
                        @endif

                        <!-- Price -->
                        <div class="sidebar-section pt-0 border-0">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="fw-bold">نطاق السعر</span>
                                <span class="material-symbols-outlined text-secondary">remove</span>
                            </div>
                            <div class="vstack gap-2">
                                @foreach ($priceOptions as $val => $label)
                                    <label class="form-check d-flex align-items-center gap-2 m-0">
                                        <input class="form-check-input mt-0" type="checkbox" name="price[]"
                                            value="{{ $val }}"
                                            {{ in_array($val, $selectedPrices) ? 'checked' : '' }}>
                                        <span class="text-secondary">{{ $label }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Occasion -->
                        <div class="sidebar-section">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="fw-bold">المناسبة</span>
                                <span class="material-symbols-outlined text-secondary">remove</span>
                            </div>
                            <div class="vstack gap-2">
                                @foreach ($occasionOptions as $val => $label)
                                    <label class="form-check d-flex align-items-center gap-2 m-0">
                                        <input class="form-check-input mt-0" type="checkbox" name="occasion[]"
                                            value="{{ $val }}"
                                            {{ in_array($val, $selectedOccasions) ? 'checked' : '' }}>
                                        <span class="text-secondary">{{ $label }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Type -->
                        <div class="sidebar-section">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="fw-bold">نوع الهدية</span>
                                <span class="material-symbols-outlined text-secondary">add</span>
                            </div>
                            <div class="vstack gap-2">
                                @foreach ($typeOptions as $val => $label)
                                    <label class="form-check d-flex align-items-center gap-2 m-0">
                                        <input class="form-check-input mt-0" type="checkbox" name="type[]"
                                            value="{{ $val }}"
                                            {{ in_array($val, $selectedTypes) ? 'checked' : '' }}>
                                        <span class="text-secondary">{{ $label }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <button class="btn w-100 mt-3 btn-choose" style="height:44px;">تطبيق</button>
                    </form>
                </div>
            </aside>

            <!-- Products Grid -->
            <section class="col-12 col-lg-9">

                <!-- Chips -->
                <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                    @foreach ($chipLabels as $chip)
                        <a class="pill" href="{{ $removeFilterUrl($chip['key'], $chip['val']) }}">
                            <span>{{ $chip['label'] }}</span>
                            <span class="material-symbols-outlined" style="font-size:18px;">close</span>
                        </a>
                    @endforeach

                    @if (count($chipLabels))
                        <a class="btn btn-link p-0 text-secondary-2" style="font-size:.85rem;text-decoration-style:dotted;"
                            href="{{ $clearAllUrl }}">
                            مسح جميع المرشحات
                        </a>
                    @endif
                </div>

                @if ($products->count())
                    <div class="row g-3 g-md-4 row-cols-2 row-cols-md-3 row-cols-lg-4">

                        @foreach ($products as $product)
                            @php
                                $primary = $product->primary_image;
                                $bg = $primary
                                    ? "url('" . asset('storage/' . $primary->path) . "')"
                                    : 'linear-gradient(135deg,#fef3c7,#ffe4e6)';
                            @endphp

                            <div class="col">
                                <a href="{{ route('products.show', $product) }}" class="text-decoration-none text-dark">
                                    <div class="card-product p-3 h-100">
                                        <div class="product-media mb-3">
                                            <div class="product-img" style="background-image: {{ $bg }};">
                                            </div>
                                        </div>

                                        <div class="text-end">
                                            <div class="fw-bold" style="color:inherit; line-height:1.25;">
                                                {{ $product->name }}
                                            </div>
                                            <div class="mt-1" style="color: var(--primary); font-weight:900;">
                                                {{ number_format($product->price, 2) }} ر.س
                                            </div>

                                            <button
                                                class="btn btn-choose w-100 mt-3 d-inline-flex align-items-center justify-content-center gap-2"
                                                type="button">
                                                <span>اختر الهدية</span>
                                                <span class="material-symbols-outlined">arrow_back</span>
                                            </button>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                    </div>

                    {{-- Pagination لو Paginate --}}
                    @if (method_exists($products, 'links'))
                        <div class="mt-5 d-flex justify-content-center">
                            {{ $products->withQueryString()->links() }}
                        </div>
                    @endif
                @else
                    <div class="text-center text-secondary-2 py-5">لا توجد منتجات داخل هذا التصنيف حالياً.</div>
                @endif

            </section>
        </div>
    </div>

    <!-- Offcanvas Filters (Mobile) -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="filtersOffcanvas">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title fw-bold">تصفية النتائج</h5>
            <button type="button" class="btn-close ms-0" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <div class="sidebar-card p-3">
                <form method="GET">
                    @if ($sort)
                        <input type="hidden" name="sort" value="{{ $sort }}">
                    @endif

                    <div class="mb-3">
                        <div class="fw-bold mb-2">نطاق السعر</div>
                        <div class="vstack gap-2">
                            @foreach ($priceOptions as $val => $label)
                                <label class="form-check d-flex align-items-center gap-2 m-0">
                                    <input class="form-check-input mt-0" type="checkbox" name="price[]"
                                        value="{{ $val }}"
                                        {{ in_array($val, $selectedPrices) ? 'checked' : '' }}>
                                    <span class="text-secondary">{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <hr>

                    <div class="mb-3">
                        <div class="fw-bold mb-2">المناسبة</div>
                        <div class="vstack gap-2">
                            @foreach ($occasionOptions as $val => $label)
                                <label class="form-check d-flex align-items-center gap-2 m-0">
                                    <input class="form-check-input mt-0" type="checkbox" name="occasion[]"
                                        value="{{ $val }}"
                                        {{ in_array($val, $selectedOccasions) ? 'checked' : '' }}>
                                    <span class="text-secondary">{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <hr>

                    <div class="mb-3">
                        <div class="fw-bold mb-2">نوع الهدية</div>
                        <div class="vstack gap-2">
                            @foreach ($typeOptions as $val => $label)
                                <label class="form-check d-flex align-items-center gap-2 m-0">
                                    <input class="form-check-input mt-0" type="checkbox" name="type[]"
                                        value="{{ $val }}"
                                        {{ in_array($val, $selectedTypes) ? 'checked' : '' }}>
                                    <span class="text-secondary">{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <button class="btn btn-choose w-100" style="height:44px;">تطبيق</button>
                    <a href="{{ $clearAllUrl }}" class="btn btn-light w-100 mt-2" style="border-radius:999px;">مسح
                        الكل</a>
                </form>
            </div>
        </div>
    </div>
@endsection
