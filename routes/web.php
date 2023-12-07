<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IController;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\AuthController;
//return view routes of all pages 
Route::get('/',[IController::class,'login'])->name('login');
Route::get('/change-password',[IController::class,'change']);
Route::get('/upload',[IController::class,'uploadcsv'])->name('upload');
Route::get('/uploadimg',[IController::class,'uploadimg'])->name('uploadimg');
//To login form 
Route::post('/postLogin',[AuthController::class,'postLogin'])->name('login.post');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
//chnagepassword
Route::post('/change-password',[CrudController::class,'change'])->name('change.password');
Route::post('/uploadfile',[CrudController::class,'upload'])->name('uploadfile');

