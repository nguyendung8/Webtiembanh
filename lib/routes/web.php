<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderUserController;
use Illuminate\Support\Facades\Route;

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
//trang chủ
Route::group(['prefix' => '/'], function (){
    Route::get('', [FrontendController::class, 'getHome']);
    // lấy ra chi tiết sản phẩm và comment
    Route::get('/detail/{id}', [FrontendController::class, 'getDetail']);
    Route::post('/detail/{id}', [FrontendController::class, 'postComment'])->middleware('CheckLogedOut');;

    // lấy ra các danh mục
    Route::get('/category/{id}', [FrontendController::class, 'getCategory']);

    //search
    Route::get('/search', [FrontendController::class, 'getSearch']);

});

// changepassword
Route::group(['prefix' => 'change-password','middleware' => 'CheckLogedOut'], function (){
    Route::get('/', [PasswordController::class, 'getChangePassword']);
    Route::post('/', [PasswordController::class, 'updatePassword']);
});

// đơn hàng của user
Route::group(['prefix' => 'list-order','middleware' => 'CheckLogedOut'], function (){
    Route::get('/', [OrderUserController::class, 'getListOrder']);
    Route::get('/received/{id}', [OrderUserController::class, 'receivedOrder']);
});

// giỏ hàng
Route::group(['prefix' => 'cart'], function (){
    Route::get('/add/{id}', [CartController::class, 'getAddCart']);
    Route::get('/show', [CartController::class, 'getShowCart']);
    Route::get('/delete/{id}', [CartController::class, 'getDeleteCart']);
    Route::get('/update', [CartController::class, 'getUpdateCart']);
    Route::post('/show', [CartController::class, 'postPayCart'])->middleware('CheckLogedOut');
    Route::get('/add_favourite/{id}', [CartController::class, 'addFavourite'])->middleware('CheckLogedOut');
});


//hoàn thành
Route::get('/complete', [CartController::class, 'getComplete'])->middleware('CheckLogedOut');

// Admin
Route::group(['namespace' => 'Admin'], function () {

    //logout
    Route::get('/logout', [HomeController::class, 'getLogout']);

    //admin
    Route::group(['prefix' => 'admin', 'middleware' => 'CheckUserRole'], function (){

        //admin page
        Route::get('/home', [HomeController::class, 'getHome']);

        //category
        Route::group(['prefix' => 'category'], function (){
            Route::get('/', [CategoryController::class, 'getCategory']);

            Route::post('/', [CategoryController::class, 'postCreateCategory']);

            Route::get('/edit/{id}', [CategoryController::class, 'getEditCategory']);
            Route::post('/edit/{id}', [CategoryController::class, 'putUpdateCategory']);

            Route::get('/delete/{id}', [CategoryController::class, 'getDeleteCategory']);
        });

        //product
        Route::group(['prefix' => 'product'], function (){
            Route::get('/', [ProductController::class, 'getProduct']);


            Route::get('/create', [ProductController::class, 'getCreateProduct']);
            Route::post('/create', [ProductController::class, 'postCreateProduct']);

            Route::get('/edit/{id}', [ProductController::class, 'getEditProduct']);
            Route::post('/edit/{id}', [ProductController::class, 'putUpdateProduct']);

            Route::get('/delete/{id}', [ProductController::class, 'getDeleteProduct']);
        });

        //account
        Route::group(['prefix' => 'account'], function (){
            Route::get('/', [AccountController::class, 'getAccount']);
            Route::get('/delete/{id}', [AccountController::class, 'getDeleteAccount']);
        });

        //order
        Route::group(['prefix' => 'order'], function (){
            Route::get('/', [OrderController::class, 'getOrder']);
            Route::get('/delete/{id}', [OrderController::class, 'getDeleteOrder']);
            Route::get('/confirm/{id}', [OrderController::class, 'confirmOrder']);
            Route::get('/transport/{id}', [OrderController::class, 'transportOrder']);
            Route::get('/detail/{id}', [OrderController::class, 'viewDetailOrder']);
        });

        //comment
        Route::group(['prefix' => 'comment'], function (){
            Route::get('/', [CommentController::class, 'getComment']);
            Route::get('/delete/{id}', [CommentController::class, 'getDeleteComment']);
            // Duyệt bình luận
            Route::get('/confirm-comment/{id}', [CommentController::class, 'confirmComment']);
        });
    });
});

require __DIR__.'/auth.php';
