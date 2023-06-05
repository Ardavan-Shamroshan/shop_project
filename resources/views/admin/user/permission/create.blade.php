@extends('admin.layouts.master')
@section('head-tag')
    <title>ایجاد دسترسی جدید</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><i class="fa fa-home text-muted"></i><a href="{{ route('admin.home') }}">خانه</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="{{route('admin.user.permission')}}">دسترسی ها</a>
            </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد دسترسی جدید</li>
        </ol>
    </nav>
    <section class="main-body-container">
        <section class="main-body-container-header"><h4>ایجاد دسترسی</h4></section>
        <section class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
            <a href="{{ route('admin.user.permission') }}" class="btn btn-info  border btn-hover color-8 rounded-lg">« بازگشت</a>
        </section>
        <section>
            <form action="{{ route('admin.user.permission.store') }}" method="post">
                @csrf
                <section class="row">
                    <section class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="name">عنوان دسترسی</label>
                            @error('name')
                            <span class="alert_required text-danger" permission="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <input type="text" class="form-control form-control-sm @error('name') border border-danger @enderror" name="name" id="name" value="{{ old('name') }}">
                        </div>
                    </section>
                    <section class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="description">توضیح دسترسی</label>
                            @error('description')
                            <span class="alert_required text-danger" permission="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <input type="text" class="form-control form-control-sm @error('description') border border-danger @enderror" name="description" id="description" value="{{ old('description') }}">
                        </div>
                    </section>
                    <section class="col-12 col-md-3 my-4">
                        <button class="btn btn-primary border btn-hover color-9 rounded-lg">ثبت</button>
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
