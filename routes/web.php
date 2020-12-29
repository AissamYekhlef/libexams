<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\FileExportController;
use App\Http\Controllers\FileImportController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserExportController;
use App\Http\Controllers\UserImportController;
use App\Models\File;
use App\Models\GoogleClientApi;
use App\Models\Level;
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
Route::group([
    'prefix' => 'admin',
    // 'as' => 'admin.',
    // 'middleware' => 'admin'
], function(){

    Route::resource('users', UserController::class);
    Route::get('export/users', [UserExportController::class, 'export'])->name('users.export');
    Route::get('export/files', [FileExportController::class, 'export'])->name('files.export');
    // Route::get('export/files', [FileExportController::class, 'export'])->name('files.import');
    Route::get('import/users', [UserImportController::class, 'show'])->name('users.import.form');
    Route::post('import/users', [UserImportController::class, 'import'])->name('users.import');

});



// TESTS
Route::get('test/{id}', function($id){
    dd(
        // File::find(10)->user
        User::find($id)->name ?? 'no User with this ID',
        User::find($id)->files->toArray() ?? 'no File with this ID',
        User::find($id)->files->last()->level->toArray() ?? 'no Level with this ID',
        User::find($id)->level->toArray(),
        Level::find(1)->users->toArray(),
    );
});


Route::get('users/files', function(){
    $users = User::with('files')->get();
    dd(
        $users
    );
    // return view('files.index')->with('files', $files);
});