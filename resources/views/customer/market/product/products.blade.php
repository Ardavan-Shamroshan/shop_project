@extends('customer.layouts.master-twin-col')


@section('content')

    <!-- start body -->
    <section class="">
        <section id="main-body-two-col" class="container-xxl body-container">
            <section class="row">
                <aside id="sidebar" class="sidebar col-md-3">
                    <form action="{{ route('customer.products') }}" method="get">

                        <input type="hidden" name="sort" value="{{ request()->sort }}">

                        <section class="content-wrapper bg-white p-3 rounded-2 mb-3">
                            <!-- start sidebar nav-->
                            <section class="sidebar-nav">
                                <section class="sidebar-nav-item">
                                    <span class="sidebar-nav-item-title">کالای دیجیتال <i class="fa fa-angle-left"></i></span>
                                    <section class="sidebar-nav-sub-wrapper">
                                        <section class="sidebar-nav-sub-item">
                                    <span class="sidebar-nav-sub-item-title"><a href="#">لوازم جانبی موبایل</a><i
                                                class="fa fa-angle-left"></i></span>
                                            <section class="sidebar-nav-sub-sub-wrapper">
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هدست</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">اسپیکر موبایل</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">پاوربانک</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری بیسیم</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">قاب موبایل</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هولدر نگهدارنده</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">شارژر بیسیم</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">مونوپاد</a></section>
                                            </section>
                                        </section>
                                        <section class="sidebar-nav-sub-item">
                                    <span class="sidebar-nav-sub-item-title"><a href="#">لوازم جانبی موبایل</a><i
                                                class="fa fa-angle-left"></i></span>
                                            <section class="sidebar-nav-sub-sub-wrapper">
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هدست</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">اسپیکر موبایل</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">پاوربانک</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری بیسیم</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">قاب موبایل</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هولدر نگهدارنده</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">شارژر بیسیم</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">مونوپاد</a></section>
                                            </section>
                                        </section>
                                    </section>
                                </section>
                                <section class="sidebar-nav-item">
                            <span class="sidebar-nav-item-title">خودرو ابزار و تجهیزات صنعتی <i
                                        class="fa fa-angle-left"></i></span>
                                    <section class="sidebar-nav-sub-wrapper">
                                        <section class="sidebar-nav-sub-item">
                                    <span class="sidebar-nav-sub-item-title"><a href="#">لوازم جانبی موبایل</a><i
                                                class="fa fa-angle-left"></i></span>
                                            <section class="sidebar-nav-sub-sub-wrapper">
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هدست</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">اسپیکر موبایل</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">پاوربانک</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری بیسیم</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">قاب موبایل</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هولدر نگهدارنده</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">شارژر بیسیم</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">مونوپاد</a></section>
                                            </section>
                                        </section>
                                        <section class="sidebar-nav-sub-item">
                                    <span class="sidebar-nav-sub-item-title"><a href="#">لوازم جانبی موبایل</a><i
                                                class="fa fa-angle-left"></i></span>
                                            <section class="sidebar-nav-sub-sub-wrapper">
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هدست</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">اسپیکر موبایل</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">پاوربانک</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری بیسیم</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">قاب موبایل</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هولدر نگهدارنده</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">شارژر بیسیم</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">مونوپاد</a></section>
                                            </section>
                                        </section>
                                    </section>
                                </section>
                                <section class="sidebar-nav-item">
                                    <span class="sidebar-nav-item-title">مد و پوشاک <i class="fa fa-angle-left"></i></span>
                                    <section class="sidebar-nav-sub-wrapper">
                                        <section class="sidebar-nav-sub-item">
                                    <span class="sidebar-nav-sub-item-title"><a href="#">لوازم جانبی موبایل</a><i
                                                class="fa fa-angle-left"></i></span>
                                            <section class="sidebar-nav-sub-sub-wrapper">
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هدست</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">اسپیکر موبایل</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">پاوربانک</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری بیسیم</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">قاب موبایل</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هولدر نگهدارنده</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">شارژر بیسیم</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">مونوپاد</a></section>
                                            </section>
                                        </section>
                                        <section class="sidebar-nav-sub-item">
                                    <span class="sidebar-nav-sub-item-title"><a href="#">لوازم جانبی موبایل</a><i
                                                class="fa fa-angle-left"></i></span>
                                            <section class="sidebar-nav-sub-sub-wrapper">
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هدست</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">اسپیکر موبایل</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">پاوربانک</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری بیسیم</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">قاب موبایل</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هولدر نگهدارنده</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">شارژر بیسیم</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">مونوپاد</a></section>
                                            </section>
                                        </section>
                                    </section>
                                </section>
                                <section class="sidebar-nav-item">
                            <span class="sidebar-nav-item-title">اسباب بازی، کودک و نوزاد <i
                                        class="fa fa-angle-left"></i></span>
                                    <section class="sidebar-nav-sub-wrapper">
                                        <section class="sidebar-nav-sub-item">
                                    <span class="sidebar-nav-sub-item-title"><a href="#">لوازم جانبی موبایل</a><i
                                                class="fa fa-angle-left"></i></span>
                                            <section class="sidebar-nav-sub-sub-wrapper">
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هدست</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">اسپیکر موبایل</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">پاوربانک</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری بیسیم</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">قاب موبایل</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هولدر نگهدارنده</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">شارژر بیسیم</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">مونوپاد</a></section>
                                            </section>
                                        </section>
                                        <section class="sidebar-nav-sub-item">
                                    <span class="sidebar-nav-sub-item-title"><a href="#">لوازم جانبی موبایل</a><i
                                                class="fa fa-angle-left"></i></span>
                                            <section class="sidebar-nav-sub-sub-wrapper">
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هدست</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">اسپیکر موبایل</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">پاوربانک</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری بیسیم</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">قاب موبایل</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هولدر نگهدارنده</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">شارژر بیسیم</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">مونوپاد</a></section>
                                            </section>
                                        </section>
                                    </section>
                                </section>
                                <section class="sidebar-nav-item">
                            <span class="sidebar-nav-item-title">کالاهای سوپرمارکتی <i
                                        class="fa fa-angle-left"></i></span>
                                    <section class="sidebar-nav-sub-wrapper">
                                        <section class="sidebar-nav-sub-item">
                                    <span class="sidebar-nav-sub-item-title"><a href="#">لوازم جانبی موبایل</a><i
                                                class="fa fa-angle-left"></i></span>
                                            <section class="sidebar-nav-sub-sub-wrapper">
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هدست</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">اسپیکر موبایل</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">پاوربانک</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری بیسیم</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">قاب موبایل</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هولدر نگهدارنده</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">شارژر بیسیم</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">مونوپاد</a></section>
                                            </section>
                                        </section>
                                        <section class="sidebar-nav-sub-item">
                                    <span class="sidebar-nav-sub-item-title"><a href="#">لوازم جانبی موبایل</a><i
                                                class="fa fa-angle-left"></i></span>
                                            <section class="sidebar-nav-sub-sub-wrapper">
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هدست</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">اسپیکر موبایل</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">پاوربانک</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری بیسیم</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">قاب موبایل</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هولدر نگهدارنده</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">شارژر بیسیم</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">مونوپاد</a></section>
                                            </section>
                                        </section>
                                    </section>
                                </section>
                                <section class="sidebar-nav-item">
                                    <span class="sidebar-nav-item-title">زیبایی و سلامت <i class="fa fa-angle-left"></i></span>
                                    <section class="sidebar-nav-sub-wrapper">
                                        <section class="sidebar-nav-sub-item">
                                    <span class="sidebar-nav-sub-item-title"><a href="#">لوازم جانبی موبایل</a><i
                                                class="fa fa-angle-left"></i></span>
                                            <section class="sidebar-nav-sub-sub-wrapper">
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هدست</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">اسپیکر موبایل</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">پاوربانک</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری بیسیم</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">قاب موبایل</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هولدر نگهدارنده</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">شارژر بیسیم</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">مونوپاد</a></section>
                                            </section>
                                        </section>
                                        <section class="sidebar-nav-sub-item">
                                    <span class="sidebar-nav-sub-item-title"><a href="#">لوازم جانبی موبایل</a><i
                                                class="fa fa-angle-left"></i></span>
                                            <section class="sidebar-nav-sub-sub-wrapper">
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هدست</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">اسپیکر موبایل</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">پاوربانک</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری بیسیم</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">قاب موبایل</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هولدر نگهدارنده</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">شارژر بیسیم</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">مونوپاد</a></section>
                                            </section>
                                        </section>
                                    </section>
                                </section>
                                <section class="sidebar-nav-item">
                                    <span class="sidebar-nav-item-title">خانه و آشپزخانه <i class="fa fa-angle-left"></i></span>
                                    <section class="sidebar-nav-sub-wrapper">
                                        <section class="sidebar-nav-sub-item">
                                    <span class="sidebar-nav-sub-item-title"><a href="#">لوازم جانبی موبایل</a><i
                                                class="fa fa-angle-left"></i></span>
                                            <section class="sidebar-nav-sub-sub-wrapper">
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هدست</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">اسپیکر موبایل</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">پاوربانک</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری بیسیم</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">قاب موبایل</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هولدر نگهدارنده</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">شارژر بیسیم</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">مونوپاد</a></section>
                                            </section>
                                        </section>
                                        <section class="sidebar-nav-sub-item">
                                    <span class="sidebar-nav-sub-item-title"><a href="#">لوازم جانبی موبایل</a><i
                                                class="fa fa-angle-left"></i></span>
                                            <section class="sidebar-nav-sub-sub-wrapper">
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هدست</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">اسپیکر موبایل</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">پاوربانک</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری بیسیم</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">قاب موبایل</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هولدر نگهدارنده</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">شارژر بیسیم</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">مونوپاد</a></section>
                                            </section>
                                        </section>
                                    </section>
                                </section>
                                <section class="sidebar-nav-item">
                            <span class="sidebar-nav-item-title">کتاب، لوازم تحریر و هنر <i
                                        class="fa fa-angle-left"></i></span>
                                    <section class="sidebar-nav-sub-wrapper">
                                        <section class="sidebar-nav-sub-item">
                                    <span class="sidebar-nav-sub-item-title"><a href="#">لوازم جانبی موبایل</a><i
                                                class="fa fa-angle-left"></i></span>
                                            <section class="sidebar-nav-sub-sub-wrapper">
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هدست</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">اسپیکر موبایل</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">پاوربانک</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری بیسیم</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">قاب موبایل</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هولدر نگهدارنده</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">شارژر بیسیم</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">مونوپاد</a></section>
                                            </section>
                                        </section>
                                        <section class="sidebar-nav-sub-item">
                                    <span class="sidebar-nav-sub-item-title"><a href="#">لوازم جانبی موبایل</a><i
                                                class="fa fa-angle-left"></i></span>
                                            <section class="sidebar-nav-sub-sub-wrapper">
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هدست</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">اسپیکر موبایل</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">پاوربانک</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری بیسیم</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">قاب موبایل</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هولدر نگهدارنده</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">شارژر بیسیم</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">مونوپاد</a></section>
                                            </section>
                                        </section>
                                    </section>
                                </section>
                                <section class="sidebar-nav-item">
                                    <span class="sidebar-nav-item-title">ورزش و سفر <i class="fa fa-angle-left"></i></span>
                                    <section class="sidebar-nav-sub-wrapper">
                                        <section class="sidebar-nav-sub-item">
                                    <span class="sidebar-nav-sub-item-title"><a href="#">لوازم جانبی موبایل</a><i
                                                class="fa fa-angle-left"></i></span>
                                            <section class="sidebar-nav-sub-sub-wrapper">
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هدست</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">اسپیکر موبایل</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">پاوربانک</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری بیسیم</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">قاب موبایل</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هولدر نگهدارنده</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">شارژر بیسیم</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">مونوپاد</a></section>
                                            </section>
                                        </section>
                                        <section class="sidebar-nav-sub-item">
                                    <span class="sidebar-nav-sub-item-title"><a href="#">لوازم جانبی موبایل</a><i
                                                class="fa fa-angle-left"></i></span>
                                            <section class="sidebar-nav-sub-sub-wrapper">
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هدست</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">اسپیکر موبایل</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">پاوربانک</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری بیسیم</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">قاب موبایل</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هولدر نگهدارنده</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">شارژر بیسیم</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">مونوپاد</a></section>
                                            </section>
                                        </section>
                                    </section>
                                </section>
                                <section class="sidebar-nav-item">
                            <span class="sidebar-nav-item-title">محصولات بومی و محلی <i
                                        class="fa fa-angle-left"></i></span>
                                    <section class="sidebar-nav-sub-wrapper">
                                        <section class="sidebar-nav-sub-item">
                                    <span class="sidebar-nav-sub-item-title"><a href="#">لوازم جانبی موبایل</a><i
                                                class="fa fa-angle-left"></i></span>
                                            <section class="sidebar-nav-sub-sub-wrapper">
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هدست</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">اسپیکر موبایل</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">پاوربانک</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری بیسیم</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">قاب موبایل</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هولدر نگهدارنده</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">شارژر بیسیم</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">مونوپاد</a></section>
                                            </section>
                                        </section>
                                        <section class="sidebar-nav-sub-item">
                                    <span class="sidebar-nav-sub-item-title"><a href="#">لوازم جانبی موبایل</a><i
                                                class="fa fa-angle-left"></i></span>
                                            <section class="sidebar-nav-sub-sub-wrapper">
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هدست</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">اسپیکر موبایل</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">پاوربانک</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هندزفری بیسیم</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">قاب موبایل</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">هولدر نگهدارنده</a>
                                                </section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">شارژر بیسیم</a></section>
                                                <section class="sidebar-nav-sub-sub-item"><a href="#">مونوپاد</a></section>
                                            </section>
                                        </section>
                                    </section>
                                </section>

                            </section>
                            <!--end sidebar nav-->
                        </section>

                        <section class="content-wrapper bg-white p-3 rounded-2 mb-3">
                            <section class="content-header mb-3">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title content-header-title-small">
                                        جستجو در نتایج
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>

                            <section class="">
                                <input class="sidebar-input-text" type="text" placeholder="جستجو بر اساس نام، برند ..." name="search" value="{{ request()->search }}">
                            </section>
                        </section>

                        <section class="content-wrapper bg-white p-3 rounded-2 mb-3">
                            <section class="content-header mb-3">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title content-header-title-small">
                                        برند
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>

                            <section class="sidebar-brand-wrapper">
                                @forelse($brands as $brand)
                                    <section class="form-check sidebar-brand-item">
                                        <input class="form-check-input" type="checkbox" name="brands[]" value="{{ $brand->id }}" id="brand_{{ $brand->id }}"
                                                @checked(request()->has('brands') && in_array($brand->id, request()->brands))
                                        >
                                        <label class="form-check-label d-flex justify-content-between" for="brand_{{ $brand->id }}">
                                            <span>{{ $brand->persian_name ?? '-' }}</span>
                                            <span>{{ $brand->original_name ?? '-' }}</span>
                                        </label>
                                    </section>
                                @empty
                                @endforelse
                            </section>
                        </section>


                        <section class="content-wrapper bg-white p-3 rounded-2 mb-3">
                            <section class="content-header mb-3">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title content-header-title-small">
                                        محدوده قیمت
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>
                            <section class="sidebar-price-range d-flex justify-content-between">
                                <section class="p-1"><input type="text" placeholder="قیمت از ..." name="min_price" value="{{ request()->min_price }}"></section>
                                <section class="p-1"><input type="text" placeholder="قیمت تا ..." name="max_price" value="{{ request()->max_price }}"></section>
                            </section>
                        </section>


                        <section class="content-wrapper bg-white p-3 rounded-2 mb-3">
                            <section class="sidebar-filter-btn d-grid gap-2">
                                <button class="btn btn-danger" type="submit">اعمال فیلتر</button>
                            </section>
                        </section>

                    </form>

                </aside>
                <main id="main-body" class="main-body col-md-9">
                    <section class="content-wrapper bg-white p-3 rounded-2 mb-2">
                        <section class="filters mb-3">
                            @if(request()->filled('search'))
                                <span class="d-inline-block border p-1 rounded bg-light">نتیجه جستجو برای : <span class="badge bg-info text-dark">"{{ request()->search }}"</span></span>
                            @endif
                            @if(request()->filled('brands'))
                                <span class="d-inline-block border p-1 rounded bg-light">برند : <span class="badge bg-info text-dark">"{{ $selectedBrands->implode('persian_name',',') }}"</span></span>
                            @endif
                            @if(request()->filled('category'))
                                <span class="d-inline-block border p-1 rounded bg-light">دسته : <span class="badge bg-info text-dark">"کتاب"</span></span>
                            @endif
                            @if(request()->filled('min_price'))
                                <span class="d-inline-block border p-1 rounded bg-light">قیمت از : <span class="badge bg-info text-dark">{{ priceFormat(request()->min_price) }}</span></span>
                            @endif
                            @if(request()->filled('max_price'))
                                <span class="d-inline-block border p-1 rounded bg-light">قیمت تا : <span class="badge bg-info text-dark">{{ priceFormat(request()->max_price) }}</span></span>
                            @endif
                        </section>
                        <section class="sort ">
                            <span>مرتب سازی بر اساس : </span>
                            <a href="{{ route('customer.products', ['search'=> request()->search, 'sort'=> '1', 'min_price' => request()->min_price, 'max_price' => request()->max_price, 'brands' => request()->brands]) }}" @class(["btn btn-sm px-1 py-0", 'btn-info' => request()->sort == 1, 'btn-light' => request()->sort != 1])>جدیدترین</a>
                            {{-- <a href="{{ route('customer.products', ['search'=> request()->search, 'sort'=> '2']) }}" @class("btn btn-light btn-sm px-1 py-0)">محبوب ترین</a>--}}
                            <a href="{{ route('customer.products', ['search'=> request()->search, 'sort'=> '2', 'min_price' => request()->min_price, 'max_price' => request()->max_price, 'brands' => request()->brands]) }}" @class(["btn btn-sm px-1 py-0", 'btn-info' => request()->sort == 2, 'btn-light' => request()->sort != 2])>گران
                                ترین</a>
                            <a href="{{ route('customer.products', ['search'=> request()->search, 'sort'=> '3', 'min_price' => request()->min_price, 'max_price' => request()->max_price, 'brands' => request()->brands]) }}" @class(["btn btn-sm px-1 py-0", 'btn-info' => request()->sort == 3 ,'btn-light' => request()->sort != 3])>ارزان
                                ترین</a>
                            <a href="{{ route('customer.products', ['search'=> request()->search, 'sort'=> '4', 'min_price' => request()->min_price, 'max_price' => request()->max_price, 'brands' => request()->brands]) }}" @class(["btn btn-sm px-1 py-0", 'btn-info' => request()->sort == 4,'btn-light' => request()->sort != 4])>پربازدیدترین</a>
                            <a href="{{ route('customer.products', ['search'=> request()->search, 'sort'=> '5', 'min_price' => request()->min_price, 'max_price' => request()->max_price, 'brands' => request()->brands]) }}" @class(["btn btn-sm px-1 py-0", 'btn-info' => request()->sort == 5,'btn-light' => request()->sort != 5])>پرفروش
                                ترین</a>
                        </section>


                        <section class="main-product-wrapper row my-4">


                            @forelse ($products as $product)
                                <section class="col-md-3 p-0">
                                    <section class="product">
                                        <section class="product-add-to-cart"><a href="#" data-bs-toggle="tooltip"
                                                                                data-bs-placement="left" title="افزودن به سبد خرید"><i
                                                        class="fa fa-cart-plus"></i></a></section>
                                        <section class="product-add-to-favorite"><a href="#" data-bs-toggle="tooltip"
                                                                                    data-bs-placement="left" title="افزودن به علاقه مندی"><i
                                                        class="fa fa-heart"></i></a></section>
                                        <a class="product-link" href="#">
                                            <section class="product-image">
                                                <img class="" src="{{ asset($product->image['indexArray']['medium']) }}" alt="">
                                            </section>
                                            <section class="product-colors"></section>
                                            <section class="product-name">
                                                <h3>{{ $product->name }}</h3>
                                            </section>
                                            <section class="product-price-wrapper">
                                                <section class="product-price">{{ priceFormat($product->price) }}</section>
                                            </section>
                                        </a>
                                    </section>
                                </section>
                            @empty
                                <h1 class="text-danger">محصولی یافت نشد</h1>
                            @endforelse


                            <section class="col-12">
                                <section class="my-4 d-flex justify-content-center">
                                    <nav>
                                        <ul class="pagination">
                                            {{ $products->links('pagination::bootstrap-5') }}
                                            {{--                                            <li class="page-item">--}}
                                            {{--                                                <a class="page-link" href="#" aria-label="Previous">--}}
                                            {{--                                                    <span aria-hidden="true">&laquo;</span>--}}
                                            {{--                                                </a>--}}
                                            {{--                                            </li>--}}
                                            {{--                                            <li class="page-item"><a class="page-link" href="#">1</a></li>--}}
                                            {{--                                            <li class="page-item active"><a class="page-link" href="#">2</a></li>--}}
                                            {{--                                            <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
                                            {{--                                            <li class="page-item">--}}
                                            {{--                                                <a class="page-link" href="#" aria-label="Next">--}}
                                            {{--                                                    <span aria-hidden="true">&raquo;</span>--}}
                                            {{--                                                </a>--}}
                                            {{--                                            </li>--}}
                                        </ul>
                                    </nav>
                                </section>
                            </section>

                        </section>


                    </section>
                </main>
            </section>
        </section>
    </section>
    <!-- end body -->

@endsection

@section('script')

    <script>
        $('.product-add-to-favorite button').click(function () {
            var url = $(this).attr('data-url');
            var element = $(this);
            $.ajax({
                url: url,
                success: function (result) {
                    if (result.status == 1) {
                        $(element).children().first().addClass('text-danger');
                        $(element).attr('data-original-title', 'حذف از علاقه مندی ها');
                        $(element).attr('data-bs-original-title', 'حذف از علاقه مندی ها');
                    } else if (result.status == 2) {
                        $(element).children().first().removeClass('text-danger')
                        $(element).attr('data-original-title', 'افزودن از علاقه مندی ها');
                        $(element).attr('data-bs-original-title', 'افزودن از علاقه مندی ها');
                    } else if (result.status == 3) {
                        $('.toast').toast('show');
                    }
                }
            })
        })
    </script>

@endsection
