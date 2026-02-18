<x-guest-layout>
    <!-- رسالة عند إعادة التوجيه لعدم تسجيل الدخول (هدية/سلة) -->
    @if (session('login_required') || request('login_required'))
        <div class="alert alert-info small mb-3" role="alert">
            {{ session('login_required', 'يجب تسجيل الدخول أولاً لاختيار الهدية أو إضافتها إلى السلة.') }}
        </div>
    @endif
    <!-- Session Status -->
    @if (session('status'))
        <div class="alert alert-success small mb-3" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="d-flex flex-column gap-3">
        @csrf

        <div>
            <label class="form-label fw-bold small mb-1" for="email">البريد الإلكتروني</label>
            <input id="email" type="email" name="email" class="form-control" placeholder="name@email.com"
                value="{{ old('email') }}" required autofocus autocomplete="username">
            @error('email')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label class="form-label fw-bold small mb-1" for="password">كلمة المرور</label>
            <input id="password" type="password" name="password" class="form-control" placeholder="••••••••" required
                autocomplete="current-password">
            @error('password')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <div class="form-check m-0">
                <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                <label class="form-check-label small fw-semibold" for="remember_me">
                    تذكرني
                </label>
            </div>

            @if (Route::has('password.request'))
                <a class="link-muted small" href="{{ route('password.request') }}">نسيت كلمة المرور؟</a>
            @endif
        </div>

        <button type="submit" class="auth-btn mt-2">تسجيل الدخول</button>

        <div class="d-grid gap-2 mt-2">
            <a class="btn btn-light border rounded-xl py-2 d-flex align-items-center justify-content-center gap-2"
                style="background:#fff; border-color:#f3e7ea;" href="{{ route('login.google') }}">
                <span class="material-symbols-outlined" style="font-size:20px;">account_circle</span>
                تسجيل الدخول عبر Google
            </a>
            <a class="btn btn-outline-secondary rounded-xl py-2 d-flex align-items-center justify-content-center gap-2"
                style="border-color:#f3e7ea;" href="{{ route('login.phone') }}">
                <span class="material-symbols-outlined" style="font-size:20px;">smartphone</span>
                تسجيل الدخول برقم الجوال
            </a>
        </div>

        <div class="text-center mt-2">
            <span class="text-muted small">ليس لديك حساب؟</span>
            <a class="link-muted small ms-1" href="{{ route('register') }}">إنشاء حساب</a>
        </div>
    </form>
</x-guest-layout>
