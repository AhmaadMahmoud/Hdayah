<!DOCTYPE html>
<html class="light" dir="rtl" lang="en">

@include('frontend.partials.head')


<body>

    @include('frontend.partials.navbar')
    <main class="flex-grow-1">

        @yield('content')

    </main>

    @include('frontend.partials.footer')
    @include('frontend.partials.footer_scripts')


</body>

</html>
