        <!-- Header -->
        <header class="sticky-top border-bottom gc-border"
            style="background: rgba(248,246,246,.80); backdrop-filter: blur(10px);">
            <div class="container" style="max-width:1280px;">
                <div class="d-flex align-items-center justify-content-between py-3">

                    <div class="d-flex align-items-center gap-3">
                        <div class="icon-pill">
                            <span class="material-symbols-outlined fs-3">card_giftcard</span>
                        </div>
                        <h2 class="m-0 fw-bold" style="letter-spacing:-.02em;">هديتي</h2>
                    </div>

                    <nav class="d-none d-md-flex align-items-center gap-4">
                        <a class="fw-bold text-decoration-none" style="color:inherit" href="{{ url('/') }}">الرئيسية</a>
                        {{-- <a class="text-decoration-none opacity-75" style="color:inherit" href="{{ route('cat.index') }}">المتجر</a> --}}
                        <a class="text-decoration-none opacity-75" style="color:inherit" href="{{ route('products.index') }}">المناسبات</a>
                        <a class="text-decoration-none opacity-75" style="color:inherit" href="{{ url('/dashboard') }}">تواصل معنا</a>
                    </nav>

                    <div class="d-flex align-items-center gap-2">
                        <button class="pill-btn" type="button" aria-label="Cart">
                            <span class="material-symbols-outlined" style="font-size:20px;">shopping_cart</span>
                        </button>
                        <button class="pill-btn" type="button" aria-label="Search">
                            <span class="material-symbols-outlined" style="font-size:20px;">search</span>
                        </button>

                        @auth
                            <div class="dropdown">
                                <button class="user-avatar-btn d-flex align-items-center justify-content-center"
                                    type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="material-symbols-outlined" style="font-size:22px;">person</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end profile-menu" aria-labelledby="userMenu">
                                    <li class="profile-top">
                                        <div class="fw-bold">{{ auth()->user()->name }}</div>
                                        <div class="text-muted small">{{ auth()->user()->email }}</div>
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button class="dropdown-item d-flex align-items-center gap-2 py-2" type="submit">
                                                <span class="material-symbols-outlined" style="font-size:18px;">logout</span>
                                                تسجيل الخروج
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <a class="pill-btn d-flex align-items-center justify-content-center text-decoration-none"
                                href="{{ route('login') }}" aria-label="Login">
                                <span class="material-symbols-outlined" style="font-size:20px;">login</span>
                            </a>
                        @endauth
                    </div>

                </div>
            </div>
        </header>

        <style>
            .user-avatar-btn {
                width: 44px;
                height: 44px;
                border-radius: 50%;
                border: 0;
                background: linear-gradient(135deg, #ee2b5b, #f48fb1);
                color: #fff;
                box-shadow: 0 10px 20px rgba(238, 43, 91, .25);
            }

            .profile-menu {
                min-width: 240px;
                border-radius: 16px;
                border: 1px solid #f3e7ea;
                box-shadow: 0 16px 40px rgba(0, 0, 0, .08);
                padding: 0;
                overflow: hidden;
            }

            .profile-menu .profile-top {
                padding: 12px 14px;
                background: #fff5f7;
                border-bottom: 1px solid #f3e7ea;
            }

            .profile-menu .dropdown-item:hover {
                background: rgba(238, 43, 91, .06);
                color: #ee2b5b;
            }
        </style>


