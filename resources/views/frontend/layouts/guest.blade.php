<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Hdaya') }}</title>

    <!-- Fonts + Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" crossorigin href="https://fonts.gstatic.com" />
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Tajawal:wght@300;400;500;700&family=Material+Symbols+Outlined:wght@100..700&display=swap"
        rel="stylesheet" />

    <!-- Bootstrap RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

    <!-- Site theme -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        :root {
            --primary: #ee2b5b;
            --bg-light: #f8f6f6;
            --text-main: #1b0d11;
            --text-muted: #9a4c5f;
            --surface: #ffffff;
            --surface-soft: #fff5f7;
            --r: 1rem;
        }

        body {
            font-family: "Tajawal", "Manrope", sans-serif;
            background: radial-gradient(circle at 20% 20%, rgba(238, 43, 91, .15), transparent 35%),
                radial-gradient(circle at 80% 10%, rgba(238, 43, 91, .10), transparent 40%),
                linear-gradient(135deg, #fff6f8, #f9f1f4 50%, #fefefe);
            min-height: 100vh;
            color: var(--text-main);
        }

        .auth-shell {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1.2fr 1fr;
        }

        @media (max-width: 992px) {
            .auth-shell {
                grid-template-columns: 1fr;
            }
        }

        .hero-pane {
            background: linear-gradient(160deg, rgba(238, 43, 91, .95), rgba(238, 43, 91, .75));
            color: #fff;
            position: relative;
            overflow: hidden;
        }

        .hero-pane::after,
        .hero-pane::before {
            content: "";
            position: absolute;
            border-radius: 999px;
            background: rgba(255, 255, 255, .12);
            filter: blur(0px);
        }

        .hero-pane::after {
            width: 320px;
            height: 320px;
            top: -80px;
            left: -60px;
        }

        .hero-pane::before {
            width: 260px;
            height: 260px;
            bottom: -40px;
            right: -60px;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 520px;
            margin: auto;
            padding: 3rem 2.5rem;
        }

        .auth-card {
            max-width: 820px;
            margin: 0 auto;
            padding: 2.5rem;
            background: var(--surface);
            border-radius: 1.5rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, .08);
            border: 1px solid #f3e7ea;
        }

        .auth-card h1 {
            font-weight: 900;
            letter-spacing: -.02em;
        }

        .form-control,
        .form-select {
            border-radius: 0.85rem;
            border: 1px solid #f3e7ea;
            padding: 0.85rem 1rem;
            background: #fff;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: rgba(238, 43, 91, .4);
            box-shadow: 0 0 0 0.15rem rgba(238, 43, 91, .15);
        }

        .auth-btn {
            background: var(--primary);
            color: #fff;
            border: 0;
            border-radius: 0.9rem;
            padding: 0.85rem 1.1rem;
            font-weight: 800;
            width: 100%;
            box-shadow: 0 14px 30px rgba(238, 43, 91, .25);
            transition: transform .15s ease, filter .2s ease;
        }

        .auth-btn:hover {
            filter: brightness(.96);
            transform: translateY(-1px);
        }

        .link-muted {
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 700;
        }

        .link-muted:hover {
            color: var(--primary);
        }

        .chip {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            padding: .35rem .8rem;
            background: rgba(255, 255, 255, .16);
            border-radius: 999px;
            font-weight: 700;
            font-size: .9rem;
        }
    </style>
</head>

<body>
    <div class="auth-shell">
        <div class="hero-pane d-none d-lg-flex align-items-center">
            <div class="hero-content">
                <div class="chip mb-3">
                    <span class="material-symbols-outlined" style="font-size:20px;">verified</span>
                    تسجيل دخول آمن
                </div>
                <h2 class="display-6 fw-black" style="font-weight:900;">مرحباً بك في لوحة هداياك</h2>
                <p class="mt-3" style="line-height:1.7; color: rgba(255,255,255,.86);">
                    حافظ على بياناتك وطلباتك في مكان واحد. سجّل دخولك للوصول إلى المبيعات، المنتجات، وتقارير الأداء
                    باستخدام ألوان الهوية البصرية الخاصة بنا.
                </p>
                <div class="d-flex gap-3 mt-4">
                    <div class="chip" style="background: rgba(255,255,255,.18);">
                        <span class="material-symbols-outlined" style="font-size:20px;">dashboard</span>
                        تحكم متكامل
                    </div>
                    <div class="chip" style="background: rgba(255,255,255,.18);">
                        <span class="material-symbols-outlined" style="font-size:20px;">security</span>
                        أمان وموثوقية
                    </div>
                </div>
            </div>
        </div>

        <main class="d-flex align-items-center justify-content-center py-5 px-3">
            <div class="auth-card">
                <div class="mb-3 text-center">
                    <div class="d-inline-flex align-items-center justify-content-center mb-3"
                        style="width:56px;height:56px;border-radius:18px;background: rgba(238,43,91,.12); color: var(--primary);">
                        <span class="material-symbols-outlined" style="font-size:26px;">redeem</span>
                    </div>
                    <h1 class="h4 m-0">أهلاً بك من جديد</h1>
                    <p class="text-muted mt-1 mb-0">سجّل دخولك أو أنشئ حساباً للمتابعة</p>
                </div>

                {{ $slot }}
            </div>
        </main>
    </div>
</body>

</html>
