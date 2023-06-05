@extends('admin.layouts.master')
@section('head-tag')
    <title>ایجاد کالا</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">

@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12">
                <i class="fa fa-home text-muted"></i><a href="{{ route('admin.home') }}">خانه</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="{{ route('admin.market.product') }}">کالا</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد کالای جدید</li>
        </ol>
    </nav>
    <section class="main-body-container">
        <section class="main-body-container-header"><h4>ایجاد کالا</h4></section>
        <section class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
            <a href="{{ route('admin.market.product') }}"
               class="btn btn-info  border rounded-lg  btn-hover color-8">«
                بازگشت</a>
        </section>
        <section>
            <form action="{{ route('admin.market.product.store') }}" method="post" enctype="multipart/form-data" id="form">
                @csrf
                <section class="row">
                    <section class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="name" class="font-weight-bold">نام کالا</label>
                            @error('name')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <input type="text" class="form-control form-control-sm @error('name') border border-danger @enderror" name="name" id="name" value="{{ old('name') }}">
                        </div>
                    </section>

                    <section class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="category_id" class="font-weight-bold">دسته کالا</label>
                            @error('category_id')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <select name="category_id" id="category_id"
                                    class="form-control form-control-sm @error('category_id') border border-danger @enderror">
                                @forelse($categories as $category)
                                    <option value="{{ $category->id }}"
                                            @if(old('category_id') == $category->id) selected @endif>{{ $category->name }}</option>
                                @empty @endforelse
                            </select>
                        </div>
                    </section>
                    <section class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="category_id" class="font-weight-bold">برند</label>
                            @error('brand_id')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <select name="brand_id" id="brand_id" class="form-control form-control-sm @error('brand_id') border border-danger @enderror">
                                <option value="">برند محصول را انتخاب کنید</option>
                                @forelse($brands as $brand)
                                    <option value="{{ $brand->id }}"
                                            @if(old('brand_id') == $brand->id) selected @endif>{{ $brand->original_name }}</option>
                                @empty @endforelse
                            </select>
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
                            <input type="hidden" class="form-control form-control-sm @error('tags') border border-danger @enderror" name="tags" id="tags" value="{{ old('tags') }}">
                            <select id="select_tags" class="select2 form-control form-control-sm @error('tags') border border-danger @enderror" multiple></select>
                        </div>
                    </section>

                    <section class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="price" class="font-weight-bold">قیمت کالا</label>
                            @error('price')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <input type="text" class="form-control form-control-sm @error('price') border border-danger @enderror" name="price" id="price" value="{{ old('price') }}">
                        </div>
                    </section>

                    <section class="col-md-6 pb-2">
                        <section class="col-md-12">
                            <section class="row border-right border-top radius-05t border-left p-2">
                                <section class="col-md-6">
                                    <div class="form-group">
                                        <label for="weight" class="font-weight-bold">وزن</label>
                                        @error('weight')
                                        <span class="alert_required text-danger" role="alert">
                                            <small>
                                                <b>{{ $message }}</b>
                                            </small>
                                        </span>
                                        @enderror
                                        <input type="text" class="form-control form-control-sm @error('weight') border border-danger @enderror" name="weight" id="weight" value="{{ old('weight') }}">
                                    </div>
                                </section>
                                <section class="col-md-6">
                                    <div class="form-group">
                                        <label for="length" class="font-weight-bold">طول</label>
                                        @error('length')
                                        <span class="alert_required text-danger" role="alert">
                                            <small>
                                                <b>{{ $message }}</b>
                                            </small>
                                        </span>
                                        @enderror
                                        <input type="text" class="form-control form-control-sm @error('length') border border-danger @enderror" name="length" id="length" value="{{ old('length') }}">
                                    </div>
                                </section>
                            </section>
                        </section>
                        <section class="col-md-12">
                            <section class="row border-right border-left radius-05b border-bottom ">
                                <section class="col-md-6">
                                    <div class="form-group">
                                        <label for="weight" class="font-weight-bold">عرض</label>
                                        @error('width')
                                        <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                                        @enderror
                                        <input type="text"
                                               class="form-control form-control-sm @error('width') border border-danger @enderror"
                                               name="width" id="width" value="{{ old('width') }}">
                                    </div>
                                </section>
                                <section class="col-md-6">
                                    <div class="form-group">
                                        <label for="weight" class="font-weight-bold">ارتفاع</label>
                                        @error('height')
                                        <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                                        @enderror
                                        <input type="text"
                                               class="form-control form-control-sm @error('height') border border-danger @enderror"
                                               name="height" id="height" value="{{ old('height') }}">
                                    </div>
                                </section>
                            </section>
                        </section>

                    </section>
                    <section class="col-md-6">
                        <section class="row">
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for=""><b>تاریخ انتشار</b></label>
                                    @error('published_at')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                                    @enderror
                                    <input type="text" name="published_at" id="published_at" class="form-control form-control-sm d-none">
                                    <input type="text" id="published_at_view" class="form-control form-control-sm @error('published_at') border border-danger @enderror">
                                </div>
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="image" class="font-weight-bold">تصویر</label>
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
                        </section>

                    </section>
                    <section class="col-12 col-md-3">
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
                                <option value="0" @if(old('status') == 0) selected @endif>غیر فعال</option>
                                <option value="1" @if(old('status') == 1) selected @endif>فعال</option>
                            </select>
                        </div>
                    </section>
                    <section class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="status" class="font-weight-bold">قابل فروش بودن</label>
                            @error('marketable')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <select name="marketable" id="marketable" class="form-control form-control-sm @error('marketable') border border-danger @enderror">
                                <option value="0" @if(old('marketable') == 0) selected @endif>غیر فعال</option>
                                <option value="1" @if(old('marketable') == 1) selected @endif>فعال</option>
                            </select>
                        </div>
                    </section>


                    <section class="col-12">
                        <div class="form-group">
                            <label for="description_body" class="font-weight-bold">توضیحات</label>
                            @error('introduction')
                            <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                            @enderror
                            <textarea type="text" class="form-control form-control-sm @error('introduction') border border-danger @enderror" name="introduction" id="description_body"> {{ old('introduction') }} </textarea>
                        </div>
                    </section>

                    <section class=" col-12 border-top border-bottom py-3 mb-3">
                        <section class="row">
                            <section class="col-6 col-md-3">
                                <div class="form-group">
                                    @error('meta_key.*')
                                    <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                                    @enderror
                                    <input type="text" name="meta_key[]" class="form-control form-control-sm" placeholder="ویژگی...">
                                </div>
                            </section>

                            <section class="col-6 col-md-3">
                                <div class="form-group">
                                    @error('meta_value.*')
                                    <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                                    @enderror
                                    <input type="text" name="meta_value[]" class="form-control form-control-sm" placeholder="مقدار...">
                                </div>
                            </section>
                        </section>

                        <section>
                            <button type="button" class="btn border rounded-lg  btn-hover color-5" id="btn-copy">
                                <i class="fa fa-plus font-size-12"></i> افزودن
                            </button>
                        </section>
                    </section>

                    <section class="col-12">
                        <button class="btn btn-primary border rounded-lg  btn-hover color-9">ثبت</button>
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
        CKEDITOR.replace('description_body')
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
    <script>
        $(function () {
            $('#btn-copy').on('click', function () {
                var element = $(this).parent().prev().clone(true);
                $(this).before(element);
            })
        });
    </script>
@endsection
