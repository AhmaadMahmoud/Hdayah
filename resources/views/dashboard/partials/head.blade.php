<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>لوحة التحكم الرئيسية</title>

    <!-- Fonts + Material Symbols -->
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700&family=Tajawal:wght@400;500;700&family=Material+Symbols+Outlined:wght@100..700&display=swap"
        rel="stylesheet" />

    <!-- Bootstrap RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet" />

    <style>
        :root {
            --primary: #eead2b;
            --bg-light: #f8f7f6;
            --bg-dark: #221c10;
            --surface: #ffffff;
            --surface-hi: #f3efe7;
            --text-main: #1b170d;
            --text-sec: #9a804c;
            --border: #e7dfcf;

            --r: .5rem;
            --r-lg: 1rem;
            --r-xl: 1.5rem;
        }

        body {
            font-family: "Tajawal", "Manrope", sans-serif;
            background: var(--bg-light);
            color: var(--text-main);
            min-height: 100vh;
            overflow-x: hidden;
        }

        html[data-bs-theme="dark"] body {
            background: var(--bg-dark);
            color: #fff;
        }

        .material-symbols-outlined {
            font-variation-settings: "FILL" 0, "wght" 400, "GRAD" 0, "opsz" 24;
        }

        /* scrollbar for sidebar/content */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--border);
            border-radius: 3px;
        }

        /* layout */
        .app-wrap {
            min-height: 100vh;
            display: flex;
        }

        .sidebar {
            width: 288px;
            /* ~w-72 */
            background: #fcfaf8;
            border-left: 1px solid var(--border);
            flex: 0 0 288px;
        }

        html[data-bs-theme="dark"] .sidebar {
            background: rgba(255, 255, 255, .04);
            border-left-color: rgba(255, 255, 255, .10);
        }

        .main-area {
            background: rgba(255, 255, 255, .50);
            overflow-y: auto;
            flex: 1 1 auto;
        }

        html[data-bs-theme="dark"] .main-area {
            background: rgba(255, 255, 255, .03);
        }

        .topbar {
            height: 80px;
            background: #fcfaf8;
            border-bottom: 1px solid var(--surface-hi);
        }

        html[data-bs-theme="dark"] .topbar {
            background: rgba(255, 255, 255, .04);
            border-bottom-color: rgba(255, 255, 255, .10);
        }

        /* helpers */
        .rounded-2xl {
            border-radius: var(--r-xl) !important;
        }

        .rounded-xl {
            border-radius: var(--r-lg) !important;
        }

        .text-sec {
            color: var(--text-sec) !important;
        }

        .text-primary-custom {
            color: var(--primary) !important;
        }

        .bg-surface-hi {
            background: var(--surface-hi) !important;
        }

        html[data-bs-theme="dark"] .bg-surface-hi {
            background: rgba(255, 255, 255, .06) !important;
        }

        .border-soft {
            border: 1px solid var(--border) !important;
        }

        html[data-bs-theme="dark"] .border-soft {
            border-color: rgba(255, 255, 255, .10) !important;
        }

        .nav-item-link {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: .75rem 1rem;
            border-radius: var(--r-xl);
            color: var(--text-main);
            text-decoration: none;
            transition: .2s ease;
        }

        html[data-bs-theme="dark"] .nav-item-link {
            color: #fff;
        }

        .nav-item-link:hover {
            background: var(--surface-hi);
            color: var(--primary);
        }

        .nav-item-link .ico {
            color: var(--text-sec);
        }

        .nav-item-link:hover .ico {
            color: var(--primary);
        }

        .nav-item-link.active {
            background: var(--surface-hi);
            color: var(--primary);
            font-weight: 800;
        }

        .logout-btn {
            width: 100%;
            display: flex;
            gap: .75rem;
            align-items: center;
            justify-content: flex-start;
            padding: .75rem 1rem;
            border-radius: var(--r-xl);
            border: 0;
            background: transparent;
            color: #dc2626;
            transition: .2s ease;
        }

        .logout-btn:hover {
            background: rgba(220, 38, 38, .08);
        }

        .icon-btn {
            width: 44px;
            height: 44px;
            border-radius: var(--r-lg);
            border: 0;
            background: var(--surface-hi);
            color: var(--text-main);
            transition: .2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        html[data-bs-theme="dark"] .icon-btn {
            color: #fff;
            background: rgba(255, 255, 255, .06);
        }

        .icon-btn:hover {
            background: rgba(238, 173, 43, .10);
            color: var(--primary);
        }

        .search-input {
            background: var(--surface-hi);
            border: 0;
            border-radius: var(--r-lg);
            padding-right: 40px;
            height: 44px;
        }

        .search-wrap {
            position: relative;
        }

        .search-ico {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-sec);
            pointer-events: none;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 999px;
            background-size: cover;
            background-position: center;
            border: 2px solid #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .08);
        }

        .kpi-card {
            background: #fcfaf8;
            border: 1px solid var(--border);
            border-radius: var(--r-xl);
            padding: 1.25rem;
            transition: .2s ease;
        }

        html[data-bs-theme="dark"] .kpi-card {
            background: rgba(255, 255, 255, .04);
            border-color: rgba(255, 255, 255, .10);
        }

        .kpi-card:hover {
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .08);
        }

        .tile {
            background: #fcfaf8;
            border: 1px solid var(--border);
            border-radius: var(--r-xl);
            padding: 1.5rem;
            text-decoration: none;
            color: var(--text-main);
            display: block;
            transition: .2s ease;
            height: 100%;
        }

        html[data-bs-theme="dark"] .tile {
            background: rgba(255, 255, 255, .04);
            border-color: rgba(255, 255, 255, .10);
            color: #fff;
        }

        .tile:hover {
            border-color: rgba(238, 173, 43, .45);
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .08);
        }

        .tile-ico {
            width: 48px;
            height: 48px;
            border-radius: var(--r-lg);
            background: var(--surface-hi);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            transition: .2s ease;
        }

        .tile:hover .tile-ico {
            background: rgba(238, 173, 43, .10);
        }

        .tile:hover .tile-ico span {
            color: var(--primary) !important;
        }

        .quick-primary {
            background: var(--primary);
            color: #fff;
            border: 0;
            border-radius: var(--r-lg);
            padding: 1rem;
            font-weight: 800;
            box-shadow: 0 12px 30px rgba(238, 173, 43, .25);
            transition: .2s ease;
        }

        .quick-primary:hover {
            filter: brightness(.96);
            transform: translateY(-1px);
        }

        .quick-secondary {
            background: var(--surface-hi);
            border: 1px solid var(--border);
            border-radius: var(--r-lg);
            padding: 1rem;
            font-weight: 800;
            transition: .2s ease;
        }

        .quick-secondary:hover {
            background: #eaddc5;
        }

        .activity-card {
            background: #fcfaf8;
            border: 1px solid var(--border);
            border-radius: var(--r-xl);
            padding: 1.5rem;
        }

        html[data-bs-theme="dark"] .activity-card {
            background: rgba(255, 255, 255, .04);
            border-color: rgba(255, 255, 255, .10);
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--surface-hi);
        }

        .activity-item:last-child {
            border-bottom: 0;
            padding-bottom: 0;
        }

        .pill {
            font-size: .75rem;
            font-weight: 800;
            padding: .25rem .5rem;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            gap: .25rem;
        }

        .content-scroll {
            height: calc(100vh - 80px);
            overflow-y: auto;
        }
    </style>
</head>
