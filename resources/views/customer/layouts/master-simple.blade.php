<!doctype html>
<html lang="fa" dir="rtl">
<head>
    @include('customer.layouts.head-tag')
    @yield('head-tag')
</head>
<body>

    <!-- no header -->

    <!-- start main one col -->
    <main id="main-body-one-col" class="main-body">
        @yield('content')
    </main>
    <!-- end main one col -->

    <!-- no footer -->

    @include('customer.layouts.script')
    @yield('script')
</body>
</html>