<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IController;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\CsvController;
use App\Http\Controllers\ImgController;
use App\Http\Controllers\AuthController;
// return view routes of all pages 
Route::get('/',[IController::class,'login'])->name('login');
Route::get('/change-password',[IController::class,'change']);
Route::get('/upload',[IController::class,'uploadcsv'])->name('upload');
Route::get('/uploadimg',[IController::class,'uploadimg'])->name('uploadimg');

// To login/logout admin-panel 
Route::post('/postLogin',[AuthController::class,'postLogin'])->name('login.post');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// for chnaging password
Route::post('/change-password',[CrudController::class,'change'])->name('change.password');

// for uplaoding imgs to database
Route::post('/uploadfile',[CrudController::class,'upload'])->name('uploadfile');

// for generating pdf 
Route::post('/pdf', [CsvController::class, 'CsvToPdf'])->name('pdf');

// for zip file of images
Route::post('/generate-pdf', [ImgController::class, 'generatePDF'])->name('generate.pdf');
