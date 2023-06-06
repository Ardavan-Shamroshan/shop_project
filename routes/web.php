<?php


use App\Http\Controllers\Admin\Market\GuaranteeController;
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Customer\Profile\ProfileController;
use App\Http\Controllers\Customer\SalesProcess\AddressController;
use App\Http\Controllers\Customer\SalesProcess\CartController;
use App\Http\Controllers\Customer\SalesProcess\ProfileCompletionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\Market\CategoryController as MarketCategoryController;
use App\Http\Controllers\Admin\Market\CommentController as MarketCommentController;
use App\Http\Controllers\Admin\Market\BrandController;
use App\Http\Controllers\Admin\Market\DiscountController;
use App\Http\Controllers\Admin\Market\DeliveryController;
use App\Http\Controllers\Admin\Market\OrderController;
use App\Http\Controllers\Admin\Market\PaymentController;
use App\Http\Controllers\Admin\Market\ProductController;
use App\Http\Controllers\Admin\Market\GalleryController;
use App\Http\Controllers\Admin\Market\ProductColorController;
use App\Http\Controllers\Admin\Market\PropertyController;
use App\Http\Controllers\Admin\Market\PropertyValueController;
use App\Http\Controllers\Admin\Market\StoreRoomController;
use App\Http\Controllers\Admin\Content\CategoryController as ContentCategoryController;
use App\Http\Controllers\Admin\Content\CommentController as ContentCommentController;
use App\Http\Controllers\Admin\Content\FAQController;
use App\Http\Controllers\Admin\Content\MenuController;
use App\Http\Controllers\Admin\Content\SlideController;
use App\Http\Controllers\Admin\Content\PageController;
use App\Http\Controllers\Admin\Content\PostController;
use App\Http\Controllers\Admin\Content\QuickLinkController;
use App\Http\Controllers\Admin\Content\ServiceController;
use App\Http\Controllers\Admin\Content\BannerController;
use App\Http\Controllers\Admin\User\AdminUserController;
use App\Http\Controllers\Admin\User\RoleController;
use App\Http\Controllers\Admin\User\PermissionController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\Notify\EmailController;
use App\Http\Controllers\Admin\Notify\SMSController;
use App\Http\Controllers\Admin\Notify\EmailFileController;
use App\Http\Controllers\Admin\Ticket\TicketController;
use App\Http\Controllers\Admin\Ticket\TicketCategoryController;
use App\Http\Controllers\Admin\Ticket\TicketPriorityController;
use App\Http\Controllers\Admin\Ticket\TicketAdminController;
use App\Http\Controllers\Admin\Setting\SettingController;
use App\Http\Controllers\Auth\Customer\LoginRegisterController;
use App\Http\Controllers\Customer\Market\ProductController as MarketProductController;
use App\Http\Controllers\Customer\SalesProcess\PaymentController as CustomerPaymentController;
use App\Http\Controllers\Customer\Profile\OrderController as ProfileOrderController;
use App\Http\Controllers\Customer\Profile\FavoriteController;
use App\Http\Controllers\Customer\Profile\AddressController as ProfileAddressController;
use App\Http\Controllers\Customer\Profile\TicketController as ProfileTicketController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*
|--------------------------------------------------------------------------
| Jetstream
|--------------------------------------------------------------------------
*/

Route::get('manual-login', function (){
    Auth::login  (\App\Models\User::find(1));
    return to_route('customer.home');
});

//Route::middleware(['auth:sanctum', 'verified', 'admin'])->get('/dashboard', function () {
//    return view('dashboard');
//})->name('dashboard');

/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
*/

Route::namespace('Auth')->group(function () {
    Route::get('login-register', [LoginRegisterController::class, 'loginRegisterForm'])->name('auth.customer.loginRegisterForm');
    Route::middleware('throttle:customer-login-register-limiter')->post('login-register', [LoginRegisterController::class, 'loginRegister'])->name('auth.customer.loginRegister');
    Route::get('login-confirm/{token}', [LoginRegisterController::class, 'loginConfirmForm'])->name('auth.customer.loginConfirmForm');
    Route::middleware('throttle:customer-login-confirm-limiter')->post('login-confirm/{token}', [LoginRegisterController::class, 'loginConfirm'])->name('auth.customer.loginConfirm');
    Route::middleware('throttle:customer-login-resend-otp-limiter')->get('login-resend-otp/{token}', [LoginRegisterController::class, 'loginResendOtp'])->name('auth.customer.loginResendOtp');
    Route::get('logout', [LoginRegisterController::class, 'logout'])->name('auth.customer.logout');
});


