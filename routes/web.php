<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::prefix('product')->group(function () {
    Route::controller(ProductController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/add', 'create')->name('add');
        Route::post('/store', 'store');
        Route::get('/{id?}', 'getDetail');
    });
});
Route::get('/login', function () {
    return view('login');
});
Route::post('/product/checkLogin', [ProductController::class, 'checkLogin']);
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