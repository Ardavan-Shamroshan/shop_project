@extends('admin.layouts.master')
@section('head-tag')
    <title>دسترسی های نقش</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><i class="fa fa-home text-muted"></i><a href="{{ route('admin.home') }}">خانه</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="{{route('admin.user.role')}}">نقش ها</a>
            </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> دسترسی های نقش</li>
        </ol>
    </nav>
    <section class="main-body-container">
        <section class="main-body-container-header"><h4>دسترسی های نقش</h4></section>
        <section class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
            <a href="{{ route('admin.user.role') }}" class="btn btn-info btn-sm border btn-hover color-8 rounded-lg">« بازگشت</a>
        </section>
        <section>
            <form action="{{ route('admin.user.role.permission-update', $role->id) }}" method="post">
                @csrf
                @method('put')
                <section class="row">
                    <section class="col-12 col-md-4">
                        <div class="shadow-sm border rounded p-3">
                            <h5>عنوان نقش : <small>{{ $role->name }}</small></h5>
                        </div>
                    </section>
                    <section class="col-12 col-md-8">
                        <div class="shadow-sm border rounded p-3">
                            <h5> توضیح نقش : <small>{{ $role->description }}</small></h5>
                        </div>
                    </section>

                    <section class="col-12">
                        <section class="row mt-3 py-3">

                            @php
                                $rolePermissionsArray = $role->permissions->pluck('id')->toArray();
                            @endphp

                            @forelse($permissions as $key => $permission)
                                <section class="col-md-2">

                                    @error('permissions.' . $key)
                                    <span class="alert_required text-danger" role="alert">
                                            <small>
                                                <b>{{ $message }}</b>
                                            </small>
                                        </span>
                                    @enderror

                                    <div class="form-check shadow-sm p-2 border rounded-lg btn-sm @error('permissions.' . $key) border-danger @enderror">
                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="{{ $permission->id }}" value="{{ $permission->id }}" @if(in_array($permission->id, $rolePermissionsArray)) checked @endif>
                                        <label for="{{ $permission->id }}" class="form-check-label mr-3 mt-1">{{ $permission->name }}</label>
                                    </div>
                                </section>

                            @empty @endforelse
                        </section>
                        <section class="col-12">
                            <button class="btn btn-primary border btn-hover color-9 rounded-lg">ثبت</button>
                        </section>
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
