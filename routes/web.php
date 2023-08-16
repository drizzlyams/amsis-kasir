<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});
Route::resource('kategori', KategoriController::class);
Route::resource('product', ProductController::class);
Route::resource('member', MemberController::class);
Route::resource('supplier', SupplierController::class);
Route::resource('penjualan', PenjualanController::class);
Route::get('penjualan/data', [PenjualanController::class, 'listData'])->name('penjualan.data');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/kategori', [App\Http\Controllers\KategoriController::class, 'index'])->name('kategori');
