@extends('admin.layouts.master')
@section('head-tag')
    <title>دسترسی ها</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12">
                <i class="fa fa-home text-muted"></i><a href="{{ route('admin.home') }}">خانه</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> دسترسی ها</li>
        </ol>
    </nav>

    <section class="main-body-container">
        <section class="main-body-container-header"><h4>دسترسی ها</h4></section>
        <section class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
            <a href="{{ route('admin.user.permission.create') }}" class="btn btn-info btn-sm rounded-lg btn-hover color-8 border">ایجاد دسترسی جدید</a>
            <div class="max-width-16-rem">
                <input type="text" placeholder="جستجو" class="form-control form-control-sm form-text">
            </div>
        </section>

        <section class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>دسترسی</th>
                    <th>توضیحات</th>
                    <th>متعلق به نقش</th>
                    <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                </tr>
                </thead>
                <tbody>
                @forelse($permissions as $permission)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->description }}</td>
                        <td>
                            <ul>
                                @if(empty($permission->roles()->get()->toArray()))
                                    <span class="text-danger">برای این دسترسی هیچ نقشی تعریف نشده است</span>
                                @else
                                    @forelse($permission->roles as $role)
                                        <li>{{  $role->name }}</li>
                                    @empty @endforelse
                                @endif
                            </ul>
                        </td>
                        <td class="text-left">
                            <a href="{{ route('admin.user.permission.edit', $permission->id) }}" class="btn btn-primary btn-sm rounded-lg btn-hover color-4 text-white border"><i class="fa fa-pen font-size-12"></i> ویرایش</a>
                            <form action="{{route('admin.user.permission.destroy', $permission->id)}}" class="d-inline" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm delete rounded-lg btn-hover color-11 border">
                                    <i class="fa fa-times"></i> حذف
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty @endforelse

                </tbody>
            </table>
        </section>
    </section>
@endsection
@section('script')
    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])
@endsection