<!DOCTYPE html>
<html lang="ar" dir="rtl" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Product Page - Luxury Gift Set</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" crossorigin href="https://fonts.gstatic.com" />
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Tajawal:wght@300;400;500;700&display=swap"
        rel="stylesheet" />

    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700&display=swap"
        rel="stylesheet" />

    <!-- Bootstrap RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet" />

    <style>
        :root {
            --primary: #ee2b5b;
            --bg-light: #f8f6f6;
            --bg-dark: #221015;
            --text-main: #1b0d11;
            --text-muted: #9a4c5f;
            --surface: #ffffff;
            --soft: #f3e7ea;

            --r: 1rem;
            --r-lg: 2rem;
        }

        body {
            font-family: "Tajawal", "Manrope", sans-serif;
            background: var(--bg-light);
            color: var(--text-main);
        }

        html[data-bs-theme="dark"] body {
            background: var(--bg-dark);
            color: #fff;
        }

        .material-symbols-outlined {
            font-variation-settings: "FILL" 0, "wght" 400, "GRAD" 0, "opsz" 24;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #e5e7eb;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #d1d5db;
        }

        /* Helpers */
        .text-muted-custom {
            color: var(--text-muted) !important;
        }

        .text-primary-custom {
            color: var(--primary) !important;
        }

        .bg-soft {
            background: var(--soft) !important;
        }

        .rounded-2xl {
            border-radius: var(--r-lg) !important;
        }

        .rounded-xl {
            border-radius: var(--r) !important;
        }

        .btn-primary {
            --bs-btn-bg: var(--primary);
            --bs-btn-border-color: var(--primary);
            --bs-btn-hover-bg: #d6204b;
            --bs-btn-hover-border-color: #d6204b;
        }

        .btn-outline-primary {
            --bs-btn-color: var(--primary);
            --bs-btn-border-color: var(--primary);
            --bs-btn-hover-bg: var(--primary);
            --bs-btn-hover-border-color: var(--primary);
        }

        /* Header glass */
        .gc-header {
            background: rgba(252, 248, 249, 0.8);
            border-bottom: 1px solid var(--soft);
            backdrop-filter: blur(12px);
        }

        html[data-bs-theme="dark"] .gc-header {
            background: rgba(34, 16, 21, 0.85);
            border-bottom-color: rgba(255, 255, 255, 0.1);
        }

        /* Icon circle buttons */
        .icon-btn {
            width: 40px;
            height: 40px;
            border-radius: 999px;
            border: 0;
            background: var(--soft);
            color: var(--text-main);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: 0.2s ease;
        }

        html[data-bs-theme="dark"] .icon-btn {
            background: rgba(255, 255, 255, 0.06);
            color: #fff;
        }

        .icon-btn:hover {
            background: rgba(238, 43, 91, 0.16);
            color: var(--primary);
        }

        /* Search pill */
        .search-pill {
            height: 40px;
            border-radius: 16px;
            background: var(--soft);
            border: 0;
            box-shadow: none !important;
        }

        html[data-bs-theme="dark"] .search-pill {
            background: rgba(255, 255, 255, 0.06);
            color: #fff;
        }

        .search-addon {
            height: 40px;
            border-radius: 16px 0 0 16px;
            background: var(--soft);
            border: 0;
            color: var(--text-muted);
        }

        html[data-bs-theme="dark"] .search-addon {
            background: rgba(255, 255, 255, 0.06);
            color: rgba(255, 255, 255, 0.7);
        }

        /* Main gallery */
        .hero-media {
            position: relative;
            aspect-ratio: 4 / 3;
            background: var(--bg-light);
            overflow: hidden;
        }

        html[data-bs-theme="dark"] .hero-media {
            background: rgba(255, 255, 255, 0.04);
        }

        .hero-bg {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            transition: transform 0.5s ease;
        }

        .hero-media:hover .hero-bg {
            transform: scale(1.05);
        }

        .badge-float {
            position: absolute;
            top: 16px;
            right: 16px;
            z-index: 2;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            color: var(--primary);
            font-weight: 800;
            font-size: 0.75rem;
            padding: 6px 12px;
            border-radius: 999px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .10);
        }

        html[data-bs-theme="dark"] .badge-float {
            background: rgba(0, 0, 0, .55);
            color: #fff;
        }

        /* Thumbnails */
        .thumb-btn {
            border: 2px solid transparent;
            border-radius: 14px;
            overflow: hidden;
            aspect-ratio: 1/1;
            padding: 0;
            background: transparent;
            position: relative;
            transition: .2s ease;
        }

        .thumb-btn.active {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(238, 43, 91, 0.18);
        }

        .thumb-bg {
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
        }

        .thumb-btn:hover {
            border-color: rgba(238, 43, 91, .45);
        }

        /* Right sticky card */
        .sticky-card {
            position: sticky;
            top: 112px;
            /* قريب من top-28 */
        }

        @media (max-width: 991.98px) {
            .sticky-card {
                position: static;
                top: auto;
            }
        }

        .divider-soft {
            border-bottom: 1px solid var(--soft);
        }

        html[data-bs-theme="dark"] .divider-soft {
            border-bottom-color: rgba(255, 255, 255, .10);
        }

        /* Surface box */
        .surface-box {
            background: var(--surface);
            border: 1px solid var(--soft);
        }

        html[data-bs-theme="dark"] .surface-box {
            background: rgba(255, 255, 255, .06);
            border-color: rgba(255, 255, 255, .10);
        }

        /* Rating star color */
        .stars {
            color: #f6c34a;
        }

        /* Quantity pill */
        .qty-pill {
            background: var(--soft);
            border-radius: 999px;
            padding: 6px 10px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            height: 44px;
        }

        html[data-bs-theme="dark"] .qty-pill {
            background: rgba(255, 255, 255, .06);
        }

        .qty-btn {
            width: 32px;
            height: 32px;
            border-radius: 999px;
            background: #fff;
            border: 0;
            box-shadow: 0 1px 2px rgba(0, 0, 0, .08);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: .2s ease;
            color: var(--text-main);
        }

        html[data-bs-theme="dark"] .qty-btn {
            background: rgba(255, 255, 255, .12);
            color: #fff;
        }

        .qty-btn:hover {
            background: var(--primary);
            color: #fff;
        }

        .qty-input {
            width: 48px;
            text-align: center;
            border: 0;
            background: transparent;
            font-weight: 800;
            font-size: 1.1rem;
            outline: none;
        }

        html[data-bs-theme="dark"] .qty-input {
            color: #fff;
        }

        /* Accordion button look (like your blocks) */
        .mini-acc .accordion-item {
            border: 1px solid var(--soft);
            border-radius: 14px !important;
            overflow: hidden;
            background: var(--surface);
        }

        html[data-bs-theme="dark"] .mini-acc .accordion-item {
            border-color: rgba(255, 255, 255, .10);
            background: rgba(255, 255, 255, .06);
        }

        .mini-acc .accordion-button {
            font-weight: 800;
            font-size: .95rem;
            background: transparent;
            box-shadow: none;
        }

        .mini-acc .accordion-button:not(.collapsed) {
            color: var(--text-main);
        }

        html[data-bs-theme="dark"] .mini-acc .accordion-button:not(.collapsed) {
            color: #fff;
        }

        /* Related cards */
        .rel-card .rel-media {
            aspect-ratio: 4/5;
            background: var(--bg-light);
            border-radius: var(--r-lg);
            overflow: hidden;
            position: relative;
        }

        html[data-bs-theme="dark"] .rel-card .rel-media {
            background: rgba(255, 255, 255, .04);
        }

        .rel-card .rel-bg {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            transition: transform .5s ease;
        }

        .rel-card:hover .rel-bg {
            transform: scale(1.05);
        }

        .bag-btn {
            position: absolute;
            bottom: 12px;
            right: 12px;
            width: 40px;
            height: 40px;
            border-radius: 999px;
            background: #fff;
            border: 0;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .14);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            opacity: 0;
            transform: translateY(10px);
            transition: .25s ease;
        }

        html[data-bs-theme="dark"] .bag-btn {
            background: rgba(255, 255, 255, .12);
            color: rgba(255, 255, 255, .75);
        }

        .rel-card:hover .bag-btn {
            opacity: 1;
            transform: translateY(0);
        }

        .bag-btn:hover {
            color: var(--primary);
            transform: translateY(0) scale(1.06);
        }

        /* Footer */
        .gc-footer {
            background: #fff;
            border-top: 1px solid var(--soft);
        }

        html[data-bs-theme="dark"] .gc-footer {
            background: rgba(255, 255, 255, .02);
            border-top-color: rgba(255, 255, 255, .10);
        }
    </style>
