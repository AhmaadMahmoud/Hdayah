<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" crossorigin href="https://fonts.gstatic.com" />
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Tajawal:wght@300;400;500;700&display=swap"
        rel="stylesheet" />

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        .material-symbols-outlined {
            font-family: 'Material Symbols Outlined';
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            visibility: hidden;
            /* إخفاء النص لحين جاهزية الخط */
        }

        .icons-loaded .material-symbols-outlined {
            visibility: visible;
        }
    </style>
    <script>
        document.fonts?.ready.then(() =>
            document.documentElement.classList.add('icons-loaded')
        );
    </script>
</head>
