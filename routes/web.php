<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
Route::prefix('product')->group(function () {
    Route::get('/', function () {
        return view('product.index');
    });
    Route::get('/add', function () {
        return view('product.add');
    })->name('add');
    Route::get('/{id?}', function (?string $id = "123") {
        return view('product.detail', ['id' => $id]);
    })->name('detail');
});
Route::prefix('sinhvien')->group(function () {
    Route::get('/{name?}/{mssv?}', function (?string $name = "Luong Xuan Hieu", ?string $mssv = "123456") {
        return view('sinhvien.info', ['name' => $name, 'mssv' => $mssv]);
    })->name('info');
});
Route::fallback(function () {
    return view('error.404');
});