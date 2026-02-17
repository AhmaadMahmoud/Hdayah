            <header class="topbar px-3 px-md-4 d-flex align-items-center justify-content-between flex-shrink-0">
                <div class="d-flex align-items-center gap-2 gap-md-3">
                    <button class="btn d-md-none p-2 bg-surface-hi rounded-xl" type="button">
                        <span class="material-symbols-outlined">menu</span>
                    </button>
                    <h2 class="h5 m-0 fw-bold d-none d-sm-block">لوحة التحكم الرئيسية</h2>
                </div>

                <div class="d-flex align-items-center gap-3 flex-grow-1 justify-content-end">
                    <!-- Search -->
                    <div class="d-none d-md-block w-100" style="max-width:520px;">
                        <div class="search-wrap">
                            <span class="material-symbols-outlined search-ico" style="font-size:20px;">search</span>
                            <input class="form-control search-input" placeholder="بحث في النظام..." />
                        </div>
                    </div>

                    <!-- Actions -->
                    <button class="icon-btn" type="button" aria-label="Notifications">
                        <span class="material-symbols-outlined" style="font-size:22px;">notifications</span>
                        <span
                            style="position:absolute; top:10px; right:12px; width:8px; height:8px; background:#ef4444; border-radius:999px; border:2px solid #fff;"></span>
                    </button>

                    <div class="d-flex align-items-center gap-3 pe-2 me-2"
                        style="border-right:1px solid var(--border);">
                        <div class="d-none d-lg-flex flex-column align-items-end">
                            <span class="small fw-bold">{{ auth()->user()->name }} </span>
                            <span class="text-sec" style="font-size:.75rem;">{{ auth()->user()->role }}</span>
                        </div>
                        <div class="avatar"
                            style="background-image:url('https://lh3.googleusercontent.com/aida-public/AB6AXuDq1yATgFu9KU3eGOQcyrPtRgyxg4VpImoYNHrF-8cwQ5rkPqoAyQpo4RcDoIpSX81Besc-18VlVz3aydur9VXvEVmz3PbGTUQc79-kfBA40mSJ-RhYkp3axlKsNWjEOPpp5glFos7mDErIDT_miagtudTYoEr4lMkFL2IFa6jNUXeMjHQ-78pB1Wovk6olf1-4Yrp-pB6zLHDSqaIf5pmNHoT-YBZUOpdcFDTqsbOPYVeUZADgsrDKmip9kcZlblUVAF4LJzrMALo');"
                            aria-label="صورة الملف الشخصي"></div>
                    </div>

                </div>
            </header>
