<?php

use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\CarouselController;
use App\Http\Controllers\Backend\CourseController;
use App\Http\Controllers\Backend\JoinController;
use App\Http\Controllers\Backend\LogoController;
use App\Http\Controllers\Backend\NewsController;
use App\Http\Controllers\Frontend\IndexController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\LoginController;
use App\Http\Controllers\Backend\StaffController;
use App\Http\Controllers\Backend\ContactController;


use App\Http\Middleware\BackendAuthenticated;


// 前台路由
Route::get('', [IndexController::class, 'index'])->name('frontend.index');
Route::post('createContact', [IndexController::class, 'storeContact'])->name('frontend.createContact');

// 後台路由
Route::group(['namespace' => 'Backend', 'prefix' => 'backend'], function () {
    // 登入登出模組路由
    Route::group([], function () {
        Route::get('login', [LoginController::class, 'login'])->name('backend.login');
        Route::post('logging', [LoginController::class, 'logging'])->name('backend.logging');
        Route::get('logout', [LoginController::class, 'logout'])->name('backend.logout');
    });
    Route::patch('api/password/{staff}', [StaffController::class, 'updatePassword'])->name('backend.updatePassword');

    // auth 中間層保護機制
    Route::middleware([BackendAuthenticated::class])->group(function () {
        // 大廳畫面路由
        Route::get('index', function () {
            return view('backend.index');
        })->name('backend.index');

        // logo路由
        Route::group(['namespace' => 'Logo', 'prefix' => 'logo'], function () {
            Route::get('', [LogoController::class, 'index'])->name('backend.logo.index');
            Route::post('api/logo', [LogoController::class, 'update'])->name('backend.logo.update');
        });

        // 輪播圖 banner 路由
        Route::group(['namespace' => 'Carousel', 'prefix' => 'carousel'], function () {
            Route::get('', [CarouselController::class, 'index'])->name('backend.carousel.index');
            Route::post('api', [CarouselController::class, 'store'])->name('backend.carousel.store');
            Route::get('api/{carousel}', [CarouselController::class, 'show'])->name('backend.carousel.show');
            Route::patch('api/{carousel}', [CarouselController::class, 'update'])->name('backend.carousel.update');
            Route::delete('api/{carousel}', [CarouselController::class, 'destroy'])->name('backend.carousel.delete');
        });

        // 關於我們路由
        Route::group(['namespace' => 'About', 'prefix' => 'about'], function () {
            Route::get('', [AboutController::class, 'index'])->name('backend.about.index');
            Route::patch('api/{about}', [AboutController::class, 'update'])->name('backend.about.update');
            Route::post('api/image/{about}', [AboutController::class, 'UpdateImageInfo'])->name('backend.about.UpdateImageInfo');
        });

        // 最新消息路由
        Route::group(['namespace' => 'News', 'prefix' => 'news'], function () {
            Route::get('', [NewsController::class, 'index'])->name('backend.news.index');
            Route::get('{news}', [NewsController::class, 'show'])->name('backend.news.detail');
            Route::post('api', [NewsController::class, 'store'])->name('backend.news.create');
            Route::patch('api/{news}', [NewsController::class, 'update'])->name('backend.news.update');
            Route::delete('api/{news}', [NewsController::class, 'destroy'])->name('backend.news.delete');
        });

        // join us 路由
        Route::group(['namespace' => 'Join', 'prefix' => 'join'], function () {
            Route::get('', [JoinController::class, 'index'])->name('backend.join.index');
            Route::patch('api/{join}', [JoinController::class, 'update'])->name('backend.join.update');
            Route::post('api/image/{join}', [JoinController::class, 'UpdateImageInfo'])->name('backend.join.UpdateImageInfo');
        });

        // 課程資訊路由
        Route::group(['namespace' => 'Course', 'prefix' => 'course'], function () {
            Route::get('', [CourseController::class, 'index'])->name('backend.course.index');
            Route::get('{course}', [CourseController::class, 'show'])->name('backend.course.detail');
            Route::post('api', [CourseController::class, 'store'])->name('backend.course.create');
            Route::patch('api/{course}', [CourseController::class, 'update'])->name('backend.course.update');
            Route::delete('api/{course}', [CourseController::class, 'destroy'])->name('backend.course.delete');
        });

        // 聯絡我們路由
        Route::group(['namespace' => 'Contact', 'prefix' => 'contact'], function () {
            Route::get('', [ContactController::class, 'index'])->name('backend.contact.index');
            Route::patch('api/{contact}', [ContactController::class, 'update'])->name('backend.contact.update');
        });

    });
});
