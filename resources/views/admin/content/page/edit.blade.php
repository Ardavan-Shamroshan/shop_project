@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش پیج </title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.content.page') }}">پیج ساز</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش پیج </li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>ویرایش پیج</h4>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.content.page') }}" class="btn btn-info  border rounded-pill  btn-hover color-8">« بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.content.page.update', $page->id) }}" method="post" id="form">
                        @csrf
                        {{ method_field('put') }}
                        <section class="row">
                            <section class="col-12 col-md-4">
                                <div class="form-group">
                                    <label for="" class="font-weight-bold">عنوان </label>
                                    @error('title')
                                    <span class="alert_required text-danger" role="alert">
                                        <small>
                                            <b>{{ $message }}</b>
                                        </small>
                                     </span>
                                    @enderror
                                    <input type="text" name="title" value="{{ old('title', $page->title) }}" class="form-control form-control-sm @error('title') border border-danger @enderror">
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
                                    <select name="status" class="form-control form-control-sm @error('status') border border-danger @enderror" id="status">
                                        <option value="0" @if(old('status', $page->status) == 0) selected @endif>غیرفعال</option>
                                        <option value="1" @if(old('status', $page->status) == 1) selected @endif>فعال</option>
                                    </select>
                                </div>
                            </section>

                            <section class="col-12 col-md-4">
                                <div class="form-group">
                                    <label for="tags" class="font-weight-bold">تگ ها</label>
                                    @error('tags')
                                    <span class="alert_required text-danger" role="alert">
                                        <small>
                                            <b>{{ $message }}</b>
                                        </small>
                                     </span>
                                    @enderror
                                    <input type="hidden" class="form-control form-control-sm @error('tags') border border-danger @enderror" name="tags" id="tags" value="{{ old('tags', $page->tags) }}">
                                    <select class="select2 form-control form-control-sm" id="select_tags" multiple></select>
                                </div>
                            </section>

                            <section class="col-12">
                                <div class="form-group">
                                    <label for="" class="font-weight-bold">محتوی</label>
                                    @error('body')
                                    <span class="alert_required text-danger" role="alert">
                                        <small>
                                            <b>{{ $message }}</b>
                                        </small>
                                     </span>
                                    @enderror
                                    <textarea name="body" id="body" class="form-control form-control-sm @error('body') border border-danger @enderror" rows="6">{{ old('body', $page->body) }}</textarea>
                                </div>
                            </section>
                            <section class="col-12">
                                <button class="btn btn-primary  border rounded-pill  btn-hover color-9">ثبت</button>
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
    <script>
        CKEDITOR.replace('body');
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
