<?php

use App\Http\Controllers\Api\PrController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', [PrController::class, 'index']);

Route::group(['prefix'=>'product'],function(){
    Route::get('list',[PrController::class, 'index'])->name('product.list');

    Route::get('edit/{id}',[PrController::class, 'edit'])->name('product.edit.form');

    Route::post('edit/{id}',[PrController::class, 'update'])->name('product.edit');

    Route::get('add',[PrController::class, 'create'])->name('product.add.form');

    Route::post('add',[PrController::class, 'store'])->name('product.add');

    Route::get('delete/{id}',[PrController::class, 'destroy'])->name('product.delete');

    Route::get('update-status/{id}/{status}',[PrController::class, 'updateStatus'])->name('product.update.status');

    Route::get('show/{id}',[PrController::class, 'show'])->name('product.show');
});
