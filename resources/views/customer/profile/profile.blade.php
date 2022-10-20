@extends('customer.layouts.master-twin-col')
@section('head-tag')
    <title>حساب کاربری شما </title>
@endsection
@section('content')

    <section class="">
        <section id="main-body-two-col" class="container-xxl body-container">
            <section class="row">

                <!-- profile sidebar -->
                @include('customer.layouts.partials.profile-sidebar')
                <!-- end profile sidebar -->

                <main id="main-body" class="main-body col-md-9">
                    <section class="content-wrapper bg-white p-3 rounded-2 mb-2">

                        @if ($errors->any())
                            <section class="address-alert alert alert-danger align-items-center p-2" role="alert">
                                <i class="fa fa-exclamation-circle flex-shrink-0 me-2"></i> خطا
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </section>
                        @endif

                        <!-- start content header -->
                        <section class="content-header mb-4">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>اطلاعات حساب</span>
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <!-- end content header -->

                        <section class="d-flex justify-content-end my-4">
                            <a class="btn btn-link btn-sm text-info text-decoration-none mx-1" href="#" data-bs-toggle="modal" data-bs-target="#edit-profile"><i class="fa fa-edit px-1"></i>ویرایش حساب</a>

                        </section>

                        <section class="row">
                            <section class="col-6 border-bottom mb-2 py-2">
                                <section class="field-title">نام</section>
                                <section class="field-value overflow-auto">{{ $user->first_name ?? '-' }}</section>
                            </section>

                            <section class="col-6 border-bottom my-2 py-2">
                                <section class="field-title">نام خانوادگی</section>
                                <section class="field-value overflow-auto">{{ $user->last_name ?? '-' }}</section>
                            </section>

                            <section class="col-6 border-bottom my-2 py-2">
                                <section class="field-title">شماره تلفن همراه</section>
                                <section class="field-value overflow-auto">{{ $user->mobile ?? '-' }}</section>
                            </section>

                            <section class="col-6 border-bottom my-2 py-2">
                                <section class="field-title">ایمیل</section>
                                <section class="field-value overflow-auto">{{ $user->email ?? '-' }}</section>
                            </section>

                            <section class="col-6 my-2 py-2">
                                <section class="field-title">کد ملی</section>
                                <section class="field-value overflow-auto">{{ $user->national_code ?? '-' }}</section>
                            </section>

                        </section>



                        <!-- start profile edit modal -->
                        <section class="modal fade" id="edit-profile" tabindex="-1" aria-labelledby="add-address-label" aria-hidden="true">
                            <section class="modal-dialog">
                                <section class="modal-content">
                                    <section class="modal-header">
                                        <h5 class="modal-title" id="add-address-label"><i class="fa fa-edit"></i> ویرایش حساب </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </section>
                                    <section class="modal-body">
                                        <form class="row" action="{{ route('customer.profile.update') }}" method="post">
                                            @csrf
                                            @method('put')

                                            <section class="col-6 mb-2">
                                                <label for="first_name" class="form-label mb-1">نام</label>
                                                <input type="text" class="form-control form-control-sm" id="first_name" name="first_name" placeholder="نام" value="{{ $user->first_name }}">
                                            </section>

                                            <section class="col-3 mb-2">
                                                <label for="last_name" class="form-label mb-1"> نام خانوادگی</label>
                                                <input type="text" class="form-control form-control-sm" id="last_name" name="last_name" placeholder="نام خانوادگی" value="{{ $user->last_name }}">

                                            </section>

                                            <section class="col-3 mb-2">
                                                <label for="national_code" class="form-label mb-1">کد ملی</label>
                                                <input type="text" class="form-control form-control-sm" id="national_code" name="national_code" placeholder="کد ملی" value="{{ $user->national_code }}">
                                            </section>

                                            <section class="border-bottom mt-2 mb-3"></section>

                                    </section>
                                    <section class="modal-footer py-1">
                                        <button type="submit" class="btn btn-sm btn-primary">ثبت اطلاعات</button>
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">بستن</button>
                                    </section>
                                    </form>
                                </section>
                            </section>
                        </section>
                        <!--end profile edit modal -->


                    </section>
                </main>
            </section>
        </section>
    </section>

@endsection
