@extends('customer.layouts.master-twin-col')
@section('head-tag')
    <title>ارسال تیکت </title>
@endsection
@section('content')

    <!-- start body -->
    <section class="">
        <section id="main-body-two-col" class="container-xxl body-container">
            <section class="row">


                @include('customer.layouts.partials.profile-sidebar')

                <main id="main-body" class="main-body col-md-9">
                    <section class="content-wrapper bg-white p-3 rounded-2 mb-2">

                        <!-- start content header -->
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>ارسال تیکت</span>
                                </h2>
                                <section class="content-header-link m-2">
                                    <a href="{{ route('customer.profile.my-tickets') }}"
                                       class="btn btn-danger text-white">بازگشت</a>
                                </section>
                            </section>
                        </section>
                        <!-- end vontent header -->

                        @if ($errors->any())
                            <section class="address-alert alert alert-danger align-items-center p-2" role="alert">
                                <i class="fa fa-exclamation-circle flex-shrink-0 me-2"></i> خطا
                                <ul>
                                    @forelse ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @empty @endforelse
                                </ul>
                            </section>
                        @endif

                        <section class="order-wrapper">


                            <section class="mx-5 my-2">
                                <form action="{{ route('customer.profile.my-tickets.store') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <section class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="category_id" class="font-weight-bold">انتخاب دسته</label>
                                                <select name="category_id" id="category_id"
                                                        class="form-control form-control-sm">
                                                    @forelse($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                                @if(old('category_id') == $category->id) selected @endif>{{ $category->name }}</option>
                                                    @empty @endforelse
                                                </select>
                                            </div>
                                        </section>
                                        <section class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="priority_id" class="font-weight-bold">انتخاب اولویت</label>
                                                <select name="priority_id" id="priority_id"
                                                        class="form-control form-control-sm">
                                                    @forelse($priorities as $priority)
                                                        <option value="{{ $priority->id }}"
                                                                @if(old('priority_id') == $priority->id) selected @endif>{{ $priority->name }}</option>
                                                    @empty @endforelse
                                                </select>
                                            </div>
                                        </section>
                                        <section class="col-md-12 my-2">
                                            <div class="form-group">
                                                <label for="" class="font-weight-bold">عنوان</label>
                                                <input type="text" class="form-control form-control-sm"
                                                       name="subject">
                                            </div>
                                        </section>
                                        <section class="col-md-12 my-2">
                                            <div class="form-group">
                                                <label class="font-weight-bold">پیام</label>
                                                <textarea class="form-control form-control-sm" name="description"
                                                          rows="6"></textarea>
                                            </div>
                                        </section>
                                        <section class="col-12">
                                            <div class="form-group">
                                                <label for="">فایل پیوست </label>
                                                <input type="file" name="file" class="form-control form-control-sm">
                                            </div>
                                        </section>

                                        <section class="col-12 mt-2">
                                            <button class="btn btn-primary border rounded-lg btn-sm btn-hover color-9">
                                                ثبت
                                            </button>
                                        </section>
                                    </div>
                                </form>
                            </section>

                        </section>


                    </section>
                </main>
            </section>
        </section>
    </section>
    <!-- end body -->

@endsection
