<?php

use App\Http\Controllers\Admin\Blog\PostController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Elevator\eedController;
use App\Http\Controllers\Admin\Global\ChartController;
use App\Http\Controllers\Admin\Global\LogController;
use App\Http\Controllers\Admin\Global\MediaController;
use App\Http\Controllers\Admin\Global\MenuController;
use App\Http\Controllers\Admin\Global\PageController;
use App\Http\Controllers\Admin\Global\SettingController;
use App\Http\Controllers\Admin\Global\SliderController;
use App\Http\Controllers\Admin\Message\MessageController;
use App\Http\Controllers\Admin\Shop\BarcodeController;
use App\Http\Controllers\Admin\Shop\BrandController;
use App\Http\Controllers\Admin\Shop\CategoryController;
use App\Http\Controllers\Admin\Shop\CommentController;
use App\Http\Controllers\Admin\Shop\CouponController;
use App\Http\Controllers\Admin\Shop\OrderController;
use App\Http\Controllers\Admin\Shop\ProductController;
use App\Http\Controllers\Admin\Shop\SubcategoryController;
use App\Http\Controllers\Admin\Shop\TagController;
use App\Http\Controllers\Admin\Shop\TypeController;
use App\Http\Controllers\Admin\Stock\BatchController;
use App\Http\Controllers\Admin\Stock\InventoryController;
use App\Http\Controllers\Admin\Supplier\SupplierController;
use App\Http\Controllers\Admin\User\CustomerController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Front\Blog\BlogController;
use App\Http\Controllers\Front\Store\Cart\CheckoutController;
use App\Livewire\Auth\Logout;
use App\Livewire\Front\Blog\IndexBlog;
use App\Livewire\Front\Blog\SingleArticle;
use App\Livewire\Front\Cart\Callback;
use App\Livewire\Front\Cart\Checkout;
use App\Livewire\Front\Panel\Clientarea;
use App\Livewire\Front\Shop\ProductIndex;
use App\Livewire\Front\Shop\Single\SingleProduct;
use App\Livewire\Front\Static\ContactUs;
use App\Livewire\Front\Static\EED;
use App\Livewire\Front\User\Expert;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
| be assigned to the "web" middleware group. Make something great!
|*/

Route::get('/',\App\Livewire\Front\Home::class)->name('home');


//Logout Authenticated User
Route::middleware('throttle:25,1')->post('/logout', [Logout::class, 'logout'])->name('logout');


