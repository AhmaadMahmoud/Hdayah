@extends('frontend.layouts.master')
@section('content')
    <section class="py-5">
        <div class="container" style="max-width:1280px;">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="text-end">
                    <h1 class="fw-black m-0" style="font-weight:900; font-size: clamp(1.6rem, 2.4vw, 2.2rem);">منتجاتنا</h1>
                    <p class="text-sub mb-0">تصفح المنتجات المتاحة حالياً.</p>
                </div>
            </div>

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
                            <a href="{{ route('products.show', $product) }}" class="text-decoration-none text-reset">
                                <div class="p-card p-3 h-100 d-flex flex-column">
                                    <div class="p-img">
                                        <div class="p-img-bg" style="background-image:url('{{ $imageUrl }}');"></div>
                                    </div>
                                    <div class="mt-3 d-flex flex-column gap-1 flex-grow-1">
                                        <h3 class="fs-5 fw-bold m-0">{{ $product->name }}</h3>
                                        <div class="text-sub small">{{ $product->category->name ?? 'غير مصنف' }}</div>
                                        <div class="fw-bold" style="color:var(--primary);">{{ number_format($product->price, 2) }} ر.س</div>
                                    </div>
                                    <span class="btn btn-dark-soft w-100 mt-2">
                                        <span class="material-symbols-outlined align-middle me-1" style="font-size:18px;">visibility</span>
                                        عرض التفاصيل
                                    </span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center text-sub">لا توجد منتجات متاحة حالياً.</div>
            @endif
        </div>
    </section>
@endsection
