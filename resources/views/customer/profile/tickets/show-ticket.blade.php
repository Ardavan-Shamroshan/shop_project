@extends('customer.layouts.master-twin-col')
@section('head-tag')
    <title>نمایش تیکت </title>
@endsection
@section('content')

    <!-- start body -->
    <section class="">
        <section id="main-body-two-col" class="container-xxl body-container">
            <section class="row">


                @include('customer.layouts.partials.profile-sidebar')

                <main id="main-body" class="main-body col-md-9">
                    <section class="content-wrapper bg-white p-3 rounded-2 mb-2">

                        <!-- start vontent header -->
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>تاریخچه تیکت ها</span>
                                </h2>
                                <section class="content-header-link m-2">
                                    <a href="{{ route('customer.profile.my-tickets') }}" class="btn btn-danger text-white">بازگشت</a>
                                </section>
                            </section>
                        </section>
                        <!-- end vontent header -->





                        <section class="order-wrapper">

                            <section class="card mb-3 mx-5">
                                <section class="card-header bg-gray-50">
                                    <span>اردوان شام روشن</span>
                                    <span> - </span>
                                    <span>2</span>
                                </section>
                                <section class="card-body">
                                    <section class="d-flex justify-content-between">
                                        <h5 class="card-title"><b>عنوان تیکت :</b>
                                            <a href="http://127.0.0.1:8000/admin/ticket/show/1" class="show-link"> مشکل در خرید </a>
                                        </h5>
                                        <p class="my-2 mx-2"><b> کد تیکت :</b> 1</p>
                                    </section>
                                    <section class="card mx-chat shadow-sm bg-light">
                                        <h6 class="mr-3 bg-custom-dark shadow-sm border text-white text-center py-1 mt-n1 rounded-top rounded-bottom-pill w-2-h-2 font-size-12">تیکت</h6>
                                        <section class="card-body">
                                            <div class=" float-left d-flex">
                                                <span class="bg-gray-50 p-4 float-left chat-message-border-radius h6 shadow-sm">مشکل در خرید دارم و نمیتوانم خرید کنم </span>
                                                <span><img class="notification-img rounded-circle mt-5 mr-1 border shadow-sm" src="http://127.0.0.1:8000/admin-assets/images/avatar-2.jpg" alt="عکس" style="width: 2.5rem"></span>
                                            </div>
                                        </section>
                                    </section>
                                </section>
                            </section>

                            <section class="mx-5">
                                <form action="http://127.0.0.1:8000/admin/ticket/answer/1" method="post">
                                    <input type="hidden" name="_token" value="ifZTDWGEq6DDwolXibUgJR8nSmhqDoSEg9eCGB3K">                        <section class="row">
                                        <section class="col-md-6">
                                            <div class="form-group">
                                                <label for="" class="font-weight-bold">پاسخ ادمین</label>
                                                <textarea type="text" class="form-control form-control-sm " name="description" rows="6"></textarea>
                                            </div>
                                        </section>
                                        <section class="col-12">
                                            <button class="btn btn-primary border rounded-lg btn-sm btn-hover color-9">ثبت</button>
                                        </section>
                                    </section>
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
