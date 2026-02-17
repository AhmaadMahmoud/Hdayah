        <!-- Sidebar -->
        <aside class="sidebar d-none d-md-flex flex-column">
            <div class="p-4 p-lg-4 d-flex align-items-center gap-3">
                <div class="p-2 rounded-xl" style="background: rgba(238,173,43,.2); border-radius: var(--r-lg);">
                    <span class="material-symbols-outlined text-primary-custom" style="font-size:32px;">redeem</span>
                </div>
                <div class="d-flex flex-column">
                    <h1 class="h5 m-0 fw-bold">إدارة هدايا</h1>
                    <p class="m-0 small text-sec fw-semibold">لوحة تحكم الإدارة</p>
                </div>
            </div>

            <nav class="flex-grow-1 overflow-auto px-3 pb-2">
                <div class="d-flex flex-column gap-1">
                    <a class="nav-item-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <span class="material-symbols-outlined">dashboard</span>
                        <span class="small fw-bold">لوحة التحكم</span>
                    </a>

                    <a class="nav-item-link {{ request()->routeIs('dashboard.products.index') ? 'active' : '' }}" href="{{ route('dashboard.products.index') }}">
                        <span class="material-symbols-outlined ico">inventory_2</span>
                        <span class="small fw-semibold">المنتجات</span>
                    </a>

                    <a class="nav-item-link {{ request()->routeIs('dashboard.categories.index') ? 'active' : '' }}" href="{{ route('dashboard.categories.index') }}">
                        <span class="material-symbols-outlined ico">category</span>
                        <span class="small fw-semibold">الأقسام</span>
                    </a>

                    <a class="nav-item-link {{ request()->routeIs('dashboard.gifts.index') ? 'active' : '' }}" href="{{ route('dashboard.gifts.index') }}">
                        <span class="material-symbols-outlined ico">card_giftcard</span>
                        <span class="small fw-semibold">تخصيص الهدية</span>
                    </a>

                    <a class="nav-item-link {{ request()->routeIs('dashboard.filters.*') ? 'active' : '' }}" href="{{ route('dashboard.filters.edit') }}">
                        <span class="material-symbols-outlined ico">tune</span>
                        <span class="small fw-semibold">الفلاتر</span>
                    </a>

                    <a class="nav-item-link" href="#">
                        <span class="material-symbols-outlined ico">cloud_upload</span>
                        <span class="small fw-semibold">تحميلات المنتجات</span>
                    </a>

                    <a class="nav-item-link" href="#">
                        <span class="material-symbols-outlined ico">shopping_cart</span>
                        <span class="small fw-semibold">الطلبات</span>
                    </a>

                    <a class="nav-item-link" href="#">
                        <span class="material-symbols-outlined ico">group</span>
                        <span class="small fw-semibold">العملاء</span>
                    </a>
                    <a class="nav-item-link" href="{{ route('dashboard.users.index') }}">
                        <span class="material-symbols-outlined ico">group</span>
                        <span class="small fw-semibold">المستخدمون</span>
                    </a>

                    <a class="nav-item-link" href="#">
                        <span class="material-symbols-outlined ico">monitoring</span>
                        <span class="small fw-semibold">التقارير</span>
                    </a>

                    <a class="nav-item-link" href="#">
                        <span class="material-symbols-outlined ico">settings</span>
                        <span class="small fw-semibold">الإعدادات</span>
                    </a>
                </div>
            </nav>

            <div class="p-3 border-top" style="border-top-color: var(--border)!important;">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="logout-btn" type="submit">
                        <span class="material-symbols-outlined">logout</span>
                        <span class="small fw-bold">تسجيل الخروج</span>
                    </button>
                </form>
            </div>
        </aside>
