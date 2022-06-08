@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش بنر</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12">
                <i class="fa fa-home text-muted"></i><a href="{{ route('admin.home') }}">خانه</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="">بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="{{ route('admin.content.banner') }}">بنر</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش بنر</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش بنر </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.content.banner') }}" class="btn btn-info btn-sm border rounded-pill btn-hover color-8">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.content.banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data" id="form">
                        @csrf
                        {{ method_field('put') }}
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
                                    <input type="text" class="form-control form-control-sm @error('title') border border-danger @enderror" name="title" value="{{ old('title', $banner->title) }}">
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
                                    <input type="text" name="url" value="{{ old('url', $banner->url) }}" class="form-control form-control-sm @error('url') border border-danger @enderror">
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="image">تصویر</label>
                                    @error('image')
                                    <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                                    @enderror
                                    <input type="file" class="form-control form-control-sm @error('image') border border-danger @enderror" name="image" id="image">
                                </div>
                            </section>

                            <section class="col-12 col-md-3">
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
                                        @foreach($positions as $key => $value)
                                            <option value="{{ $key }}" @if(old('position', $banner->position) == $key) selected @endif>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('position')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-3">
                                <div class="form-group">
                                    <label for="status">وضعیت</label>
                                    <select name="status" class="form-control form-control-sm" id="status">
                                        <option value="0" @if (old('status', $banner->status) == 0) selected @endif>غیرفعال</option>
                                        <option value="1" @if (old('status', $banner->status) == 1) selected @endif>فعال</option>
                                    </select>
                                </div>
                                @error('status')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-md-6 my-4">
                                <section class="row">
                                    <div class="form-check pl-0 py-2 border border-gray rounded text-capitalize text-center shadow-sm mx-3">
                                        <label for="" class="form-check-label mx-2 font-weight-bold">
                                            <img src="{{ asset($banner->image)}}" class="w-100 border rounded" alt="عکس">
                                        </label>
                                    </div>
                                </section>
                            </section>

                            <section class="col-6 my-4">
                                <button class="btn btn-primary border rounded-pill btn-hover color-9">ثبت</button>
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

            if (tags_input.val() !== null && tags_input.val().length > 0) {
                default_data = default_tags.split(',');
            }

            select_tags.select2({
                placeholder: 'لطفا تگ های خود را وارد نمایید',
                tags: true,
                data: default_data
            });
            select_tags.children('option').attr('selected', true).trigger('change');


            $('#form').submit(function (event) {
                if (select_tags.val() !== null && select_tags.val().length > 0) {
                    var selectedSource = select_tags.val().join(',');
                    tags_input.val(selectedSource)
                }
            })
        })
    </script>

@endsection
