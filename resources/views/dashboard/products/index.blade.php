    @extends('dashboard.layouts.master')
    @section('content_dash')
        <!-- Main content -->
            <div class="content-area">
                <div class="container-fluid" style="max-width: 1280px;">
                    <!-- Header -->
                    <header
                        class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
                        <div>
                            <h1 class="display-6 fw-black m-0" style="font-weight: 900;">إدارة المنتجات</h1>
                            <p class="text-secondary-custom mb-0">إدارة قائمة المنتجات وتحديث المخزون</p>
                        </div>

                        <div class="d-flex align-items-center gap-2">
                            <button class="btn btn-light border border-soft rounded-xl px-3 py-2">
                                <span class="material-symbols-outlined align-middle"
                                    style="font-size:20px;">file_upload</span>
                                <span class="fw-bold small align-middle">تصدير</span>
                            </button>

                            <button class="btn text-white rounded-xl px-4 py-2"
                                style="background: var(--primary); border: 0;" data-bs-toggle="modal"
                                data-bs-target="#addProductModal">
                                <span class="material-symbols-outlined align-middle" style="font-size:20px;">add</span>
                                <span class="fw-bold small align-middle">إضافة منتج جديد</span>
                            </button>
                        </div>
                    </header>

                    <!-- Search + Filters -->
                    <div class="panel rounded-xl p-3 p-md-4 shadow-sm mb-4">
                        <div class="row g-3 align-items-center">
                            <div class="col-12 col-md">
                                <div class="search-wrap">
                                    <span class="material-symbols-outlined search-icon">search</span>
                                    <input type="text" class="form-control rounded-xl search-input py-3"
                                        placeholder="بحث عن اسم المنتج، الرقم التسلسلي..." />
                                </div>
                            </div>

                            <div class="col-12 col-md-auto">
                                <div class="d-flex gap-2 flex-wrap">
                                    <select class="form-select rounded-xl border-0"
                                        style="background: var(--bg-light); min-width: 160px;">
                                        <option value="">جميع الأقسام</option>
                                        <option value="gifts">هدايا رجالية</option>
                                        <option value="perfumes">عطور</option>
                                        <option value="flowers">زهور</option>
                                    </select>

                                    <select class="form-select rounded-xl border-0"
                                        style="background: var(--bg-light); min-width: 160px;">
                                        <option value="">حالة المخزون</option>
                                        <option value="instock">متوفر</option>
                                        <option value="lowstock">كمية منخفضة</option>
                                        <option value="outofstock">نفذت الكمية</option>
                                    </select>

                                    <button class="btn rounded-xl border-0" style="background: var(--bg-light);">
                                        <span class="material-symbols-outlined">filter_list</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="panel rounded-xl shadow-sm overflow-hidden">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle m-0 text-end">
                                <thead>
                                    <tr style="background: var(--bg-light);">
                                        <th class="px-4 py-3 text-secondary-custom small fw-bold">المنتج</th>
                                        <th class="px-4 py-3 text-secondary-custom small fw-bold">القسم</th>
                                        <th class="px-4 py-3 text-secondary-custom small fw-bold">السعر</th>
                                        <th class="px-4 py-3 text-secondary-custom small fw-bold">الكمية</th>
                                        <th class="px-4 py-3 text-secondary-custom small fw-bold">الحالة</th>
                                        <th class="px-4 py-3 text-secondary-custom small fw-bold text-center">إجراءات
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <!-- Row 1 -->
                                    <tr>
                                        <td class="px-4 py-3">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="thumb"
                                                    style="background-image:url('https://lh3.googleusercontent.com/aida-public/AB6AXuAp1p5DQr9lr7XmkGFo-NKyneQtJwKnu9fs1phILOJ3uS4qpAgVZqXT2kholamyvOc0om3y9kSdVtkMSoKHHv4ogx-ASp7m_FTwhUC5EfWS4t2ubquLD45LK0RBrgJ9EM_5by-RdC5lTxlTy4k2ef_bZl112o4FMoOgzzAewEXLs_xkkHn40bP_YyqPyLqFipxh9LRLOxWes8Fr7_qoBDfIURTaVHM3hIl0meq1phyFL7TW6B-UUoiiNJZ8Pe-VMqp_mvcm-kivDVM');">
                                                </div>
                                                <div>
                                                    <div class="fw-bold">بوكس هدايا فاخر</div>
                                                    <div class="text-secondary-custom" style="font-size:.75rem;">SKU:
                                                        GB-001</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-secondary-custom fw-semibold">هدايا رجالية</td>
                                        <td class="px-4 py-3 fw-bold">250 ر.س</td>
                                        <td class="px-4 py-3 fw-semibold">45</td>
                                        <td class="px-4 py-3">
                                            <span class="badge rounded-pill" style="background:#dcfce7; color:#15803d;">
                                                <span class="dot me-1" style="background:#22c55e;"></span>
                                                متوفر
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <button class="icon-btn" type="button">
                                                <span class="material-symbols-outlined"
                                                    style="font-size:20px;">edit</span>
                                            </button>
                                            <button class="icon-btn danger" type="button">
                                                <span class="material-symbols-outlined"
                                                    style="font-size:20px;">delete</span>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Row 2 -->
                                    <tr>
                                        <td class="px-4 py-3">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="thumb"
                                                    style="background-image:url('https://lh3.googleusercontent.com/aida-public/AB6AXuAlIe0ZF0ZH4kqYatzB78cyNpHBp7H2CZQXbny1FdavrsFvfA2vD6HSZk5JmYaFqbu_-UmBLjzG5uebcZhs3ty0BOslMsGyjalBSWwO1yFBalTOs8fo0QNqKtvjO2L51an0b0JYZa4T_WZq-5eVIchC8MsoTCEtYejFetj5pPWNGsQlrsHHeaGi1WvPEcL7w4H805QuMaFvxJ91HsBH7T3BHQR7Xd7AhsEZhIPeM7RgIHJHkSxPnn9APzuEb26y5IO-YwQyj2DJFfk');">
                                                </div>
                                                <div>
                                                    <div class="fw-bold">عطر العود الملكي</div>
                                                    <div class="text-secondary-custom" style="font-size:.75rem;">SKU:
                                                        PF-024</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-secondary-custom fw-semibold">عطور</td>
                                        <td class="px-4 py-3 fw-bold">450 ر.س</td>
                                        <td class="px-4 py-3 fw-semibold">3</td>
                                        <td class="px-4 py-3">
                                            <span class="badge rounded-pill" style="background:#ffedd5; color:#c2410c;">
                                                <span class="dot me-1" style="background:#f97316;"></span>
                                                منخفض
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <button class="icon-btn" type="button">
                                                <span class="material-symbols-outlined"
                                                    style="font-size:20px;">edit</span>
                                            </button>
                                            <button class="icon-btn danger" type="button">
                                                <span class="material-symbols-outlined"
                                                    style="font-size:20px;">delete</span>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Row 3 -->
                                    <tr>
                                        <td class="px-4 py-3">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="thumb"
                                                    style="background-image:url('https://lh3.googleusercontent.com/aida-public/AB6AXuD5aojQ3HEWCQaBZV2QUEzmwSsv-tf51kV4v7lEuKP2OgxnuSNdn4B4xQpnlM7srSRKmMHsseKYXGm29vBgrMAsKppjBZSpZM9sg-iFgCrtN8G3j-d2sNYUj7ige56OH8YUFNUt03sbNySqmZvEPE3qY5mX-9vfRkWC9v32Kc4em2tADnx-SwRaAHAdrS-GtctA0DayajRrCaxRovVE8s5zrJuLGvblldhnh3QDkG0OU9aPcZeZpth-GgHwpLWSZ5vM9ejUyELLnvA');">
                                                </div>
                                                <div>
                                                    <div class="fw-bold">باقة ورد جوري أحمر</div>
                                                    <div class="text-secondary-custom" style="font-size:.75rem;">SKU:
                                                        FL-105</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-secondary-custom fw-semibold">زهور</td>
                                        <td class="px-4 py-3 fw-bold">180 ر.س</td>
                                        <td class="px-4 py-3 fw-semibold">0</td>
                                        <td class="px-4 py-3">
                                            <span class="badge rounded-pill" style="background:#fee2e2; color:#b91c1c;">
                                                <span class="dot me-1" style="background:#ef4444;"></span>
                                                نفذت الكمية
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <button class="icon-btn" type="button">
                                                <span class="material-symbols-outlined"
                                                    style="font-size:20px;">edit</span>
                                            </button>
                                            <button class="icon-btn danger" type="button">
                                                <span class="material-symbols-outlined"
                                                    style="font-size:20px;">delete</span>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Row 4 -->
                                    <tr>
                                        <td class="px-4 py-3">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="thumb"
                                                    style="background-image:url('https://lh3.googleusercontent.com/aida-public/AB6AXuAE88t1yOWweOC0ik5ilQdfnFBeteTFa23IRfvGaUXD6-ulpiEn3HCQXxeL-MHBRBhkg9fnPsWUcNalpILBZ4vdxJ7fpSS6xzl90vsE_JoSX82Xz7HL8CpRZ_ugP1y9HQgG-9ukjX7oTygkGF-JXVgBePljI2RUq4oUMkgwIoHQZBSbce2EK2BZ4Z1C3l2_akYBtpKJ27ZvOtlcAG3W2Xvmsqbgq-uwLwux6NTw4qMnm_hQmpHRD3HyqW4I638igyXaVyEi5RSqD8w');">
                                                </div>
                                                <div>
                                                    <div class="fw-bold">علبة شوكولاتة بلجيكية</div>
                                                    <div class="text-secondary-custom" style="font-size:.75rem;">SKU:
                                                        CH-055</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-secondary-custom fw-semibold">حلويات</td>
                                        <td class="px-4 py-3 fw-bold">120 ر.س</td>
                                        <td class="px-4 py-3 fw-semibold">120</td>
                                        <td class="px-4 py-3">
                                            <span class="badge rounded-pill" style="background:#dcfce7; color:#15803d;">
                                                <span class="dot me-1" style="background:#22c55e;"></span>
                                                متوفر
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <button class="icon-btn" type="button">
                                                <span class="material-symbols-outlined"
                                                    style="font-size:20px;">edit</span>
                                            </button>
                                            <button class="icon-btn danger" type="button">
                                                <span class="material-symbols-outlined"
                                                    style="font-size:20px;">delete</span>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex align-items-center justify-content-between p-3 border-top border-soft">
                            <div class="small text-secondary-custom">
                                عرض <span class="fw-bold">1-4</span> من <span class="fw-bold">120</span> منتج
                            </div>

                            <div class="d-flex gap-2">
                                <button class="btn btn-outline-secondary btn-sm rounded-xl" disabled>السابق</button>
                                <button class="btn btn-outline-secondary btn-sm rounded-xl">التالي</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content rounded-2xl panel">
                <div class="modal-header border-bottom border-soft">
                    <h5 class="modal-title fw-black" style="font-weight: 900;">إضافة منتج جديد</h5>
                    <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-4">
                        <!-- Images -->
                        <div class="col-12 col-lg-4">
                            <div class="fw-bold mb-2">صورة المنتج</div>

                            <div class="dropzone">
                                <div class="p-3 rounded-circle"
                                    style="background: var(--surface-light); box-shadow: 0 6px 18px rgba(0,0,0,.06);">
                                    <span class="material-symbols-outlined"
                                        style="font-size:34px; color: var(--primary);">add_photo_alternate</span>
                                </div>
                                <div class="text-center">
                                    <div class="fw-bold">اسحب الصورة هنا</div>
                                    <div class="small text-secondary-custom">أو اضغط للتصفح</div>
                                </div>
                            </div>

                            <div class="row g-2 mt-2">
                                <div class="col-4">
                                    <div class="mini-slot">
                                        <span class="material-symbols-outlined text-secondary-custom">add</span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mini-slot"></div>
                                </div>
                                <div class="col-4">
                                    <div class="mini-slot"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Details -->
                        <div class="col-12 col-lg-8">
                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-bold">اسم المنتج</label>
                                    <input class="form-control rounded-xl border-0" style="background: var(--bg-light);"
                                        placeholder="مثال: بوكس هدايا" />
                                </div>

                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-bold">القسم</label>
                                    <select class="form-select rounded-xl border-0"
                                        style="background: var(--bg-light);">
                                        <option>اختر القسم...</option>
                                        <option>هدايا رجالية</option>
                                        <option>هدايا نسائية</option>
                                        <option>عطور</option>
                                    </select>
                                </div>

                                <div class="col-12 col-md-4">
                                    <label class="form-label fw-bold">السعر (ر.س)</label>
                                    <input type="number" class="form-control rounded-xl border-0"
                                        style="background: var(--bg-light);" placeholder="0.00" />
                                </div>

                                <div class="col-12 col-md-4">
                                    <label class="form-label fw-bold">تكلفة الشراء</label>
                                    <input type="number" class="form-control rounded-xl border-0"
                                        style="background: var(--bg-light);" placeholder="0.00" />
                                </div>

                                <div class="col-12 col-md-4">
                                    <label class="form-label fw-bold">الكمية المتوفرة</label>
                                    <input type="number" class="form-control rounded-xl border-0"
                                        style="background: var(--bg-light);" placeholder="0" />
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-bold">وصف المنتج</label>
                                    <textarea rows="4" class="form-control rounded-xl border-0"
                                        style="background: var(--bg-light);"
                                        placeholder="اكتب وصفاً جذاباً للمنتج..."></textarea>
                                </div>

                                <div class="col-12">
                                    <div class="p-3 rounded-xl" style="background: var(--bg-light);">
                                        <div class="form-check m-0">
                                            <input class="form-check-input" type="checkbox" id="publishNow" />
                                            <label class="form-check-label fw-semibold" for="publishNow">
                                                نشر المنتج فوراً على المتجر
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Details -->
                    </div>
                </div>

                <div class="modal-footer border-top border-soft">
                    <button type="button" class="btn btn-outline-secondary rounded-xl px-4" data-bs-dismiss="modal">
                        إلغاء
                    </button>
                    <button type="button" class="btn text-white rounded-xl px-4"
                        style="background: var(--primary); border:0;">
                        <span class="material-symbols-outlined align-middle" style="font-size:20px;">save</span>
                        <span class="fw-bold align-middle">حفظ المنتج</span>
                    </button>
                </div>
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

        /* Theme */
        html[data-bs-theme="dark"] body {
            background: var(--bg-dark);
            color: var(--text-dark);
        }

        .material-symbols-outlined {
            font-variation-settings: "FILL" 0, "wght" 400, "GRAD" 0, "opsz" 24;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--border-light);
            border-radius: 4px;
        }

        html[data-bs-theme="dark"] ::-webkit-scrollbar-thumb {
            background: var(--border-dark);
        }

        /* Layout */
        .app-wrap {
            min-height: 100vh;
        }

        .sidebar {
            width: 288px;
            /* 72 */
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

        /* Sidebar Links */
        .nav-link-custom {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.85rem 1rem;
            border-radius: var(--r-lg);
            text-decoration: none;
            color: var(--text2-light);
            transition: 0.2s ease;
            font-weight: 600;
        }

        html[data-bs-theme="dark"] .nav-link-custom {
            color: var(--text2-dark);
        }

        .nav-link-custom:hover {
            background: rgba(0, 0, 0, 0.03);
            color: var(--primary);
        }

        html[data-bs-theme="dark"] .nav-link-custom:hover {
            background: rgba(255, 255, 255, 0.04);
        }

        .nav-link-custom.active {
            background: rgba(238, 173, 43, 0.1);
            color: var(--primary);
            font-weight: 800;
        }

        /* Cards */
        .panel {
            background: var(--surface-light);
            border: 1px solid var(--border-light);
        }

        html[data-bs-theme="dark"] .panel {
            background: var(--surface-dark);
            border-color: var(--border-dark);
        }

        /* Search input icon */
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

        html[data-bs-theme="dark"] .search-icon {
            color: var(--text2-dark);
        }

        .search-input {
            padding-right: 44px !important;
            border: 0;
            background: var(--bg-light);
        }

        html[data-bs-theme="dark"] .search-input {
            background: var(--bg-dark);
            color: var(--text-dark);
        }

        /* Table hover */
        .table-hover tbody tr:hover {
            background: rgba(0, 0, 0, 0.02);
        }

        html[data-bs-theme="dark"] .table-hover tbody tr:hover {
            background: rgba(255, 255, 255, 0.03);
        }

        /* Badge dots */
        .dot {
            width: 7px;
            height: 7px;
            border-radius: 999px;
            display: inline-block;
        }

        /* Small icon buttons */
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

        html[data-bs-theme="dark"] .icon-btn {
            color: var(--text2-dark);
        }

        .icon-btn:hover {
            background: rgba(0, 0, 0, 0.03);
            color: var(--primary);
        }

        html[data-bs-theme="dark"] .icon-btn:hover {
            background: rgba(255, 255, 255, 0.04);
        }

        .icon-btn.danger:hover {
            color: #ef4444;
        }

        /* Product thumb */
        .thumb {
            width: 48px;
            height: 48px;
            border-radius: 0.75rem;
            background-size: cover;
            background-position: center;
            flex: 0 0 auto;
            background-color: #f1f1f1;
        }

        html[data-bs-theme="dark"] .thumb {
            background-color: rgba(255, 255, 255, 0.06);
        }

        /* Modal dropzone style */
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
        }

        html[data-bs-theme="dark"] .dropzone {
            border-color: var(--border-dark);
            background: var(--bg-dark);
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

        html[data-bs-theme="dark"] .mini-slot {
            border-color: var(--border-dark);
            background: var(--bg-dark);
        }
    </style>
