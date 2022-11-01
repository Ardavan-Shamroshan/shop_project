@extends('admin.layouts.master')
@section('head-tag')
    <title>ویرایش نقش جدید</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><i class="fa fa-home text-muted"></i><a href="{{ route('admin.home') }}">خانه</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="{{route('admin.user.role')}}">نقش ها</a>
            </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش نقش جدید</li>
        </ol>
    </nav>
    <section class="main-body-container">
        <section class="main-body-container-header"><h4>ویرایش نقش</h4></section>
        <section class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
            <a href="{{ route('admin.user.role') }}" class="btn btn-info btn-sm border btn-hover color-8 rounded-pill">« بازگشت</a>
        </section>
        <section>
            <form action="{{ route('admin.user.role.update', $role->id) }}" method="post">
                @csrf
                @method('put')
                <section class="row">
                    <section class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="name">عنوان نقش</label>
                            @error('name')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <input type="text" class="form-control form-control-sm @error('name') border border-danger @enderror" name="name" id="name" value="{{ old('name', $role->name) }}">
                        </div>
                    </section>
                    <section class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="description">توضیح نقش</label>
                            @error('description')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <input type="text" class="form-control form-control-sm @error('description') border border-danger @enderror" name="description" id="description" value="{{ old('description', $role->description) }}">
                        </div>
                    </section>
                    <section class="col-12 col-md-3 my-4">
                        <button class="btn btn-primary border btn-hover color-9 rounded-pill">ثبت</button>
                    </section>
                </section>


                <section class="col-12">
                    <section class="row border-top mt-3 py-3">
                        @foreach($permissions as $key => $permission)

                            <section class="col-md-2">

                                @error('permissions.' . $key)
                                <span class="alert_required text-danger" role="alert">
                                            <small>
                                                <b>{{ $message }}</b>
                                            </small>
                                        </span>
                                @enderror

                                <div class="form-check shadow-sm p-2 border rounded-pill btn-sm @error('permissions.' . $key) border-danger @enderror">
                                    <input type="checkbox" class="form-check-input" name="permissions[]" id="{{ $permission->id }}" value="{{ $permission->id }}" @checked($role->permissions->contains($permission))>
                                    <label for="{{ $permission->id }}" class="form-check-label mr-3 mt-1">{{ $permission->name }}</label>
                                </div>
                            </section>

                        @endforeach

                    </section>
                </section>

            </form>
        </section>
    </section>
@endsection
@section('script')
    <script src="{{ asset('admin-assets/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('post_body')
    </script>
@endsection