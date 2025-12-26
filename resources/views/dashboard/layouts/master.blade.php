<!DOCTYPE html>
<html lang="ar" dir="rtl" data-bs-theme="light">

        @include('dashboard.partials.head')


<body>
    <div class="d-flex app-wrap w-100">
        @include('dashboard.partials.sidebar')

        <!-- Main -->
        <main class="flex-grow-1 d-flex flex-column main-area">
            <!-- Topbar -->
        @include('dashboard.partials.navbar')


            <!-- Content -->
            @yield('content_dash')
        </main>
    </div>

    <!-- Bootstrap JS -->

        @include('dashboard.partials.footer_script')

</body>

</html>
