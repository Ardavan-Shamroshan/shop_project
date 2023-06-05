@extends('admin.layouts.master')
@section('head-tag')
    <title>تنظیمات</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="{{ route('admin.home') }}">خانه</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="">بخش تنظیمات</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> تنظیمات</li>
        </ol>
    </nav>

    <section class="main-body-container">
        <section class="main-body-container-header"><h4>تنظیمات</h4></section>
        <section class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
            <a href="{{ route('admin.setting.create') }}" class="btn btn-info  disabled rounded-pill btn-hover color-8">ایجاد تنظیمات</a>
            <div class="max-width-16-rem">
                <input type="text" placeholder="جستجو" class="form-control form-control-sm form-text">
            </div>
        </section>

        <section class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>عنوان سایت</th>
                    <th>توضیحات سایت</th>
                    <th>کلمات کلیدی</th>
                    <th>ایمیل</th>
                    <th>تلفن همراه</th>
                    <th>تلفن1</th>
                    <th>تلفن2</th>
                    <th>آدرس</th>
                    <th>کپی رایت</th>
                    <th>لوگو</th>
                    <th>آیکون</th>
                    <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th>1</th>
                    <td>{{ \Illuminate\Support\Str::limit($setting->title, 10) }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($setting->description, 30) }}</td>
                    <td>{{ $setting->keywords }}</td>
                    <td>{{ $setting->email }}</td>
                    @if(!is_null($setting->mobile))
                        <td><i class="fa fa-check text-success"></i></td>@else
                        <td><i class="fa fa-times text-danger"></i></td>@endif
                    @if(!is_null($setting->phone1))
                        <td><i class="fa fa-check text-success"></i></td>@else
                        <td><i class="fa fa-times text-danger"></i></td>@endif
                    @if(!is_null($setting->phone2))
                        <td><i class="fa fa-check text-success"></i></td>@else
                        <td><i class="fa fa-times text-danger"></i></td>@endif
                   @if(!is_null($setting->address))
                        <td><i class="fa fa-check text-success"></i></td>@else
                        <td><i class="fa fa-times text-danger"></i></td>@endif
                   @if(!is_null($setting->copyright))
                        <td><i class="fa fa-check text-success"></i></td>@else
                        <td><i class="fa fa-times text-danger"></i></td>@endif


                    <td class="shadow-sm text-center">
                        <img src="{{ asset($setting->logo) }}" alt="عکس" width="70" height="50" class="border rounded">
                    </td>
                    <td class="shadow-sm text-center">
                        <img src="{{ asset($setting->icon) }}" alt="عکس" width="70" height="50" class="border rounded">
                    </td>
                    <td class="width-16-rem text-left">
                        <a href="{{ route('admin.setting.edit', $setting->id) }}" class="btn btn-primary  rounded-pill btn-hover color-9"><i class="fa fa-pen font-size-12"></i> ویرایش </a>
                        <button type="submit" class="btn btn-danger  disabled rounded-pill btn-hover color-11"><i class="fa fa-times"></i> حذف</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </section>
    </section>

@endsection
@section('script')
@endsection