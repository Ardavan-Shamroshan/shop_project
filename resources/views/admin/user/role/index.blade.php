@extends('admin.layouts.master')
@section('head-tag')
    <title>نقش ها</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><i class="fa fa-home text-muted"></i><a href="{{ route('admin.home') }}">خانه</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> نقش ها</li>
        </ol>
    </nav>

    <section class="main-body-container">
        <section class="main-body-container-header"><h4>نقش ها</h4></section>
        <section class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
            <a href="{{ route('admin.user.role.create') }}" class="btn btn-info btn-sm rounded-pill btn-hover color-8 border">ایجاد نقش جدید</a>
            <div class="max-width-16-rem">
                <input type="text" placeholder="جستجو" class="form-control form-control-sm form-text">
            </div>
        </section>

        <section class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>نقش</th>
                    <th>دسترسی ها</th>
                    <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $role->name }}</td>
                        <td>
                            <ul>
                                @if(empty($role->permissions()->get()->toArray()))
                                    <span class="text-danger">برای این نقش هیچ سطح دسترسی تعریف نشده است</span>
                                @else
                                    @foreach($role->permissions as $permission)
                                        <li>{{  $permission->name }}</li>
                                    @endforeach
                                @endif
                            </ul>
                        </td>
                        <td class="text-left">
                            <a href="{{ route('admin.user.role.permission-form', $role->id) }}" class="btn btn-success btn-sm rounded-pill btn-hover color-9 border"><i class="fa fa-user-cog font-size-12"></i> دسترسی ها</a>
                            <a href="{{ route('admin.user.role.edit', $role->id) }}" class="btn btn-primary btn-sm rounded-pill btn-hover color-4 text-white border"><i class="fa fa-pen font-size-12"></i> ویرایش</a>
                            <form action="{{route('admin.user.role.destroy', $role->id)}}" class="d-inline" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm delete rounded-pill btn-hover color-11 border">
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
    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])
@endsection