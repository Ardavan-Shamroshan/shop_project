@extends('admin.layouts.master')
@section('head-tag')
    <title>جزئیات سفارش</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12">
                <i class="fa fa-home text-muted"></i><a href="{{ route('admin.home') }}">خانه</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> جزئیات سفارش</li>
        </ol>
    </nav>

    <section class="main-body-container">
        <section class="main-body-container-header"><h4>جزئیات سفارش</h4></section>

        <section class="table-responsive">
            <table class="table table-striped table-hover h-150px">
                <thead>
                <tr>
                    <th>#</th>
                    <th>نام محصول</th>
                    <th>درصد فروش فوق العاده</th>
                    <th>مبلغ فروش فوق العاده</th>
                    <th>تعداد</th>
                    <th>جمع قیمت محصول</th>
                    <th>مبلغ نهایی</th>
                    <th>رنگ</th>
                    <th>گارانتی</th>
                    <th>ویژگی ها</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($order->orderItems as $item)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $item->singleProduct->name ?? '-'}}</td>
                        <td>{{ $item->amazingSale->percentage ?? '-'}}%</td>
                        <td>{{ $item->amazing_sale_discount_amount ?? '-'}} تومان</td>
                        <td>{{ $item->number ?? '-'}}</td>
                        <td>{{ $item->final_product_price ?? '-'}} تومان</td>
                        <td>{{ $item->final_total_price ?? '-'}} تومان</td>
                        <td>{{ $item->color->color_name ?? '-'}} </td>
                        <td>{{ $item->guaranty->name ?? '-'}} </td>
                        <td>
                            @forelse($item->orderItemAttributes as $attribute)
                                {{ $attribute->categoryAttribute->name ?? '-' }} : {{ $attribute->categoryAttributeValue->value ?? '-' }}
                            @empty
                                -
                            @endforelse
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