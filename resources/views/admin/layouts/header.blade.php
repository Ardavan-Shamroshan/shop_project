<header class="header-main">
    <section class="sidebar-header flex-fill bg-gray">
        <section class="d-flex justify-content-between flex-md-row-reverse px-2">
            <span id="sidebar-toggle-show" class="d-inline d-md-none pointer"><i class="fas fa-toggle-off"></i></span>
            <span id="sidebar-toggle-hide" class="d-none d-md-inline pointer"><i class="fas fa-toggle-on"></i></span>
            <span><img class="logo" src="{{ asset('admin-assets/images/logo.png') }}" alt="پروفایل"></span>
            <span class="d-md-none" id="menu-toggle"><i class="fas fa-ellipsis-h"></i></span>
        </section>
    </section>
    <section class="body-header" id="body-header">
        <section class="d-flex justify-content-between">


            <section>
                <span class="mr-5"><a href="{{ route('customer.home') }}" class="btn btn-sm btn-link" target="_blank">نمایش وبگاه</a></span>

                    <span class="mr-5">
                        <span id="search-area" class="search-area d-none">
                            <i id="search-area-hide" class="fas fa-times pointer text-secondary"></i>
                            <input id="search-input" type="text" class="search-input shadow-none border-0">
                            <i class="fas fa-search pointer text-secondary"></i>
                        </span>
                    <i id="search-toggle" class="fas fa-search p-1 d-none d-md-inline pointer text-secondary"></i>
                    </span>
                <span id="full-screen" class="pointer p-1 d-none d-md-inline mr-5">
                        <i id="screen-compress" class="fas fa-compress d-none text-secondary"></i>
                        <i id="screen-expand" class="fas fa-expand text-secondary"></i>
                    </span>
            </section>

            <section>
                  <span class="ml-2 ml-md-4 position-relative">
                        <span id="header-notification-toggle" class="pointer">
                                <i class="far fa-bell text-secondary position-relative"></i>
                            @if($notifications->count() != 0)
                                <sup class="badge bg-simple-c-blue text-dark-blue rounded-circle position-absolute" style="right: 5px;">{{ $notifications->count() }}</sup>
                            @endif
                        </span>

                    <section id="header-notification" class="header-notifictation rounded shadow-sm">
                        <section class="d-flex justify-content-between">
                            <span class="px-2">نوتیفیکیشن ها</span>
                            <span class="px-2">
                                <span class="badge bg-simple-c-blue text-dark-blue">جدید</span>
                            </span>
                        </section>

                        <ul class="list-group rounded px-0">
                            @foreach($notifications as $notification)
                                <li class="list-group-item list-group-item-action">
                                    <a href="#" class="text-decoration-none text-dark">
                                        <section class="media">
                                            <section class="media-body pr-1">
                                                <p class="notification-text">{{ $notification['data']['message'] }}</p>
                                                <p class="notification-time">{{ jalaliDate($notification->created_at . '10 minutes') }}</p>
                                            </section>
                                        </section>
                                    </a>
                            </li>
                            @endforeach
                        </ul>
                    </section>
                  </span>

                <span class="ml-2 ml-md-4 position-relative">
                        <span id="header-ticket-toggle" class="pointer">
                                <i class="far fa-bell text-secondary position-relative"></i>
                            @if($unseenTickets->count() != 0)
                                <sup class="badge bg-simple-c-green text-dark-blue rounded-circle position-absolute" style="right: 5px;">{{ $unseenTickets->count() }}</sup>
                            @endif
                        </span>
                    <section id="header-ticket" class="header-notifictation rounded shadow-sm">
                        <section class="d-flex justify-content-between">
                            <span class="px-2">تیکت های خوانده نشده</span>
                            <span class="px-2">
                                <span class="badge bg-simple-c-green text-dark-blue">جدید</span>
                            </span>
                        </section>

                        <ul class="list-group rounded px-0">
                            @foreach($unseenTickets as $unseenTicket)
                                <li class="list-group-item list-group-item-action">
                                    <a href="{{ route('admin.ticket.show', $unseenTicket->id) }}" class="text-decoration-none text-dark">
                                        <section class="media">
                                            <img class="notification-img rounded-circle border border-success" src="{{ asset($unseenTicket->user->profile_photo_path) }}" alt="پروفایل">
                                            <section class="media-body pr-1">
                                                <h5 class="notification-user">{{ $unseenTicket->user->fullname }}</h5>
                                                <p class="notification-text">{{ $unseenTicket->subject }}</p>
                                                <p class="notification-time">{{ jalaliDate($unseenTicket->created_at . '10 minutes') }}</p>
                                            </section>
                                        </section>
                                    </a>
                            </li>
                            @endforeach
                        </ul>
                    </section>
                    </span>
                <span class="ml-2 ml-md-4 position-relative">
                        <span id="header-comment-toggle" class="pointer">
                            <i class="far fa-comment-alt text-secondary position-relative">
                                @if($unseenComments->count() != 0)
                                    <sup class="badge bg-simple-c-pink text-dark-blue rounded-circle position-absolute" style="right: 8px;top: -8px; color: #232323">{{ $unseenComments->count() }}</sup>
                                @endif
                            </i>
                        </span>
                    @if($unseenComments->count() != 0)
                        <section id="header-comment" class="header-comment rounded shadow-sm my-1 ml-1">
                        <section class="d-flex justify-content-between">
                            <span class="px-2">نظر های خوانده نشده</span>
                            <span class="px-2">
                                <span class="badge bg-simple-c-pink text-dark-blue">جدید</span>
                            </span>
                        </section>
                        <section class="header-comment-wrapper">
                            <ul class="list-group rounded px-0">
                                @foreach($unseenComments as $unseenComment)
                                    <li class="list-group-item list-group-item-action">
                                    <a href="@if ($unseenComment->commentable_type === 'App\Models\Content\Post') {{  route('admin.content.comment.show', $unseenComment->id) }} @else {{ route('admin.market.comment.show', $unseenComment->id) }} @endif" class="text-decoration-none text-dark">
                                        <section class="media">
                                            <img class="notification-img rounded-circle border border-danger" src="{{ asset($unseenComment->user->profile_photo_path) }}" alt="پروفایل">
                                            <section class="media-body pr-1">
                                                <h5 class="notification-user">{{ $unseenComment->user->fullname }}</h5>
                                                <p class="notification-text">{{ $unseenComment->body }}</p>
                                                <p class="notification-time">{{ jalaliDate($unseenComment->created_at . '10 minutes') }}</p>
                                            </section>
                                        </section>
                                    </a>
                            </li>
                                @endforeach
                            </ul>
                        </section>
                    </section>
                    @endif
                    </span>
                <span class="ml-3 ml-md-5 position-relative">
                        <span id="header-profile-toggle" class="pointer">
                            <img class="header-avatar rounded-circle border border-info" src="{{ asset('admin-assets/images/avatar-4.jpg') }}" alt="">
                            <span class="header-username"></span>
                            <i class="fas fa-angle-down text-secondary"></i>
                        </span>
                    <section id="header-profile" class="header-profile shadow-lg radius-05 header-notification-border">
                        <section class="list-group rounded">
                            <a href="#" class="list-group-item list-group-item-action header-profile-link radius-05"><b>حساب کاربری</b></a>
                            <a href="" class="list-group-item list-group-item-action header-profile-link"><i class="fas fa-cogs"></i>تنظیمات</a>
                            <a href="" class="list-group-item list-group-item-action header-profile-link"><i class="fas fa-user"></i>کاربر</a>
                            <a href="#" class="list-group-item list-group-item-action header-profile-link"><i class="far fa-envelope"></i>پیام ها</a>
                            <a href="#" class="list-group-item list-group-item-action header-profile-link"><i class="fas fa-lock"></i>قفل صفحه</a>
                            <form method="POST" action="" class="">
                                <button class="list-group-item list-group-item-action header-profile-link radius-05">
                                    <i class="fas fa-sign-out-alt"></i>خروج
                                </button>
                            </form>
                        </section>
                    </section>
                </span>
            </section>
        </section>
    </section>
</header>
