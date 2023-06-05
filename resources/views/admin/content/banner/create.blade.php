@extends('admin.layouts.master')

@section('head-tag')
<title>ایجاد بنر</title>
<link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item font-size-12"><i class="fa fa-home text-muted"></i><a href="{{ route('admin.home') }}">خانه</a></li>
        <li class="breadcrumb-item font-size-12 p-0"><a href="">بخش محتوی</a></li>
        <li class="breadcrumb-item font-size-12 p-0"><a href="{{ route('admin.content.banner') }}">بنر</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد بنر</li>
    </ol>
  </nav>

  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>ایجاد بنر</h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.content.banner') }}" class="btn btn-info  border rounded-lg  btn-hover color-8">بازگشت</a>
            </section>

            <section>
                <form action="{{ route('admin.content.banner.store') }}" method="POST" enctype="multipart/form-data" id="form">
                    @csrf
                    <section class="row">

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">عنوان بنر</label>
                                @error('title')
                                <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                                @enderror
                                <input type="text" class="form-control form-control-sm @error('title') border border-danger @enderror" name="title" value="{{ old('title') }}">
                            </div>

                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">تصویر </label>
                                @error('image')
                                <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                                @enderror
                                <input type="file" name="image" class="form-control form-control-sm @error('image') border border-danger @enderror">
                            </div>
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="status">وضعیت</label>
                                @error('status')
                                <span class="alert_required text-danger" role="alert">
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

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">آدرس URL</label>
                                @error('url')
                                <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                                @enderror
                                <input type="text" name="url" value="{{ old('url') }}" class="form-control form-control-sm @error('url') border border-danger @enderror">
                            </div>
                        </section>

                        <section class="col-12">
                            <div class="form-group">
                                <label for="">موقعیت</label>
                                @error('position')
                                <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                                @enderror
                                <select name="position" class="form-control form-control-sm @error('position') border border-danger @enderror">
                                @forelse($positions as $key => $value)
                                        <option value="{{ $key }}" @if(old('position') == $key) selected @endif>{{ $value }}</option>
                                @empty @endforelse
                                </select>
                            </div>
                        </section>

                        <section class="col-12">
                            <button class="btn btn-primary border rounded-lg  btn-hover color-9">ثبت</button>
                        </section>
                    </section>
                </form>
            </section>
        </section>
    </section>
</section>
@endsection

@section('script')

    <script src="{{ asset('admin-assets/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.js') }}"></script>
    <script>
        CKEDITOR.replace('body');
        CKEDITOR.replace('summary');
    </script>

    <script>
            $(document).ready(function () {
                $('#published_at_view').persianDatepicker({
                    format: 'YYYY/MM/DD',
                    altField: '#published_at'
                })
            });
    </script>

<script>
    $(document).ready(function () {
        var tags_input = $('#tags');
        var select_tags = $('#select_tags');
        var default_tags = tags_input.val();
        var default_data = null;

        if(tags_input.val() !== null && tags_input.val().length > 0)
        {
            default_data = default_tags.split(',');
        }

        select_tags.select2({
            placeholder : 'لطفا تگ های خود را وارد نمایید',
            tags: true,
            data: default_data
        });
        select_tags.children('option').attr('selected', true).trigger('change');


        $('#form').submit(function ( event ){
            if(select_tags.val() !== null && select_tags.val().length > 0){
                var selectedSource = select_tags.val().join(',');
                tags_input.val(selectedSource)
            }
        })
    })
</script>

@endsection
