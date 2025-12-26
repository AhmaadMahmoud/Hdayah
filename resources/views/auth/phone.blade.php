<x-guest-layout>
    @if (session('status'))
        <div class="alert alert-success small mb-3" role="alert">
            {{ session('status') }}
            @if (session('dev_code'))
                <div class="mt-1 text-muted">رمز (للتجربة): {{ session('dev_code') }}</div>
            @endif
        </div>
    @endif

    <form method="POST" action="{{ route('login.phone.send') }}" class="d-flex flex-column gap-3">
        @csrf
        <div>
            <label class="form-label fw-bold small mb-1" for="phone">رقم الجوال</label>
            <input id="phone" type="text" name="phone" class="form-control" placeholder="05XXXXXXXX"
                value="{{ old('phone', session('phone')) }}" required>
            @error('phone')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="auth-btn">إرسال الرمز</button>
    </form>

    <div class="text-center text-muted small my-2">أو أدخل الرمز إذا وصلك</div>

    <form method="POST" action="{{ route('login.phone.verify') }}" class="d-flex flex-column gap-3">
        @csrf
        <div>
            <label class="form-label fw-bold small mb-1" for="phone_verify">رقم الجوال</label>
            <input id="phone_verify" type="text" name="phone" class="form-control" placeholder="05XXXXXXXX"
                value="{{ old('phone', session('phone')) }}" required>
        </div>
        <div>
            <label class="form-label fw-bold small mb-1" for="code">رمز التحقق</label>
            <input id="code" type="text" name="code" class="form-control" placeholder="123456" required>
            @error('code')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-dark w-100 rounded-xl py-2">تسجيل الدخول</button>
    </form>

    <div class="text-center mt-3">
        <a class="link-muted small" href="{{ route('login') }}">تسجيل الدخول بالبريد</a>
    </div>
</x-guest-layout>
