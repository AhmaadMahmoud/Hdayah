@extends('dashboard.layouts.master')

@section('content_dash')
    <div class="content-area">
        <div class="container-fluid" style="max-width: 1280px;">
            <header class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
                <div>
                    <h1 class="display-6 fw-black m-0" style="font-weight: 900;">خيارات التغليف والإهداء</h1>
                    <p class="text-secondary-custom mb-0">تحكم كامل في صفحة تغليف الهدايا: الصناديق والإضافات وبطاقات الإهداء.</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <button class="btn text-white rounded-xl px-4 py-2" style="background: var(--primary); border: 0;"
                        data-bs-toggle="modal" data-bs-target="#giftOptionModal" id="openCreateGift">
                        <span class="material-symbols-outlined align-middle" style="font-size:20px;">add</span>
                        <span class="fw-bold small align-middle">إضافة خيار جديد</span>
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
                    <div class="fw-bold mb-1">برجاء مراجعة الحقول التالية:</div>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @php
                $typeLabels = [
                    \App\Models\GiftOption::TYPE_BOX => 'صناديق التغليف',
                    \App\Models\GiftOption::TYPE_ADDON => 'الإضافات',
                    \App\Models\GiftOption::TYPE_CARD => 'بطاقات الإهداء',
                ];
            @endphp

            <p class="small text-secondary-custom mb-4">العناصر <strong>النشطة</strong> فقط تظهر في صفحة المستخدم (تغليف الهدية). استخدم "عرض في الموقع" أو "مخفي" للتحكم في الظهور.</p>

            @foreach ($typeLabels as $type => $label)
                @php
                    $addLabel = $type === \App\Models\GiftOption::TYPE_BOX ? 'إضافة صندوق' : ($type === \App\Models\GiftOption::TYPE_ADDON ? 'إضافة إضافة' : 'إضافة بطاقة');
                @endphp
                <div class="panel rounded-xl shadow-sm overflow-hidden mb-4" data-gift-type="{{ $type }}">
                    <div class="d-flex align-items-center justify-content-between px-4 py-3 border-bottom border-soft flex-wrap gap-2" style="background: var(--bg-light);">
                        <div>
                            <h3 class="h5 fw-bold mb-0">{{ $label }}</h3>
                            <div class="small text-secondary-custom">إدارة العناصر المعروضة في خطوة التغليف.</div>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <button type="button" class="btn btn-sm text-white rounded-xl px-3 py-2 btn-add-by-type" style="background: var(--primary); border: 0;"
                                data-type="{{ $type }}" data-bs-toggle="modal" data-bs-target="#giftOptionModal">
                                <span class="material-symbols-outlined align-middle" style="font-size:18px;">add</span>
                                <span class="small fw-bold align-middle">{{ $addLabel }}</span>
                            </button>
                            <span class="badge rounded-pill" style="background:#fef3f3; color:var(--primary);">
                                {{ ($options[$type] ?? collect())->count() }} عنصر
                            </span>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle m-0 text-end">
                            <thead>
                                <tr style="background: var(--bg-light);">
                                    <th class="px-4 py-3 text-secondary-custom small fw-bold">الاسم</th>
                                    <th class="px-4 py-3 text-secondary-custom small fw-bold">السعر</th>
                                    <th class="px-4 py-3 text-secondary-custom small fw-bold">الترتيب</th>
                                    <th class="px-4 py-3 text-secondary-custom small fw-bold">افتراضي</th>
                                    <th class="px-4 py-3 text-secondary-custom small fw-bold">مفعل</th>
                                    <th class="px-4 py-3 text-secondary-custom small fw-bold">صورة/أيقونة</th>
                                    <th class="px-4 py-3 text-secondary-custom small fw-bold text-center">خيارات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($options[$type] ?? [] as $option)
                                    <tr>
                                        <td class="px-4 py-3">
                                            <div class="fw-bold">{{ $option->name }}</div>
                                            @if ($option->description)
                                                <div class="small text-secondary-custom">{{ $option->description }}</div>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 fw-bold">{{ number_format($option->price, 2) }} ر.س</td>
                                        <td class="px-4 py-3 text-secondary-custom fw-semibold">{{ $option->sort_order }}</td>
                                        <td class="px-4 py-3">
                                            @if ($option->is_default)
                                                <span class="badge rounded-pill" style="background:#dcfce7; color:#15803d;">افتراضي</span>
                                            @else
                                                <span class="badge rounded-pill" style="background:#f3f4f6; color:#6b7280;">-</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3">
                                            @if ($option->is_active)
                                                <span class="badge rounded-pill" style="background:#dcfce7; color:#15803d;">نشط</span>
                                            @else
                                                <span class="badge rounded-pill" style="background:#fee2e2; color:#b91c1c;">مخفي</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="d-flex align-items-center gap-2">
                                                @if ($option->image_url)
                                                    <span class="thumb thumb-mini" style="background-image:url('{{ $option->image_url }}');"></span>
                                                @endif
                                                @if ($option->icon)
                                                    <span class="material-symbols-outlined text-secondary-custom">{{ $option->icon }}</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <button class="icon-btn edit-gift" type="button" data-bs-toggle="modal"
                                                data-bs-target="#giftOptionModal"
                                                data-action="{{ route('dashboard.gifts.update', $option) }}"
                                                data-name="{{ $option->name }}"
                                                data-type="{{ $option->type }}"
                                                data-price="{{ $option->price }}"
                                                data-description="{{ $option->description }}"
                                                data-icon="{{ $option->icon }}"
                                                data-sort="{{ $option->sort_order }}"
                                                data-default="{{ $option->is_default ? '1' : '0' }}"
                                                data-active="{{ $option->is_active ? '1' : '0' }}"
                                                data-image="{{ $option->image_url }}">
                                                <span class="material-symbols-outlined" style="font-size:20px;">edit</span>
                                            </button>
                                            <form method="POST" action="{{ route('dashboard.gifts.destroy', $option) }}"
                                                class="d-inline" onsubmit="return confirm('هل تريد حذف هذا الخيار؟');">
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
                                        <td colspan="7" class="px-4 py-4 text-center text-secondary-custom">
                                            لا توجد عناصر لهذا القسم بعد.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="modal fade" id="giftOptionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content rounded-2xl panel">
                <form id="giftForm" method="POST" action="{{ route('dashboard.gifts.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" id="giftFormMethod" value="">
                    <div class="modal-header border-bottom border-soft">
                        <h5 class="modal-title fw-black" id="giftModalTitle" style="font-weight: 900;">إضافة خيار جديد</h5>
                        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold">الاسم</label>
                                <input id="giftName" name="name" class="form-control rounded-xl border-0"
                                    style="background: var(--bg-light);" placeholder="مثال: صندوق وردي فاخر" required />
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label fw-bold">النوع</label>
                                <select id="giftType" name="type" class="form-select rounded-xl border-0"
                                    style="background: var(--bg-light);" required>
                                    <option value="">— اختر النوع —</option>
                                    @foreach ($typeLabels as $value => $text)
                                        <option value="{{ $value }}">{{ $text }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label fw-bold">السعر (ر.س)</label>
                                <input id="giftPrice" name="price" type="number" step="0.01" min="0"
                                    class="form-control rounded-xl border-0" style="background: var(--bg-light);" placeholder="0.00" required />
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">الوصف (اختياري)</label>
                                <textarea id="giftDescription" name="description" rows="3" class="form-control rounded-xl border-0"
                                    style="background: var(--bg-light);" placeholder="تفاصيل مختصرة عن الصندوق أو الإضافة"></textarea>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold">ترتيب العرض</label>
                                <input id="giftSort" name="sort_order" type="number" min="0"
                                    class="form-control rounded-xl border-0" style="background: var(--bg-light);" placeholder="0" />
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold">أيقونة (Material Icons)</label>
                                <input id="giftIcon" name="icon" class="form-control rounded-xl border-0"
                                    style="background: var(--bg-light);" placeholder="مثال: redeem" />
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold">صورة</label>
                                <input id="giftImage" name="image" type="file" accept="image/*"
                                    class="form-control rounded-xl border-0" style="background: var(--bg-light);" />
                                <div class="small text-secondary-custom mt-1">يُفضّل مقاس مربع 600 بكسل.</div>
                                <div id="giftImagePreview" class="mt-2 small text-secondary-custom"></div>
                            </div>
                            <div class="col-12 d-flex gap-3 flex-wrap">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="giftDefault" name="is_default" value="1" />
                                    <label class="form-check-label fw-semibold" for="giftDefault">اجعله افتراضياً لهذا النوع</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="giftActive" name="is_active" value="1" checked />
                                    <label class="form-check-label fw-semibold" for="giftActive">عرض في الموقع</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer border-top border-soft">
                        <button type="button" class="btn btn-outline-secondary rounded-xl px-4" data-bs-dismiss="modal">
                            إلغاء
                        </button>
                        <button id="giftSubmitBtn" type="submit" class="btn text-white rounded-xl px-4"
                            style="background: var(--primary); border:0;">
                            <span class="material-symbols-outlined align-middle" style="font-size:20px;">save</span>
                            <span class="fw-bold align-middle" id="giftSubmitText">حفظ الخيار</span>
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

    .thumb.thumb-mini {
        width: 40px;
        height: 40px;
        border-radius: 0.75rem;
        background-size: cover;
        background-position: center;
        background-color: #f1f1f1;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('giftForm');
        const methodInput = document.getElementById('giftFormMethod');
        const modalTitle = document.getElementById('giftModalTitle');
        const submitBtnText = document.getElementById('giftSubmitText');
        const imagePreview = document.getElementById('giftImagePreview');
        const fieldName = document.getElementById('giftName');
        const fieldType = document.getElementById('giftType');
        const fieldPrice = document.getElementById('giftPrice');
        const fieldDescription = document.getElementById('giftDescription');
        const fieldIcon = document.getElementById('giftIcon');
        const fieldSort = document.getElementById('giftSort');
        const fieldDefault = document.getElementById('giftDefault');
        const fieldActive = document.getElementById('giftActive');
        const createBtn = document.getElementById('openCreateGift');

        const resetForm = (presetType = null) => {
            form.action = "{{ route('dashboard.gifts.store') }}";
            methodInput.value = '';
            modalTitle.textContent = 'إضافة خيار جديد';
            submitBtnText.textContent = 'حفظ الخيار';
            fieldName.value = '';
            fieldType.value = presetType !== null && presetType !== '' ? presetType : '';
            fieldPrice.value = '';
            fieldDescription.value = '';
            fieldIcon.value = '';
            fieldSort.value = '';
            fieldDefault.checked = false;
            fieldActive.checked = true;
            imagePreview.textContent = '';
            const fileInput = document.getElementById('giftImage');
            if (fileInput) fileInput.value = '';
        };

        document.querySelectorAll('.btn-add-by-type').forEach((btn) => {
            btn.addEventListener('click', () => {
                resetForm(btn.dataset.type || null);
            });
        });

        document.querySelectorAll('.edit-gift').forEach((btn) => {
            btn.addEventListener('click', () => {
                form.action = btn.dataset.action;
                methodInput.value = 'PATCH';
                modalTitle.textContent = 'تعديل خيار التغليف';
                submitBtnText.textContent = 'تحديث البيانات';
                fieldName.value = btn.dataset.name || '';
                fieldType.value = btn.dataset.type || "{{ \App\Models\GiftOption::TYPE_BOX }}";
                fieldPrice.value = btn.dataset.price || '';
                fieldDescription.value = btn.dataset.description || '';
                fieldIcon.value = btn.dataset.icon || '';
                fieldSort.value = btn.dataset.sort || '';
                fieldDefault.checked = btn.dataset.default === '1';
                fieldActive.checked = btn.dataset.active !== '0';
                if (btn.dataset.image) {
                    imagePreview.innerHTML = `<img src="${btn.dataset.image}" alt="preview" class="rounded mt-2" style="width:80px;height:80px;object-fit:cover;">`;
                } else {
                    imagePreview.textContent = '';
                }
            });
        });

        createBtn?.addEventListener('click', () => resetForm(null));
    });
</script>
