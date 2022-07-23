@extends('admin.layouts.master')
@section('head-tag')
    <title>کاربران ادمین</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><i class="fa fa-home text-muted"></i><a href="{{ route('admin.home') }}">خانه</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> کاربران ادمین</li>
        </ol>
    </nav>

    <section class="main-body-container">
        <section class="main-body-container-header"><h4>کاربران ادمین</h4></section>
        <section class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
            <a href="{{ route('admin.user.admin-user.create') }}" class="btn btn-info btn-sm btn-hover color-8 rounded-pill">ایجاد ادمین جدید</a>
            <div class="max-width-16-rem">
                <input type="text" placeholder="جستجو" class="form-control form-control-sm form-text">
            </div>
        </section>

        <section class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>ایمیل</th>
                    <th>شماره موبایل</th>
                    <th>کد ملی</th>
                    <th>نام</th>
                    <th>نام خانوادگی</th>
                    <th>نقش</th>
                    <th>وضعیت</th>
                    <th>حساب کاربری</th>
                    <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($admins as $key => $admin)
                    <tr>
                        <th>{{ $key += 1 }}</th>
                        <td>{{ $admin->email }}</td>
                        <td>{{ $admin->mobile }}</td>
                        <td>{{ $admin->national_code ?? '-' }}</td>
                        <td>{{ $admin->first_name }}</td>
                        <td>{{ $admin->last_name }}</td>
                        <td>سوپر ادمین</td>
                        <td>
                            <label for="">
                                <input type="checkbox" id="{{ $admin->id }}" onchange="changeStatus({{ $admin->id }})"
                                       data-url="{{ route('admin.user.admin-user.status', $admin->id) }}"
                                       data-value="{{ $admin->status }}"
                                       @if($admin->status === 1) checked @endif>
                            </label>
                        </td>

                        <td>
                            <label for="">
                                <input type="checkbox" id="active{{ $admin->id }}" onchange="changeActivation({{ $admin->id }})"
                                       data-url="{{ route('admin.user.admin-user.activation', $admin->id) }}"
                                       data-value="{{ $admin->activation }}"
                                       @if($admin->activation === 1) checked @endif>
                            </label>
                        </td>

                        <td class="width-16-rem text-left">
                            <a href="" class="btn btn-warning btn-sm btn-hover rounded-pill border color-4"><i class="fa fa-user-cog"></i> نقش</a>
                            <a href="{{ route('admin.user.admin-user.edit', $admin->id) }}" class="btn btn-primary btn-sm btn-hover border rounded-pill color-9"><i class="fa fa-pen font-size-12"></i> ویرایش</a>
                            <form action="{{ route('admin.user.admin-user.destroy', $admin->id) }}" class="d-inline" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm btn-hover color-11 delete border rounded-pill">
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
                            successToast('ادمین با موفقیت فعال شد');
                        } else {
                            element.prop('checked', false);
                            activated_status.removeClass();
                            deactivated_status.removeClass();
                            activated_status.addClass('d-none');
                            deactivated_status.addClass(['d-inline', 'text-danger']);
                            successToast('ادمین با موفقیت غیر فعال شد');
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

        function changeActivation(id) {
            var element = $('#active' + id);
            var url = element.attr('data-url');
            var elementValue = !element.prop('checked');
            var activated_admin = $('#activated' + id);
            var deactivated_admin = $('#deactivated' + id);

            $.ajax({
                url: url,
                type: 'GET',
                success: function (response) {
                    if (response.activation)
                        if (response.checked) {
                            element.prop('checked', true);
                            activated_admin.removeClass();
                            deactivated_admin.removeClass();
                            activated_admin.addClass(['d-inline', 'text-success']);
                            deactivated_admin.addClass('d-none');
                            successToast('حساب کاربری با موفقیت فعال شد');
                        } else {
                            element.prop('checked', false);
                            activated_admin.removeClass();
                            deactivated_admin.removeClass();
                            activated_admin.addClass('d-none');
                            deactivated_admin.addClass(['d-inline', 'text-danger']);
                            successToast('حساب کاربری با موفقیت غیر فعال شد');
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