<aside id="sidebar" class="sidebar">
    <section class="sidebar-container">
        <section class="sidebar-wrapper">
            <a href="{{ route('admin.home') }}" class="sidebar-link">
                <i class="fas fa-home"></i>
                <span>خانه</span>
            </a>

            <section class="sidebar-part-title">بخش فروش ________________</section>

            <section class="sidebar-group-link">
                <section class="sidebar-dropdown-toggle">
                    <i class="fas fa-store icon"></i>
                    <span>ویترین</span>
                    <i class="fas fa-angle-left angle"></i>
                </section>
                <section class="sidebar-dropdown">
                    <a href="{{ route('admin.market.category') }}" class="sidebar-link"><i class="fas fa-book"></i><span>دسته بندی</span></a>
                    <a href="{{ route('admin.market.property') }}" class="sidebar-link"> <i class="fas fa-envelope-open-text"></i><span>فرم کالا</span></a>
                    <a href="{{ route('admin.market.brand') }}" class="sidebar-link"> <i class="fas fa-infinity"></i><span>برندها</span></a>
                    <a href="{{ route('admin.market.product') }}" class="sidebar-link"><i class="fas fa-tags"></i><span>کالاها</span></a>
                    <a href="{{ route('admin.market.storeroom') }}" class="sidebar-link"> <i class="fas fa-warehouse"></i><span>انبار</span></a>
                    <a href="{{ route('admin.market.comment') }}" class="sidebar-link"> <i class="fas fa-comments"></i><span>نظرات</span></a>
                </section>
            </section>

            <section class="sidebar-group-link">
                <section class="sidebar-dropdown-toggle">
                    <i class="fas fa-shopping-cart icon"></i>
                    <span>سفارشات</span>
                    <i class="fas fa-angle-left angle"></i>
                </section>
                <section class="sidebar-dropdown">
                    <a href="{{ route('admin.market.order.all') }}" class="sidebar-link"><i class="fa fa-shopping-basket"></i><span>تمام سفارشات</span></a>
                    <a href="{{ route('admin.market.order.newOrder') }}" class="sidebar-link"><i class="fa fa-shopping-bag"></i><span>جدید</span></a>
                    <a href="{{ route('admin.market.order.sending') }}" class="sidebar-link"><i class="fa fa-shipping-fast"></i><span>در حال ارسال</span></a>
                    <a href="{{ route('admin.market.order.unpaid') }}" class="sidebar-link"><i class="fa fa-cash-register"></i><span>پرداخت نشده</span></a>
                    <a href="{{ route('admin.market.order.canceled') }}" class="sidebar-link"><i class="fa fa-unlink"></i><span>باطل شده</span></a>
                    <a href="{{ route('admin.market.order.returned') }}" class="sidebar-link"><i class="fa fa-retweet"></i><span>مرجوعی</span></a>
                </section>
            </section>

            <section class="sidebar-group-link">
                <section class="sidebar-dropdown-toggle">
                    <i class="fas fa-wallet icon"></i>
                    <span>پرداخت ها</span>
                    <i class="fas fa-angle-left angle"></i>
                </section>
                <section class="sidebar-dropdown">
                    <a href="{{ route('admin.market.payment') }}" class="sidebar-link"><i class="fa fa-money-check"></i><span>تمام پرداخت ها</span></a>
                    <a href="{{ route('admin.market.payment.online') }}" class="sidebar-link"><i class="fa fa-credit-card"></i><span>پرداخت های آنلاین</span></a>
                    <a href="{{ route('admin.market.payment.offline') }}" class="sidebar-link"><i class="fa fa-money-bill-alt"></i><span>پرداخت های آفلاین</span></a>
                    <a href="{{ route('admin.market.payment') }}" class="sidebar-link"><i class="fa fa-money-check-alt"></i><span>پرداخت نشده</span></a>
                    <a href="{{ route('admin.market.payment.cash') }}" class="sidebar-link"><i class="fa fa-money-bill-wave"></i><span>پرداخت در محل</span></a>

                </section>
            </section>

            <section class="sidebar-group-link">
                <section class="sidebar-dropdown-toggle">
                    <i class="fas fa-percent icon"></i>
                    <span>تخفیف ها</span>
                    <i class="fas fa-angle-left angle"></i>
                </section>
                <section class="sidebar-dropdown">
                    <a href="{{ route('admin.market.discount.coupon') }}" class="sidebar-link"><i class="fa fa-gift"></i><span> کوپن تخفیف</span></a>
                    <a href="{{ route('admin.market.discount.commonDiscount') }}" class="sidebar-link"><i class="fab fa-shopify"></i><span>تخفیف عمومی</span></a>
                    <a href="{{ route('admin.market.discount.amazingSale') }}" class="sidebar-link"><i class="fa fa-gifts"></i><span>فروش شگفت انگیز</span></a>
                </section>
            </section>

            <a href="{{ route('admin.market.delivery') }}" class="sidebar-link">
                <i class="fas fa-truck"></i><span>روش های ارسال</span>
            </a>

            <section class="sidebar-part-title">بخش محتوی ________________</section>
            <section class="sidebar-group-link">
                <section class="sidebar-dropdown-toggle">
                    <i class="fas fa-chart-bar icon"></i>
                    <span>بلاگ</span>
                    <i class="fas fa-angle-left angle"></i>
                </section>
                <section class="sidebar-dropdown">
                    <a href="{{ route('admin.content.post') }}" class="sidebar-link">
                        <i class="fas fa-newspaper"></i><span>پست ها</span>
                    </a>
                    <a href="{{ route('admin.content.category') }}" class="sidebar-link">
                        <i class="fas fa-list-alt"></i><span>دسته بندی ها</span>
                    </a>
                    <a href="{{ route('admin.content.comment') }}" class="sidebar-link">
                        <i class="fas fa-comments"></i><span>نظرات</span>
                    </a>
                </section>
            </section>
{{--            <section class="sidebar-group-link">--}}
{{--                <section class="sidebar-dropdown-toggle text-muted">--}}
{{--                    <i class="fas fa-chart-bar icon"></i>--}}
{{--                    <span>مجله</span>--}}
{{--                    <i class="fas fa-angle-left angle"></i>--}}
{{--                </section>--}}
{{--                <section class="sidebar-dropdown">--}}
{{--                    <a href="" class="sidebar-link text-muted">--}}
{{--                        <i class="fas fa-newspaper"></i><span>اخبار</span>--}}
{{--                    </a>--}}
{{--                    <a href="" class="sidebar-link text-muted">--}}
{{--                        <i class="fas fa-list-alt"></i><span>دسته بندی ها</span>--}}
{{--                    </a>--}}
{{--                    <a href="" class="sidebar-link text-muted">--}}
{{--                        <i class="fas fa-comments"></i><span>نظرات</span>--}}
{{--                    </a>--}}
{{--                </section>--}}
{{--            </section>--}}
{{--            <a href="#" class="sidebar-link text-muted">--}}
{{--                <i class="fas fa-book"></i>--}}
{{--                <span>میکروبوک</span>--}}
{{--            </a>--}}
            <a href="{{ route('admin.content.service') }}" class="sidebar-link">
                <i class="fas fa-clipboard-check"></i>
                <span>خدمات</span>
            </a>
            <a href="{{ route('admin.content.quickLink') }}" class="sidebar-link">
                <i class="fas fa-link"></i>
                <span>لینک های سریع</span>
            </a>
            <a href="{{ route('admin.content.menu') }}" class="sidebar-link">
                <i class="fas fa-list"></i><span>منو</span>
            </a>
            <a href="{{ route('admin.content.faq') }}" class="sidebar-link">
                <i class="fas fa-question"></i><span>سوالات متداول</span>
            </a>
            <a href="{{ route('admin.content.page') }}" class="sidebar-link">
                <i class="fas fa-pager"></i><span>پیج ساز</span>
            </a>
             <a href="{{ route('admin.content.banner') }}" class="sidebar-link">
                <i class="fas fa-pager"></i><span>بنر ها</span>
            </a>

            <section class="sidebar-part-title">بخش کاربران ________________</section>
            <section class="sidebar-group-link">
                <section class="sidebar-dropdown-toggle">
                    <i class="fas fa-user-astronaut icon"></i>
                    <span>کاربران</span>
                    <i class="fas fa-angle-left angle"></i>
                </section>
                <section class="sidebar-dropdown">
                    <a href="{{ route('admin.user.admin-user') }}" class="sidebar-link">
                        <i class="fas fa-user"></i>
                        <span>کاربران ادمین</span>
                    </a>
                    <a href="{{ route('admin.user') }}" class="sidebar-link">
                        <i class="fas fa-user-friends"></i>
                        <span>کاربران</span>
                    </a>
                </section>
            </section>
            <a href="{{ route('admin.user.role') }}" class="sidebar-link">
                <i class="fas fa-user-lock"></i>
                <span>سطوح دسترسی</span>
            </a>

            <section class="sidebar-part-title">بخش تیکت ها ______________</section>
            <a href="{{ route('admin.ticket') }}" class="sidebar-link">
                <i class="fas fa-tags"></i>
                <span>همه ی تیکت ها</span>
            </a>
            <section class="sidebar-group-link">
                <section class="sidebar-dropdown-toggle">
                    <i class="fas fa-credit-card icon"></i>
                    <span>تیکت ها</span>
                    <i class="fas fa-angle-left angle"></i>
                </section>
                <section class="sidebar-dropdown">
                    <section class="sidebar-dropdown">
                        <a href="{{ route('admin.ticket.newTickets') }}" class="sidebar-link">
                            <i class="fas fa-ticket-alt"></i>
                            <span>تیکت های جدید</span>
                        </a>
                        <a href="{{ route('admin.ticket.openTickets') }}" class="sidebar-link">
                            <i class="fas fa-ticket-alt"></i>
                            <span>تیکت های باز</span>
                        </a>
                        <a href="{{ route('admin.ticket.closeTickets') }}" class="sidebar-link">
                            <i class="fas fa-ticket-alt"></i>
                            <span>تیکت های بسته</span>
                        </a>
                        <a href="{{ route('admin.ticket.admin') }}" class="sidebar-link">
                            <i class="fas fa-user-tag"></i>
                            <span> تیکت های ادمین</span>
                        </a>
                        <a href="{{ route('admin.ticket.category') }}" class="sidebar-link">
                            <i class="fas fa-clipboard-list"></i>
                            <span>دسته بندی تیکت ها</span>
                        </a>
                        <a href="{{ route('admin.ticket.priority') }}" class="sidebar-link">
                            <i class="fas fa-flag"></i>
                            <span>اولویت تیکت ها</span>
                        </a>
                    </section>
                </section>
            </section>
            <section class="sidebar-part-title">بخش اطلاع رسانی ___________</section>
            <section class="sidebar-group-link">
                <section class="sidebar-dropdown-toggle">
                    <i class="fab fa-telegram-plane icon"></i>
                    <span>اطلاع رسانی</span>
                    <i class="fas fa-angle-left angle"></i>
                </section>
                <section class="sidebar-dropdown">
                    <a href="{{ route('admin.notify.email') }}" class="sidebar-link">
                        <i class="fas fa-mail-bulk"></i>
                        <span>اعلامیه ایمیلی</span>
                    </a>
                    <a href="{{ route('admin.notify.sms') }}" class="sidebar-link">
                        <i class="fas fa-sms"></i>
                        <span>اعلامیه پیامکی</span>
                    </a>
                </section>
            </section>
            <section class="sidebar-part-title">تنظیمات</section>
            <a href="{{ route('admin.setting') }}" class="sidebar-link">
                <i class="fas fa-cog"></i>
                <span>تنظیمات</span>
            </a>
        </section>
    </section>
</aside>
