<x-guest-layout>
    <div class="d-flex flex-column flex-md-row align-items-stretch gap-2 mb-3">
        <a href="{{ route('login.google') }}" class="btn btn-light border rounded-xl py-2 w-100 flex-md-1 d-flex align-items-center justify-content-center gap-2"
            style="background:#fff; border-color:#f3e7ea;">
            <span class="material-symbols-outlined" style="font-size:20px;">account_circle</span>
            التسجيل بواسطة Google
        </a>
        <a href="{{ route('login.phone') }}" class="btn btn-outline-secondary rounded-xl py-2 w-100 flex-md-1 d-flex align-items-center justify-content-center gap-2"
            style="border-color:#f3e7ea;">
            <span class="material-symbols-outlined" style="font-size:20px;">smartphone</span>
            التسجيل برقم الهاتف
        </a>
    </div>

    <div class="text-center text-muted small mb-2">أو أدخل بياناتك للتسجيل بالبريد الإلكتروني</div>

    <form method="POST" action="{{ route('register') }}" class="d-flex flex-column gap-3">
        @csrf

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-bold small mb-1" for="name">الاسم الكامل</label>
                <input id="name" type="text" name="name" class="form-control" placeholder="الاسم"
                    value="{{ old('name') }}" required autofocus autocomplete="name">
                @error('name')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold small mb-1" for="email">البريد الإلكتروني</label>
                <input id="email" type="email" name="email" class="form-control" placeholder="name@email.com"
                    value="{{ old('email') }}" required autocomplete="username">
                @error('email')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-bold small mb-1" for="password">كلمة المرور</label>
                <input id="password" type="password" name="password" class="form-control" placeholder="********" required
                    autocomplete="new-password">
                @error('password')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold small mb-1" for="password_confirmation">تأكيد كلمة المرور</label>
                <input id="password_confirmation" type="password" name="password_confirmation" class="form-control"
                    placeholder="********" required autocomplete="new-password">
                @error('password_confirmation')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="p-3 rounded-3" style="background: #fff5f7; border:1px solid #f3e7ea;">
            <div class="small fw-bold mb-1" style="color:#9a4c5f;">سياسة الخصوصية</div>
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 small text-muted">
                <span>نلتزم بحماية بياناتك واستخدامها فقط لإنشاء حساب جديد.</span>
                <span>لا نقوم بمشاركة معلوماتك مع أي طرف ثالث دون موافقتك.</span>
            </div>
        </div>

        <button type="submit" class="auth-btn mt-1">إنشاء حساب جديد</button>

        <div class="text-center mt-2">
            <span class="text-muted small">لديك حساب بالفعل؟</span>
            <a class="link-muted small ms-1" href="{{ route('login') }}">تسجيل الدخول</a>
        </div>
    </form>
</x-guest-layout>
