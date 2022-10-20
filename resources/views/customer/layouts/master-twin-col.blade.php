<!doctype html>
<html lang="fa" dir="rtl">
<head>
    @include('customer.layouts.head-tag')
    @yield('head-tag')
</head>
<body>
    @include('customer.layouts.header')

    <section class="container-xxl body-container">
        @yield('customer.layouts.sidebar')
    </section>

   <div class="mx-auto px-2 row">
       <!-- start alert section -->
       @include('customer.alerts.alert-section.success')
       @include('customer.alerts.alert-section.error')
       @include('customer.alerts.alert-section.info')
       <!-- end alert section -->
   </div>

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