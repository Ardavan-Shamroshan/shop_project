@extends('admin.layouts.master')
@section('head-tag')
    <title>نظرات</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12">
                <i class="fa fa-home text-muted"></i><a href="{{ route('admin.home') }}">خانه</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="">بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> نظرات</li>
        </ol>
    </nav>

    <section class="main-body-container">
        <section class="main-body-container-header"><h4>نظرات</h4></section>
        <section class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
            <a href="" class="btn btn-info  disabled border rounded-lg  btn-hover color-8">ایجاد نظر جدید</a>
            <div class="max-width-16-rem">
                <input type="text" placeholder="جستجو" class="form-control form-control-sm form-text">
            </div>
        </section>

        <section class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>نظر</th>
                    <th>پاسخ به</th>
                    <th>کد کاربر</th>
                    <th>نویسنده نظر</th>
                    <th>کد محصول</th>
                    <th>محصول</th>
                    <th>وضعیت تایید</th>
                    <th>وضعیت کامنت</th>
                    <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($comments as  $comment)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ Str::limit($comment->body, 10) }}</td>
                        <td>{{ $comment->parent_id ? \Illuminate\Support\Str::limit($comment->parent->body, 10) : ' - ' }}</td>
                        <td>{{ $comment->author_id }}</td>
                        <td>{{ $comment->user->fullname  }}</td>
                        <td>{{ $comment->commentable_id }}</td>
                        <td>{{ $comment->commentable->name }}</td>
                        <td>{{ $comment->approved == 1 ? 'تایید شده ' : 'تایید نشده'}} </td>
                        <td>
                            <label>
                                <input id="{{ $comment->id }}" onchange="changeStatus({{ $comment->id }})" data-url="{{ route('admin.market.comment.status', $comment->id) }}" type="checkbox" @if ($comment->status === 1)checked  @endif>
                            </label>
                        </td>
                        <td class="width-16-rem text-left">
                            <a href="{{ route('admin.market.comment.show', $comment->id) }}" class="btn btn-info  border rounded-lg  btn-hover color-9"><i class="fa fa-eye font-size-12"></i> نمایش </a>
                            @if($comment->approved == 1)
                                <a href="{{ route('admin.market.comment.approved', $comment->id)}}" class="btn btn-success  btn-hover color-5 text-white border rounded-lg " type="submit"><i class="fa fa-check"></i> تایید </a>
                            @else
                                <a href="{{ route('admin.market.comment.approved', $comment->id)}}" class="btn btn-warning  border btn-hover color-4 rounded-lg" type="submit"><i class="fa fa-check"></i> درانتظار تایید </a>
                            @endif
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
                            successToast('نظر با موفقیت فعال شد');
                        } else {
                            element.prop('checked', false);
                            activated_status.removeClass();
                            deactivated_status.removeClass();
                            activated_status.addClass('d-none');
                            deactivated_status.addClass(['d-inline', 'text-danger']);
                            successToast('نظر با موفقیت غیر فعال شد');
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
@endsection
