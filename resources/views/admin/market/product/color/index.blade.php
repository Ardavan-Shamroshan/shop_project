@extends('admin.layouts.master')
@section('head-tag')
    <title>رنگ کالا</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12">
                <i class="fa fa-home text-muted"></i><a href="{{ route('admin.home') }}">خانه</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="{{ route('admin.market.product') }}">کالا ها</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> رنگ کالا</li>
        </ol>
    </nav>

    <section class="main-body-container">
        <section class="main-body-container-header"><h4>رنگ کالا</h4></section>
        <section class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
            <a href="{{ route('admin.market.product.color.create', $product->id) }}" class="btn btn-info btn-sm border rounded-pill btn-hover color-8">ایجاد رنگ جدید</a>
            <div class="max-width-16-rem">
                <input type="text" placeholder="جستجو" class="form-control form-control-sm form-text">
            </div>
        </section>

        <section class="table-responsive">
            <table class="table table-striped table-hover h-150">
                <thead>
                <tr>
                    <th>#</th>
                    <th> نام کالا</th>
                    <th>رنگ کالا</th>
                    <th>افزایش قیمت</th>
                    <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($product->colors as $color)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->name }}</td>
                        <td>
                            <span class="text-light p-2 rounded-circle" style="@if(!is_null($color->color)) background-color: {{ $color->color}} @endif">{{ $color->color_name }} </span>
                        </td>
                        <td>{{ $color->price_increase }} تومان</td>
                        <td class="width-8-rem text-left">
                            <form class="d-inline" action="{{ route('admin.market.product.color.destroy', ['product' => $product->id, 'color' => $color->id]) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm delete border rounded-pill btn-hover color-11">
                                    <i class="fa fa-times rounded-pill"></i> حذف
                                </button>
                            </form>
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
                            successToast('رنگ کالا  با موفقیت فعال شد');
                        } else {
                            element.prop('checked', false);
                            activated_status.removeClass();
                            deactivated_status.removeClass();
                            activated_status.addClass('d-none');
                            deactivated_status.addClass(['d-inline', 'text-danger']);
                            successToast('رنگ کالا  با موفقیت غیر فعال شد');
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
