@extends('admin.layouts.master')
@section('head-tag')
    <title>تصاویر کالا</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12">
                <i class="fa fa-home text-muted"></i><a href="{{ route('admin.home') }}">خانه</a>
            </li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="{{ route('admin.market.product') }}">کالا ها</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> تصاویر کالا</li>
        </ol>
    </nav>

    <section class="main-body-container">
        <section class="main-body-container-header">
            <h4>تصاویر کالا</h4>
        </section>
        <section class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
            <div class="max-width-16-rem">
                <input type="text" placeholder="جستجو" class="form-control form-control-sm form-text">
            </div>
        </section>
        <form action="{{ route('admin.market.product.gallery.store', $product->id) }}" method="post" enctype="multipart/form-data" id="form">
            @csrf
            <section class="row">
                <section class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="image" class="font-weight-bold">تصویر</label>
                        @error('image')
                            <span class="alert_required text-danger" role="alert">
                                <small>
                                    <b>{{ $message }}</b>
                                </small>
                            </span>
                        @enderror
                        <input type="file" class="form-control form-control-sm @error('image') border border-danger @enderror" name="image" id="image">
                    </div>
                </section>
                <section class="py-4">
                    <button class="btn btn-primary border rounded-lg  btn-hover color-9">ثبت</button>
                </section>
            </section>
        </form>

        <section class="table-responsive">
            <table class="table table-striped table-hover h-150">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>نام کالا</th>
                        <th>تصویر کالا</th>
                        <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($product->images->isNotEmpty())
                        @forelse ($product->images as $image)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product->name }}</td>
                                <td><img src="{{ asset($image->image['indexArray'][$image->image['currentImage']]) }}" alt="عکس" width="80" height=70" class="border rounded shadow-sm"></td>
                                <td class="width-8-rem text-left">
                                    <form class="d-inline" action="{{ route('admin.market.product.gallery.destroy', ['product' => $product->id, 'gallery' => $image->id]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger  delete border rounded-lg  btn-hover color-11"><i class="fa fa-times rounded-lg"></i> حذف</button>
                                    </form>
                                </td>
                            </tr>
                        @empty @endforelse
                    @endif

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
                success: function(response) {
                    if (response.status)
                        if (response.checked) {
                            element.prop('checked', true);
                            activated_status.removeClass();
                            deactivated_status.removeClass();
                            activated_status.addClass(['d-inline', 'text-success']);
                            deactivated_status.addClass('d-none');
                            successToast('تصاویر کالا  با موفقیت فعال شد');
                        } else {
                            element.prop('checked', false);
                            activated_status.removeClass();
                            deactivated_status.removeClass();
                            activated_status.addClass('d-none');
                            deactivated_status.addClass(['d-inline', 'text-danger']);
                            successToast('تصاویر کالا  با موفقیت غیر فعال شد');
                        }
                    else {
                        element.prop('checked', elementValue);
                        errorToast('مشکلی رخ داده است');
                    }
                },
                error: function() {
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
                $('.toast').toast('show').delay('2000').queue(function() {
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
                $('.toast').toast('show').delay('2000').queue(function() {
                    $(this).remove();
                });
            }
        }
    </script>

    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])
@endsection