/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->namespace('Admin')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.home');
    /*
    |--------------------------------------------------------------------------
    | Market
    |--------------------------------------------------------------------------
    */
    Route::prefix('market')->namespace('Market')->group(function () {
        // Category
        Route::prefix('category')->group(function () {
            Route::get('/', [MarketCategoryController::class, 'index'])->name('admin.market.category');
            Route::get('/create', [MarketCategoryController::class, 'create'])->name('admin.market.category.create');
            Route::post('/store', [MarketCategoryController::class, 'store'])->name('admin.market.category.store');
            Route::get('/edit/{productCategory}', [MarketCategoryController::class, 'edit'])->name('admin.market.category.edit');
            Route::put('/update/{productCategory}', [MarketCategoryController::class, 'update'])->name('admin.market.category.update');
            Route::delete('/destroy/{productCategory}', [MarketCategoryController::class, 'destroy'])->name('admin.market.category.destroy');
            Route::get('/status/{productCategory}', [MarketCategoryController::class, 'status'])->name('admin.market.category.status');
            Route::get('/show-in-menu/{productCategory}', [MarketCategoryController::class, 'showInMenu'])->name('admin.market.category.showInMenu');
        });
        // Brand
        Route::prefix('brand')->group(function () {
            Route::get('/', [BrandController::class, 'index'])->name('admin.market.brand');
            Route::get('/create', [BrandController::class, 'create'])->name('admin.market.brand.create');
            Route::post('/store', [BrandController::class, 'store'])->name('admin.market.brand.store');
            Route::get('/edit/{brand}', [BrandController::class, 'edit'])->name('admin.market.brand.edit');
            Route::put('/update/{brand}', [BrandController::class, 'update'])->name('admin.market.brand.update');
            Route::delete('/destroy/{brand}', [BrandController::class, 'destroy'])->name('admin.market.brand.destroy');
            Route::get('/status/{brand}', [BrandController::class, 'status'])->name('admin.market.brand.status');
        });
        // Comment
        Route::prefix('comment')->group(function () {
            Route::get('/', [MarketCommentController::class, 'index'])->name('admin.market.comment');
            Route::get('/show/{comment}', [MarketCommentController::class, 'show'])->name('admin.market.comment.show');
            Route::post('/confirm', [MarketCommentController::class, 'confirm'])->name('admin.market.comment.confirm');
            Route::get('/edit/comment', [MarketCommentController::class, 'edit'])->name('admin.market.comment.edit');
            Route::put('/update/{comment}', [MarketCommentController::class, 'update'])->name('admin.market.comment.update');
            Route::delete('/destroy/{comment}', [MarketCommentController::class, 'destroy'])->name('admin.market.comment.destroy');
            Route::get('/status/{comment}', [MarketCommentController::class, 'status'])->name('admin.market.comment.status');
            Route::post('/answer/{comment}', [MarketCommentController::class, 'answer'])->name('admin.market.comment.answer');
            Route::get('/seen/{comment}', [MarketCommentController::class, 'seen'])->name('admin.market.comment.seen');
            Route::get('/approved/{comment}', [MarketCommentController::class, 'approved'])->name('admin.market.comment.approved');
        });
        // Delivery
        Route::prefix('delivery')->group(function () {
            Route::get('/', [DeliveryController::class, 'index'])->name('admin.market.delivery');
            Route::get('/create', [DeliveryController::class, 'create'])->name('admin.market.delivery.create');
            Route::post('/store', [DeliveryController::class, 'store'])->name('admin.market.delivery.store');
            Route::get('/edit/{delivery}', [DeliveryController::class, 'edit'])->name('admin.market.delivery.edit');
            Route::put('/update/{delivery}', [DeliveryController::class, 'update'])->name('admin.market.delivery.update');
            Route::delete('/destroy/{delivery}', [DeliveryController::class, 'destroy'])->name('admin.market.delivery.destroy');
            Route::get('/status/{delivery}', [DeliveryController::class, 'status'])->name('admin.market.delivery.status');
        });
        // Discount
        Route::prefix('discount')->group(function () {
            Route::prefix('coupon')->group(function () {
                Route::get('/', [DiscountController::class, 'coupon'])->name('admin.market.discount.coupon');
                Route::get('/create', [DiscountController::class, 'couponCreate'])->name('admin.market.discount.coupon.create');
                Route::post('/store', [DiscountController::class, 'couponStore'])->name('admin.market.discount.coupon.store');
                Route::get('/edit/{coupon}', [DiscountController::class, 'couponEdit'])->name('admin.market.discount.coupon.edit');
                Route::put('/update/{coupon}', [DiscountController::class, 'couponUpdate'])->name('admin.market.discount.coupon.update');
                Route::delete('/destroy/{coupon}', [DiscountController::class, 'couponDestroy'])->name('admin.market.discount.coupon.destroy');
            });
            Route::prefix('common-discount')->group(function () {
                Route::get('/', [DiscountController::class, 'commonDiscount'])->name('admin.market.discount.commonDiscount');
                Route::get('/create', [DiscountController::class, 'commonDiscountCreate'])->name('admin.market.discount.commonDiscount.create');
                Route::post('/store', [DiscountController::class, 'commonDiscountStore'])->name('admin.market.discount.commonDiscount.store');
                Route::get('/edit/{commonDiscount}', [DiscountController::class, 'commonDiscountEdit'])->name('admin.market.discount.commonDiscount.edit');
                Route::put('/update/{commonDiscount}', [DiscountController::class, 'commonDiscountUpdate'])->name('admin.market.discount.commonDiscount.update');
                Route::delete('/destroy/{commonDiscount}', [DiscountController::class, 'commonDiscountDestroy'])->name('admin.market.discount.commonDiscount.destroy');
            });
            Route::prefix('amazing-sale')->group(function () {
                Route::get('/', [DiscountController::class, 'amazingSale'])->name('admin.market.discount.amazingSale');
                Route::get('/create', [DiscountController::class, 'amazingSaleCreate'])->name('admin.market.discount.amazingSale.create');
                Route::post('/store', [DiscountController::class, 'amazingSaleStore'])->name('admin.market.discount.amazingSale.store');
                Route::get('/edit/{amazingSale}', [DiscountController::class, 'amazingSaleEdit'])->name('admin.market.discount.amazingSale.edit');
                Route::put('/update/{amazingSale}', [DiscountController::class, 'amazingSaleUpdate'])->name('admin.market.discount.amazingSale.update');
                Route::delete('/destroy/{amazingSale}', [DiscountController::class, 'amazingSaleDestroy'])->name('admin.market.discount.amazingSale.destroy');
            });
        });
        // Order
        Route::prefix('order')->group(function () {
            Route::get('/', [OrderController::class, 'all'])->name('admin.market.order.all');
            Route::get('/show/{order}', [OrderController::class, 'show'])->name('admin.market.order.show');
            Route::get('/show/{order}/detail', [OrderController::class, 'detail'])->name('admin.market.order.show.detail');
            Route::get('/new-order', [OrderController::class, 'newOrders'])->name('admin.market.order.newOrder');
            Route::get('/sending', [OrderController::class, 'sending'])->name('admin.market.order.sending');
            Route::get('/unpaid', [OrderController::class, 'unpaid'])->name('admin.market.order.unpaid');
            Route::get('/canceled', [OrderController::class, 'canceled'])->name('admin.market.order.canceled');
            Route::get('/returned', [OrderController::class, 'returned'])->name('admin.market.order.returned');
            Route::get('/change-send-status/{order}', [OrderController::class, 'changeSendStatus'])->name('admin.market.order.changeSendStatus');
            Route::get('/change-order-status/{order}', [OrderController::class, 'changeOrderStatus'])->name('admin.market.order.changeOrderStatus');
            Route::delete('/destroy/{order}', [OrderController::class, 'destroy'])->name('admin.market.order.destroy');
        });
        // Payment
        Route::prefix('payment')->group(function () {
            Route::get('/', [PaymentController::class, 'index'])->name('admin.market.payment');
            Route::get('/show/{payment}', [PaymentController::class, 'show'])->name('admin.market.payment.show');
            Route::get('/online', [PaymentController::class, 'online'])->name('admin.market.payment.online');
            Route::get('/offline', [PaymentController::class, 'offline'])->name('admin.market.payment.offline');
            Route::get('/cash', [PaymentController::class, 'cash'])->name('admin.market.payment.cash');
            Route::get('/canceled/{payment}', [PaymentController::class, 'canceled'])->name('admin.market.payment.canceled');
            Route::get('/returned/{payment}', [PaymentController::class, 'returned'])->name('admin.market.payment.returned');
        });
        // Product
        Route::prefix('product')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('admin.market.product');
            Route::get('/create', [ProductController::class, 'create'])->name('admin.market.product.create');
            Route::post('/store', [ProductController::class, 'store'])->name('admin.market.product.store');
            Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('admin.market.product.edit');
            Route::put('/update/{product}', [ProductController::class, 'update'])->name('admin.market.product.update');
            Route::delete('/destroy/{product}', [ProductController::class, 'destroy'])->name('admin.market.product.destroy');
            Route::get('/status/{product}', [ProductController::class, 'status'])->name('admin.market.product.status');
            // Product color
            Route::prefix('color')->group(function () {
                Route::get('/{product}', [ProductColorController::class, 'index'])->name('admin.market.product.color');
                Route::get('/{product}/create', [ProductColorController::class, 'create'])->name('admin.market.product.color.create');
                Route::post('/{product}/store', [ProductColorController::class, 'store'])->name('admin.market.product.color.store');
                Route::delete('/destroy/{product}/{color}', [ProductColorController::class, 'destroy'])->name('admin.market.product.color.destroy');
            });
            // Gallery
            Route::prefix('{product}/gallery')->group(function () {
                Route::get('/', [GalleryController::class, 'index'])->name('admin.market.product.gallery');
                Route::post('/store', [GalleryController::class, 'store'])->name('admin.market.product.gallery.store');
                Route::delete('/destroy/{gallery}', [GalleryController::class, 'destroy'])->name('admin.market.product.gallery.destroy');
            });
            // Guarantee
            Route::prefix('{product}/guarantee')->group(function () {
                Route::get('/', [GuaranteeController::class, 'index'])->name('admin.market.product.guarantee');
                Route::get('/create', [GuaranteeController::class, 'create'])->name('admin.market.product.guarantee.create');
                Route::post('/store', [GuaranteeController::class, 'store'])->name('admin.market.product.guarantee.store');
                Route::delete('/destroy/{guarantee}', [GuaranteeController::class, 'destroy'])->name('admin.market.product.guarantee.destroy');
            });
        });
        // Property
        Route::prefix('property')->group(function () {
            Route::get('/', [PropertyController::class, 'index'])->name('admin.market.property');
            Route::get('/create', [PropertyController::class, 'create'])->name('admin.market.property.create');
            Route::post('/store', [PropertyController::class, 'store'])->name('admin.market.property.store');
            Route::get('/edit/{attribute}', [PropertyController::class, 'edit'])->name('admin.market.property.edit');
            Route::put('/update/{attribute}', [PropertyController::class, 'update'])->name('admin.market.property.update');
            Route::delete('/destroy/{attribute}', [PropertyController::class, 'destroy'])->name('admin.market.property.destroy');
            Route::get('/status/{attribute}', [PropertyController::class, 'status'])->name('admin.market.property.status');
            // Attribute value
            Route::prefix('{attribute}/value')->group(function () {
                Route::get('/', [PropertyValueController::class, 'index'])->name('admin.market.property.value');
                Route::get('/create', [PropertyValueController::class, 'create'])->name('admin.market.property.value.create');
                Route::post('/store', [PropertyValueController::class, 'store'])->name('admin.market.property.value.store');
                Route::get('/edit/{value}', [PropertyValueController::class, 'edit'])->name('admin.market.property.value.edit');
                Route::put('/update/{value}', [PropertyValueController::class, 'update'])->name('admin.market.property.value.update');
                Route::delete('/destroy/{value}', [PropertyValueController::class, 'destroy'])->name('admin.market.property.value.destroy');
            });
        });
        // Storeroom
        Route::prefix('storeroom')->group(function () {
            Route::get('/', [StoreRoomController::class, 'index'])->name('admin.market.storeroom');
            Route::get('/add-to-store/{product}', [StoreRoomController::class, 'addToStore'])->name('admin.market.storeroom.addToStore');
            Route::post('/store/{product}', [StoreRoomController::class, 'store'])->name('admin.market.storeroom.store');
            Route::get('/edit/{product}', [StoreRoomController::class, 'edit'])->name('admin.market.storeroom.edit');
            Route::put('/update/{product}', [StoreRoomController::class, 'update'])->name('admin.market.storeroom.update');
        });
    });
    /*
    |--------------------------------------------------------------------------
    | Content
    |--------------------------------------------------------------------------
    */
    Route::prefix('content')->namespace('Content')->group(function () {
        // Category
        // Route::prefix('category')->middleware('role:operator')->group(function () {
        Route::prefix('category')->group(function () {
            Route::get('/', [ContentCategoryController::class, 'index'])->name('admin.content.category');
            Route::get('/create', [ContentCategoryController::class, 'create'])->name('admin.content.category.create');
            Route::post('/store', [ContentCategoryController::class, 'store'])->name('admin.content.category.store');
            Route::get('/edit/{postCategory}', [ContentCategoryController::class, 'edit'])->name('admin.content.category.edit');
            Route::put('/update/{postCategory}', [ContentCategoryController::class, 'update'])->name('admin.content.category.update');
            Route::delete('/destroy/{postCategory}', [ContentCategoryController::class, 'destroy'])->name('admin.content.category.destroy');
            Route::get('/status/{postCategory}', [ContentCategoryController::class, 'status'])->name('admin.content.category.status');
        });

        // Comment
        Route::prefix('comment')->group(function () {
            Route::get('/', [ContentCommentController::class, 'index'])->name('admin.content.comment');
            Route::get('/show/{comment}', [ContentCommentController::class, 'show'])->name('admin.content.comment.show');
            Route::get('/confirm', [ContentCommentController::class, 'confirm'])->name('admin.content.comment.confirm');
            Route::get('/edit/{comment}', [ContentCommentController::class, 'edit'])->name('admin.content.comment.edit');
            Route::put('/update/{comment}', [ContentCommentController::class, 'update'])->name('admin.content.comment.update');
            Route::delete('/destroy/{comment}', [ContentCommentController::class, 'destroy'])->name('admin.content.comment.destroy');
            Route::post('/answer/{comment}', [ContentCommentController::class, 'answer'])->name('admin.content.comment.answer');
            Route::get('/status/{comment}', [ContentCommentController::class, 'status'])->name('admin.content.comment.status');
            Route::get('/seen/{comment}', [ContentCommentController::class, 'seen'])->name('admin.content.comment.seen');
            Route::get('/approved/{comment}', [ContentCommentController::class, 'approved'])->name('admin.content.comment.approved');
        });

        // Slide
        Route::prefix('slide')->group(function () {
            Route::get('/', [SlideController::class, 'index'])->name('admin.content.slide');
            Route::get('/create', [SlideController::class, 'create'])->name('admin.content.slide.create');
            Route::post('/store', [SlideController::class, 'store'])->name('admin.content.slide.store');
            Route::get('/edit/{slide}', [SlideController::class, 'edit'])->name('admin.content.slide.edit');
            Route::put('/update/{slide}', [SlideController::class, 'update'])->name('admin.content.slide.update');
            Route::delete('/destroy/{slide}', [SlideController::class, 'destroy'])->name('admin.content.slide.destroy');
            Route::get('/status/{slide}', [SlideController::class, 'status'])->name('admin.content.slide.status');
        });

        // FAQ
        Route::prefix('faq')->group(function () {
            Route::get('/', [FAQController::class, 'index'])->name('admin.content.faq');
            Route::get('/create', [FAQController::class, 'create'])->name('admin.content.faq.create');
            Route::post('/store', [FAQController::class, 'store'])->name('admin.content.faq.store');
            Route::get('/edit/{faq}', [FAQController::class, 'edit'])->name('admin.content.faq.edit');
            Route::put('/update/{faq}', [FAQController::class, 'update'])->name('admin.content.faq.update');
            Route::delete('/destroy/{faq}', [FAQController::class, 'destroy'])->name('admin.content.faq.destroy');
            Route::get('/status/{faq}', [FAQController::class, 'status'])->name('admin.content.faq.status');
        });

        // Menu
        Route::prefix('menu')->group(function () {
            Route::get('/', [MenuController::class, 'index'])->name('admin.content.menu');
            Route::get('/create', [MenuController::class, 'create'])->name('admin.content.menu.create');
            Route::post('/store', [MenuController::class, 'store'])->name('admin.content.menu.store');
            Route::get('/edit/{menu}', [MenuController::class, 'edit'])->name('admin.content.menu.edit');
            Route::put('/update/{menu}', [MenuController::class, 'update'])->name('admin.content.menu.update');
            Route::delete('/destroy/{menu}', [MenuController::class, 'destroy'])->name('admin.content.menu.destroy');
            Route::get('/status/{menu}', [MenuController::class, 'status'])->name('admin.content.menu.status');
        });

        // Page
        Route::prefix('page')->group(function () {
            Route::get('/', [PageController::class, 'index'])->name('admin.content.page');
            Route::get('/create', [PageController::class, 'create'])->name('admin.content.page.create');
            Route::post('/store', [PageController::class, 'store'])->name('admin.content.page.store');
            Route::get('/edit/{page}', [PageController::class, 'edit'])->name('admin.content.page.edit');
            Route::put('/update/{page}', [PageController::class, 'update'])->name('admin.content.page.update');
            Route::delete('/destroy/{page}', [PageController::class, 'destroy'])->name('admin.content.page.destroy');
            Route::get('/status/{page}', [PageController::class, 'status'])->name('admin.content.page.status');
        });

        // Post
        Route::prefix('post')->group(function () {
            Route::get('/', [PostController::class, 'index'])->name('admin.content.post');
            Route::get('/create', [PostController::class, 'create'])->name('admin.content.post.create');
            Route::get('/show/{post}', [PostController::class, 'show'])->name('admin.content.post.show');
            Route::post('/store', [PostController::class, 'store'])->name('admin.content.post.store');

//            Route::post('/store', [PostController::class, 'store'])->name('admin.content.post.store')->middleware('can:update,App\Models\Content\Post');
//            Route::post('/store', [PostController::class, 'store'])->name('admin.content.post.store')->can('update', App\Models\Content\Post::class);

            Route::get('/edit/{post}', [PostController::class, 'edit'])->name('admin.content.post.edit');
            Route::put('/update/{post}', [PostController::class, 'update'])->name('admin.content.post.update');
//
//            Route::put('/update/{post}', [PostController::class, 'update'])->name('admin.content.post.update')->middleware('can:update,post');
//            Route::put('/update/{post}', [PostController::class, 'update'])->name('admin.content.post.update')->can('update','post');

            Route::delete('/destroy/{post}', [PostController::class, 'destroy'])->name('admin.content.post.destroy');
            Route::get('/status/{post}', [PostController::class, 'status'])->name('admin.content.post.status');
            Route::get('/commentable/{post}', [PostController::class, 'commentable'])->name('admin.content.post.commentable');
        });

        // Service
        Route::prefix('service')->group(function () {
            Route::get('/', [ServiceController::class, 'index'])->name('admin.content.service');
            Route::get('/create', [ServiceController::class, 'create'])->name('admin.content.service.create');
            Route::get('/show/{service}', [ServiceController::class, 'show'])->name('admin.content.service.show');
            Route::post('/store', [ServiceController::class, 'store'])->name('admin.content.service.store');
            Route::get('/edit/{service}', [ServiceController::class, 'edit'])->name('admin.content.service.edit');
            Route::put('/update/{service}', [ServiceController::class, 'update'])->name('admin.content.service.update');
            Route::delete('/destroy/{service}', [ServiceController::class, 'destroy'])->name('admin.content.service.destroy');
            Route::get('/status/{service}', [ServiceController::class, 'status'])->name('admin.content.service.status');
        });

        // Quick Link
        Route::prefix('quickLink')->group(function () {
            Route::get('/', [QuickLinkController::class, 'index'])->name('admin.content.quickLink');
            Route::get('/create', [QuickLinkController::class, 'create'])->name('admin.content.quickLink.create');
            Route::get('/show/{quickLink}', [QuickLinkController::class, 'show'])->name('admin.content.quickLink.show');
            Route::post('/store', [QuickLinkController::class, 'store'])->name('admin.content.quickLink.store');
            Route::get('/edit/{quickLink}', [QuickLinkController::class, 'edit'])->name('admin.content.quickLink.edit');
            Route::put('/update/{quickLink}', [QuickLinkController::class, 'update'])->name('admin.content.quickLink.update');
            Route::delete('/destroy/{quickLink}', [QuickLinkController::class, 'destroy'])->name('admin.content.quickLink.destroy');
            Route::get('/status/{quickLink}', [QuickLinkController::class, 'status'])->name('admin.content.quickLink.status');
        });

        Route::prefix('banner')->group(function () {
            Route::get('/', [BannerController::class, 'index'])->name('admin.content.banner');
            Route::get('/create', [BannerController::class, 'create'])->name('admin.content.banner.create');
            Route::post('/store', [BannerController::class, 'store'])->name('admin.content.banner.store');
            Route::get('/edit/{banner}', [BannerController::class, 'edit'])->name('admin.content.banner.edit');
            Route::put('/update/{banner}', [BannerController::class, 'update'])->name('admin.content.banner.update');
            Route::delete('/destroy/{banner}', [BannerController::class, 'destroy'])->name('admin.content.banner.destroy');
            Route::get('/status/{banner}', [BannerController::class, 'status'])->name('admin.content.banner.status');
        });
    });
    /*
    |--------------------------------------------------------------------------
    | User
    |--------------------------------------------------------------------------
    */
    Route::prefix('user')->namespace('User')->group(function () {
        // َAdmin-User
        Route::prefix('admin-user')->group(function () {
            Route::get('/', [AdminUserController::class, 'index'])->name('admin.user.admin-user');
            Route::get('/create', [AdminUserController::class, 'create'])->name('admin.user.admin-user.create');
            Route::post('/store', [AdminUserController::class, 'store'])->name('admin.user.admin-user.store');
            Route::get('/edit/{admin}', [AdminUserController::class, 'edit'])->name('admin.user.admin-user.edit');
            Route::put('/update/{admin}', [AdminUserController::class, 'update'])->name('admin.user.admin-user.update');
            Route::delete('/destroy/{admin}', [AdminUserController::class, 'destroy'])->name('admin.user.admin-user.destroy');
            Route::get('/status/{admin}', [AdminUserController::class, 'status'])->name('admin.user.admin-user.status');
            Route::get('/activation/{admin}', [AdminUserController::class, 'activation'])->name('admin.user.admin-user.activation');
            // admin roles
            Route::get('roles/{admin}', [AdminUserController::class, 'roles'])->name('admin.user.admin-user.roles');
            Route::post('roles/{admin}/store', [AdminUserController::class, 'rolesStore'])->name('admin.user.admin-user.roles.store');
            // admin permissions
            Route::get('permissions/{admin}', [AdminUserController::class, 'permissions'])->name('admin.user.admin-user.permissions');
            Route::post('permissions/{admin}/store', [AdminUserController::class, 'permissionsStore'])->name('admin.user.admin-user.permissions.store');
        });

        // User
        Route::prefix('user')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('admin.user');
            Route::get('/create', [UserController::class, 'create'])->name('admin.user.create');
            Route::post('/store', [UserController::class, 'store'])->name('admin.user.store');
            Route::get('/edit/{user}', [UserController::class, 'edit'])->name('admin.user.edit');
            Route::put('/update/{user}', [UserController::class, 'update'])->name('admin.user.update');
            Route::delete('/destroy/{user}', [UserController::class, 'destroy'])->name('admin.user.destroy');
            Route::get('/status/{user}', [UserController::class, 'status'])->name('admin.user.status');
            Route::get('/activation/{user}', [UserController::class, 'activation'])->name('admin.user.activation');
        });

        // Role
        Route::prefix('role')->group(function () {
            Route::get('/', [RoleController::class, 'index'])->name('admin.user.role');
            Route::get('/create', [RoleController::class, 'create'])->name('admin.user.role.create');
            Route::post('/store', [RoleController::class, 'store'])->name('admin.user.role.store');
            Route::get('/edit/{role}', [RoleController::class, 'edit'])->name('admin.user.role.edit');
            Route::put('/update/{role}', [RoleController::class, 'update'])->name('admin.user.role.update');
            Route::delete('/destroy/{role}', [RoleController::class, 'destroy'])->name('admin.user.role.destroy');
            Route::get('/permission-form/{role}', [RoleController::class, 'permissionForm'])->name('admin.user.role.permission-form');
            Route::put('/permission-update/{role}', [RoleController::class, 'permissionUpdate'])->name('admin.user.role.permission-update');
        });

        // Permission
        Route::prefix('permission')->group(function () {
            Route::get('/', [PermissionController::class, 'index'])->name('admin.user.permission');
            Route::get('/create', [PermissionController::class, 'create'])->name('admin.user.permission.create');
            Route::post('/store', [PermissionController::class, 'store'])->name('admin.user.permission.store');
            Route::get('/edit/{permission}', [PermissionController::class, 'edit'])->name('admin.user.permission.edit');
            Route::put('/update/{permission}', [PermissionController::class, 'update'])->name('admin.user.permission.update');
            Route::delete('/destroy/{permission}', [PermissionController::class, 'destroy'])->name('admin.user.permission.destroy');
        });
    });
    /*
    |--------------------------------------------------------------------------
    | Notify
    |--------------------------------------------------------------------------
    */
    Route::prefix('notify')->namespace('Notify')->group(function () {
        // email
        Route::prefix('email')->group(function () {
            Route::get('/', [EmailController::class, 'index'])->name('admin.notify.email');
            Route::get('/create', [EmailController::class, 'create'])->name('admin.notify.email.create');
            Route::post('/store', [EmailController::class, 'store'])->name('admin.notify.email.store');
            Route::get('/edit/{email}', [EmailController::class, 'edit'])->name('admin.notify.email.edit');
            Route::put('/update/{email}', [EmailController::class, 'update'])->name('admin.notify.email.update');
            Route::delete('/destroy/{email}', [EmailController::class, 'destroy'])->name('admin.notify.email.destroy');
            Route::get('/status/{email}', [EmailController::class, 'status'])->name('admin.notify.email.status');
        });

        // email file
        Route::prefix('email-file')->group(function () {
            Route::get('/{email}', [EmailFileController::class, 'index'])->name('admin.notify.email-file');
            Route::get('/{email}/create', [EmailFileController::class, 'create'])->name('admin.notify.email-file.create');
            Route::post('/{email}/store', [EmailFileController::class, 'store'])->name('admin.notify.email-file.store');
            Route::get('/edit/{file}', [EmailFileController::class, 'edit'])->name('admin.notify.email-file.edit');
            Route::put('/update/{file}', [EmailFileController::class, 'update'])->name('admin.notify.email-file.update');
            Route::delete('/destroy/{file}', [EmailFileController::class, 'destroy'])->name('admin.notify.email-file.destroy');
            Route::get('/status/{file}', [EmailFileController::class, 'status'])->name('admin.notify.email-file.status');
        });

        // SMS
        Route::prefix('sms')->group(function () {
            Route::get('/', [SMSController::class, 'index'])->name('admin.notify.sms');
            Route::get('/create', [SMSController::class, 'create'])->name('admin.notify.sms.create');
            Route::post('/store', [SMSController::class, 'store'])->name('admin.notify.sms.store');
            Route::get('/edit/{sms}', [SMSController::class, 'edit'])->name('admin.notify.sms.edit');
            Route::put('/update/{sms}', [SMSController::class, 'update'])->name('admin.notify.sms.update');
            Route::delete('/destroy/{sms}', [SMSController::class, 'destroy'])->name('admin.notify.sms.destroy');
            Route::get('/status/{sms}', [SMSController::class, 'status'])->name('admin.notify.sms.status');
        });
    });
    /*
    |--------------------------------------------------------------------------
    | Ticket
    |--------------------------------------------------------------------------
    */
    Route::prefix('ticket')->namespace('Ticket')->group(function () {
        // Category
        Route::prefix('category')->group(function () {
            Route::get('/', [TicketCategoryController::class, 'index'])->name('admin.ticket.category');
            Route::get('/create', [TicketCategoryController::class, 'create'])->name('admin.ticket.category.create');
            Route::post('/store', [TicketCategoryController::class, 'store'])->name('admin.ticket.category.store');
            Route::get('/edit/{ticketCategory}', [TicketCategoryController::class, 'edit'])->name('admin.ticket.category.edit');
            Route::put('/update/{ticketCategory}', [TicketCategoryController::class, 'update'])->name('admin.ticket.category.update');
            Route::delete('/destroy/{ticketCategory}', [TicketCategoryController::class, 'destroy'])->name('admin.ticket.category.destroy');
            Route::get('/status/{ticketCategory}', [TicketCategoryController::class, 'status'])->name('admin.ticket.category.status');
        });

        // Priority
        Route::prefix('priority')->group(function () {
            Route::get('/', [TicketPriorityController::class, 'index'])->name('admin.ticket.priority');
            Route::get('/create', [TicketPriorityController::class, 'create'])->name('admin.ticket.priority.create');
            Route::post('/store', [TicketPriorityController::class, 'store'])->name('admin.ticket.priority.store');
            Route::get('/edit/{ticketPriority}', [TicketPriorityController::class, 'edit'])->name('admin.ticket.priority.edit');
            Route::put('/update/{ticketPriority}', [TicketPriorityController::class, 'update'])->name('admin.ticket.priority.update');
            Route::delete('/destroy/{ticketPriority}', [TicketPriorityController::class, 'destroy'])->name('admin.ticket.priority.destroy');
            Route::get('/status/{ticketPriority}', [TicketPriorityController::class, 'status'])->name('admin.ticket.priority.status');
        });

        // Admin Ticket
        Route::prefix('admin')->group(function () {
            Route::get('/', [TicketAdminController::class, 'index'])->name('admin.ticket.admin');
            Route::get('/set/{admin}', [TicketAdminController::class, 'set'])->name('admin.ticket.admin.set');
        });

        // Main Tickets
        Route::get('/', [TicketController::class, 'index'])->name('admin.ticket');
        Route::get('/new-tickets', [TicketController::class, 'newTickets'])->name('admin.ticket.newTickets');
        Route::get('/open-tickets', [TicketController::class, 'openTickets'])->name('admin.ticket.openTickets');
        Route::get('/close-tickets', [TicketController::class, 'closeTickets'])->name('admin.ticket.closeTickets');
        Route::get('/show/{ticket}', [TicketController::class, 'show'])->name('admin.ticket.show');
        Route::post('/answer/{ticket}', [TicketController::class, 'answer'])->name('admin.ticket.answer');
        Route::get('/change/{ticket}', [TicketController::class, 'change'])->name('admin.ticket.change');
    });
    /*
    |--------------------------------------------------------------------------
    | Setting
    |--------------------------------------------------------------------------
    */
    Route::prefix('setting')->namespace('Setting')->group(function () {
        // Settings
        Route::get('/', [SettingController::class, 'index'])->name('admin.setting');
        Route::get('/create', [SettingController::class, 'create'])->name('admin.setting.create');
        Route::post('/store', [SettingController::class, 'store'])->name('admin.setting.store');
        Route::get('/edit/{setting}', [SettingController::class, 'edit'])->name('admin.setting.edit');
        Route::put('/update/{setting}', [SettingController::class, 'update'])->name('admin.setting.update');
        Route::delete('/destroy/{setting}', [SettingController::class, 'destroy'])->name('admin.setting.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | Notification Read All
    |--------------------------------------------------------------------------
    */
    Route::post('/notification/read-all', function () {
        $notifications = \App\Models\Notification::all();
        foreach ($notifications as $notification) {
            $notification->update(['read_at' => now()]);
        }
    })->name('admin.setting.readAll');
});

/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'home'])->name('customer.home');
Route::get('/products/{category:slug?}', [HomeController::class, 'products'])->name('customer.products');


