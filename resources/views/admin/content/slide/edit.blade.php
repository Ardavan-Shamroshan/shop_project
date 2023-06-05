@extends('admin.layouts.master')
@section('head-tag')
    <title>ویرایش اسلاید شو</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><i class="fa fa-home text-muted"></i><a href="{{ route('admin.home') }}">خانه</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="">بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="{{ route('admin.content.slide') }}">اسلاید شو</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش اسلاید شو</li>
        </ol>
    </nav>
    <section class="main-body-container">
        <section class="main-body-container-header"><h4>ویرایش اسلاید شو</h4></section>
        <section class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
            <a href="{{ route('admin.content.slide') }}" class="btn btn-info  border rounded-pill  btn-hover color-8">« بازگشت</a>
        </section>
        <section>
            <form action="{{ route('admin.content.slide.update', $slide->id) }}" method="post" enctype="multipart/form-data" id="form">
                @csrf
                @method('put')
                <section class="row">
                    <section class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="title" class="font-weight-bold">عنوان اسلاید</label>
                            @error('title')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <input type="text" class="form-control form-control-sm @error('title') border border-danger @enderror" name="title" id="title" value="{{ old('title', $slide->title) }}">
                        </div>
                    </section>

                    <section class="col-12 col-md-2">
                        <div class="form-group">
                            <label for="status" class="font-weight-bold">وضعیت</label>
                            @error('status')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <select name="status" id="status" class="form-control form-control-sm @error('status') border border-danger @enderror">
                                <option value="0" @if(old('status', $slide->status) == 0) selected @endif>غیر فعال</option>
                                <option value="1" @if(old('status', $slide->status) == 1) selected @endif>فعال</option>
                            </select>
                        </div>
                    </section>

                    <section class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="url" class="font-weight-bold">آدرس url</label>
                            @error('url')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <input type="text" class="form-control form-control @error('url') border border-danger @enderror" name="url" id="url" value="{{ old('url', $slide->url) }}" placeholder="مثال: example.com">
                        </div>
                    </section>

                    <section class="col-12 col-md-8">
                        <div class="form-group">
                            <label for="slide_body" class="font-weight-bold">متن بدنه</label>
                            @error('body')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <textarea type="text" class="form-control form-control-sm @error('body') border border-danger @enderror" name="body" id="slide_body"> {{ old('body', $slide->body) }} </textarea>
                        </div>
                    </section>

                    <section class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="image" class="font-weight-bold">تصویر</label>
                            @error('image')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <input type="file" class="form-control form-control-sm @error('image', $slide->image) border border-danger @enderror" name="image" id="image">
                        </div>
                        <section>
                            <div class="form-check pl-0 py-2 border border-gray rounded text-capitalize text-center shadow-sm">
                                <label for="" class="form-check-label mx-2 font-weight-bold">
                                    <img src="{{ asset($slide->image)}}" class="w-100 border rounded" alt="عکس">
                                </label>
                                <hr>
                                @php
                                    $imageName = explode('\\', $slide->image);
                                    $imageName = $imageName[5];
                                @endphp
                                <small>{{ $imageName }}</small>
                            </div>

                        </section>
                    </section>

                    <section class="col-12 col-md-6">
                        <button class="btn btn-primary border rounded-pill  btn-hover color-9">ثبت</button>
                    </section>
                </section>
            </form>
        </section>
    </section>
@endsection
@section('script')
    <script src="{{ asset('admin-assets/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('slide_body')
    </script>
    <script>
        $(document).ready(function () {
            var tags_input = $('#tags');
            var select_tags = $('#select_tags');
            var default_tags = tags_input.val();
            var default_data = null;

            if (tags_input.val() !== null && tags_input.val().length > 0)
                default_data = default_tags.split(',');

            select_tags.select2({
                placeholder: 'لطفا تگ های خود را وارد نمایید',
                tags: true,
                data: default_data
            });
            select_tags.children('option').attr('selected', true).trigger('change');
            $('#form').submit(function () {
                if (select_tags.val() !== null && select_tags.val().length > 0) {
                    var selectedSource = select_tags.val().join(',');
                    tags_input.val(selectedSource)
                }
            })
        })
    </script>
@endsection
