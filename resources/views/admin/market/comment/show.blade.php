@extends('admin.layouts.master')
@section('head-tag')
    <title>نمایش نظر</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><i class="fa fa-home text-muted"></i><a href="{{ route('admin.home') }}">خانه</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="">بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12 p-0"><a href="{{ route('admin.market.comment') }}">نظرات</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> نمایش نظر</li>
        </ol>
    </nav>

    <section class="main-body-container">
        <section class="main-body-container-header"><h4>نمایش نظر</h4></section>
        <section class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
            <a href="{{ route('admin.market.comment') }}" class="btn btn-info btn-sm border rounded-pill btn-sm btn-hover color-8">« بازگشت</a>
        </section>

        <section class="card mb-3 mx-5">
            <section class="card-header bg-gray-50">
                <span>{{ $comment->user->fullname }}</span>
                <span> - </span>
                <span>{{ $comment->author_id }}</span>
            </section>
            <section class="card-body">
                <section class="d-flex justify-content-between">
                    <h5 class="card-title"><b>عنوان محصول :</b>
{{--                        <a href="{{ route('admin.market.product.show', $comment->commentable->id) }}" class="show-link"> {{ $comment->commentable->name }} </a>--}}
                        <a href="#" class="show-link"> {{ $comment->commentable->name }} </a>
                    </h5>
                    <p class="my-2 mx-2"><b> کد محصول :</b> {{ $comment->commentable_id }}</p>
                </section>
                <section class="card mx-chat shadow-sm bg-light">
                    <h6 class="mr-3 bg-custom-dark border shadow-sm text-white text-center py-1 rounded-bottom-pill w-2-h-2 mt-n1 rounded-top">نظر</h6>
                    @if($comment->parent_id != null)
                        <section class="card-body">
                            <div class="float-left d-flex">
                                <span class="bg-gray-50 p-4 float-left chat-message-border-radius h6 shadow-sm">{{ $comment->parent->body }} </span>
                                <span><img  class="notification-img rounded-circle mt-5 mr-1 border shadow-sm" src="{{ asset('admin-assets/images/avatar-2.jpg') }}" alt="عکس" style="width: 2.5rem"></span>
                            </div>
                        </section>

                        <section class="card-body">
                            <div class=" float-right d-flex">
                                <span><img  class="notification-img rounded-circle mt-5 ml-1 border shadow-sm" src="{{ asset('admin-assets/images/avatar-2.jpg') }}" alt="عکس" style="width: 2.5rem"></span>
                                <p class="  bg-custom-blue-chat text-white p-4 p-3 chat-answer-border-radius h6 shadow-sm"> {{ $comment->body }} </p>
                            </div>
                        </section>
                    @else
                        <section class="card-body">
                            <div class=" float-left d-flex">
                                <span class="  bg-gray-50 p-4 float-left chat-message-border-radius h6 shadow-sm">{{ $comment->body }} </span>
                                <span><img class="notification-img rounded-circle mt-5 mr-1 border shadow-sm" src="{{ asset('admin-assets/images/avatar-2.jpg') }}" alt="عکس" style="width: 2.5rem"></span>
                            </div>
                        </section>
                    @endif
                </section>
            </section>
        </section>

        <section class="mx-5">
            @if($comment->parent_id == null)
                <form action="{{ route('admin.market.comment.answer', $comment->id) }}" method="post">
                    @csrf
                    <section class="row">
                        <section class="col-md-6">
                            <div class="form-group">
                                <label for="" class="font-weight-bold">پاسخ ادمین</label>
                                @error('body')
                                <span class="alert_required text-danger" role="alert">
                                    <small>
                                        <b>{{ $message }}</b>
                                    </small>
                                </span>
                                @enderror
                                <textarea type="text" class="form-control form-control-sm @error('body') border border-danger @enderror" name="body" rows="6">{{ old('body') }}</textarea>
                            </div>
                        </section>
                        <section class="col-12">
                            <button class="btn btn-primary border rounded-pill btn-sm btn-hover color-9">ثبت</button>
                        </section>
                    </section>
                </form>
            @else
                <form>
                    @csrf
                    <section class="row">
                        <section class="col-md-6">
                            <div class="form-group">
                                <label for="" class="font-weight-bold">پاسخ ادمین</label>
                                <textarea type="text" class="form-control form-control-sm" name="body" rows="4" readonly>امکان پاسخ به این کامنت وجود ندارد.</textarea>
                            </div>
                        </section>
                    </section>
                </form>
                <section class="">
                    <button class="btn btn-primary border disabled rounded-pill btn-hover color-9">ثبت</button>
                </section>
            @endif
        </section>
    </section>
@endsection
