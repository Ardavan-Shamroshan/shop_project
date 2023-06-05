@extends('admin.layouts.master')
@section('head-tag')
    <title>کالا ها</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12">
                <i class="fa fa-home text-muted"></i><a href="{{ route('admin.home') }}">خانه</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> کالا ها</li>
        </ol>
    </nav>

    <section class="main-body-container">
        <section class="main-body-container-header"><h4>کالا ها</h4></section>
        <section class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
            <a href="{{ route('admin.market.product.create') }}" class="btn btn-info  border rounded-lg  btn-hover color-8">ایجاد
                کالای جدید</a>
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
                    <th>تصویر کالا</th>
                    <th>قیمت</th>
                    <th>دسته</th>
                    <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                </tr>
                </thead>
                <tbody>
                @forelse($products as $product)

                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->name }}</td>
                        <td class="shadow-sm text-center">
                            <img src="{{ asset($product->image['indexArray'][$product->image['currentImage']]) }}" alt="عکس" width="90" height="70" class="border rounded">
                        </td>
                        <td>{{ $product->price }} تومان</td>
                        <td>{{ $product->category->name }}</td>
                        <td class="width-8-rem text-left">
                            <div class="dropdown transition">
                                <a href="" class="dropdown-toggle btn  btn-block btn-hover color-4 rounded-lg" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-tools"></i><span> عملیات</span>
                                </a>
                                <div class="dropdown-menu border-dropdown radius-05 transition shadow-sm" aria-labelledby="dropdownMenuLink" style="min-width: 7rem!important;">
                                    <a href="{{ route('admin.market.product.gallery', $product->id) }}" class="dropdown-item text-right font-size-12 px-2"><i class="fa fa-images text-dark-blue"></i><span> گالری</span></a>
                                    <a href="{{ route('admin.market.product.color', $product->id) }}" class="dropdown-item text-right font-size-12 px-2"><i class="fa fa-envelope-open-text text-dark-blue"></i><span> رنگ کالا</span></a>
                                    <a href="{{ route('admin.market.product.guarantee', $product->id) }}" class="dropdown-item text-right font-size-12 px-2"><i class="fa fa-shield-alt text-dark-blue"></i><span> گارانتی</span></a>
                                    <a href="{{ route('admin.market.product.edit', $product->id) }}" class="dropdown-item text-right font-size-12 px-2"><i class="fa fa-pen text-dark-blue"></i><span> ویرایش</span></a>
                                    <form action="{{ route('admin.market.product.destroy', $product->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="dropdown-item text-right delete font-size-12 px-2">
                                            <i class="fa fa-times text-dark-blue"></i><span> حذف </span></button>
                                    </form>
                                </div>
                            </div>
                        </td>

                @empty @endforelse

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
                            successToast('کالا  با موفقیت فعال شد');
                        } else {
                            element.prop('checked', false);
                            activated_status.removeClass();
                            deactivated_status.removeClass();
                            activated_status.addClass('d-none');
                            deactivated_status.addClass(['d-inline', 'text-danger']);
                            successToast('کالا  با موفقیت غیر فعال شد');
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
