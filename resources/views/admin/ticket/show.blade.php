@extends('admin.layouts.master')

@section('head-tag')
    <title>نمایش تیکت ها</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش تیکت ها</a></li>
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.ticket') }}"> تیکت ها</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> نمایش تیکت ها</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h4>نمایش تیکت ها</h4>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.ticket') }}" class="btn btn-info btn-sm btn-hover rounded-pill border color-8">« بازگشت</a>
                </section>

                <section class="card mb-3 mx-5">
                    <section class="card-header bg-gray-50">
                        <span>{{ $ticket->user->fullname }}</span>
                        <span> - </span>
                        <span>{{ $ticket->user_id }}</span>
                    </section>
                    <section class="card-body">
                        <section class="d-flex justify-content-between">
                            <h5 class="card-title"><b>عنوان تیکت :</b>
                                @if($ticket->ticket_id != null)
                                    <a href="{{ route('admin.ticket.show', $ticket->parent->id) }}" class="show-link"> {{ $ticket->parent->subject }} </a>
                                @else
                                    <a href="{{ route('admin.ticket.show', $ticket->id) }}" class="show-link"> {{ $ticket->subject }} </a>
                                @endif
                            </h5>
                            <p class="my-2 mx-2"><b> کد تیکت :</b> {{ $ticket->id }}</p>
                        </section>
                        <section class="card mx-chat shadow-sm bg-light">
                            <h6 class="mr-3 bg-custom-dark shadow-sm border text-white text-center py-1 mt-n1 rounded-top rounded-bottom-pill w-2-h-2 font-size-12">تیکت</h6>
                            @if($ticket->ticket_id != null)
                                <section class="card-body">
                                    <div class="float-left d-flex">
                                        <span class="  bg-gray-50 p-4 float-left chat-message-border-radius rounded-pill h6 border shadow-sm">{{ $ticket->parent->description }} </span>
                                        <span><img class="notification-img rounded-circle mt-5 mr-1 border shadow-sm" src="{{ asset('admin-assets/images/avatar-2.jpg') }}" alt="عکس" style="width: 2.5rem"></span>
                                    </div>
                                </section>

                                <section class="card-body">
                                    <div class="float-right d-flex">
                                        <span><img class="notification-img rounded-circle mt-5 ml-1 border shadow-sm" src="{{ asset('admin-assets/images/avatar-2.jpg') }}" alt="عکس" style="width: 2.5rem"></span>
                                        <p class="bg-custom-green-chat border text-white p-4 p-3 chat-answer-border-radius h6 shadow-sm rounded-pill"> {{ $ticket->description }} </p>
                                    </div>
                                </section>
                            @else
                                <section class="card-body">
                                    <div class=" float-left d-flex">
                                        <span class="bg-gray-50 p-4 float-left chat-message-border-radius h6 shadow-sm">{{ $ticket->description }} </span>
                                        <span><img class="notification-img rounded-circle mt-5 mr-1 border shadow-sm" src="{{ asset('admin-assets/images/avatar-2.jpg') }}" alt="عکس" style="width: 2.5rem"></span>
                                    </div>
                                </section>
                            @endif
                        </section>
                    </section>
                </section>
                <section class="mx-5">
                    <form action="{{ route('admin.ticket.answer', $ticket->id) }}" method="post">
                        @csrf
                        <section class="row">
                            <section class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="font-weight-bold">پاسخ ادمین</label>
                                    @error('description')
                                    <span class="alert_required text-danger" role="alert">
                                        <small>
                                            <b>{{ $message }}</b>
                                        </small>
                                    </span>
                                    @enderror
                                    <textarea type="text" class="form-control form-control-sm @error('description') border border-danger @enderror" name="description" rows="6">{{ old('description') }}</textarea>
                                </div>
                            </section>
                            <section class="col-12">
                                <button class="btn btn-primary border rounded-pill btn-sm btn-hover color-9">ثبت</button>
                            </section>
                        </section>
                    </form>
                </section>
            </section>
        </section>
    </section>
@endsection
