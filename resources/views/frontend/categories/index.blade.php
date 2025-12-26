@extends('frontend.layouts.master')













@section('content')
    <div class="container-fluid py-4" style="max-width:1440px;">

      <!-- Breadcrumb + heading -->
      <div class="mb-4">
        <nav class="crumb d-flex flex-wrap gap-2 mb-3 small fw-semibold">
          <a href="#">الرئيسية</a>
          <span class="text-secondary-custom">/</span>
          <a href="#">الهدايا</a>
          <span class="text-secondary-custom">/</span>
          <span class="fw-bold">هدايا أعياد الميلاد</span>
        </nav>

        <div class="d-flex flex-column flex-md-row align-items-md-end justify-content-between gap-3">
          <div>
            <h2 class="fw-black mb-2" style="font-weight:900; font-size:clamp(1.75rem, 2.6vw, 2.4rem);">
              هدايا أعياد الميلاد
            </h2>
            <p class="m-0 text-secondary-custom fs-5" style="max-width:720px;">
              تشكيلة مميزة من الهدايا المختارة بعناية لتناسب أحبائك في يومهم المميز.
            </p>
          </div>

          <div class="dropdown">
            <button class="sort-btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
              <span class="material-symbols-outlined" style="font-size:18px;">sort</span>
              <span>ترتيب حسب: الأكثر ملاءمة</span>
            </button>
            <ul class="dropdown-menu rounded-lg">
              <li><a class="dropdown-item" href="#">الأكثر ملاءمة</a></li>
              <li><a class="dropdown-item" href="#">الأحدث</a></li>
              <li><a class="dropdown-item" href="#">الأقل سعرًا</a></li>
              <li><a class="dropdown-item" href="#">الأعلى سعرًا</a></li>
            </ul>
          </div>
        </div>
      </div>

      <div class="row g-4 align-items-start">

        <!-- Sidebar -->
        <aside class="col-12 col-lg-3">

          <!-- Mobile filter button -->
          <button class="btn w-100 d-lg-none rounded-xl text-start d-flex align-items-center justify-content-between"
                  data-bs-toggle="offcanvas" data-bs-target="#filtersCanvas">
            <span class="fw-bold d-flex align-items-center gap-2">
              <span class="material-symbols-outlined">filter_list</span>
              تصفية النتائج
            </span>
            <span class="material-symbols-outlined">expand_more</span>
          </button>

          <!-- Desktop filters -->
          <div class="filter-card d-none d-lg-block">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <h3 class="m-0 filter-title fs-5">تصفية النتائج</h3>
              <button class="btn btn-link p-0 fw-bold" style="color:var(--primary); font-size:.8rem;">مسح الكل</button>
            </div>

            <div class="filter-section pt-0 mt-0" style="border-top:0;">
              <button class="btn w-100 text-start d-flex align-items-center justify-content-between p-0 mb-3">
                <span class="fw-bold small">نطاق السعر</span>
                <span class="material-symbols-outlined text-secondary">remove</span>
              </button>

              <div class="vstack gap-2">
                <label class="form-check d-flex align-items-center gap-2 m-0">
                  <input class="form-check-input mt-0" type="checkbox">
                  <span class="small text-secondary-custom">أقل من ١٠٠ ر.س</span>
                </label>

                <label class="form-check d-flex align-items-center gap-2 m-0">
                  <input class="form-check-input mt-0" type="checkbox" checked>
                  <span class="small text-secondary-custom">١٠٠ - ٣٠٠ ر.س</span>
                </label>

                <label class="form-check d-flex align-items-center gap-2 m-0">
                  <input class="form-check-input mt-0" type="checkbox">
                  <span class="small text-secondary-custom">٣٠٠ - ٥٠٠ ر.س</span>
                </label>

                <label class="form-check d-flex align-items-center gap-2 m-0">
                  <input class="form-check-input mt-0" type="checkbox">
                  <span class="small text-secondary-custom">أكثر من ٥٠٠ ر.س</span>
                </label>
              </div>
            </div>

            <div class="filter-section">
              <button class="btn w-100 text-start d-flex align-items-center justify-content-between p-0 mb-3">
                <span class="fw-bold small">المناسبة</span>
                <span class="material-symbols-outlined text-secondary">remove</span>
              </button>

              <div class="vstack gap-2">
                <label class="form-check d-flex align-items-center gap-2 m-0">
                  <input class="form-check-input mt-0" type="checkbox">
                  <span class="small text-secondary-custom">أعياد الميلاد</span>
                </label>

                <label class="form-check d-flex align-items-center gap-2 m-0">
                  <input class="form-check-input mt-0" type="checkbox">
                  <span class="small text-secondary-custom">ذكرى زواج</span>
                </label>

                <label class="form-check d-flex align-items-center gap-2 m-0">
                  <input class="form-check-input mt-0" type="checkbox">
                  <span class="small text-secondary-custom">تخرج</span>
                </label>

                <label class="form-check d-flex align-items-center gap-2 m-0">
                  <input class="form-check-input mt-0" type="checkbox">
                  <span class="small text-secondary-custom">مولود جديد</span>
                </label>
              </div>
            </div>

            <div class="filter-section">
              <button class="btn w-100 text-start d-flex align-items-center justify-content-between p-0">
                <span class="fw-bold small">نوع الهدية</span>
                <span class="material-symbols-outlined text-secondary">add</span>
              </button>
            </div>
          </div>
        </aside>

        <!-- Products -->
        <section class="col-12 col-lg-9">

          <!-- Active chips -->
          <div class="d-flex flex-wrap gap-2 mb-3">
            <div class="chip">
              <span>١٠٠ - ٣٠٠ ر.س</span>
              <span class="material-symbols-outlined" style="font-size:16px;">close</span>
            </div>
            <div class="chip">
              <span>أعياد الميلاد</span>
              <span class="material-symbols-outlined" style="font-size:16px;">close</span>
            </div>
            <button class="btn btn-link p-0 small text-secondary-custom" style="text-decoration: underline; text-decoration-style:dotted;">
              مسح جميع المرشحات
            </button>
          </div>

          <!-- Grid -->
          <div class="row g-4 row-cols-1 row-cols-sm-2 row-cols-lg-3">

            <!-- Card 1 -->
            <div class="col">
              <div class="p-card">
                <div class="p-media">
                  <div class="p-badge">الأكثر مبيعاً</div>
                  <div class="p-bg" style="background-image:url('https://lh3.googleusercontent.com/aida-public/AB6AXuB8r7yLPjCx0XZIiypyU21Am28bp74ffBwA8umraajZviI-B8gDH7Al9tFUtQFQC3I108taa3CH9rys4NslXe0O6qIGsEAUKaebOsiyUva-K9gyGMCHnBM1FVM-4N8WNfum30Hz2TGhNzgMYZC7FmGkbABlO45opGXqiXKfpV0KOwgw6T0dr-FdqnM6CRC5aKpmvV0K_C0Z35bWS4yqieA5Ad44tO-mwFOzgjR0VG-apZ9Hfytsbrh3_tv8SgZxuShUcx7J1dShmC4');"></div>

                  <div class="p-overlay">
                    <a href="{{ route('products.index') }}" class="quick-btn" type="button">
                      <span class="material-symbols-outlined">visibility</span>
                    </a>
                    <button class="quick-btn" type="button">
                      <span class="material-symbols-outlined">favorite</span>
                    </button>
                  </div>
                </div>

                <div class="p-3">
                  <h3 class="m-0 fw-bold fs-5">باقة السعادة الوردية</h3>

                  <div class="d-flex align-items-end justify-content-between mt-2">
                    <div class="fw-bold" style="color:var(--primary); font-size:1.25rem;">١٥٠ ر.س</div>
                    <div class="old-price">١٨٠ ر.س</div>
                  </div>

                  <button class="btn btn-primary w-100 rounded-pill fw-bold mt-3 d-flex align-items-center justify-content-center gap-2">
                    <span>اختر الهدية</span>
                    <span class="material-symbols-outlined" style="font-size:18px;">arrow_back</span>
                  </button>
                </div>
              </div>
            </div>

            <!-- Card 2 -->
            <div class="col">
              <div class="p-card">
                <div class="p-media">
                  <div class="p-bg" style="background-image:url('https://lh3.googleusercontent.com/aida-public/AB6AXuDRI2A7dCXSyYueaScJVNUbjEp-9wYVR3DeiK9X-uoUBE00qPSX6iLHfU1Efh1IMTr_yXgbFVVClBHmy80F1cXjIvbGt75RaY1zjDuBa1zUVp6sPNRWe6Pw9KoVtsPx5J4y7YfvQ4MA49h1Ei5Uetv1NegIsay5ITF3EGmTbMWqzebwFAdS6Y9D_RLCjky3vp7FxFCJjklJyTM2xu21EeMIad0g1XkTtUTslKLm6uGrWvHp9ASRRcAF8aCXdbKdQM5KP5qCXwGQ83U');"></div>
                  <div class="p-overlay">
                    <button class="quick-btn" type="button"><span class="material-symbols-outlined">visibility</span></button>
                    <button class="quick-btn" type="button"><span class="material-symbols-outlined">favorite</span></button>
                  </div>
                </div>

                <div class="p-3">
                  <h3 class="m-0 fw-bold fs-5">صندوق المفاجآت الفاخر</h3>
                  <div class="d-flex align-items-end justify-content-between mt-2">
                    <div class="fw-bold" style="color:var(--primary); font-size:1.25rem;">٢٢٠ ر.س</div>
                  </div>

                  <button class="btn btn-primary w-100 rounded-pill fw-bold mt-3 d-flex align-items-center justify-content-center gap-2">
                    <span>اختر الهدية</span>
                    <span class="material-symbols-outlined" style="font-size:18px;">arrow_back</span>
                  </button>
                </div>
              </div>
            </div>

            <!-- Card 3 -->
            <div class="col">
              <div class="p-card">
                <div class="p-media">
                  <div class="p-badge dark">جديد</div>
                  <div class="p-bg" style="background-image:url('https://lh3.googleusercontent.com/aida-public/AB6AXuDByXdxNBLbnBI2lXAc6cYyx2EL0kBUojVs5i1nJJAHPZj9S0sBWlNmMcJkL3WcIlMzFfmnfOO1jQ6S2wYMJQaGdISFxV-jnbgxYDryX1ivx2ZnGll708VVEzwEdNJEXZWWiZdmaqVWq7TkrO0qK83aay_WkIzUx5f7l4MmxNuzGgsP0NI7zp_oeYQwHn5JJyVCyAFheWifCxht6HKVF3OpMZQBkdBwRfy16SVcT3ttbFZZnlk6Zfmxu2SU776FX6PU0Qc_zdOUgoU');"></div>
                  <div class="p-overlay">
                    <button class="quick-btn" type="button"><span class="material-symbols-outlined">visibility</span></button>
                    <button class="quick-btn" type="button"><span class="material-symbols-outlined">favorite</span></button>
                  </div>
                </div>

                <div class="p-3">
                  <h3 class="m-0 fw-bold fs-5">مجموعة الشوكولاتة البلجيكية</h3>
                  <div class="d-flex align-items-end justify-content-between mt-2">
                    <div class="fw-bold" style="color:var(--primary); font-size:1.25rem;">١٨٠ ر.س</div>
                  </div>

                  <button class="btn btn-primary w-100 rounded-pill fw-bold mt-3 d-flex align-items-center justify-content-center gap-2">
                    <span>اختر الهدية</span>
                    <span class="material-symbols-outlined" style="font-size:18px;">arrow_back</span>
                  </button>
                </div>
              </div>
            </div>

            <!-- Card 4 -->
            <div class="col">
              <div class="p-card">
                <div class="p-media">
                  <div class="p-bg" style="background-image:url('https://lh3.googleusercontent.com/aida-public/AB6AXuD5qC-QNfmoDMZ7OMhELkFpYofufLV6iI_blXQgeyQrnzSmOtE3m0tPg3t8NTsI_yh56s68wPge7O9kWRciYnjHIDl5p_ZZ5KmJCe1zdObZE5jHA4fSx7YR2VIWqPD5YQsBneBu-MJwOXZNaw0NneGDRtj8tXvBLWuAeBzhC5nmGAMTe72PRrLcpBvz7TAJ5lShuHdTigkQS6U_-V4cXHqM2K2suLQGDfju682T6wLA-KeYJETXf2rulXie6sdyv_i8rM3infg5dYw');"></div>
                  <div class="p-overlay">
                    <button class="quick-btn" type="button"><span class="material-symbols-outlined">visibility</span></button>
                    <button class="quick-btn" type="button"><span class="material-symbols-outlined">favorite</span></button>
                  </div>
                </div>

                <div class="p-3">
                  <h3 class="m-0 fw-bold fs-5">دمية الدب المحب</h3>
                  <div class="d-flex align-items-end justify-content-between mt-2">
                    <div class="fw-bold" style="color:var(--primary); font-size:1.25rem;">٩٥ ر.س</div>
                  </div>

                  <button class="btn btn-primary w-100 rounded-pill fw-bold mt-3 d-flex align-items-center justify-content-center gap-2">
                    <span>اختر الهدية</span>
                    <span class="material-symbols-outlined" style="font-size:18px;">arrow_back</span>
                  </button>
                </div>
              </div>
            </div>

            <!-- Card 5 -->
            <div class="col">
              <div class="p-card">
                <div class="p-media">
                  <div class="p-badge">عرض خاص</div>
                  <div class="p-bg" style="background-image:url('https://lh3.googleusercontent.com/aida-public/AB6AXuDSlx3_JXFwBPwMPu-oWppKbnynO1vpTWWuHokANTYoS3N5a4v67mOz73SmLSe-xqthB23WF7vdIF4sbEzmUZnfi7VUI0ffGvJx0d-V3XP7rQ3cIepyzY2F7eo0i2X-VcBsKF-Ukz5wPOz3YkCjJiKPybdRHAa0UyLXUHiFEFIG3FM6ncRZ22aasToor7z9cbxj8SCu3HXQ5LKSMJUXIfys6_40u2I__MhnrMjFnXf2V3cFi1SW8THcMMyVueRHkXP7sKpC4YNvzf4');"></div>
                  <div class="p-overlay">
                    <button class="quick-btn" type="button"><span class="material-symbols-outlined">visibility</span></button>
                    <button class="quick-btn" type="button"><span class="material-symbols-outlined">favorite</span></button>
                  </div>
                </div>

                <div class="p-3">
                  <h3 class="m-0 fw-bold fs-5">ساعة كلاسيكية ذهبية</h3>
                  <div class="d-flex align-items-end justify-content-between mt-2">
                    <div class="fw-bold" style="color:var(--primary); font-size:1.25rem;">٣٥٠ ر.س</div>
                    <div class="old-price">٤٥٠ ر.س</div>
                  </div>

                  <button class="btn btn-primary w-100 rounded-pill fw-bold mt-3 d-flex align-items-center justify-content-center gap-2">
                    <span>اختر الهدية</span>
                    <span class="material-symbols-outlined" style="font-size:18px;">arrow_back</span>
                  </button>
                </div>
              </div>
            </div>

            <!-- Card 6 -->
            <div class="col">
              <div class="p-card">
                <div class="p-media">
                  <div class="p-bg" style="background-image:url('https://lh3.googleusercontent.com/aida-public/AB6AXuBjOCo9XCa0dgEq3LmD9mwkNaQpwHhonHj0ucF2ZY3On-1roTuJQOS7BNAkBbqHG827_RnA7YJ9fmGElftOQOW1zvJkjydjBr1Huc-tgnY0RBa51JA1f4nnOafi3zDUTVaR1gXbjEi-qmIqa3_62geqaFVajd6z-pld0IRirsas-mXQ_sKFFklEcZ014EwLFi2IE342kkawY3ygnqcQmtQQ5rgs47oda7ikNP3HPFT73eV_sKvciPFnpx2FZg3Y5M8zt2OF8YjNYK0');"></div>
                  <div class="p-overlay">
                    <button class="quick-btn" type="button"><span class="material-symbols-outlined">visibility</span></button>
                    <button class="quick-btn" type="button"><span class="material-symbols-outlined">favorite</span></button>
                  </div>
                </div>

                <div class="p-3">
                  <h3 class="m-0 fw-bold fs-5">عطر الزهور البرية</h3>
                  <div class="d-flex align-items-end justify-content-between mt-2">
                    <div class="fw-bold" style="color:var(--primary); font-size:1.25rem;">٢٨٠ ر.س</div>
                  </div>

                  <button class="btn btn-primary w-100 rounded-pill fw-bold mt-3 d-flex align-items-center justify-content-center gap-2">
                    <span>اختر الهدية</span>
                    <span class="material-symbols-outlined" style="font-size:18px;">arrow_back</span>
                  </button>
                </div>
              </div>
            </div>

          </div>

          <!-- Pagination -->
          <nav class="d-flex align-items-center justify-content-center gap-2 mt-5">
            <button class="btn page-circle icon-btn text-secondary" type="button">
              <span class="material-symbols-outlined">chevron_right</span>
            </button>

            <button class="btn page-circle btn-primary fw-bold shadow" type="button"
                    style="box-shadow:0 12px 25px rgba(238,43,91,.30)!important;">1</button>

            <button class="btn page-circle icon-btn" type="button">2</button>
            <button class="btn page-circle icon-btn" type="button">3</button>
            <span class="text-secondary">...</span>
            <button class="btn page-circle icon-btn" type="button">12</button>

            <button class="btn page-circle icon-btn" type="button">
              <span class="material-symbols-outlined">chevron_left</span>
            </button>
          </nav>

        </section>
      </div>
    </div>
