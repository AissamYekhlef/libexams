<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FileExportController;
use App\Http\Controllers\FileImportController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserExportController;
use App\Http\Controllers\UserImportController;
use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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

// Login With Google, Facebbok, Github By Laravel-Socialite
// Google login
Route::get('login/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [LoginController::class, 'handleGoogleCallback']);

// Facebook login
Route::get('login/facebook', [LoginController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('login/facebook/callback', [LoginController::class, 'handleFacebookCallback']);

// Github login
Route::get('login/github', [LoginController::class, 'redirectToGithub'])->name('login.github');
Route::get('login/github/callback', [LoginController::class, 'handleGithubCallback']);


Route::get('/files', [FileController::class, 'index'])->name('files.index');
Route::get('/bac', function(){
    return redirect()->route('files.levels.name', ['name' => 'bac']);
});

Route::get('/files/upload', [FileController::class, 'upload'])->name('files.create');
Route::post('/files/upload', [FileController::class, 'uploadToDrive'])->name('files.store');

Route::get('/files/read/{id}', [FileController::class, 'show'])->name('files.show');
Route::get('/files/download/{id}', [FileController::class, 'download'])->name('files.download');

Route::get('/files/{id}/edit', [FileController::class, 'edit'])->name('files.edit');
Route::post('/files/{id}/update', [FileController::class, 'update'])->name('files.update');

Route::get('/files/{id}/delete', [FileController::class, 'destroy'])->name('files.delete');

// TODO
// Route::get('/files/search', [FileController::class, 'search_form'])->name('files.search.form');
// Route::post('/files/search', [FileController::class, 'search'])->name('files.search');

Route::get('files/levels/{name}', [FileController::class, 'get_files_by_level'])->name('files.levels.name');
Route::get('files/levels/{name}/year', [FileController::class, 'get_files_by_level_and_year'])->name('files.levels.name.year');
// Route::post('/files/search', [FileController::class, 'search'])->name('files.search');
Route::get('files/confirmed', function(){
    $files = File::where('confirmed', 1)->paginate(8);

    return view('files.index')->with('files', $files);
});

/**
 * Users Routes
 */

Route::get('/profile', [UserController::class, 'profile'])->name('users.profile');

Route::group([
    'prefix' => 'admin',
    // 'as' => 'admin.',
    // 'middleware' => 'admin'
], function(){

    Route::resource('users', UserController::class);
    
    Route::get('export/users', [UserExportController::class, 'export'])->name('users.export');
    Route::get('import/users', [UserImportController::class, 'show'])->name('users.import.form');
    Route::post('import/users', [UserImportController::class, 'import'])->name('users.import');


    Route::get('export/files', [FileExportController::class, 'export'])->name('files.export');
    Route::get('import/files', [FileImportController::class, 'show'])->name('files.import.form');
    Route::post('import/files', [FileImportController::class, 'import'])->name('files.import');

});



// TESTS
Route::get('permissions/{role}', function($role){
    dd(
        Role::findByName($role)->permissions
    );
});

Route::get('admin', function(){
    return view('admin');
})->name('admin');


Route::get('users/files', function(){
    $users = User::with('files')->get();
    dd(
        $users
    );
    // return view('files.index')->with('files', $files);
});

Route::get('host',function(Request $request){
    return  $request->getHttpHost();
});
Route::get('test',function(){
    $file = File::first();
    dd(
        auth()->user()->avatar()
    ); 
});