<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Middleware\CheckValidAge;

Route::get('/', function () {
    return view('home');
});
//Auth Routes
Route::prefix('auth')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/signIn', 'signIn');
        Route::post('/checkSignIn', 'checkSignIn');
        Route::get('/login', 'login');
        Route::post('/checkLogin', 'checkLogin');
        Route::get('/getAge', 'getAge');
        Route::post('/checkAge', 'checkAge')->middleware(CheckValidAge::class);
    });
});
//Product Routes
Route::prefix('product')->group(function () {
    Route::controller(ProductController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/add', 'create')->name('add');
        Route::post('/store', 'store');
        Route::get('/{id?}', 'getDetail');
    });
});
Route::prefix('sinhvien')->group(function () {
    Route::get('/{name?}/{mssv?}', function (?string $name = "Luong Xuan Hieu", ?string $mssv = "123456") {
        return view('sinhvien.info', ['name' => $name, 'mssv' => $mssv]);
    })->name('info');
});
Route::get('/banco/{n}', function (int $n) {
    return view('banco', ['n' => $n]);
})->name('banco');
Route::fallback(function () {
    return view('error.404');
});