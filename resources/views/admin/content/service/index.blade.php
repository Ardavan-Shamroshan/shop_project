@extends('admin.layouts.master')
@section('head-tag')
    <title>خدمات</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><i class="fa fa-home text-muted"></i><a href="{{ route('admin.home') }}">خانه</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="">بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> خدمات</li>
        </ol>
    </nav>

    <section class="main-body-container">
        <section class="main-body-container-header"><h4>خدمات</h4></section>
        <section class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
            <a href="{{ route('admin.content.service.create') }}" class="btn btn-info btn-sm border rounded-pill btn-sm btn-hover color-8">ایجاد خدمات جدید</a>
            <div class="max-width-16-rem">
                <input type="text" placeholder="جستجو" class="form-control form-control-sm form-text">
            </div>
        </section>

        <section class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>عنوان خدمات</th>
                    <th>متن خلاصه</th>
                    <th>اسلاگ</th>
                    <th>تصویر</th>
                    <th>وضعیت</th>
                    <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                </tr>
                </thead>
                <tbody>
                @forelse($services as $key => $service)
                    <tr>
                        <th>{{ $key+=1 }}</th>
                        <td>{{ $service->title }}</td>
                        <td>{!! \Illuminate\Support\Str::limit($service->summary, 30) !!}</td>
                        <td>{{ $service->slug }}</td>
                        <td class="shadow-sm text-center">
                            <img src="{{ asset($service->image['indexArray'][$service->image['currentImage']]) }}" alt="عکس" width="70" height="60" class="border rounded">
                        </td>
                        <td>
                            <label for="">
                                <input type="checkbox" id="{{ $service->id }}" onchange="changeStatus({{ $service->id }})"
                                       data-url="{{ route('admin.content.service.status', $service->id) }}"
                                       data-value="{{ $service->status }}"
                                       @if($service->status === 1) checked @endif>
                            </label>
                        </td>
                        <td class="width-16-rem text-left">
                            <a href="{{ route('admin.content.service.edit', $service->id) }}"
                               class="btn btn-primary btn-sm border rounded-pill btn-sm btn-hover color-9"><i class="fa fa-pen font-size-12"></i> ویرایش</a>
                            <form class="d-inline" action="{{ route('admin.content.service.destroy', $service->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm delete border rounded-pill btn-sm btn-hover color-11">
                                    <i class="fa fa-times"></i> حذف
                                </button>
                            </form>
                        </td>
                    </tr>
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
                            successToast('خدمت با موفقیت فعال شد');
                        } else {
                            element.prop('checked', false);
                            activated_status.removeClass();
                            deactivated_status.removeClass();
                            activated_status.addClass('d-none');
                            deactivated_status.addClass(['d-inline', 'text-danger']);
                            successToast('خدمت با موفقیت غیر فعال شد');
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
