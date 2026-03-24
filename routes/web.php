<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

$homeControllerRoute = 'App\Http\Controllers\HomeController';
$productControllerRoute = 'App\Http\Controllers\ProductController';
$userControllerRoute = 'App\Http\Controllers\UserController';
$adminHomeControllerRoute = 'App\Http\Controllers\Admin\HomeController';
$cartControllerRoute = 'App\Http\Controllers\CartController';
$reviewControllerRoute = 'App\Http\Controllers\ReviewController';

// Home Controller routes
Route::get('/', $homeControllerRoute.'@index')->name('home.index');

// Product Controller routes (final user)
Route::get('/product', $productControllerRoute.'@index')->name('product.index');
Route::get('/product/show/{id}', $productControllerRoute.'@show')->name('product.show');

// Cart Controller routes
Route::get('/cart', $cartControllerRoute.'@index')->name('cart.index');

// User Controller routes (final user - require login)
Route::middleware('auth')->group(function () use ($userControllerRoute, $cartControllerRoute, $reviewControllerRoute) {
    Route::get('/user/profile', $userControllerRoute.'@show')->name('user.show');
    Route::get('/user/orders', $userControllerRoute.'@orders')->name('user.orders');
    Route::post('/cart/add/{id}', $cartControllerRoute.'@add')->name('cart.add');
    Route::get('/cart/delete', $cartControllerRoute.'@delete')->name('cart.delete');
    Route::post('/cart/purchase', $cartControllerRoute.'@purchase')->name('cart.purchase');
    Route::post('/review/save', $reviewControllerRoute.'@save')->name('review.save');
});

// Admin Home Controller routes
Route::middleware('admin')->group(function () use ($adminHomeControllerRoute) {
    Route::get('/admin/home', $adminHomeControllerRoute.'@index')->name('admin.home.index');
});

// Admin Product Controller routes
Route::middleware('admin')->group(function () {
    $adminProductControllerRoute = 'App\Http\Controllers\Admin\ProductController';
    Route::get('/admin/product', $adminProductControllerRoute.'@index')->name('admin.product.index');
    Route::get('/admin/product/create', $adminProductControllerRoute.'@create')->name('admin.product.create');
    Route::post('/admin/product/save', $adminProductControllerRoute.'@save')->name('admin.product.save');
    Route::get('/admin/product/show/{id}', $adminProductControllerRoute.'@show')->name('admin.product.show');
    Route::get('/admin/product/edit/{id}', $adminProductControllerRoute.'@edit')->name('admin.product.edit');
    Route::post('/admin/product/update/{id}', $adminProductControllerRoute.'@update')->name('admin.product.update');
    Route::get('/admin/product/disable/{id}', $adminProductControllerRoute.'@disable')->name('admin.product.disable');
    Route::get('/admin/product/enable/{id}', $adminProductControllerRoute.'@enable')->name('admin.product.enable');
});

// Admin Category Controller routes
Route::middleware('admin')->group(function () {
    $adminCategoryControllerRoute = 'App\Http\Controllers\Admin\CategoryController';
    Route::get('/admin/category', $adminCategoryControllerRoute.'@index')->name('admin.category.index');
    Route::get('/admin/category/create', $adminCategoryControllerRoute.'@create')->name('admin.category.create');
    Route::post('/admin/category/save', $adminCategoryControllerRoute.'@save')->name('admin.category.save');
    Route::get('/admin/category/show/{id}', $adminCategoryControllerRoute.'@show')->name('admin.category.show');
    Route::get('/admin/category/edit/{id}', $adminCategoryControllerRoute.'@edit')->name('admin.category.edit');
    Route::post('/admin/category/update/{id}', $adminCategoryControllerRoute.'@update')->name('admin.category.update');
    Route::get('/admin/category/disable/{id}', $adminCategoryControllerRoute.'@disable')->name('admin.category.disable');
    Route::get('/admin/category/enable/{id}', $adminCategoryControllerRoute.'@enable')->name('admin.category.enable');
});

Auth::routes();