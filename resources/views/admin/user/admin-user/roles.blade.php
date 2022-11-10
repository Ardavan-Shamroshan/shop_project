@extends('admin.layouts.master')
@section('head-tag')
    <title>ایجاد نقش ادمین</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><i class="fa fa-home text-muted"></i><a href="{{ route('admin.home') }}">خانه</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="">بخش نقش ها</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="{{ route('admin.user.admin-user') }}">نقش ادمین</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد نقش ادمین</li>
        </ol>
    </nav>
    <section class="main-body-container">
        <section class="main-body-container-header"><h4>ایجاد نقش ادمین</h4></section>
        <section class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
            <a href="{{ route('admin.user.admin-user') }}" class="btn btn-info btn-sm btn-hover color-8 rounded-pill">« بازگشت</a>
        </section>
        <section>
            <form action="{{ route('admin.user.admin-user.roles.store', $admin) }}" method="post" enctype="multipart/form-data">
                @csrf
                <section class="row">

                    <section class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="roles" class="font-weight-bold">نقش ها</label>
                            @error('roles')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        {{ $message }}
                                    </small>
                                </span>
                            @enderror
                            <select class="select2 form-control form-control-sm" id="select_roles" name="roles[]" multiple>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" @foreach($admin->roles as $adminRole) @selected($adminRole->id == $role->id) @endforeach>{{ $role->name }}</option>

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
        var select_roles = $('#select_roles')
        select_roles.select2({
            placeholder: 'لطفا نقش مورد نظر را انتخاب کنید',
            multiple: true,
            tag: true
        })
    </script>

@endsection