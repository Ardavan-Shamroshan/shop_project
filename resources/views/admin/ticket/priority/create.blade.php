@extends('admin.layouts.master')

@section('head-tag')
<title>دسته بندی</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12 p-0"> <a href="#">بخش تیکت ها</a></li>
      <li class="breadcrumb-item font-size-12 p-0"> <a href="{{ route('admin.ticket.priority') }}">اولویت</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد اولویت</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h4>ایجاد اولویت</h4>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.ticket.priority') }}" class="btn btn-info  border rounded-pill  btn-hover color-8">« بازگشت</a>
            </section>

            <section>
                <form action="{{ route('admin.ticket.priority.store') }}" method="post" enctype="multipart/form-data" id="form">
                    @csrf
                    <section class="row">
                        <section class="col-12 col-md-6 my-2">
                            <div class="form-group">
                                <label for="name">نام دسته</label>
                                @error('name')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                                @enderror
                                <input type="text" class="form-control form-control-sm @error('name') border border-danger @enderror" name="name" id="name" value="{{ old('name') }}">
                            </div>
                        </section>



                        <section class="col-12 col-md-6 my-2">
                            <div class="form-group">
                                <label for="status">وضعیت</label>
                                @error('status')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                                @enderror
                                <select name="status" class="form-control form-control-sm @error('status') border border-danger @enderror" id="status">
                                    <option value="0" @if(old('status') == 0) selected @endif>غیرفعال</option>
                                    <option value="1" @if(old('status') == 1) selected @endif>فعال</option>
                                </select>
                            </div>
                        </section>

                        <section class="col-12 my-3">
                            <button class="btn btn-primary  border rounded-pill  btn-hover color-9">ثبت</button>
                        </section>
                    </section>
                </form>
            </section>
        </section>
    </section>
</section>
@endsection

