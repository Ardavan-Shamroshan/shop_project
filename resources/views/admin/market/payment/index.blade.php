@extends('admin.layouts.master')
@section('head-tag')
    <title>پرداخت ها</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><i class="fa fa-home text-muted"></i><a href="{{ route('admin.home') }}">خانه</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> پرداخت ها</li>
        </ol>
    </nav>

    <section class="main-body-container">
        <section class="main-body-container-header"><h4>پرداخت ها</h4></section>
        <section class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
            <a href="#" class="btn btn-info btn-sm border rounded-pill btn-hover color-8 disabled">ایجاد پرداخت جدید</a>
            <div class="max-width-16-rem">
                <input type="text" placeholder="جستجو" class="form-control form-control-sm form-text">
            </div>
        </section>

        <section class="table-responsive">
            <table class="table table-striped table-hover h-150">
                <thead>
                <tr>
                    <th>#</th>
                    <th>کد تراکنش</th>
                    <th>بانک</th>
                    <th>مبلغ</th>
                    <th>پرداخت کننده</th>
                    <th>وضعیت پرداخت</th>
                    <th>نوع پرداخت</th>
                    <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($payments as $payment)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $payment->paymentable->transaction_id ?? '-' }}</td>
                    <td>{{ $payment->paymentable->gateway ?? '-' }}</td>
                    <td>{{ $payment->amount }}</td>
                    <td>{{ $payment->user->fullname}}</td>
                    <td>
                        @if($payment->status == 0) پرداخت نشده
                        @elseif($payment->status == 1) پرداخت شده
                        @elseif($payment->status == 2) باطل شده
                        @else برگشت داده شده
                        @endif
                    </td>
                    <td>
                     @if($payment->type == 0) آفلاین
                     @elseif($payment->type == 1)  آنلاین
                     @else پرداخت در محل
                     @endif
                    </td>
                    <td class="width-22-rem text-left">
                        <a href="{{ route('admin.market.payment.show', $payment->id) }}" class="btn btn-primary btn-sm border rounded-pill btn-hover color-9"><i class="fa fa-eye font-size-12"></i> مشاهده </a>
                        <a href="{{ route('admin.market.payment.canceled', $payment->id) }}" class="btn btn-primary btn-sm border rounded-pill btn-hover color-11"><i class="fa fa-unlink font-size-12"></i> باطل کردن </a>
                        <a href="{{ route('admin.market.payment.returned', $payment->id) }}" class="btn btn-primary btn-sm border rounded-pill btn-hover color-4"><i class="fa fa-retweet font-size-12"></i> برگرداندن </a>
                    </td>
                </tr>
                @endforeach
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
                            successToast('پرداخت با موفقیت فعال شد');
                        } else {
                            element.prop('checked', false);
                            activated_status.removeClass();
                            deactivated_status.removeClass();
                            activated_status.addClass('d-none');
                            deactivated_status.addClass(['d-inline', 'text-danger']);
                            successToast('پرداخت با موفقیت غیر فعال شد');
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
                var successToastTag = '<section class="toast" data-delay="5000">\n' +
                    '<section class="toast-body py-3 d-flex bg-success text-white">\n' +
                    '<p class="ml-auto mt-3">' + message + '</p>\n' +
                    '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</section>\n' +
                    '</section>';

                $('.toast-wrapper').append(successToastTag);
                $('.toast').toast('show').delay('5000').queue(function () {
                    $(this).remove();
                });
            }

            function errorToast(message) {
                var errorToastTag = '<section class="toast" data-delay="5000">\n' +
                    '<section class="toast-body py-3 d-flex bg-danger text-white">\n' +
                    '<p class="ml-auto mt-3">' + message + '</p>\n' +
                    '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</section>\n' +
                    '</section>';

                $('.toast-wrapper').append(errorToastTag);
                $('.toast').toast('show').delay('5000').queue(function () {
                    $(this).remove();
                });
            }
        }
    </script>

    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])

@endsection