</head>

<body class="min-vh-100 d-flex flex-column">
    <!-- Header -->
    <header class="gc-header sticky-top z-3">
        <div class="container-fluid" style="max-width:1440px;">
            <div class="d-flex align-items-center justify-content-between gap-3 py-3 px-2 px-md-0">

                <!-- Logo -->
                <div class="d-flex align-items-center gap-2" role="button">
                    <div class="text-primary-custom" style="width:32px; height:32px;">
                        <!-- same svg -->
                        <svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M13.8261 30.5736C16.7203 29.8826 20.2244 29.4783 24 29.4783C27.7756 29.4783 31.2797 29.8826 34.1739 30.5736C36.9144 31.2278 39.9967 32.7669 41.3563 33.8352L24.8486 7.36089C24.4571 6.73303 23.5429 6.73303 23.1514 7.36089L6.64374 33.8352C8.00331 32.7669 11.0856 31.2278 13.8261 30.5736Z"
                                fill="currentColor"></path>
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M39.998 35.764C39.9944 35.7463 39.9875 35.7155 39.9748 35.6706C39.9436 35.5601 39.8949 35.4259 39.8346 35.2825C39.8168 35.2403 39.7989 35.1993 39.7813 35.1602C38.5103 34.2887 35.9788 33.0607 33.7095 32.5189C30.9875 31.8691 27.6413 31.4783 24 31.4783C20.3587 31.4783 17.0125 31.8691 14.2905 32.5189C12.0012 33.0654 9.44505 34.3104 8.18538 35.1832C8.17384 35.2075 8.16216 35.233 8.15052 35.2592C8.09919 35.3751 8.05721 35.4886 8.02977 35.589C8.00356 35.6848 8.00039 35.7333 8.00004 35.7388C8.00004 35.739 8 35.7393 8.00004 35.7388C8.00004 35.7641 8.0104 36.0767 8.68485 36.6314C9.34546 37.1746 10.4222 37.7531 11.9291 38.2772C14.9242 39.319 19.1919 40 24 40C28.8081 40 33.0758 39.319 36.0709 38.2772C37.5778 37.7531 38.6545 37.1746 39.3151 36.6314C39.9006 36.1499 39.9857 35.8511 39.998 35.764ZM4.95178 32.7688L21.4543 6.30267C22.6288 4.4191 25.3712 4.41909 26.5457 6.30267L43.0534 32.777C43.0709 32.8052 43.0878 32.8338 43.104 32.8629L41.3563 33.8352C43.104 32.8629 43.1038 32.8626 43.104 32.8629L43.1051 32.865L43.1065 32.8675L43.1101 32.8739L43.1199 32.8918C43.1276 32.906 43.1377 32.9246 43.1497 32.9473C43.1738 32.9925 43.2062 33.0545 43.244 33.1299C43.319 33.2792 43.4196 33.489 43.5217 33.7317C43.6901 34.1321 44 34.9311 44 35.7391C44 37.4427 43.003 38.7775 41.8558 39.7209C40.6947 40.6757 39.1354 41.4464 37.385 42.0552C33.8654 43.2794 29.133 44 24 44C18.867 44 14.1346 43.2794 10.615 42.0552C8.86463 41.4464 7.30529 40.6757 6.14419 39.7209C4.99695 38.7775 3.99999 37.4427 3.99999 35.7391C3.99999 34.8725 4.29264 34.0922 4.49321 33.6393C4.60375 33.3898 4.71348 33.1804 4.79687 33.0311C4.83898 32.9556 4.87547 32.8935 4.9035 32.8471C4.91754 32.8238 4.92954 32.8043 4.93916 32.7889L4.94662 32.777L4.95178 32.7688ZM35.9868 29.004L24 9.77997L12.0131 29.004C12.4661 28.8609 12.9179 28.7342 13.3617 28.6282C16.4281 27.8961 20.0901 27.4783 24 27.4783C27.9099 27.4783 31.5719 27.8961 34.6383 28.6282C35.082 28.7342 35.5339 28.8609 35.9868 29.004Z"
                                fill="currentColor"></path>
                        </svg>
                    </div>
                    <h2 class="m-0 fw-extrabold" style="font-weight:900;">هدية</h2>
                </div>

                <!-- Search (md+) -->
                <div class="d-none d-md-block flex-grow-1" style="max-width:420px;">
                    <div class="input-group">
                        <span class="input-group-text search-addon px-3">
                            <span class="material-symbols-outlined" style="font-size:20px;">search</span>
                        </span>
                        <input class="form-control search-pill px-3" placeholder="ابحث عن هدية..." />
                    </div>
                </div>

                <!-- Right -->
                <div class="d-flex align-items-center gap-3">
                    <nav class="d-none d-lg-flex align-items-center gap-4">
                        <a class="text-decoration-none fw-semibold" style="color:inherit;" href="#">الرئيسية</a>
                        <a class="text-decoration-none fw-semibold" style="color:inherit;" href="#">المناسبات</a>
                        <a class="text-decoration-none fw-semibold" style="color:inherit;" href="#">الهدايا</a>
                        <a class="text-decoration-none fw-semibold" style="color:inherit;" href="#">من نحن</a>
                    </nav>

                    <div class="d-flex align-items-center gap-2">
                        <button class="icon-btn" type="button" aria-label="Cart">
                            <span class="material-symbols-outlined" style="font-size:20px;">shopping_cart</span>
                        </button>
                        <button class="icon-btn" type="button" aria-label="Account">
                            <span class="material-symbols-outlined" style="font-size:20px;">account_circle</span>
                        </button>
                        <button class="icon-btn d-lg-none" type="button" aria-label="Menu">
                            <span class="material-symbols-outlined" style="font-size:20px;">menu</span>
                        </button>

                        <button id="themeToggle" class="btn btn-outline-secondary btn-sm rounded-pill">
                            Dark
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </header>



    <!-- Footer -->
    <footer class="gc-footer mt-5">
        <div class="container-fluid py-5" style="max-width:1440px;">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
                <div class="d-flex align-items-center gap-2">
                    <div class="text-primary-custom" style="width:24px; height:24px;">
                        <svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M13.8261 30.5736C16.7203 29.8826 20.2244 29.4783 24 29.4783C27.7756 29.4783 31.2797 29.8826 34.1739 30.5736C36.9144 31.2278 39.9967 32.7669 41.3563 33.8352L24.8486 7.36089C24.4571 6.73303 23.5429 6.73303 23.1514 7.36089L6.64374 33.8352C8.00331 32.7669 11.0856 31.2278 13.8261 30.5736Z"
                                fill="currentColor"></path>
                        </svg>
                    </div>
                    <span class="fw-bold fs-5">هدية</span>
                </div>

                <div class="text-muted-custom small">© ٢٠٢٤ هدية. جميع الحقوق محفوظة.</div>

                <div class="d-flex gap-3">
                    <a class="text-decoration-none text-muted-custom" href="#">
                        <span class="material-symbols-outlined">thumb_up</span>
                    </a>
                    <a class="text-decoration-none text-muted-custom" href="#">
                        <span class="material-symbols-outlined">photo_camera</span>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Theme Toggle -->
    <script>
        const html = document.documentElement;
        const btn = document.getElementById("themeToggle");

        function setTheme(theme) {
            html.setAttribute("data-bs-theme", theme);
            btn.textContent = theme === "dark" ? "Light" : "Dark";
        }

        btn.addEventListener("click", () => {
            const cur = html.getAttribute("data-bs-theme") || "light";
            setTheme(cur === "dark" ? "light" : "dark");
        });
    </script>
</body>

</html>
