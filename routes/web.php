<?php

use App\Http\Controllers\BakiController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\InvoiceManagerController;
use App\Http\Controllers\LiveSearchController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\UserController;
use App\Models\Products;
use Illuminate\Support\Facades\DB;
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

Route::get('/', function () {
    return redirect()->route('login');
});
//home
Route::get('/home', function () {
    return view('home');
});
// logout
Route::get('/logout',[UserController::class,'logout'])->name('logout');
Route::middleware('isAdmin')->group(function(){
    // product controller
    Route::get('/dashboard',[UserController::class,'dashboard'])->name('dashboard');
    Route::get('/setting',[UserController::class,'setting'])->name('setting');
    Route::post('/setting/update',[UserController::class,'update'])->name('setting.update');
    Route::get('/product',[ProductsController::class,'index'])->name('product.index');
    Route::get('/product/add',[ProductsController::class,'add'])->name('product.add');
    Route::get('/product/edit/{id}',[ProductsController::class,'edit'])->name('product.edit');
    Route::post('/product/update/{id}',[ProductsController::class,'update'])->name('product.update');
    Route::post('/product/store',[ProductsController::class,'store'])->name('product.store');
    Route::get('/product/delete/{id}',[ProductsController::class,'destroy'])->name('product.delete');
    // invoice controller
    Route::get('/invoice',[InvoiceManagerController::class,'index'])->name('invoice.manager');
    Route::get('/invoice/getprice/{id}',[InvoiceManagerController::class,'getPrice'])->name('invoice.get_price');
    Route::post('/invoice/export-pdf/{id}',[InvoiceManagerController::class,'exportPdf'])->name('invoice.export_pdf');
    // sales controller
    Route::get('/sales',[SalesController::class,'index'])->name('sales.index');
    Route::get('/sales/{date}',[SalesController::class,'search'])->name('sales.search');
    Route::get('/export',[SalesController::class,'export'])->name('sales.export');
    // baki controller
    Route::get('/baki',[BakiController::class,'index'])->name('baki.index');
    Route::get('/baki/add',[BakiController::class,'add'])->name('baki.add');
    Route::post('/baki/sore',[BakiController::class,'store'])->name('baki.store');
    Route::get('/baki/setPaid/{id}',[BakiController::class,'setPaid'])->name('baki.setPaid');
    //live search controller
    Route::get('/live-search/{data}',[LiveSearchController::class,'liveSearch'])->name('live.search');
});



