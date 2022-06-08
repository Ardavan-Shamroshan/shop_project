@extends('admin.layouts.master')
@section('head-tag')
<title>تیکت ها</title>
@endsection
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#"> خانه</a></li>
      <li class="breadcrumb-item font-size-12 p-0"> <a href="{{ route('admin.ticket') }}"> بخش تیکت ها</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> تیکت</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                 تیکت
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="#" class="btn btn-info btn-sm disabled border rounded-pill btn-hover color-8">ایجاد تیکت </a>
                <div class="max-width-16-rem">
                    <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>نویسنده تیکت</th>
                            <th>عنوان تیکت</th>
                            <th>دسته تیکت</th>
                            <th>اولویت تیکت</th>
                            <th>ارجاع شده به</th>
                            <th>تیکت مرجع</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($tickets as $ticket)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $ticket->user->fullname }}</td>
                            <td>{{ $ticket->subject }}</td>
                            <td>{{ $ticket->category->name }}</td>
                            <td>{{ $ticket->priority->name }}</td>
                            <td>{{ $ticket->admin->user->fullname }}</td>
                            <td>{{ $ticket->parent->subject ?? '-' }}</td>
                            <td class="width-16-rem text-left">
                                <a href="{{ route('admin.ticket.show', $ticket->id) }}" class="btn btn-info btn-sm border rounded-pill btn-hover color-9"><i class="fa fa-eye font-size-12"></i> مشاهده</a>
                                <a href="{{ route('admin.ticket.change', $ticket->id) }}" class="btn btn-info btn-sm border rounded-pill btn-hover {{ $ticket->status == 1 ? 'color-5' : 'color-11' }}"><i class="fa {{ $ticket->status == 1 ? 'fa-check-circle' : 'fa-times-circle' }} "></i>
                                {{ $ticket->status == 1 ? 'باز کردن' : 'بستن'}}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </section>
        </section>
    </section>
</section>

@endsection
