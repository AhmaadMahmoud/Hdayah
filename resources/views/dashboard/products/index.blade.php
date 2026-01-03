@extends('dashboard.layouts.master')

@section('content_dash')
    <div class="content-area">
        <div class="container-fluid" style="max-width: 1280px;">
            <header class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
                <div>
                    <h1 class="display-6 fw-black m-0" style="font-weight: 900;">المنتجات</h1>
                    <p class="text-secondary-custom mb-0">إدارة المنتجات، الأقسام، الأسعار، والمخزون. يمكنك إضافة منتج جديد أو تعديل الموجود.</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <button class="btn text-white rounded-xl px-4 py-2" style="background: var(--primary); border: 0;"
                        data-bs-toggle="modal" data-bs-target="#addProductModal" id="openCreateProduct">
                        <span class="material-symbols-outlined align-middle" style="font-size:20px;">add</span>
                        <span class="fw-bold small align-middle">إضافة منتج جديد</span>
                    </button>
                </div>
            </header>

            @if (session('status'))
                <div class="alert alert-success rounded-xl border-0" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger rounded-xl border-0" role="alert">
                    <div class="fw-bold mb-1">حدثت الأخطاء التالية:</div>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="panel rounded-xl p-3 p-md-4 shadow-sm mb-4">
                <form id="filtersForm" method="GET" class="row g-3 align-items-center">
                    <div class="col-12 col-md">
                        <div class="search-wrap">
                            <span class="material-symbols-outlined search-icon">search</span>
                            <input type="text" name="q" value="{{ $search }}"
                                class="form-control rounded-xl search-input py-3" placeholder="ابحث باسم المنتج أو الوصف..." />
                        </div>
                    </div>
                    <div class="col-12 col-md-auto">
                        <div class="d-flex gap-2 flex-wrap">
                            <select name="category_id" class="form-select rounded-xl border-0"
                                style="background: var(--bg-light); min-width: 160px;">
                                <option value="">كل الأقسام</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected($categoryFilter == $category->id)>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <select name="stock_status" class="form-select rounded-xl border-0"
                                style="background: var(--bg-light); min-width: 160px;">
                                <option value="">حالة المخزون</option>
                                <option value="instock" @selected($stockFilter === 'instock')>متوفر (أكثر من 5)</option>
                                <option value="low" @selected($stockFilter === 'low')>قليل (1 - 5)</option>
                                <option value="out" @selected($stockFilter === 'out')>غير متوفر</option>
                            </select>
                            <button class="btn rounded-xl border-0 d-flex align-items-center gap-1"
                                style="background: var(--bg-light);" type="submit">
                                <span class="material-symbols-outlined">filter_list</span>
                                <span class="small fw-semibold">تصفية</span>
                            </button>
                            <a href="{{ route('dashboard.products.index') }}" class="btn btn-light rounded-xl border-0">
                                إعادة تعيين
                            </a>
                        </div>
                    </div>
                </form>
                <div class="small text-secondary-custom mt-2">استخدم البحث والتصفية لتقليل النتائج ثم اضغط إعادة تعيين لإظهار كل المنتجات.</div>
            </div>

            <div class="panel rounded-xl shadow-sm overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-hover align-middle m-0 text-end">
                        <thead>
                            <tr style="background: var(--bg-light);">
                                <th class="px-4 py-3 text-secondary-custom small fw-bold">المنتج</th>
                                <th class="px-4 py-3 text-secondary-custom small fw-bold">القسم</th>
                                <th class="px-4 py-3 text-secondary-custom small fw-bold">السعر</th>
                                <th class="px-4 py-3 text-secondary-custom small fw-bold">المخزون</th>
                                <th class="px-4 py-3 text-secondary-custom small fw-bold">الحالة</th>
                                <th class="px-4 py-3 text-secondary-custom small fw-bold text-center">إجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                @php
                                    $primary = $product->primary_image;
                                    $gallery = $product->images;
                                @endphp
                                <tr>
                                    <td class="px-4 py-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="thumb"
                                                style="background-image: {{ $primary ? "url('" . asset('storage/' . $primary->path) . "')" : 'linear-gradient(135deg, #fef3c7, #ffe4e6)' }};">
                                            </div>
                                            <div>
                                                <div class="fw-bold">{{ $product->name }}</div>
                                                <div class="d-flex align-items-center gap-1 mt-1 flex-wrap">
                                                    @foreach ($gallery->take(3) as $image)
                                                        <span class="thumb thumb-mini"
                                                            style="background-image:url('{{ asset('storage/' . $image->path) }}');"></span>
                                                    @endforeach
                                                    @if ($gallery->count() > 3)
                                                        <span class="thumb thumb-mini more">+{{ $gallery->count() - 3 }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-secondary-custom fw-semibold">
                                        {{ $product->category->name ?? 'غير مصنف' }}
                                    </td>
                                    <td class="px-4 py-3 fw-bold">{{ number_format($product->price, 2) }} ر.س</td>
                                    <td class="px-4 py-3 fw-semibold">{{ $product->stock }}</td>
                                    <td class="px-4 py-3">
                                        @if ($product->is_published)
                                            <span class="badge rounded-pill" style="background:#dcfce7; color:#15803d;">
                                                <span class="dot me-1" style="background:#22c55e;"></span>
                                                منشور
                                            </span>
                                        @elseif ($product->stock === 0)
                                            <span class="badge rounded-pill" style="background:#fee2e2; color:#b91c1c;">
                                                <span class="dot me-1" style="background:#ef4444;"></span>
                                                غير متوفر
                                            </span>
                                        @else
                                            <span class="badge rounded-pill" style="background:#ffedd5; color:#c2410c;">
                                                <span class="dot me-1" style="background:#f97316;"></span>
                                                مسودة
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <button class="icon-btn edit-product" type="button" data-bs-toggle="modal"
                                            data-bs-target="#addProductModal"
                                            data-action="{{ route('dashboard.products.update', $product) }}"
                                            data-name="{{ $product->name }}"
                                            data-category-id="{{ $product->category_id }}"
                                            data-price="{{ $product->price }}"
                                            data-cost="{{ $product->cost }}"
                                            data-stock="{{ $product->stock }}"
                                            data-description="{{ $product->description }}"
                                            data-published="{{ $product->is_published ? '1' : '0' }}"
                                            data-images='@json($gallery->map(fn($img) => asset('storage/' . $img->path)))'>
                                            <span class="material-symbols-outlined" style="font-size:20px;">edit</span>
                                        </button>
                                        <form method="POST" action="{{ route('dashboard.products.destroy', $product) }}"
                                            class="d-inline" onsubmit="return confirm('هل تريد حذف هذا المنتج؟');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="icon-btn danger" type="submit">
                                                <span class="material-symbols-outlined" style="font-size:20px;">delete</span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-4 text-center text-secondary-custom">
                                        لا توجد منتجات حالياً.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex align-items-center justify-content-between p-3 border-top border-soft">
                    <div class="small text-secondary-custom">
                        إجمالي <span class="fw-bold">{{ $products->count() }}</span> منتج/منتجات
                        @if ($search || $categoryFilter || $stockFilter)
                            <span class="ms-2">| فُلتر حسب اختياراتك</span>
                        @endif
                    </div>
                    <div class="small text-secondary-custom">يمكنك إضافة/تحديث المنتجات من النموذج أدناه.</div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addProductModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content rounded-2xl panel">
                <form id="productForm" method="POST" action="{{ route('dashboard.products.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" id="formMethod" value="">
                    <div class="modal-header border-bottom border-soft">
                        <h5 class="modal-title fw-black" id="productModalTitle" style="font-weight: 900;">إضافة منتج جديد</h5>
                        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row g-4">
                            <div class="col-12 col-lg-4">
                                <div class="fw-bold mb-2">صور المنتج</div>

                                <label for="productImages" class="dropzone">
                                    <div class="p-3 rounded-circle"
                                        style="background: var(--surface-light); box-shadow: 0 6px 18px rgba(0,0,0,.06);">
                                        <span class="material-symbols-outlined"
                                            style="font-size:34px; color: var(--primary);">add_photo_alternate</span>
                                    </div>
                                    <div class="text-center">
                                        <div class="fw-bold">ارفع صور المنتج أو اسحبها هنا</div>
                                        <div class="small text-secondary-custom">الحد الأقصى 4 صور، حجم كل صورة 4MB</div>
                                    </div>
                                </label>
                                <input id="productImages" name="images[]" type="file" class="d-none" multiple accept="image/*" />

                                <div class="row g-2 mt-2" id="existingImages">
                                    <div class="col-12 text-secondary-custom small">لا توجد صور حالياً.</div>
                                </div>
                                <div class="row g-2 mt-2" id="imagesPreview">
                                    <div class="col-12 text-secondary-custom small">ستظهر الصور المضافة هنا قبل الحفظ.</div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-8">
                                <div class="row g-3">
                                    <div class="col-12 col-md-6">
                                        <label class="form-label fw-bold">اسم المنتج</label>
                                        <input id="fieldName" name="name" class="form-control rounded-xl border-0"
                                            style="background: var(--bg-light);" placeholder="مثال: صندوق هدايا فاخر"
                                            value="{{ old('name') }}" required />
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label class="form-label fw-bold">القسم</label>
                                        <select id="fieldCategory" name="category_id" class="form-select rounded-xl border-0"
                                            style="background: var(--bg-light);">
                                            <option value="">اختر القسم</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <label class="form-label fw-bold">السعر (ر.س)</label>
                                        <input id="fieldPrice" name="price" type="number" step="0.01" min="0"
                                            class="form-control rounded-xl border-0" style="background: var(--bg-light);"
                                            placeholder="0.00" value="{{ old('price') }}" required />
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <label class="form-label fw-bold">تكلفة المنتج (اختياري)</label>
                                        <input id="fieldCost" name="cost" type="number" step="0.01" min="0"
                                            class="form-control rounded-xl border-0" style="background: var(--bg-light);"
                                            placeholder="0.00" value="{{ old('cost') }}" />
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <label class="form-label fw-bold">الكمية في المخزون</label>
                                        <input id="fieldStock" name="stock" type="number" min="0"
                                            class="form-control rounded-xl border-0" style="background: var(--bg-light);"
                                            placeholder="0" value="{{ old('stock', 0) }}" required />
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label fw-bold">وصف المنتج</label>
                                        <textarea id="fieldDescription" name="description" rows="4" class="form-control rounded-xl border-0"
                                            style="background: var(--bg-light);" placeholder="وصف مختصر يوضح مميزات المنتج...">{{ old('description') }}</textarea>
                                    </div>

                                    <div class="col-12">
                                        <div class="p-3 rounded-xl" style="background: var(--bg-light);">
                                            <div class="form-check m-0">
                                                <input class="form-check-input" type="checkbox" id="publishNow" name="publish"
                                                    value="1" @checked(old('publish', true)) />
                                                <label class="form-check-label fw-semibold" for="publishNow">
                                                    نشر المنتج فوراً بعد الحفظ
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer border-top border-soft">
                        <button type="button" class="btn btn-outline-secondary rounded-xl px-4" data-bs-dismiss="modal">
                            إلغاء
                        </button>
                        <button id="submitBtn" type="submit" class="btn text-white rounded-xl px-4"
                            style="background: var(--primary); border:0;">
                            <span class="material-symbols-outlined align-middle" style="font-size:20px;">save</span>
                            <span class="fw-bold align-middle" id="submitBtnText">حفظ المنتج</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<style>
    :root {
        --primary: #eead2b;
        --bg-light: #f8f7f6;
        --bg-dark: #221c10;
        --surface-light: #ffffff;
        --surface-dark: #2d261a;
        --border-light: #e7dfcf;
        --border-dark: #3d3220;
        --text-light: #1b170d;
        --text-dark: #eceae5;
        --text2-light: #9a804c;
        --text2-dark: #d1c2a3;
        --r: 0.5rem;
        --r-lg: 1rem;
        --r-xl: 1.5rem;
    }

    body {
        font-family: "Tajawal", "Manrope", sans-serif;
        background: var(--bg-light);
        color: var(--text-light);
        overflow-x: hidden;
    }

    html[data-bs-theme="dark"] body {
        background: var(--bg-dark);
        color: var(--text-dark);
    }

    .material-symbols-outlined {
        font-variation-settings: "FILL" 0, "wght" 400, "GRAD" 0, "opsz" 24;
    }

    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    ::-webkit-scrollbar-thumb {
        background: var(--border-light);
        border-radius: 4px;
    }

    .app-wrap {
        min-height: 100vh;
    }

    .sidebar {
        width: 288px;
        background: var(--surface-light);
        border-left: 1px solid var(--border-light);
    }

    html[data-bs-theme="dark"] .sidebar {
        background: var(--surface-dark);
        border-left-color: var(--border-dark);
    }

    .content-area {
        padding: 1rem;
    }

    @media (min-width: 768px) {
        .content-area {
            padding: 2rem;
        }
    }

    .rounded-xl {
        border-radius: var(--r-lg) !important;
    }

    .rounded-2xl {
        border-radius: var(--r-xl) !important;
    }

    .text-secondary-custom {
        color: var(--text2-light) !important;
    }

    html[data-bs-theme="dark"] .text-secondary-custom {
        color: var(--text2-dark) !important;
    }

    .border-soft {
        border-color: var(--border-light) !important;
    }

    html[data-bs-theme="dark"] .border-soft {
        border-color: var(--border-dark) !important;
    }

    .panel {
        background: var(--surface-light);
        border: 1px solid var(--border-light);
    }

    html[data-bs-theme="dark"] .panel {
        background: var(--surface-dark);
        border-color: var(--border-dark);
    }

    .search-wrap {
        position: relative;
    }

    .search-icon {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text2-light);
        pointer-events: none;
    }

    .search-input {
        padding-right: 44px !important;
        border: 0;
        background: var(--bg-light);
    }

    .table-hover tbody tr:hover {
        background: rgba(0, 0, 0, 0.02);
    }

    .dot {
        width: 7px;
        height: 7px;
        border-radius: 999px;
        display: inline-block;
    }

    .icon-btn {
        width: 38px;
        height: 38px;
        border-radius: 0.75rem;
        border: 0;
        background: transparent;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: 0.2s ease;
        color: var(--text2-light);
    }

    .icon-btn:hover {
        background: rgba(0, 0, 0, 0.03);
        color: var(--primary);
    }

    .icon-btn.danger:hover {
        color: #ef4444;
    }

    .thumb {
        width: 48px;
        height: 48px;
        border-radius: 0.75rem;
        background-size: cover;
        background-position: center;
        flex: 0 0 auto;
        background-color: #f1f1f1;
    }

    .thumb.thumb-mini {
        width: 32px;
        height: 32px;
    }

    .thumb.thumb-mini.more {
        background: var(--bg-light);
        border: 1px dashed var(--border-light);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.85rem;
        font-weight: 800;
        color: var(--text2-light);
    }

    .dropzone {
        border: 2px dashed var(--border-light);
        background: var(--bg-light);
        border-radius: var(--r-lg);
        padding: 1rem;
        min-height: 220px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 0.75rem;
        cursor: pointer;
        transition: 0.2s ease;
        text-align: center;
    }

    .dropzone:hover {
        border-color: rgba(238, 173, 43, 0.5);
        background: rgba(238, 173, 43, 0.04);
    }

    .mini-slot {
        border: 1px solid var(--border-light);
        background: var(--bg-light);
        border-radius: 0.75rem;
        aspect-ratio: 1/1;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .preview-slot {
        background-size: cover;
        background-position: center;
        border: 0;
        position: relative;
        overflow: hidden;
    }

    .remove-btn {
        position: absolute;
        top: 6px;
        left: 6px;
        border: 0;
        background: rgba(0, 0, 0, 0.45);
        color: #fff;
        width: 26px;
        height: 26px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        cursor: pointer;
        transition: 0.15s ease;
    }

    .remove-btn:hover {
        background: rgba(0, 0, 0, 0.65);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('productForm');
        const filtersForm = document.getElementById('filtersForm');
        const searchInput = document.querySelector('input[name="q"]');
        const categorySelect = document.querySelector('select[name="category_id"]');
        const stockSelect = document.querySelector('select[name="stock_status"]');
        const methodInput = document.getElementById('formMethod');
        const modalTitle = document.getElementById('productModalTitle');
        const submitBtnText = document.getElementById('submitBtnText');
        const input = document.getElementById('productImages');
        const preview = document.getElementById('imagesPreview');
        const existing = document.getElementById('existingImages');
        const fieldName = document.getElementById('fieldName');
        const fieldCategory = document.getElementById('fieldCategory');
        const fieldPrice = document.getElementById('fieldPrice');
        const fieldCost = document.getElementById('fieldCost');
        const fieldStock = document.getElementById('fieldStock');
        const fieldDescription = document.getElementById('fieldDescription');
        const publishNow = document.getElementById('publishNow');
        const createBtn = document.getElementById('openCreateProduct');
        let selectedFiles = [];
        let searchTimeout;

        const submitFilters = () => {
            filtersForm?.submit();
        };

        const resetForm = () => {
            form.action = "{{ route('dashboard.products.store') }}";
            methodInput.value = '';
            modalTitle.textContent = 'إضافة منتج جديد';
            submitBtnText.textContent = 'حفظ المنتج';
            fieldName.value = '';
            fieldCategory.value = '';
            fieldPrice.value = '';
            fieldCost.value = '';
            fieldStock.value = 0;
            fieldDescription.value = '';
            publishNow.checked = true;
            selectedFiles = [];
            renderPreviews();
            renderExisting([]);
        };

        const syncInputFiles = () => {
            const dt = new DataTransfer();
            selectedFiles.forEach((file) => dt.items.add(file));
            input.files = dt.files;
        };

        const renderExisting = (images) => {
            existing.innerHTML = '';
            if (!images || images.length === 0) {
                existing.innerHTML = '<div class="col-12 text-secondary-custom small">لا توجد صور حالياً.</div>';
                return;
            }
            images.forEach((url) => {
                const col = document.createElement('div');
                col.className = 'col-4';
                col.innerHTML = `<div class="mini-slot preview-slot" style="background-image:url('${url}');"></div>`;
                existing.appendChild(col);
            });
        };

        const renderPreviews = () => {
            preview.innerHTML = '';
            if (!selectedFiles.length) {
                preview.innerHTML = '<div class="col-12 text-secondary-custom small">ستظهر الصور المضافة هنا قبل الحفظ.</div>';
                return;
            }
            selectedFiles.forEach((file, index) => {
                if (!file.type.startsWith('image/')) return;
                const url = URL.createObjectURL(file);
                const col = document.createElement('div');
                col.className = 'col-4';
                col.innerHTML = `
                    <div class="mini-slot preview-slot" style="background-image:url('${url}');">
                        <button type="button" class="remove-btn" data-index="${index}" title="حذف">
                            <span class="material-symbols-outlined" style="font-size:16px;">close</span>
                        </button>
                    </div>`;
                preview.appendChild(col);
            });
        };

        input?.addEventListener('change', () => {
            const newFiles = Array.from(input.files || []);
            selectedFiles = selectedFiles.concat(newFiles);
            syncInputFiles();
            renderPreviews();
        });

        preview?.addEventListener('click', (e) => {
            const btn = e.target.closest('.remove-btn');
            if (!btn) return;
            const idx = Number(btn.dataset.index);
            selectedFiles = selectedFiles.filter((_, i) => i !== idx);
            syncInputFiles();
            renderPreviews();
        });

        categorySelect?.addEventListener('change', submitFilters);
        stockSelect?.addEventListener('change', submitFilters);
        searchInput?.addEventListener('input', () => {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(submitFilters, 450);
        });

        document.querySelectorAll('.edit-product').forEach((btn) => {
            btn.addEventListener('click', () => {
                form.action = btn.dataset.action;
                methodInput.value = 'PATCH';
                modalTitle.textContent = 'تعديل المنتج';
                submitBtnText.textContent = 'حفظ التعديلات';
                fieldName.value = btn.dataset.name || '';
                fieldCategory.value = btn.dataset.categoryId || '';
                fieldPrice.value = btn.dataset.price || 0;
                fieldCost.value = btn.dataset.cost || '';
                fieldStock.value = btn.dataset.stock || 0;
                fieldDescription.value = btn.dataset.description || '';
                publishNow.checked = btn.dataset.published === '1';
                selectedFiles = [];
                syncInputFiles();
                renderPreviews();
                try {
                    const imgs = JSON.parse(btn.dataset.images || '[]');
                    renderExisting(imgs);
                } catch {
                    renderExisting([]);
                }
            });
        });

        createBtn?.addEventListener('click', () => resetForm());
    });
</script>
