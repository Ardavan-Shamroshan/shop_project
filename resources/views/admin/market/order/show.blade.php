@extends('admin.layouts.master')
@section('head-tag')
    <title> فاکتور سفارش</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12">
                <i class="fa fa-home text-muted"></i><a href="{{ route('admin.home') }}">خانه</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> فاکتور سفارش</li>
        </ol>
    </nav>

    <section class="main-body-container w-75 mx-auto">
        <section class="main-body-container-header"><h4>فاکتور سفارش</h4></section>
        <section class="table-responsive">
            <table class="table table-striped h-150px" id="printable">
                <thead>
                <tr>
                    <th>#</th>
                    <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th>{{ $order->id }}</th>
                    <td class="width-16-rem text-left">
                        <a href="#" class="btn btn-sm btn-hover btn-dark rounded-lg border" id="print"><i class="fa fa-print"></i> چاپ</a>
                        <a href="{{ route('admin.market.order.show.detail', $order->id) }}" class="btn btn-sm btn-hover color-9 rounded-lg border"><i class="fa fa-book"></i> جزئیات سفارش</a>
                    </td>
                </tr>
                <tr>
                    <th> نام مشتری</th>
                    <td class="text-left">{{ $order->user->fullname ?? '-' }}</td>
                </tr>
                <tr>
                    <th>آدرس</th>
                    <td class="text-left">{{ $order->address->address ?? '-' }}</td>
                </tr>

                <tr>
                    <th>شهر</th>
                    <td class="text-left">{{ $order->address->city->name ?? '-' }}</td>
                </tr>

                <tr>
                    <th>کد پستی</th>
                    <td class="text-left">{{ $order->address->postal_code ?? '-' }}</td>
                </tr>

                <tr>
                    <th>پلاک</th>
                    <td class="text-left">{{ $order->address->unit ?? '-' }}</td>
                </tr>
                <tr>
                    <th>نام تحویل گیرنده</th>
                    <td class="text-left">{{ $order->address->recipient_first_name . ' ' . $order->address->recipient_last_name ?? '-' }}</td>
                </tr>
                <tr>
                    <th>موبایل</th>
                    <td class="text-left">{{ $order->address->mobile ?? '-' }}</td>
                </tr>
                <tr>
                    <th>نوع پرداخت</th>
                    <td class="text-left">{{ $order->payment_type_value }}</td>

                </tr>
                <tr>
                    <th>وضعیت پرداخت</th>
                    <td class="text-left">{{ $order->payment_status_value }}</td>
                </tr>

                <tr>
                    <th>مبلغ ارسال</th>
                    <td class="text-left">{{ $order->delivery_amount ?? '-' }}</td>
                </tr>
                <tr>
                    <th>وضعیت ارسال</th>
                    <td class="text-left">{{ $order->delivery_status_value }}</td>
                </tr>
                <tr>
                    <th>تاریخ ارسال</th>
                    <td class="text-left">{{ jalaliDate($order->delivery_time) ?? '-' }}</td>
                </tr>
                <tr>
                    <th>مجموع مبلغ سفارش (بدون تخفیف)</th>
                    <td class="text-left">{{ $order->order_final_amount  ?? '-' }} تومان</td>
                </tr>
                <tr>
                    <th>مجموع تمامی مبلغ تخفیفات</th>
                    <td class="text-left">{{ $order->order_discount_amount  ?? '-' }} تومان</td>
                </tr>
                <tr>
                    <th>مبلغ تخفیف همه محصولات</th>
                    <td class="text-left">{{ $order->order_total_products_discount_amount  ?? '-' }} تومان</td>
                </tr>

                <tr>
                    <th>مبلغ نهایی</th>
                    <td class="text-left">{{ $order->order_final_amount - $order->order_discount_amount  ?? '-' }} تومان</td>
                </tr>

                <tr>
                    <th>بانک</th>
                    <td class="text-left">{{ $order->payment->paymentable->gateway ?? '-'}} </td>
                </tr>

                <tr>
                    <th>کوپن استفاده شده</th>
                    <td class="text-left">{{ $order->coupon->code ?? '-'}} </td>
                </tr>

                <tr>
                    <th>تخفیف کد تخفیف</th>
                    <td class="text-left">{{ $order->order_coupon_discount_amount ?? '-' }} تومان</td>
                </tr>

                <tr>
                    <th>تخفیف عمومی استفاده شده</th>
                    <td class="text-left">{{ $order->commonDiscount->title ?? '-'}} </td>
                </tr>

                <tr>
                    <th>مبلغ تخفیف عمومی</th>
                    <td class="text-left">{{ $order->commonDiscount->amount ?? '-'}} تومان</td>
                </tr>

                <tr>
                    <th>تخفیف عمومی استفاده شده</th>
                    <td class="text-left">{{ $order->commonDiscount->title ?? '-'}} </td>
                </tr>

                <tr>
                    <th>تخفیف عمومی استفاده شده</th>
                    <td class="text-left">{{ $order->order_common_discount_amount ?? '-'}} تومان</td>
                </tr>

                <tr>
                    <th>وضعیت سفارش</th>
                    <td class="text-left">{{ $order->order_status_value }}</td>
                </tr>
                </tbody>
            </table>
        </section>
    </section>
@endsection
@section('script')
    <script>
        var printBtn = document.getElementById('print');
        printBtn.addEventListener('click', function() {
            printContent('printable');
        })

        function printContent(el) {
            var restorePage = $('body').html();
            var printContent = $('#' + el).clone();
            $('body').empty().html(printContent);
            window.print();
            $('body').empty().html(restorePage);
        }
    </script>
@endsection