@extends('admin.layouts.master')

@section('head-tag')
    <title>تیکت ادمین</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#"> خانه</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="#"> بخش تیکت ها</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> تیکت ادمین</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>تیکت ادمین</h4>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="#" class="btn btn-info btn-sm disabled rounded-pill border btn-hover color-8">ایجاد تیکت </a>
                    <div class="max-width-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>نام ادمین</th>
                            <th>ایمیل ادمین</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($admins as $key => $admin)
                            <tr>
                                <th>{{ $key += 1 }}</th>
                                <td>{{ $admin->fullname }}</td>
                                <td>{{ $admin->email }}</td>
                                <td class="width-16-rem text-left">
                                    <a href="{{ route('admin.ticket.admin.set', $admin->id) }}" class="btn btn-sm btn-hover text-white rounded-pill border {{ $admin->ticketAdmin == null ? 'color-9' : 'color-11' }}"><i class="fa {{ $admin->ticketAdmin == null ? 'fa-user-plus' : 'fa-user-minus' }}"></i> {{ $admin->ticketAdmin == null ? 'اضافه' : 'حذف' }}</a>
                                </td>
                            </tr>
                        @empty @endforelse

                        </tbody>
                    </table>
                </section>

            </section>
        </section>
    </section>

@endsection
