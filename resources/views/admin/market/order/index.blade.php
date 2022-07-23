@extends('admin.layouts.master')
@section('head-tag')
    <title>تمام سفارشات</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12">
                <i class="fa fa-home text-muted"></i><a href="{{ route('admin.home') }}">خانه</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> سفارشات</li>
        </ol>
    </nav>

    <section class="main-body-container">
        <section class="main-body-container-header"><h4>سفارشات</h4></section>
        <section class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
            <a href="#" class="btn btn-info btn-sm border rounded-pill btn-hover color-8 disabled">ایجاد سفارش جدید</a>
            <div class="max-width-16-rem">
                <input type="text" placeholder="جستجو" class="form-control form-control-sm form-text">
            </div>
        </section>

        <section class="table-responsive">
            <table class="table table-striped table-hover h-150px">
                <thead>
                <tr>
                    <th>#</th>
                    <th>کد سفارش</th>
                    <th>مجموع مبلغ سفارش (بدون تخفیف)</th>
                    <th>مجموع تمامی مبلغ تخفیفات</th>
                    <th>مبلغ تخفیف همه محصولات</th>
                    <th>مبلغ نهایی</th>
                    <th>وضعیت پرداخت</th>
                    <th>شیوه پرداخت</th>
                    <th>بانک</th>
                    <th>وضعیت ارسال</th>
                    <th>شیوه ارسال</th>
                    <th>وضعیت سفارش</th>
                    <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->order_final_amount }} تومان</td>
                        <td>{{ $order->order_discount_amount }} تومان</td>
                        <td>{{ $order->order_total_products_discount_amount }} تومان</td>
                        <td>{{ $order->order_final_amount -  $order->order_discount_amount }} تومان</td>
                        <td>{{ $order->payment_status_value }}</td>
                        <td>{{ $order->payment_type_value }}</td>
                        <td>{{ $order->payment->paymentable->gateway ?? '-' }}</td>
                        <td>{{ $order->delivery_status_value}}</td>
                        <td>{{ $order->delivery->name ?? '-' }}</td>
                        <td>{{$order->order_status_value}}</td>
                        <td class="width-8-rem text-left">
                            <div class="dropdown transition">
                                <a href="" class=" dropdown-toggle btn btn-sm btn-block btn-hover color-4 rounded-pill" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-tools"></i><span> عملیات</span>
                                </a>
                                <div class="dropdown-menu border-dropdown radius-05 transition shadow-sm " aria-labelledby="dropdownMenuLink">
                                    <a href="{{ route('admin.market.order.show', $order->id) }}" class="dropdown-item text-right font-size-12 px-2"><i class="fa fa-clipboard-list text-dark-blue"></i><span> مشاهده فاکتور</span></a>
                                    <a href="{{ route('admin.market.order.changeSendStatus', $order->id) }}" class="dropdown-item text-right font-size-12 px-2"><i class="fa fa-shipping-fast text-dark-blue"></i><span> تغییر وضعیت ارسال</span></a>
                                    <a href="{{ route('admin.market.order.changeOrderStatus', $order->id)}}" class="dropdown-item text-right font-size-12 px-2"><i class="fa fa-shopping-basket text-dark-blue"></i><span> تغییر وضعیت سفارش</span></a>
                                    <form action="{{ route('admin.market.order.destroy', $order->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="dropdown-item delete text-right font-size-12 px-2">
                                            <i class="fa fa-unlink text-dark-blue"></i><span> باطل کردن سفارش</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </section>
    </section>
@endsection
@section('script')
    <script type="text/javascript">
        function changeStatus(id) {
            var element = $('#' + id);
            var url = element.attr('data-url');
            var elementValue = !element.prop('checked');
            var activated_status = $('#activated' + id);
            var deactivated_status = $('#deactivated' + id);

            $.ajax({
                url: url,
                type: 'GET',
                success: function (response) {
                    if (response.status)
                        if (response.checked) {
                            element.prop('checked', true);
                            activated_status.removeClass();
                            deactivated_status.removeClass();
                            activated_status.addClass(['d-inline', 'text-success']);
                            deactivated_status.addClass('d-none');
                            successToast('سفارش با موفقیت فعال شد');
                        } else {
                            element.prop('checked', false);
                            activated_status.removeClass();
                            deactivated_status.removeClass();
                            activated_status.addClass('d-none');
                            deactivated_status.addClass(['d-inline', 'text-danger']);
                            successToast('سفارش با موفقیت غیر فعال شد');
                        }
                    else {
                        element.prop('checked', elementValue);
                        errorToast('مشکلی رخ داده است');
                    }
                },
                error: function () {
                    element.prop('checked', elementValue);
                    errorToast('ارتباط برقرار نشد');
                }
            })

            function successToast(message) {
                var successToastTag = '<section class="toast" data-delay="2000">\n' +
                    '<section class="toast-body py-3 d-flex bg-success text-white">\n' +
                    '<p class="ml-auto mt-3">' + message + '</p>\n' +
                    '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</section>\n' +
                    '</section>';

                $('.toast-wrapper').append(successToastTag);
                $('.toast').toast('show').delay('2000').queue(function () {
                    $(this).remove();
                });
            }

            function errorToast(message) {
                var errorToastTag = '<section class="toast" data-delay="2000">\n' +
                    '<section class="toast-body py-3 d-flex bg-danger text-white">\n' +
                    '<p class="ml-auto mt-3">' + message + '</p>\n' +
                    '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</section>\n' +
                    '</section>';

                $('.toast-wrapper').append(errorToastTag);
                $('.toast').toast('show').delay('2000').queue(function () {
                    $(this).remove();
                });
            }
        }
    </script>
    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])
@endsection