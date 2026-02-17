@extends('frontend.layouts.master')
@section('content')
    @php
        $totalProducts = method_exists($products, 'total') ? $products->total() : $products->count();
        $config = $filtersEnabled ?? [];

        $priceOptions = collect($config['price']['options'] ?? [])
            ->mapWithKeys(fn($opt) => [$opt['value'] => $opt['label']])
            ->all();
        $selectedPrices = $selectedPrices ?? [];
        $stockFilter = $stockFilter ?? null;
        $sort = $sort ?? ($config['sort']['default'] ?? 'relevance');
        $search = $search ?? '';
    @endphp

    <section class="py-5">
        <div class="container" style="max-width:1280px;">
            <div
                class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4 border-bottom pb-3">
                <div class="text-end">
                    <h1 class="fw-black m-0" style="font-weight:900; font-size: clamp(1.6rem, 2.4vw, 2.2rem);">منتجاتنا</h1>
                    <p class="text-sub mb-0">عدد المنتجات: {{ $totalProducts }}</p>
                </div>

                <div class="d-flex flex-column flex-md-row align-items-stretch align-items-md-center gap-2">
                    @if (($config['search']['enabled'] ?? true))
                        <form method="GET" class="w-100" style="max-width:260px;">
                            @foreach (request()->except('q') as $k => $v)
                                @if (is_array($v))
                                    @foreach ($v as $vv)
                                        <input type="hidden" name="{{ $k }}[]" value="{{ $vv }}">
                                    @endforeach
                                @else
                                    <input type="hidden" name="{{ $k }}" value="{{ $v }}">
                                @endif
                            @endforeach
                            <div class="input-group">
                                <input type="search" name="q" value="{{ $search }}" class="form-control"
                                    placeholder="بحث عن منتج..." />
                                <button class="btn btn-outline-secondary" type="submit">
                                    <span class="material-symbols-outlined" style="font-size:18px;">search</span>
                                </button>
                            </div>
                        </form>
                    @endif

                    @if (($config['sort']['enabled'] ?? true) && !empty($config['sort']['options']))
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
                                @foreach ($config['sort']['options'] as $opt)
                                    @php
                                        $labelMap = [
                                            'relevance' => 'الأكثر ملاءمة',
                                            'price_asc' => 'الأقل سعراً',
                                            'price_desc' => 'الأعلى سعراً',
                                            'latest' => 'الأحدث',
                                        ];
                                    @endphp
                                    <li>
                                        <button class="dropdown-item" name="sort" value="{{ $opt }}">
                                            {{ $labelMap[$opt] ?? $opt }}
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                        </form>
                    @endif
                </div>
            </div>

            <div class="row g-4">
                <aside class="col-12 col-lg-3">
                    <div class="sidebar-card p-4 bg-white rounded-3 border mb-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h3 class="h6 fw-bold mb-0">تصفية النتائج</h3>
                            <a href="{{ route('products.index') }}" class="small text-decoration-none"
                                style="color:var(--primary);">مسح الكل</a>
                        </div>

                        <form method="GET" class="vstack gap-3">
                            @if ($search !== '')
                                <input type="hidden" name="q" value="{{ $search }}">
                            @endif
                            @if ($sort)
                                <input type="hidden" name="sort" value="{{ $sort }}">
                            @endif

                            @if (($config['price']['enabled'] ?? true) && count($priceOptions))
                                <div>
                                    <div class="fw-bold mb-2">نطاق السعر</div>
                                    <div class="vstack gap-2">
                                        @foreach ($priceOptions as $val => $label)
                                            <label class="form-check d-flex align-items-center gap-2 m-0">
                                                <input class="form-check-input mt-0" type="checkbox" name="price[]"
                                                    value="{{ $val }}"
                                                    {{ in_array($val, $selectedPrices) ? 'checked' : '' }}>
                                                <span class="text-sub small">{{ $label }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            @if (($config['stock']['enabled'] ?? true))
                                <div>
                                    <div class="fw-bold mb-2">حالة التوفر</div>
                                    <select name="stock" class="form-select form-select-sm rounded-2">
                                        <option value="">الكل</option>
                                        <option value="instock" @selected($stockFilter === 'instock')>متوفر</option>
                                        <option value="out" @selected($stockFilter === 'out')>غير متوفر</option>
                                    </select>
                                </div>
                            @endif

                            <button class="btn btn-dark-soft w-100 mt-1" type="submit">تطبيق</button>
                        </form>
                    </div>
                </aside>

                <section class="col-12 col-lg-9">
                    @if ($products->count())
                        <div class="row g-3 g-md-4 row-cols-2 row-cols-md-3 row-cols-lg-4">
                            @foreach ($products as $product)
                                @php
                                    $primary = $product->primary_image;
                                    $imageUrl = $primary
                                        ? asset('storage/' . ltrim($primary->path, '/'))
                                        : 'https://via.placeholder.com/400x400/eee/aaa?text=No+Image';
                                @endphp
                                <div class="col">
                                    <a href="{{ route('products.show', $product) }}"
                                        class="text-decoration-none text-reset">
                                        <div class="p-card p-3 h-100 d-flex flex-column">
                                            <div class="p-img">
                                                <div class="p-img-bg" style="background-image:url('{{ $imageUrl }}');"></div>
                                            </div>
                                            <div class="mt-3 d-flex flex-column gap-1 flex-grow-1">
                                                <h3 class="fs-5 fw-bold m-0">{{ $product->name }}</h3>
                                                <div class="text-sub small">{{ $product->category->name ?? 'غير مصنف' }}</div>
                                                <div class="fw-bold" style="color:var(--primary);">
                                                    {{ number_format($product->price, 2) }} ر.س
                                                </div>
                                            </div>
                                            <span class="btn btn-dark-soft w-100 mt-2">
                                                <span class="material-symbols-outlined align-middle me-1"
                                                    style="font-size:18px;">visibility</span>
                                                عرض التفاصيل
                                            </span>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        @if (method_exists($products, 'links'))
                            <div class="mt-4 d-flex justify-content-center">
                                {{ $products->withQueryString()->links() }}
                            </div>
                        @endif
                    @else
                        <div class="text-center text-sub py-5">لا توجد منتجات متاحة حالياً.</div>
                    @endif
                </section>
            </div>
        </div>
    </section>
@endsection
