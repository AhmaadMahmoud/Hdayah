@extends('dashboard.layouts.master')
@section('content_dash')
            <div class="content-scroll p-3 p-md-4">
                <div class="container-fluid" style="max-width: 1280px;">
                    <div class="d-flex flex-column gap-4 gap-md-5">

                        <!-- KPI -->
                        <section class="row g-3 g-md-4">
                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="kpi-card">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div class="p-2 rounded-xl" style="background:#eff6ff; color:#2563eb;">
                                            <span class="material-symbols-outlined">shopping_bag</span>
                                        </div>
                                        <span class="pill" style="background:#ecfdf5; color:#16a34a;">
                                            <span class="material-symbols-outlined"
                                                style="font-size:14px;">trending_up</span>
                                            +5%
                                        </span>
                                    </div>
                                    <div class="text-sec small fw-semibold mb-1">عدد الطلبات اليوم</div>
                                    <div class="display-6 fw-bold m-0" style="font-size:2rem;">42</div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="kpi-card">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div class="p-2 rounded-xl"
                                            style="background: rgba(238,173,43,.10); color: var(--primary);">
                                            <span class="material-symbols-outlined">payments</span>
                                        </div>
                                        <span class="pill" style="background:#ecfdf5; color:#16a34a;">
                                            <span class="material-symbols-outlined"
                                                style="font-size:14px;">trending_up</span>
                                            +12%
                                        </span>
                                    </div>
                                    <div class="text-sec small fw-semibold mb-1">المبيعات اليوم</div>
                                    <div class="fw-bold" style="font-size:2rem;">
                                        1,240 <span class="text-sec"
                                            style="font-size:1rem; font-weight:500;">ر.س</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="kpi-card">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div class="p-2 rounded-xl" style="background:#f3e8ff; color:#7c3aed;">
                                            <span class="material-symbols-outlined">local_shipping</span>
                                        </div>
                                        <span class="pill" style="background:#ecfdf5; color:#16a34a;">
                                            <span class="material-symbols-outlined"
                                                style="font-size:14px;">trending_up</span>
                                            +2%
                                        </span>
                                    </div>
                                    <div class="text-sec small fw-semibold mb-1">الطلبات الجديدة</div>
                                    <div class="display-6 fw-bold m-0" style="font-size:2rem;">15</div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="kpi-card">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div class="p-2 rounded-xl" style="background:#fff7ed; color:#ea580c;">
                                            <span class="material-symbols-outlined">person_add</span>
                                        </div>
                                        <span class="pill" style="background:#ecfdf5; color:#16a34a;">
                                            <span class="material-symbols-outlined"
                                                style="font-size:14px;">trending_up</span>
                                            +4%
                                        </span>
                                    </div>
                                    <div class="text-sec small fw-semibold mb-1">عدد العملاء الجدد</div>
                                    <div class="display-6 fw-bold m-0" style="font-size:2rem;">8</div>
                                </div>
                            </div>
                        </section>

                        <!-- Tiles -->
                        <section>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h3 class="h5 fw-bold m-0">أقسام لوحة التحكم</h3>
                            </div>

                            <div class="row g-3 g-md-4">
                                <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                                    <a class="tile" href="#">
                                        <div class="tile-ico">
                                            <span class="material-symbols-outlined"
                                                style="font-size:28px; color:var(--text-main);">inventory_2</span>
                                        </div>
                                        <h4 class="h6 fw-bold mb-1">المنتجات</h4>
                                        <p class="text-sec small m-0">إدارة المخزون والهدايا</p>
                                    </a>
                                </div>

                                <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                                    <a class="tile" href="#">
                                        <div class="tile-ico">
                                            <span class="material-symbols-outlined"
                                                style="font-size:28px; color:var(--text-main);">cloud_upload</span>
                                        </div>
                                        <h4 class="h6 fw-bold mb-1">رفع منتج جديد</h4>
                                        <p class="text-sec small m-0">إضافة هدايا جديدة للمتجر</p>
                                    </a>
                                </div>

                                <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                                    <a class="tile" href="#">
                                        <div class="tile-ico">
                                            <span class="material-symbols-outlined"
                                                style="font-size:28px; color:var(--text-main);">shopping_cart</span>
                                        </div>
                                        <h4 class="h6 fw-bold mb-1">الطلبات</h4>
                                        <p class="text-sec small m-0">متابعة الطلبات الحالية</p>
                                    </a>
                                </div>

                                <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                                    <a class="tile" href="#">
                                        <div class="tile-ico">
                                            <span class="material-symbols-outlined"
                                                style="font-size:28px; color:var(--text-main);">receipt_long</span>
                                        </div>
                                        <h4 class="h6 fw-bold mb-1">تفاصيل الطلبات</h4>
                                        <p class="text-sec small m-0">عرض تفاصيل كل طلب</p>
                                    </a>
                                </div>

                                <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                                    <a class="tile" href="#">
                                        <div class="tile-ico">
                                            <span class="material-symbols-outlined"
                                                style="font-size:28px; color:var(--text-main);">group</span>
                                        </div>
                                        <h4 class="h6 fw-bold mb-1">تحليلات العملاء</h4>
                                        <p class="text-sec small m-0">فهم سلوك المشترين</p>
                                    </a>
                                </div>

                                <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                                    <a class="tile" href="#">
                                        <div class="tile-ico">
                                            <span class="material-symbols-outlined"
                                                style="font-size:28px; color:var(--text-main);">monitoring</span>
                                        </div>
                                        <h4 class="h6 fw-bold mb-1">تحليل المبيعات</h4>
                                        <p class="text-sec small m-0">تقارير الأداء المالي</p>
                                    </a>
                                </div>

                                <!-- Settings wide -->
                                <div class="col-12 col-sm-12 col-lg-4 col-xl-6">
                                    <a class="tile" href="#">
                                        <div class="tile-ico">
                                            <span class="material-symbols-outlined"
                                                style="font-size:28px; color:var(--text-main);">settings</span>
                                        </div>
                                        <h4 class="h6 fw-bold mb-1">الإعدادات</h4>
                                        <p class="text-sec small m-0">تهيئة النظام وتفضيلات الحساب</p>
                                    </a>
                                </div>
                            </div>
                        </section>

                        <!-- Quick + Activity -->
                        <section class="row g-3 g-md-4 align-items-start">
                            <!-- Quick -->
                            <div class="col-12 col-lg-4">
                                <h3 class="h5 fw-bold mb-3">إجراءات سريعة</h3>

                                <button
                                    class="quick-primary w-100 d-flex align-items-center justify-content-center gap-2 mb-3"
                                    type="button">
                                    <span class="material-symbols-outlined">add_circle</span>
                                    <span>إنشاء طلب جديد</span>
                                </button>

                                <button
                                    class="quick-secondary w-100 d-flex align-items-center justify-content-center gap-2"
                                    type="button">
                                    <span class="material-symbols-outlined text-sec">post_add</span>
                                    <span>إضافة منتج للمتجر</span>
                                </button>
                            </div>

                            <!-- Activity -->
                            <div class="col-12 col-lg-8">
                                <div class="activity-card">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <h3 class="h6 fw-bold m-0">النشاط الأخير</h3>
                                        <a class="text-decoration-none fw-bold" style="color:var(--primary);"
                                            href="#">عرض الكل</a>
                                    </div>

                                    <div class="d-flex flex-column gap-3">
                                        <!-- Item 1 -->
                                        <div class="activity-item">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                                                style="width:40px;height:40px;background:#dcfce7;color:#16a34a;">
                                                <span class="material-symbols-outlined"
                                                    style="font-size:22px;">check_circle</span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="small fw-bold">تم اكتمال الطلب #40293</div>
                                                <div class="text-sec" style="font-size:.75rem;">عميل: سارة أحمد • منذ
                                                    15 دقيقة</div>
                                            </div>
                                            <div class="small fw-bold">350 ر.س</div>
                                        </div>

                                        <!-- Item 2 -->
                                        <div class="activity-item">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                                                style="width:40px;height:40px;background:#dbeafe;color:#2563eb;">
                                                <span class="material-symbols-outlined"
                                                    style="font-size:22px;">inventory</span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="small fw-bold">نفاد كمية "صندوق الشوكولاتة الفاخر"</div>
                                                <div class="text-sec" style="font-size:.75rem;">المخزون • منذ 45 دقيقة
                                                </div>
                                            </div>
                                            <span class="pill"
                                                style="background:#fef2f2;color:#ef4444;">تنبيه</span>
                                        </div>

                                        <!-- Item 3 -->
                                        <div class="activity-item">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                                                style="width:40px;height:40px;background: rgba(238,173,43,.2); color: var(--primary);">
                                                <span class="material-symbols-outlined"
                                                    style="font-size:22px;">person_add</span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="small fw-bold">تسجيل عميل جديد: محمد علي</div>
                                                <div class="text-sec" style="font-size:.75rem;">المستخدمين • منذ
                                                    ساعتين</div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </section>

                    </div>
                </div>
            </div>
@endsection
