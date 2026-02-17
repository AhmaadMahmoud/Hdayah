@extends('dashboard.layouts.master')

@section('content_dash')
    <div class="content-area">
        <div class="container-fluid" style="max-width: 1280px;">
            <header class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
                <div>
                    <h1 class="display-6 fw-black m-0" style="font-weight: 900;">الفلاتر</h1>
                    <p class="text-secondary-custom mb-0">تحكم مركزي في الفلاتر المطبقة على صفحة المنتجات وصفحة التصنيفات.</p>
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

            <form method="POST" action="{{ route('dashboard.filters.update') }}">
                @csrf

                <div class="row g-4">
                    <div class="col-12 col-lg-6">
                        <div class="panel rounded-xl p-3 p-md-4 shadow-sm h-100">
                            <h2 class="h5 fw-bold mb-3">فلاتر صفحة المنتجات</h2>
                            <p class="small text-secondary-custom mb-3">سيتم تطبيق هذه الإعدادات على صفحة
                                <code>/products</code>.
                            </p>

                            @php
                                $p = $productsConfig;
                            @endphp

                            <div class="mb-3">
                                <div class="fw-bold mb-2">الترتيب (Sort)</div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="p_sort_enabled"
                                        name="p_sort_enabled" value="1" @checked($p['sort']['enabled'])>
                                    <label class="form-check-label fw-semibold" for="p_sort_enabled">
                                        إظهار \"ترتيب حسب\"
                                    </label>
                                </div>

                                <div class="row g-2">
                                    <div class="col-12">
                                        <div class="small text-secondary-custom mb-1">الخيارات المتاحة:</div>
                                        @php
                                            $pSortSelected = $p['sort']['options'] ?? [];
                                        @endphp
                                        <div class="d-flex flex-wrap gap-3">
                                            @foreach (['relevance' => 'الأكثر ملاءمة', 'price_asc' => 'الأقل سعراً', 'price_desc' => 'الأعلى سعراً', 'latest' => 'الأحدث'] as $key => $label)
                                                <label class="form-check d-inline-flex align-items-center gap-2 m-0">
                                                    <input class="form-check-input mt-0" type="checkbox"
                                                        name="p_sort_options[]" value="{{ $key }}"
                                                        @checked(in_array($key, $pSortSelected, true))>
                                                    <span class="fw-semibold small">{{ $label }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-7">
                                        <label class="form-label fw-bold small mb-1">الاختيار الافتراضي</label>
                                        <select id="p_sort_default" name="p_sort_default"
                                            class="form-select rounded-xl border-0" style="background: var(--bg-light);">
                                            @foreach (['relevance' => 'الأكثر ملاءمة', 'latest' => 'الأحدث', 'price_asc' => 'الأقل سعراً', 'price_desc' => 'الأعلى سعراً'] as $key => $label)
                                                <option value="{{ $key }}" @selected($p['sort']['default'] === $key)>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="mb-3">
                                <div class="fw-bold mb-2">نطاق السعر (Price)</div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="p_price_enabled"
                                        name="p_price_enabled" value="1" @checked($p['price']['enabled'])>
                                    <label class="form-check-label fw-semibold" for="p_price_enabled">
                                        إظهار فلتر السعر
                                    </label>
                                </div>
                                <div class="small text-secondary-custom mb-2">
                                    تقدر تعدّل/تضيف نطاقات سعر. اترك Min أو Max فارغ علشان يكون مفتوح.
                                </div>
                                <div id="p_price_ranges" class="vstack gap-2">
                                    @foreach ($p['price']['options'] as $opt)
                                        <div class="row g-2 align-items-end price-row">
                                            <div class="col-12 col-md-3">
                                                <label class="form-label fw-bold small mb-1">Key</label>
                                                <input name="p_price_value[]" class="form-control rounded-xl border-0"
                                                    style="background:#fff; direction:ltr;" value="{{ $opt['value'] }}"
                                                    placeholder="under-100" />
                                            </div>
                                            <div class="col-12 col-md-5">
                                                <label class="form-label fw-bold small mb-1">Label</label>
                                                <input name="p_price_label[]" class="form-control rounded-xl border-0"
                                                    style="background:#fff;" value="{{ $opt['label'] }}"
                                                    placeholder="أقل من ١٠٠ ر.س" />
                                            </div>
                                            <div class="col-6 col-md-2">
                                                <label class="form-label fw-bold small mb-1">Min</label>
                                                <input name="p_price_min[]" type="number" step="0.01" min="0"
                                                    class="form-control rounded-xl border-0"
                                                    style="background:#fff; direction:ltr;"
                                                    value="{{ $opt['min'] ?? '' }}" placeholder="100" />
                                            </div>
                                            <div class="col-6 col-md-2">
                                                <label class="form-label fw-bold small mb-1">Max</label>
                                                <input name="p_price_max[]" type="number" step="0.01" min="0"
                                                    class="form-control rounded-xl border-0"
                                                    style="background:#fff; direction:ltr;"
                                                    value="{{ $opt['max'] ?? '' }}" placeholder="300" />
                                            </div>
                                            <div class="col-12">
                                                <button type="button"
                                                    class="btn btn-link p-0 small text-danger remove-range-btn">حذف
                                                    النطاق</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-light rounded-xl border-0 mt-2"
                                    id="p_addPriceRangeBtn">
                                    + إضافة نطاق سعر
                                </button>
                            </div>

                            <hr>

                            <div class="mb-3">
                                <div class="fw-bold mb-2">بحث وتوفر</div>
                                <div class="form-check mb-1">
                                    <input class="form-check-input" type="checkbox" id="p_search_enabled"
                                        name="p_search_enabled" value="1" @checked($p['search']['enabled'])>
                                    <label class="form-check-label fw-semibold" for="p_search_enabled">
                                        تفعيل مربع البحث عن منتج
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="p_stock_enabled"
                                        name="p_stock_enabled" value="1" @checked($p['stock']['enabled'])>
                                    <label class="form-check-label fw-semibold" for="p_stock_enabled">
                                        تفعيل فلتر حالة المخزون (متوفر/غير متوفر)
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="panel rounded-xl p-3 p-md-4 shadow-sm h-100">
                            <h2 class="h5 fw-bold mb-3">فلاتر صفحة التصنيف</h2>
                            <p class="small text-secondary-custom mb-3">سيتم تطبيق هذه الإعدادات على صفحات
                                <code>/categories/{id}</code>.
                            </p>

                            @php
                                $c = $categoriesConfig;
                            @endphp

                            <div class="mb-3">
                                <div class="fw-bold mb-2">الترتيب (Sort)</div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="c_sort_enabled"
                                        name="c_sort_enabled" value="1" @checked($c['sort']['enabled'])>
                                    <label class="form-check-label fw-semibold" for="c_sort_enabled">
                                        إظهار \"ترتيب حسب\"
                                    </label>
                                </div>

                                <div class="row g-2">
                                    <div class="col-12">
                                        <div class="small text-secondary-custom mb-1">الخيارات المتاحة:</div>
                                        @php
                                            $cSortSelected = $c['sort']['options'] ?? [];
                                        @endphp
                                        <div class="d-flex flex-wrap gap-3">
                                            @foreach (['relevance' => 'الأكثر ملاءمة', 'price_asc' => 'الأقل سعراً', 'price_desc' => 'الأعلى سعراً', 'latest' => 'الأحدث'] as $key => $label)
                                                <label class="form-check d-inline-flex align-items-center gap-2 m-0">
                                                    <input class="form-check-input mt-0" type="checkbox"
                                                        name="c_sort_options[]" value="{{ $key }}"
                                                        @checked(in_array($key, $cSortSelected, true))>
                                                    <span class="fw-semibold small">{{ $label }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-7">
                                        <label class="form-label fw-bold small mb-1">الاختيار الافتراضي</label>
                                        <select id="c_sort_default" name="c_sort_default"
                                            class="form-select rounded-xl border-0" style="background: var(--bg-light);">
                                            @foreach (['relevance' => 'الأكثر ملاءمة', 'latest' => 'الأحدث', 'price_asc' => 'الأقل سعراً', 'price_desc' => 'الأعلى سعراً'] as $key => $label)
                                                <option value="{{ $key }}" @selected($c['sort']['default'] === $key)>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="mb-3">
                                <div class="fw-bold mb-2">نطاق السعر (Price)</div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="c_price_enabled"
                                        name="c_price_enabled" value="1" @checked($c['price']['enabled'])>
                                    <label class="form-check-label fw-semibold" for="c_price_enabled">
                                        إظهار فلتر السعر
                                    </label>
                                </div>
                                <div class="small text-secondary-custom mb-2">
                                    نفس النطاقات هتستخدم لتصفية منتجات كل تصنيف.
                                </div>
                                <div id="c_price_ranges" class="vstack gap-2">
                                    @foreach ($c['price']['options'] as $opt)
                                        <div class="row g-2 align-items-end price-row">
                                            <div class="col-12 col-md-3">
                                                <label class="form-label fw-bold small mb-1">Key</label>
                                                <input name="c_price_value[]" class="form-control rounded-xl border-0"
                                                    style="background:#fff; direction:ltr;" value="{{ $opt['value'] }}"
                                                    placeholder="under-100" />
                                            </div>
                                            <div class="col-12 col-md-5">
                                                <label class="form-label fw-bold small mb-1">Label</label>
                                                <input name="c_price_label[]" class="form-control rounded-xl border-0"
                                                    style="background:#fff;" value="{{ $opt['label'] }}"
                                                    placeholder="أقل من ١٠٠ ر.س" />
                                            </div>
                                            <div class="col-6 col-md-2">
                                                <label class="form-label fw-bold small mb-1">Min</label>
                                                <input name="c_price_min[]" type="number" step="0.01" min="0"
                                                    class="form-control rounded-xl border-0"
                                                    style="background:#fff; direction:ltr;"
                                                    value="{{ $opt['min'] ?? '' }}" placeholder="100" />
                                            </div>
                                            <div class="col-6 col-md-2">
                                                <label class="form-label fw-bold small mb-1">Max</label>
                                                <input name="c_price_max[]" type="number" step="0.01" min="0"
                                                    class="form-control rounded-xl border-0"
                                                    style="background:#fff; direction:ltr;"
                                                    value="{{ $opt['max'] ?? '' }}" placeholder="300" />
                                            </div>
                                            <div class="col-12">
                                                <button type="button"
                                                    class="btn btn-link p-0 small text-danger remove-range-btn">حذف
                                                    النطاق</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-light rounded-xl border-0 mt-2"
                                    id="c_addPriceRangeBtn">
                                    + إضافة نطاق سعر
                                </button>
                            </div>

                            <hr>

                            <div class="mb-3">
                                <div class="fw-bold mb-2">بحث وتوفر</div>
                                <div class="form-check mb-1">
                                    <input class="form-check-input" type="checkbox" id="c_search_enabled"
                                        name="c_search_enabled" value="1" @checked($c['search']['enabled'])>
                                    <label class="form-check-label fw-semibold" for="c_search_enabled">
                                        تفعيل مربع البحث داخل التصنيف
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="c_stock_enabled"
                                        name="c_stock_enabled" value="1" @checked($c['stock']['enabled'])>
                                    <label class="form-check-label fw-semibold" for="c_stock_enabled">
                                        تفعيل فلتر حالة المخزون (متوفر/غير متوفر)
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-end mt-4">
                    <button type="submit" class="btn text-white rounded-xl px-4"
                        style="background: var(--primary); border:0;">
                        <span class="material-symbols-outlined align-middle" style="font-size:20px;">save</span>
                        <span class="fw-bold align-middle">حفظ إعدادات الفلاتر</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const setupPriceRepeater = (wrapperId, addBtnId, prefix) => {
            const wrapper = document.getElementById(wrapperId);
            const addBtn = document.getElementById(addBtnId);
            if (!wrapper || !addBtn) return;

            const bindRemove = () => {
                wrapper.querySelectorAll('.remove-range-btn').forEach((btn) => {
                    btn.onclick = () => {
                        const row = btn.closest('.price-row');
                        row?.remove();
                    };
                });
            };

            bindRemove();

            addBtn.addEventListener('click', () => {
                const div = document.createElement('div');
                div.className = 'row g-2 align-items-end price-row';
                div.innerHTML = `
                    <div class="col-12 col-md-3">
                        <label class="form-label fw-bold small mb-1">Key</label>
                        <input name="${prefix}price_value[]" class="form-control rounded-xl border-0"
                            style="background:#fff; direction:ltr;" placeholder="range-1" />
                    </div>
                    <div class="col-12 col-md-5">
                        <label class="form-label fw-bold small mb-1">Label</label>
                        <input name="${prefix}price_label[]" class="form-control rounded-xl border-0"
                            style="background:#fff;" placeholder="وصف النطاق" />
                    </div>
                    <div class="col-6 col-md-2">
                        <label class="form-label fw-bold small mb-1">Min</label>
                        <input name="${prefix}price_min[]" type="number" step="0.01" min="0"
                            class="form-control rounded-xl border-0" style="background:#fff; direction:ltr;" />
                    </div>
                    <div class="col-6 col-md-2">
                        <label class="form-label fw-bold small mb-1">Max</label>
                        <input name="${prefix}price_max[]" type="number" step="0.01" min="0"
                            class="form-control rounded-xl border-0" style="background:#fff; direction:ltr;" />
                    </div>
                    <div class="col-12">
                        <button type="button" class="btn btn-link p-0 small text-danger remove-range-btn">حذف النطاق</button>
                    </div>
                `;
                wrapper.appendChild(div);
                bindRemove();
            });
        };

        setupPriceRepeater('p_price_ranges', 'p_addPriceRangeBtn', 'p_');
        setupPriceRepeater('c_price_ranges', 'c_addPriceRangeBtn', 'c_');
    });
</script>

