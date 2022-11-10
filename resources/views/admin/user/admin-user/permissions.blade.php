@extends('admin.layouts.master')
@section('head-tag')
    <title>ایجاد سطح دسترسی ادمین</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><i class="fa fa-home text-muted"></i><a href="{{ route('admin.home') }}">خانه</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="">بخش سطح دسترسی ها</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="{{ route('admin.user.admin-user') }}">سطح دسترسی ادمین</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد سطح دسترسی ادمین</li>
        </ol>
    </nav>
    <section class="main-body-container">
        <section class="main-body-container-header"><h4>ایجاد سطح دسترسی ادمین</h4></section>
        <section class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
            <a href="{{ route('admin.user.admin-user') }}" class="btn btn-info btn-sm btn-hover color-8 rounded-pill">« بازگشت</a>
        </section>
        <section>
            <form action="{{ route('admin.user.admin-user.permissions.store', $admin) }}" method="post" enctype="multipart/form-data">
                @csrf
                <section class="row">

                    <section class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="permissions" class="font-weight-bold">سطح دسترسی ها</label>
                            @error('permissions')
                            <span class="alert_required text-danger" permission="alert">
                                    <small>
                                        {{ $message }}
                                    </small>
                                </span>
                            @enderror
                            <select class="select2 form-control form-control-sm" id="select_permissions" name="permissions[]" multiple>
                                @foreach($permissions as $permission)
                                    <option value="{{ $permission->id }}" @foreach($admin->permissions as $adminRole) @selected($adminRole->id == $permission->id) @endforeach>{{ $permission->name }}</option>

                                @endforeach
                            </select>
                        </div>
                    </section>

                    <section class="col-12">
                        <button class="btn btn-primary btn-hover color-9 rounded-pill">ثبت</button>
                    </section>
                </section>
            </form>
        </section>
    </section>
@endsection
@section('script')

    <script>
        var select_permissions = $('#select_permissions')
        select_permissions.select2({
            placeholder: 'لطفا سطح دسترسی مورد نظر را انتخاب کنید',
            multiple: true,
            tag: true
        })
    </script>

@endsection