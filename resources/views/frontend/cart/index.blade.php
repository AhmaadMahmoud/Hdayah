@extends('frontend.layouts.master')
@section('content')
    <div class="container-fluid py-4" style="max-width:1440px;">
        <div class="container-fluid py-4 py-md-5" style="max-width:1440px;">

            <div class="d-flex flex-wrap align-items-center gap-2 mb-4 fw-semibold small">
                <a class="text-decoration-none text-muted-custom" href="{{ route('home') }}">الرئيسية</a>
                <span class="material-symbols-outlined text-muted-custom" style="font-size:18px;">chevron_left</span>
                <span class="fw-bold">السلة</span>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (count($items) === 0)
                <div class="text-center py-5">
                    <span class="material-symbols-outlined text-muted" style="font-size:64px;">shopping_cart</span>
                    <p class="mt-3 fw-semibold text-muted">السلة فارغة</p>
                    <a href="{{ route('products.index') }}" class="btn btn-primary rounded-pill px-4">تصفح المنتجات</a>
                </div>
            @else
                <div class="row g-4">
                    <div class="col-12 col-lg-8">
                        <div class="surface-box rounded-2xl p-3 p-md-4">
                            <h2 class="fw-bold mb-4" style="font-size:1.25rem;">عناصر السلة</h2>
                            <div class="vstack gap-3">
                                @foreach ($items as $item)
                                    @php
                                        $img = $item->product->primary_image;
                                        $imgUrl = $img ? asset('storage/' . ltrim($img->path, '/')) : 'https://via.placeholder.com/120/eee/aaa?text=No+Image';
                                    @endphp
                                    <div class="cart-item d-flex align-items-center gap-3 p-3 rounded-2xl" style="background: rgba(0,0,0,.02);">
                                        <div class="flex-shrink-0 rounded-2xl overflow-hidden" style="width:80px; height:80px; background-size:cover; background-position:center; background-image:url('{{ $imgUrl }}');"></div>
                                        <div class="flex-grow-1 min-w-0">
                                            <a href="{{ route('products.show', $item->product) }}" class="fw-bold text-decoration-none text-dark">{{ $item->product->name }}</a>
                                            <p class="mb-0 small text-muted-custom">{{ number_format($item->product->price, 2) }} ر.س × {{ $item->quantity }}</p>
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            <form action="{{ route('cart.update', $item->product) }}" method="post" class="d-flex align-items-center gap-1">
                                                @csrf
                                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock ?? 99 }}" class="form-control form-control-sm text-center" style="width:60px;" onchange="this.form.submit()">
                                            </form>
                                            <form action="{{ route('cart.remove', $item->product) }}" method="post" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-link text-danger p-1" aria-label="حذف">
                                                    <span class="material-symbols-outlined" style="font-size:20px;">delete</span>
                                                </button>
                                            </form>
                                        </div>
                                        <div class="fw-bold text-primary-custom">{{ number_format($item->subtotal, 2) }} ر.س</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="surface-box rounded-2xl p-4 sticky-top" style="top: 100px;">
                            <h3 class="fw-bold mb-3" style="font-size:1.1rem;">ملخص السلة</h3>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-muted-custom">المجموع</span>
                                <span class="fw-bold" style="font-size:1.5rem;">{{ number_format($total, 2) }} ر.س</span>
                            </div>
                            <a href="{{ route('products.index') }}" class="btn btn-outline-primary w-100 rounded-pill fw-bold py-2 mb-2">متابعة التسوق</a>
                            <a href="{{ route('gifts.index', $items[0]->product) }}" class="btn btn-primary w-100 rounded-pill fw-bold py-3 d-flex align-items-center justify-content-center gap-2" style="box-shadow: 0 14px 30px rgba(238,43,91,.25);">
                                <span>انتقل لتغليف الهدية</span>
                                <span class="material-symbols-outlined" style="font-size:20px;">arrow_right_alt</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
