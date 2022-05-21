<?php

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


Route::get('/',[App\Http\Controllers\EventController::class,'index'])->name('event-list');
Route::prefix('event')->group(function(){
    Route::get('/add',[App\Http\Controllers\EventController::class,'add'])->name('event-add');
    Route::Post('/add',[App\Http\Controllers\EventController::class,'addData'])->name('event-add-data');
    Route::get('/delete/{id}',[App\Http\Controllers\EventController::class,'delete'])->name('event-delete');
    Route::get('/view/{id}',[App\Http\Controllers\EventController::class,'view'])->name('event-view');
    Route::get('/edit/{id}',[App\Http\Controllers\EventController::class,'edit'])->name('event-edit');
    Route::Post('/edit',[App\Http\Controllers\EventController::class,'editData'])->name('event-edit-data');
});