@endsection



  <!-- Offcanvas filters (Mobile) -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="filtersCanvas" aria-labelledby="filtersCanvasLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title fw-bold" id="filtersCanvasLabel">تصفية النتائج</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <div class="filter-card" style="box-shadow:none;">
        <div class="d-flex align-items-center justify-content-between mb-3">
          <h3 class="m-0 filter-title fs-6">تصفية النتائج</h3>
          <button class="btn btn-link p-0 fw-bold" style="color:var(--primary); font-size:.8rem;">مسح الكل</button>
        </div>

        <div class="filter-section pt-0 mt-0" style="border-top:0;">
          <div class="d-flex align-items-center justify-content-between mb-3">
            <span class="fw-bold small">نطاق السعر</span>
          </div>
          <div class="vstack gap-2">
            <label class="form-check d-flex align-items-center gap-2 m-0">
              <input class="form-check-input mt-0" type="checkbox">
              <span class="small text-secondary-custom">أقل من ١٠٠ ر.س</span>
            </label>
            <label class="form-check d-flex align-items-center gap-2 m-0">
              <input class="form-check-input mt-0" type="checkbox" checked>
              <span class="small text-secondary-custom">١٠٠ - ٣٠٠ ر.س</span>
            </label>
            <label class="form-check d-flex align-items-center gap-2 m-0">
              <input class="form-check-input mt-0" type="checkbox">
              <span class="small text-secondary-custom">٣٠٠ - ٥٠٠ ر.س</span>
            </label>
            <label class="form-check d-flex align-items-center gap-2 m-0">
              <input class="form-check-input mt-0" type="checkbox">
              <span class="small text-secondary-custom">أكثر من ٥٠٠ ر.س</span>
            </label>
          </div>
        </div>

        <div class="filter-section">
          <div class="d-flex align-items-center justify-content-between mb-3">
            <span class="fw-bold small">المناسبة</span>
          </div>
          <div class="vstack gap-2">
            <label class="form-check d-flex align-items-center gap-2 m-0">
              <input class="form-check-input mt-0" type="checkbox">
              <span class="small text-secondary-custom">أعياد الميلاد</span>
            </label>
            <label class="form-check d-flex align-items-center gap-2 m-0">
              <input class="form-check-input mt-0" type="checkbox">
              <span class="small text-secondary-custom">ذكرى زواج</span>
            </label>
            <label class="form-check d-flex align-items-center gap-2 m-0">
              <input class="form-check-input mt-0" type="checkbox">
              <span class="small text-secondary-custom">تخرج</span>
            </label>
            <label class="form-check d-flex align-items-center gap-2 m-0">
              <input class="form-check-input mt-0" type="checkbox">
              <span class="small text-secondary-custom">مولود جديد</span>
            </label>
          </div>
        </div>

        <div class="filter-section">
          <div class="d-flex align-items-center justify-content-between">
            <span class="fw-bold small">نوع الهدية</span>
            <span class="material-symbols-outlined text-secondary">add</span>
          </div>
        </div>

        <button class="btn btn-primary w-100 rounded-pill fw-bold mt-4" data-bs-dismiss="offcanvas">
          تطبيق
        </button>
      </div>
    </div>
  </div>





