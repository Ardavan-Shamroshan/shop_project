<!doctype html>
<html lang="fa" dir="rtl">
<head>
    @include('customer.layouts.head-tag')
    @yield('head-tag')
</head>
<body>
@include('customer.layouts.header')

<!-- start main one col -->
    <main id="main-body-one-col" class="main-body">
        @yield('content')
    </main>
    <!-- end main one col -->

    @include('customer.layouts.footer')

    @include('customer.layouts.script')
    @yield('script')
</body>
</html>