// Admin Routes Group
Route::middleware(['throttle:100,1','CheckAccess'])->prefix('admin')->group(function ()
{




    Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');
    Route::get('getChartData/new', [ChartController::class,'getChartData'])->name('get-chart-data');
    Route::get('getSalesDiff',[DashboardController::class,'getSalesDifference'])->name('getSalesDiff');

    Route::get('log', [LogController::class,'index'])->name('log-system');
    Route::get('log/save', [LogController::class,'saveLog'])->name('log-save');
    Route::get('log/delete', [LogController::class,'deleteLogs'])->name('log-delete');

    //Global Routes
    Route::get('setting',[SettingController::class,'index'])->name('setting');
    Route::get('setting/optimize',[SettingController::class,'clearCache'])->name('clearCache');
    Route::post('setting/update',[SettingController::class,'update'])->name('setting-update');
    Route::resource('slider',SliderController::class);


    Route::resource('menu',MenuController::class);
    Route::resource('page',PageController::class);
    Route::match(['post', 'put'], 'page-validator', [PageController::class, 'live_validator'])->name('page-validator');
    Route::delete('/delete-image/{id}', [SliderController::class,'liveDelete'])->name('delete-slider-image');
    Route::get('multimedia', [MediaController::class,'index'])->name('multimedia.index');
    Route::get('multimedia/delete/{id}', [MediaController::class,'destroy'])->name('multimedia.destroy');
    Route::post('multimedia/store', [MediaController::class,'store'])->name('multimedia.store');

    //Elevator features Routes
    Route::resource('eed',eedController::class);

    Route::resource('expert/profile',expert::class);

    //Store Routes Group
    Route::prefix('store')->group(function ()
    {

        Route::resource('products',ProductController::class);
        Route::resource('categories',CategoryController::class);
        Route::resource('tags',TagController::class);
        Route::resource('brands',BrandController::class);
        Route::resource('orders',OrderController::class);
        Route::resource('coupons',CouponController::class);
        //Types

        //Order
        Route::middleware('throttle:2,1')->post('orders/coupon/validator',[CheckoutController::class,'CouponValidate'])->name('couponValidator');

        Route::put('types/edit/', [TypeController::class, 'edit'])->name('edit-type');
        Route::put('types/delete/', [TypeController::class, 'destroy'])->name('delete-type');


        Route::get('get-subcategories',[SubcategoryController::class,'GetSubcategories'])->name('get-subcategories');
        Route::match(['post', 'put'], 'product-validator', [ProductController::class, 'live_validator'])->name('product-validator');
        Route::post('liveRemove/{id}',[ProductController::class,'liveRemove'])->name('liveRemove');
        Route::get('barcode',[BarcodeController::class,'index'])->name('barcode');
        //Live Comments  Route Actions - In Product Edit Page
        Route::post('liveReplySave',[CommentController::class,'liveReplySave'])->name('liveReplySave');
        Route::post('liveDeleteComment',[CommentController::class,'liveDeleteComment'])->name('liveDeleteComment');
        Route::post('liveConfirmComment',[CommentController::class,'liveConfirmComment'])->name('liveConfirmComment');

    });

    //Blog Routes Group
    Route::prefix('blog')->group(function ()
    {
        Route::resource('posts',PostController::class);
        Route::resource('blogTags',\App\Http\Controllers\Admin\Blog\TagController::class);
        Route::resource('blogCategories',\App\Http\Controllers\Admin\Blog\CategoryController::class);
        Route::match(['post', 'put'], 'post-validator', [PostController::class, 'live_validator'])->name('post-validator');
        Route::post('liveRemove/{id}',[PostController::class,'liveRemove'])->name('liveRemoveImg');

    });


    //Blog Routes Group
    Route::middleware('throttle:20,1')->prefix('inventory')->group(function ()
    {

        Route::resource('batch',BatchController::class);
        Route::resource('stock',InventoryController::class);
        Route::post('stock/actions/increase/sales',[InventoryController::class,'increaseSales'])->name('live_increase_sales');
        Route::post('batch/{id}', [BatchController::class, 'destroy'])->name('liveRemoveBatch');

        Route::resource('supplier',SupplierController::class);

    });


    //Users Routes Group
    Route::prefix('users')->group(function ()
    {

        Route::resource('user',UserController::class);
        Route::resource('customers',CustomerController::class);
        Route::post('channelSend',[MessageController::class,'channelSend'])->name('channelSend');

    });

});
//Fronts...
Route::prefix('')->group(function ()
{
    //Panel Routes
    Route::middleware(['throttle:100,1','CheckAuth'])->prefix('')->group(function ()
    {
        Route::get('payment/checkout',Checkout::class)->name('checkout');
        Route::get('payment/callback',Callback::class)->name('zarinpal-callback');
        Route::get('panel', Clientarea::class)->name('panel');

    });

// public front routes for

    Route::get('products',ProductIndex::class)->name('shop');
    Route::get('product/{id}/{slug}',SingleProduct::class)->name('singleProduct');
    Route::get('contact-us',ContactUs::class)->name('contactUs');
    Route::get('elevator-error-detection', EED::class)->name('EED');


    Route::prefix('blog')->group(function ()
    {
        Route::get('{id}/{slug}',SingleArticle::class)->name('singleArticle');
        Route::get('index',IndexBlog::class)->name('blogIndex');
        Route::get('cid-{category}/{slug}',[BlogController::class,'indexByCategory'])->name('indexByCategoryPosts');
        Route::middleware('throttle:2,3')->post('/comments/store',[BlogController::class,'storeComment'])->name('storeComment');

    });

    Route::prefix('eng-calc')->group(function ()
    {
        Route::get('/main',\App\Livewire\Calc\Main::class)->name('calcMain');

    });


});
