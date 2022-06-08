@extends('admin.layouts.master')
@section('head-tag')
    <title>داشبورد اصلی</title>
@endsection
@section('content')
    <section class="row px-4 py-2">
        <section class="col-lg-3 col-md-6 col-12">
            <a href="#" class="text-decoration-none d-block mb-4">
                <section class="rounded bg-custom-yellow text-white">
                    <section class="card-body">
                        <section class="d-flex justify-content-between">
                            <section class="info-box-body">
                                <h4 class="font-weight-bold">{{ $postsCount }}</h4>
                                <h6>مقاله</h6>
                            </section>
                            <section class="info-box-icon">
                                <i class="fas fa-newspaper text-custom-yellow" style="font-size: 2.5rem!important;"></i>
                            </section>
                        </section>
                    </section>
                    <section class="card-footer info-box-footer">
                        <i class="fas fa-clock mx-2 font"></i> به روز رسانی شده در : {{ jalaliDate(now(), '%A, %d %B ساعت H:i') }}
                    </section>
                </section>
            </a>
        </section>
        <section class="col-lg-3 col-md-6 col-12">
            <a href="#" class="text-decoration-none d-block mb-4">
                <section class="rounded bg-custom-green text-white">
                    <section class="card-body">
                        <section class="d-flex justify-content-between">
                            <section class="info-box-body">
                                <h4 class="font-weight-bold">{{ $postCategoriesCount }}</h4>
                                <h6>دسته بندی مقاله</h6>
                            </section>
                            <section class="info-box-icon">
                                <i class="fas fa-book text-custom-green" style="font-size: 2.5rem!important;"></i>
                            </section>
                        </section>
                    </section>
                    <section class="card-footer info-box-footer">
                        <i class="fas fa-clock mx-2 font"></i> به روز رسانی شده در : {{ jalaliDate(now(), '%A, %d %B ساعت H:i') }}
                    </section>
                </section>
            </a>
        </section>
        <section class="col-lg-3 col-md-6 col-12">
            <a href="#" class="text-decoration-none d-block mb-4">
                <section class="rounded bg-custom-pink text-white shadow-sm border-0">
                    <section class="card-body">
                        <section class="d-flex justify-content-between">
                            <section class="info-box-body">
                                <h4 class="font-weight-bold">{{ $commentsCount }}</h4>
                                <h6>نظر</h6>
                            </section>
                            <section class="info-box-icon">
                                <i class="fas fa-comments text-custom-pink" style="font-size: 2.5rem!important;"></i>
                            </section>
                        </section>
                    </section>
                    <section class="card-footer info-box-footer">
                        <i class="fas fa-clock mx-2 font"></i> به روز رسانی شده در : {{ jalaliDate(now(), '%A, %d %B ساعت H:i') }}
                    </section>
                </section>
            </a>
        </section>
        <section class="col-lg-3 col-md-6 col-12">
            <a href="#" class="text-decoration-none d-block mb-4">
                <section class="rounded bg-custom-blue text-white shadow-sm border-0">
                    <section class="card-body">
                        <section class="d-flex justify-content-between">
                            <section class="info-box-body">
                                <h4 class="font-weight-bold">{{ $adminsCount }}</h4>
                                <h6>ادمین فعال</h6>
                            </section>
                            <section class="info-box-icon">
                                <i class="fas fa-user-secret text-custom-blue" style="font-size: 2.5rem!important;"></i>
                            </section>
                        </section>
                    </section>
                    <section class="card-footer info-box-footer">
                        <i class="fas fa-clock mx-2 font"></i> به روز رسانی شده در : {{ jalaliDate(now(), '%A, %d %B ساعت H:i') }}
                    </section>
                </section>
            </a>
        </section>
        <section class="col-lg-3 col-md-6 col-12">
            <a href="#" class="text-decoration-none d-block mb-4">
                <section class="rounded text-dark card border-0 shadow-sm">
                    <section class="card-body">
                        <section class="d-flex justify-content-between">
                            <section class="info-box-body">
                                <h4 class="font-weight-bold text-custom-yellow">{{ $usersCount }}</h4>
                                <h6 class="text-muted font-weight-bd">کاربر فعال</h6>
                            </section>
                            <section class="info-box-icon">
                                <i class="fas fa-user-astronaut text-custom-yellow"></i>
                            </section>
                        </section>
                    </section>
                    <section class="card-footer info-box-footer bg-custom-yellow text-white">
                        <i class="fas fa-clock mx-2 font"></i> به روز رسانی شده در : {{ jalaliDate(now(), '%A, %d %B ساعت H:i') }}
                    </section>
                </section>
            </a>
        </section>
        <section class="col-lg-3 col-md-6 col-12">
            <a href="#" class="text-decoration-none d-block mb-4">
                <section class="rounded text-dark card border-0 shadow-sm">
                    <section class="card-body">
                        <section class="d-flex justify-content-between">
                            <section class="info-box-body">
                                <h4 class="font-weight-bold text-custom-green">{{ $ticketsCount }}</h4>
                                <h6 class="text-muted font-weight-bold">تیکت</h6>
                            </section>
                            <section class="info-box-icon">
                                <i class="fas fa-ticket-alt text-custom-green"></i>
                            </section>
                        </section>
                    </section>
                    <section class="card-footer text-white info-box-footer bg-custom-green">
                        <i class="fas fa-clock mx-2 font"></i> به روز رسانی شده در : {{ jalaliDate(now(), '%A, %d %B ساعت H:i') }}
                    </section>
                </section>
            </a>
        </section>
        <section class="col-lg-3 col-md-6 col-12">
            <a href="#" class="text-decoration-none d-block mb-4">
                <section class="rounded text-dark card border-0 shadow-sm">
                    <section class="card-body">
                        <section class="d-flex justify-content-between">
                            <section class="info-box-body">
                                <h4 class="font-weight-bold text-custom-pink">{{ $smsCount }}</h4>
                                <h5 class="font-weight-bold text-muted">اطلاعیه پیامکی</h5>
                            </section>
                            <section class="info-box-icon">
                                <i class="fas fa-sms text-custom-pink"></i>
                            </section>
                        </section>
                    </section>
                    <section class="card-footer info-box-footer bg-custom-pink text-white">
                        <i class="fas fa-clock mx-2 font"></i> به روز رسانی شده در : {{ jalaliDate(now(), '%A, %d %B ساعت H:i') }}
                    </section>
                </section>
            </a>
        </section>
        <section class="col-lg-3 col-md-6 col-12">
            <a href="#" class="text-decoration-none d-block mb-4">
                <section class="rounded text-dark card border-0 shadow-sm">
                    <section class="card-body">
                        <section class="d-flex justify-content-between">
                            <section class="info-box-body">
                                <h4 class="font-weight-bold text-custom-blue">{{ $emailsCount }}</h4>
                                <h6 class="text-muted font-weight-bold">اطلاعیه ایمیلی</h6>
                            </section>
                            <section class="info-box-icon">
                                <i class="fas fa-mail-bulk text-custom-blue"></i>
                            </section>
                        </section>
                    </section>
                    <section class="card-footer info-box-footer bg-custom-blue text-white">
                        <i class="fas fa-clock mx-2 font"></i> به روز رسانی شده در : {{ jalaliDate(now(), '%A, %d %B ساعت H:i') }}
                    </section>
                </section>
            </a>
        </section>

    </section>
    <section class="row px-4">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>درباره آپا</h5>
                    <p>مرکز آپا دانشگاه شهید چمران اهواز</p>
                </section>
                <section class="body-content col-12 d-flex justify-content-between">
                    <section class="col-md-4">
                        <h4> آموزش و اطلاع رسانی</h4>
                        <p>
                            مدیران شرکت ها و سازمان ها همیشه نگران این هستند که نا آگاهی افراد مجموعه تحت امرشان از مسائل امنیتی میتواند به نشت اطلاعات منجر شود.
                            چنین موضوعی علاوه بر تبعات مالی سنگین میتواند اعتبار آن مجوعه را زیر سوال ببرد. از طرف دیگر، یافتن و استخدام افراد متخصص در حوزه امنیت فضا مجازی، چالشی بزرگ است. لازمه‌ی هر اقدام هوشمندانه‌ای، داشتن علم و گسترش دانش در آن زمینه است. مرکز آپا میتواند در این راه به یاری مدیران مجموعه ها آمده و با برگزاری کارگاه های آموزشی در سطوح مختلف، به ارتقا سطح علمی و تخصصی افراد کمک کند.

                        </p>
                    </section>
                    <section class="col-md-4">
                        <h4> پشتیبانی و ایمن‌سازی</h4>
                        <p>
                            مسائل امنیت فضای مجازی در نگاه اول اولویت چندانی ندارند اما در صورتی که یک تهدید واقع شود، بسیار قابل توجه است. در کنار این موضوع پیشرفته شدن تهدیدات فضای مجازی و استفاده از فناوری های به روز مؤید این مطلب است که مدیران سازمان ها باید منظم و پیوسته برنامه هایی برای پیشگیری از حملات و تهدیدات فضا مجازی داشته باشند.
                            از این رو مرکز آپا آماده است ضمن عقد قرارداد های پشتیبانی در سطوح مختلف و با حفظ محرمانگی در جهت پیشگیری از وقوع تهدیدات، با سازمان ها همکاری کند.
                        </p>
                    </section>
                    <section class="col-md-4">
                        <h4> امــداد رســانی</h4>
                        <p>
                            وقوع تهدیدات امنیتی را میتوان کاهش داد اما نمیتوان رخداد آن را به صفر رساند. آن چیزی که برای مدیران سازمان ها جلوه میکند، این موضوع است که اثر تهدیدات رخ داده از نظر مالی و اعتباری به سازمان، حداقل باشد.
                            لذا وجود یک تیم امداد به همین منظور لازم است. از ویژگی های یک تیم امداد میتوان به پاسخ گویی در اسرع وقت، در دسترس پذیری و آگاهی و دانش بالا اشاره کرد. مرکز آپا با در اختیار داشتن نیرو های متخصص میتواند در این راستا به مدیران سازمان ها یاری رساند تا اثرات منفی حملات و تهدیدات را کاهش دهد.
                        </p>
                    </section>
                </section>

                <section class="body-content col-12 d-flex justify-content-between">
                    <section class="col-md-4">
                        <h4> خدمات آموزشی شامل :</h4>
                        <p>
                            - آموزش مفاهیم پایه امنیت و جرم‌یابی به عوامل و مسئولین
                            - برگزاری دوره‌های آموزشی ویژه با توجه به نیازهای مجموعه
                            - آموزش امنیت فضای ابری، تلفن‌همراه و غیره
                            - آموزش مقابله با نفوذ از طریق وب، اکسس پوینت و غیره
                        </p>
                    </section>
                    <section class="col-md-4">
                        <h4>خدمات پشتیبانی شامل :</h4>
                        <p>
                            - پایش شبکه‌های داخلی و سیستم‌ها
                            - ارائه راهکارهای امنیتی مناسب با شبکه‌ها و سامانه‌های موجود
                            - مطلع نمودن مجموعه‌ها از آخرین آسیب پذیری‌ها و خطرات احتمالی
                            - تحلیل ترافیک و داده‌ها به منظور جرم‌یابی </p>
                    </section>
                    <section class="col-md-4">
                        <h4> خدمات امداد شامل :</h4>
                        <p>
                            - آگاهی رسانی به پرسنل و ارائه راهکار در صورت وقوع تهدید
                            - جداسازی شبکه و سیستم‌های آلوده به منظور جلوگیری از شیوع تهدید و کاهش اثرات حمله
                            - ارزیابی بد افزار ها و باج افزار ها در صورت شیوع آنها در شبکه
                            - جرم‌یابی به منظور یافتن منبع حملات و وقایع امنیتی </p>
                    </section>
                </section>
            </section>
        </section>
    </section>

@endsection
@section('script')
@endsection