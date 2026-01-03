@php
    use App\Models\Category;
    $cats = isset($categories) ? $categories : Category::latest()->get();
@endphp

<!-- Categories -->
<section class="py-5">
    <div class="container" style="max-width:1280px;">
        <div class="mb-4 text-end">
            <h2 class="fw-black" style="font-weight:900; font-size: clamp(1.8rem, 3vw, 2.4rem);">تسوق حسب الفئة</h2>
            <p class="text-sub fs-5 m-0">تصفح المجموعات المميزة لدينا واختر ما يناسبك.</p>
        </div>

        @if ($cats->count())
            <div class="row g-3 g-md-4 row-cols-2 row-cols-md-3 row-cols-lg-5">
                @foreach ($cats as $cat)
                    @php
                        $img = $cat->image;
                        $imageUrl = $img
                            ? (preg_match('/^https?:\/\//', $img)
                                ? $img
                                : asset('storage/' . ltrim($img, '/')))
                            : null;
                    @endphp
                    <div class="col">
                        <a href="{{ route('products.index', ['category_id' => $cat->id]) }}" class="text-decoration-none">
                            <div class="cat-thumb">
                                <div class="cat-bg"
                                    style="background-image: {{ $imageUrl ? "url('" . $imageUrl . "')" : 'linear-gradient(135deg, #fef3c7, #ffe4e6)' }};">
                                </div>
                                <div class="cat-overlay"></div>
                                <div class="cat-icon">
                                    <span class="material-symbols-outlined">category</span>
                                </div>
                            </div>
                            <div class="text-end mt-3">
                                <h3 class="fs-5 fw-bold mb-1" style="color:inherit;">{{ $cat->name }}</h3>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center text-secondary-custom">لا توجد أقسام مضافة بعد.</div>
        @endif
    </div>
</section>