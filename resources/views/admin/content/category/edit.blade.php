@extends('admin.layouts.master')
@section('head-tag')
    <title>ویرایش دسته بندی ها</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><i class="fa fa-home text-muted"></i><a href="{{ route('admin.home') }}">خانه</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="">بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="{{ route('admin.content.category') }}">دسته بندی</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش دسته بندی</li>
        </ol>
    </nav>
    <section class="main-body-container">
        <section class="main-body-container-header"><h4>ویرایش دسته بندی</h4></section>
        <section class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
            <a href="{{ route('admin.content.category') }}" class="btn btn-info btn-sm border rounded-pill btn-sm btn-hover color-8">« بازگشت</a>
        </section>
        <section>
            <form action="{{ route('admin.content.category.update', $postCategory->id) }}" method="post" enctype="multipart/form-data" id="form">
                @csrf
                {{ method_field('put') }}
                <section class="row">
                    <section class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="name" class="font-weight-bold">نام دسته</label>
                            @error('name')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        {{ $message }}
                                    </small>
                                </span>
                            @enderror
                            <input type="text" class="form-control form-control-sm @error('name') border border-danger @enderror" name="name" id="name" value="{{ old('name', $postCategory->name) }}">
                        </div>

                    </section>
                    <section class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="tags" class="font-weight-bold">تگ ها</label>
                            @error('tags')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        {{ $message }}
                                    </small>
                                </span>
                            @enderror
                            <input type="hidden" class="form-control form-control-sm @error('tags') border border-danger @enderror" name="tags" id="tags" value="{{ old('tags', $postCategory->tags) }}">
                            <select class="select2 form-control form-control-sm" id="select_tags" multiple>

                            </select>
                        </div>
                    </section>
                    <section class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="status" class="font-weight-bold">وضعیت</label>
                            @error('status')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        {{ $message }}
                                    </small>
                                </span>
                            @enderror
                            <select name="status" id="status" class="form-control form-control-sm @error('status') border border-danger @enderror">
                                <option value="0" @if(old('status', $postCategory->status) == 0) selected @endif>غیر فعال</option>
                                <option value="1" @if(old('status', $postCategory->status) == 1) selected @endif>فعال</option>
                            </select>
                        </div>
                    </section>

                    <section class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="image" class="font-weight-bold">تصویر</label>
                            @error('image')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        {{ $message }}
                                    </small>
                                </span>
                            @enderror
                            <input type="file" class="form-control form-control-sm @error('image') border border-danger @enderror" name="image" id="image">
                        </div>
                    </section>

                    <section class="col-md-6">
                        <div class="form-group">
                            <label for="description_body" class="font-weight-bold">توضیحات</label>
                            @error('description')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        {{ $message }}
                                    </small>
                                </span>
                            @enderror
                            <textarea type="text" class="form-control form-control-sm @error('description') border border-danger @enderror" name="description" id="description_body"> {{ old('description', $postCategory->description) }} </textarea>
                        </div>
                    </section>

                    <section class="col-md-6 my-4">
                        <section class="row">
                            @php
                                $number = 1;
                            @endphp
                            @foreach ($postCategory->image['indexArray'] as $key => $value)
                                <section class="col-md-{{ 6 / $number }}">
                                    <div class="form-check pl-0 py-2 border border-gray rounded text-capitalize text-center shadow-sm">
                                        <input type="radio" class="form-check-input" value="{{ $key }}" id="{{ $number }}"
                                               name="currentImage" @if($postCategory->image['currentImage'] == $key) checked @endif>
                                        <label for="{{ $number }}" class="form-check-label mx-2 font-weight-bold">
                                            <img src="{{ asset($value)}}" class="w-100 border rounded" alt="عکس">
                                        </label>
                                        <hr>
                                        <span class="font-weight-bold">{{$key}}</span>
                                        <small class="font-weight-bold">{{ \Illuminate\Support\Facades\Config::get('image.index-images-size.' . $key . '.width') }}X{{\Illuminate\Support\Facades\Config::get('image.index-images-size.' . $key . '.height')}}</small>
                                    </div>
                                </section>
                                @php
                                    $number++;
                                @endphp
                            @empty @endforelse
                        </section>
                    </section>
                    <section class="col-12 col-md-6">
                        <button class="btn btn-primary border rounded-pill btn-sm btn-hover color-9">ثبت</button>
                    </section>
                </section>
            </form>
        </section>
    </section>
@endsection
@section('script')
    <script src="{{ asset('admin-assets/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('description_body')
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


            $('#form').submit(function (event) {
                if (select_tags.val() !== null && select_tags.val().length > 0) {
                    var selectedSource = select_tags.val().join(',');
                    tags_input.val(selectedSource)
                }
            })
        })
    </script>
@endsection
