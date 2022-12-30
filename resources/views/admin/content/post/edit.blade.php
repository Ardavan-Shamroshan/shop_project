@extends('admin.layouts.master')
@section('head-tag')
    <title>ویرایش پست</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><i class="fa fa-home text-muted"></i><a href="{{ route('admin.home') }}">خانه</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="">بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="{{ route('admin.content.post') }}">بلاگ</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش پست</li>
        </ol>
    </nav>

    <section class="main-body-container">
        <section class="main-body-container-header"><h4>ویرایش پست</h4></section>
        <section class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
            <a href="{{ route('admin.content.post') }}" class="btn btn-info btn-sm border rounded-pill btn-sm btn-hover color-8">« بازگشت</a>
        </section>

        <section>
            <form action="{{ route('admin.content.post.update', $post->id) }}" method="post" enctype="multipart/form-data" id="form">
                @csrf
                {{ method_field('put') }}
                <section class="row">
                    <section class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="title" class="font-weight-bold">عنوان پست</label>
                            @error('title')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                            </span>
                            @enderror
                            <input type="text" class="form-control form-control-sm @error('title') border border-danger @enderror" name="title" id="title" value="{{ old('title', $post->title) }}">
                        </div>
                    </section>
                    <section class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="category_id" class="font-weight-bold">انتخاب دسته</label>
                            @error('category_id')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <select name="category_id" id="category_id" class="form-control form-control-sm @error('category_id') border border-danger @enderror">
                                @foreach($postCategories as $postCategory)
                                    <option value="{{ $postCategory->id }}" @if(old('category_id', $post->category_id) == $postCategory->id) selected @endif>{{ $postCategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </section>

                    <section class="col-12 col-md-4">
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
                                <option value="0" @if(old('status', $post->status) == 0) selected @endif>غیر فعال
                                </option>
                                <option value="1" @if(old('status', $post->status) == 1) selected @endif>فعال</option>
                            </select>
                        </div>
                    </section>

                    <section class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="commentable" class="font-weight-bold">امکان درج نظر</label>
                            @error('commentable')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <select name="commentable" id="commentable" class="form-control form-control-sm @error('commentable') border border-danger @enderror">
                                <option value="0" @if(old('commentable', $post->commentable) == 0) selected @endif>غیر فعال</option>
                                <option value="1" @if(old('commentable', $post->commentable) == 1) selected @endif>فعال</option>
                            </select>
                        </div>
                    </section>

                    <section class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="">تاریخ انتشار</label>
                            @error('published_at')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                            @enderror
                            <input type="text" name="published_at" id="published_at" class="form-control form-control-sm d-none" value="{{ old('published_at', $post->published_at) }}">
                            <input type="text" id="published_at_view" class="form-control form-control-sm @error('published_at') border border-danger @enderror"    ">
                        </div>
                    </section>

                    <section class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="tags" class="font-weight-bold">تگ ها</label>
                            @error('tags')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <input type="hidden" class="form-control form-control-sm @error('tags') border border-danger @enderror" name="tags" id="tags" value="{{ old('tags', $post->tags) }}">
                            <select id="select_tags" class="select2 form-control form-control-sm @error('tags') border border-danger @enderror" multiple></select>
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
                            <label for="summary" class="font-weight-bold">خلاصه پست</label>
                            @error('summary')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                            </span>
                            @enderror
                            <textarea type="text" class="form-control form-control-sm @error('summary') border border-danger @enderror" name="summary" id="summary" rows="8"> {{ old('summary', $post->summary) }} </textarea>
                        </div>
                    </section>

                    <section class="col-md-6 my-4">
                        <section class="row">
                            @php
                                $number = 1;
                            @endphp
                            @foreach ($post->image['indexArray'] as $key => $value)
                                <section class="col-md-{{ 6 / $number }}">
                                    <div class="form-check pl-0 py-2 border border-gray rounded text-capitalize text-center shadow-sm">
                                        <input type="radio" class="form-check-input" value="{{ $key }}" id="{{ $number }}"
                                               name="currentImage" @if($post->image['currentImage'] == $key) checked @endif>
                                        <label for="{{ $number }}" class="form-check-label mx-2 font-weight-bold">
                                            <img src="{{ asset($value)}}" class="w-100 rounded" alt="عکس">
                                        </label>
                                        <hr>
                                        <span class="font-weight-bold">{{$key}}</span>
                                        <small class="font-weight-bold">{{ \Illuminate\Support\Facades\Config::get('image.index-images-size.' . $key . '.width') }}X{{\Illuminate\Support\Facades\Config::get('image.index-images-size.' . $key . '.height')}}</small>
                                    </div>
                                </section>
                                @php
                                    $number++;
                                @endphp
                            @endforeach
                        </section>
                    </section>

                    <section class="col-12">
                        <div class="form-group">
                            <label for="post_body" class="font-weight-bold">متن بدنه</label>
                            @error('body')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <textarea type="text" class="form-control form-control-sm @error('body') border border-danger @enderror" name="body" id="post_body"> {{ old('body', $post->body) }} </textarea>
                        </div>
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
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.js') }}"></script>
    <script>
        CKEDITOR.replace('post_body');
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
