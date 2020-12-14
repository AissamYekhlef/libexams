<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use App\Models\File;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
    return view('index');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/files/upload', [FileController::class, 'index'])->name('files.create');
Route::post('/files/upload', [FileController::class, 'uploadToDrive'])->name('files.store');

// Route::get('show',function(){
//     return view('files.show');
// });

Route::get('/files/show/{id}', [FileController::class, 'show'])->name('files.show');

Route::get('test', function(){
    dd(
        // File::find(10)->user
        User::find(3)->files
    );
});