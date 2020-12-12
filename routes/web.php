<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/upload', [UploadController::class, 'index'])->name('files.create');
Route::post('/upload', [UploadController::class, 'uploadToDrive'])->name('files.store');

Route::get('test', function(){
    Storage::disk('google')->put('test.txt', 'Hello World again');

    dd("Added Successfuly");
});