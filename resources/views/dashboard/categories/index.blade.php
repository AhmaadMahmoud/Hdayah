@extends('dashboard.layouts.master')

@section('content_dash')
    <div class="content-area">
        <div class="container-fluid" style="max-width: 1280px;">
            <header class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
                <div>
                    <h1 class="display-6 fw-black m-0" style="font-weight: 900;">التصنيفات</h1>
                    <p class="text-secondary-custom mb-0">إدارة التصنيفات وعرض صورها في الجدول. يمكنك إضافة تصنيف جديد أو تعديل
                        الموجود والتأكد من ظهور الصور.</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <button class="btn text-white rounded-xl px-4 py-2" style="background: var(--primary); border: 0;"
                        data-bs-toggle="modal" data-bs-target="#categoryModal" id="openCreateCategory">
                        <span class="material-symbols-outlined align-middle" style="font-size:20px;">add</span>
                        <span class="fw-bold small align-middle">إضافة تصنيف</span>
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

            <div class="panel rounded-xl shadow-sm overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-hover align-middle m-0 text-end">
                        <thead>
                            <tr style="background: var(--bg-light);">
                                <th class="px-4 py-3 text-secondary-custom small fw-bold">اسم التصنيف</th>
                                <th class="px-4 py-3 text-secondary-custom small fw-bold">الصورة</th>
                                <th class="px-4 py-3 text-secondary-custom small fw-bold text-center">إجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                @php
                                    $img = $category->image;
                                    $imageUrl = $img
                                        ? (preg_match('/^https?:\/\//', $img)
                                            ? $img
                                            : asset('storage/' . ltrim($img, '/')))
                                        : null;
                                @endphp
                                <tr>
                                    <td class="px-4 py-3 fw-bold">{{ $category->name }}</td>
                                    <td class="px-4 py-3">
                                        @if ($imageUrl)
                                            <span class="thumb thumb-mini" style="background-image:url('{{ $imageUrl }}');"></span>
                                        @else
                                            <span class="text-secondary-custom small">لا توجد صورة</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <button class="icon-btn edit-category" type="button" data-bs-toggle="modal"
                                            data-bs-target="#categoryModal"
                                            data-action="{{ route('dashboard.categories.update', $category) }}"
                                            data-name="{{ $category->name }}"
                                            data-image="{{ $imageUrl }}">
                                            <span class="material-symbols-outlined" style="font-size:20px;">edit</span>
                                        </button>
                                        <form method="POST" action="{{ route('dashboard.categories.destroy', $category) }}"
                                            class="d-inline" onsubmit="return confirm('هل تريد حذف هذا التصنيف؟');">
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
                                    <td colspan="3" class="px-4 py-4 text-center text-secondary-custom">لا توجد تصنيفات حتى الآن.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex align-items-center justify-content-between p-3 border-top border-soft">
                    <div class="small text-secondary-custom">
                        إجمالي <span class="fw-bold">{{ $categories->count() }}</span> تصنيف/تصنيفات.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="categoryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content rounded-2xl panel">
                <form id="categoryForm" method="POST" action="{{ route('dashboard.categories.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" id="catMethod" value="">
                    <div class="modal-header border-bottom border-soft">
                        <h5 class="modal-title fw-black" id="categoryModalTitle" style="font-weight: 900;">إضافة تصنيف</h5>
                        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-4">
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold">اسم التصنيف</label>
                                <input id="catName" name="name" class="form-control rounded-xl border-0"
                                    style="background: var(--bg-light);" placeholder="مثال: عناية شخصية" required />
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold">صورة التصنيف (اختياري)</label>
                                <input id="catImage" name="image" type="file" accept="image/*"
                                    class="form-control rounded-xl border-0" style="background: var(--bg-light);" />
                            </div>
                            <div class="col-12">
                                <div class="small text-secondary-custom mb-2">معاينة الصورة قبل الحفظ:</div>
                                <div id="catImagePreview" class="mini-slot" style="width: 120px; height: 120px;">
                                    <span class="text-secondary-custom small">لا توجد صورة</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top border-soft">
                        <button type="button" class="btn btn-outline-secondary rounded-xl px-4" data-bs-dismiss="modal">
                            إلغاء
                        </button>
                        <button id="catSubmitBtn" type="submit" class="btn text-white rounded-xl px-4"
                            style="background: var(--primary); border:0;">
                            <span class="material-symbols-outlined align-middle" style="font-size:20px;">save</span>
                            <span class="fw-bold align-middle" id="catSubmitText">حفظ التصنيف</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<style>
    .mini-slot {
        border: 1px solid var(--border-light);
        background: var(--bg-light);
        border-radius: 0.75rem;
        aspect-ratio: 1/1;
        display: flex;
        align-items: center;
        justify-content: center;
        background-size: cover;
        background-position: center;
    }

    .thumb {
        width: 48px;
        height: 48px;
        border-radius: 0.75rem;
        background-size: cover;
        background-position: center;
        display: inline-block;
        background-color: #f1f1f1;
    }

    .thumb.thumb-mini {
        width: 40px;
        height: 40px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('categoryForm');
        const methodInput = document.getElementById('catMethod');
        const modalTitle = document.getElementById('categoryModalTitle');
        const submitText = document.getElementById('catSubmitText');
        const nameInput = document.getElementById('catName');
        const imageInput = document.getElementById('catImage');
        const preview = document.getElementById('catImagePreview');
        const createBtn = document.getElementById('openCreateCategory');

        const resetForm = () => {
            form.action = "{{ route('dashboard.categories.store') }}";
            methodInput.value = '';
            modalTitle.textContent = 'إضافة تصنيف';
            submitText.textContent = 'حفظ التصنيف';
            nameInput.value = '';
            imageInput.value = '';
            preview.style.backgroundImage = 'none';
            preview.innerHTML = '<span class="text-secondary-custom small">لا توجد صورة</span>';
        };

        const setPreview = (url) => {
            preview.style.backgroundImage = url ? `url('${url}')` : 'none';
            preview.innerHTML = url ? '' : '<span class="text-secondary-custom small">لا توجد صورة</span>';
        };

        imageInput?.addEventListener('change', () => {
            const file = imageInput.files?.[0];
            if (file && file.type.startsWith('image/')) {
                const url = URL.createObjectURL(file);
                setPreview(url);
            } else {
                setPreview('');
            }
        });

        document.querySelectorAll('.edit-category').forEach((btn) => {
            btn.addEventListener('click', () => {
                form.action = btn.dataset.action;
                methodInput.value = 'PATCH';
                modalTitle.textContent = 'تعديل التصنيف';
                submitText.textContent = 'حفظ التعديلات';
                nameInput.value = btn.dataset.name || '';
                imageInput.value = '';
                setPreview(btn.dataset.image || '');
            });
        });

        createBtn?.addEventListener('click', () => resetForm());
    });
</script>