// Product
Route::controller(MarketProductController::class)->prefix('product')->group(function () {
    Route::get('/{product:slug}/', 'product')->name('customer.market.product');
    Route::post('/{product:slug}/add-comment', 'addComment')->name('customer.market.product.add-comment');
    Route::get('/{product:slug}/add-to-favorite', 'addToFavorite')->name('customer.market.product.add-to-favorite');
    Route::get('/{product:slug}/add-to-compare', 'addToCompare')->name('customer.market.product.add-to-compare');
    Route::get('/{product:slug}/add-rate', 'addRate')->name('customer.market.product.add-rate');
});

Route::prefix('sales-process')->group(function () {
    // Cart
    Route::controller(CartController::class)->prefix('cart')->group(function () {
        Route::get('/', 'cart')->name('customer.sales-process.cart');
        Route::post('/', 'updateCart')->name('customer.sales-process.cart.update-cart');
        Route::post('/add-to-cart/{product:slug}', 'addToCart')->name('customer.sales-process.cart.add-to-cart');
        Route::get('/remove-from-cart/{cartItem}', 'removeFromCart')->name('customer.sales-process.cart.remove-from-cart');
    });

    // Address and Delivery
    Route::middleware('profile.completion')->group(function () {
        Route::controller(AddressController::class)->prefix('address-and-delivery')->group(function () {
            Route::get('/', 'addressAndDelivery')->name('customer.sales-process.address-and-delivery');
            Route::post('/add-address', 'addAddress')->name('customer.sales-process.addAddress');
            Route::put('/update-address/{address}', 'updateAddress')->name('customer.sales-process.updateAddress');
            Route::post('/choose-address-and-delivery/', 'chooseAddressAndDelivery')->name('customer.sales-process.choose-address-and-delivery');
            Route::get('/get-cities/{province}', 'getCities')->name('customer.sales-process.getCities');
        });

        // Payment
        Route::controller(CustomerPaymentController::class)->prefix('payment')->group(function () {
            Route::get('/', 'payment')->name('customer.sales-process.payment');
            Route::post('/coupon-discount', 'couponDiscount')->name('customer.sales-process.coupon-discount');
            Route::post('/coupon-discount', 'couponDiscount')->name('customer.sales-process.coupon-discount');
            Route::post('/payment-submit', 'paymentSubmit')->name('customer.sales-process.payment-submit');
            // zarinpal callback url
            Route::any('/payment-callback/{order}/{onlinePayment}', 'paymentCallback')->name('customer.sales-process.payment-callback');
        });
    });

    // Profile Completion
    Route::controller(ProfileCompletionController::class)->prefix('profile-completion')->group(function () {
        Route::get('/', 'profileCompletion')->name('customer.sales-process.profile-completion');
        Route::post('/', 'completion')->name('customer.sales-process.profile-completion.completion');
    });
});

