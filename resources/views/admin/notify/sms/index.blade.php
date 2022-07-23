@extends('admin.layouts.master')
@section('head-tag')
    <title>اعلامیه پیامکی</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><i class="fa fa-home text-muted"></i><a href="{{ route('admin.home') }}">خانه</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="">بخش اطلاع رسانی</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> اعلامیه پیامکی</li>
        </ol>
    </nav>

    <section class="main-body-container">
        <section class="main-body-container-header"><h4>اعلامیه پیامکی</h4></section>
        <section class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
            <a href="{{ route('admin.notify.sms.create') }}" class="btn btn-info btn-sm btn-hover color-8 rounded-pill">ایجاد اطلاعیه پیامکی</a>
            <div class="max-width-16-rem">
                <input type="text" placeholder="جستجو" class="form-control form-control-sm form-text">
            </div>
        </section>

        <section class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>عنوان اطلاعیه</th>
                    <th>متن پیامک</th>
                    <th>تاریخ ارسال</th>
                    <th>وضعیت</th>
                    <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sms as $key => $message)
                    <tr>
                        <th>{{ $key += 1 }}</th>
                        <td>{{ $message->title }}</td>
                        <td>{{ $message->body }}</td>
                        <td>{{ jalaliDate($message->published_at, '%A, %d %B %Y ساعت H:i:s') }}</td>
                        <td>
                            <label for="">
                                <input type="checkbox" id="{{ $message->id }}" onchange="changeStatus({{ $message->id }})"
                                       data-url="{{ route('admin.notify.sms.status', $message->id) }}"
                                       data-value="{{ $message->status }}"
                                       @if($message->status === 1) checked @endif>
                            </label>
                        </td>
                        <td class="width-16-rem text-left">
                            <a href="{{ route('admin.notify.sms.edit', $message->id) }}" class="btn btn-info btn-sm btn-hover color-9 rounded-pill"><i class="fa fa-pen font-size-12"></i> ویرایش </a>
                            <form class="d-inline" action="{{ route('admin.notify.sms.destroy', $message->id) }}" method="post">
                                @csrf
                                {{ method_field('delete') }}
                                <button type="submit" class="btn btn-danger btn-sm delete border btn-hover color-11 rounded-pill">
                                    <i class="fa fa-times"></i> حذف
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
                            successToast('پیامک با موفقیت فعال شد');
                        } else {
                            element.prop('checked', false);
                            activated_status.removeClass();
                            deactivated_status.removeClass();
                            activated_status.addClass('d-none');
                            deactivated_status.addClass(['d-inline', 'text-danger']);
                            successToast('پیامک با موفقیت غیر فعال شد');
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