// Profile
Route::middleware('auth')->prefix('profile')->group(function () {
    // profile
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/', 'index')->name('customer.profile');
        Route::put('/update', 'update')->name('customer.profile.update');
    });
    // orders
    Route::controller(ProfileAddressController::class)->prefix('my-addresses')->group(function () {
        Route::get('/', 'index')->name('customer.profile.my-addresses');
    });

    // orders
    Route::controller(ProfileOrderController::class)->prefix('orders')->group(function () {
        Route::get('/', 'index')->name('customer.profile.orders');
    });
    // favorite products
    Route::controller(FavoriteController::class)->prefix('my-favorites')->group(function () {
        Route::get('/', 'index')->name('customer.profile.my-favorites');
        Route::get('/remove/{product}', 'remove')->name('customer.profile.my-favorites.remove');
    });

    // compare products
    Route::get('my-compares', [\App\Http\Controllers\Customer\Profile\CompareController::class, 'index'])->name('customer.profile.my-compares');

    // tickets
    Route::controller(ProfileTicketController::class)->prefix('my-tickets')->group(function () {
        Route::get('/', 'index')->name('customer.profile.my-tickets');
        Route::get('/show/{ticket}', 'show')->name('customer.profile.my-tickets.show');
        Route::post('/answer/{ticket}', 'answer')->name('customer.profile.my-tickets.answer');
        Route::get('/change/{ticket}', 'change')->name('customer.profile.my-tickets.change');
        Route::get('/create', 'create')->name('customer.profile.my-tickets.create');
        Route::post('/store', 'store')->name('customer.profile.my-tickets.store');
    });

});


/*
|--------------------------------------------------------------------------
| Fallback
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    abort(404);
});