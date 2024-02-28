<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\CategoryController;


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
    return view('login');
})->name('login');

Route::get('/dashboard', function () {
    return view('dashboard/index');
});





// Route::resource('admin-user', AdminUserController::class);


Route::resource('category', CategoryController::class);
// Route::delete('delete-multiple', 'deleteMultiple')->name('delete-multiple-category');
Route::delete('delete-multiple', [CategoryController::class, 'deleteMultiple'])->name('delete-multiple-category');








/////////////////////////////////////////////////////////////////////////////////////////////////////////////
    Route::get('/admin/show/')->name('admin.profile'); // show profile page
    Route::post('/admin/update')->name('admin.update'); // update process
    Route::get('/admin/change-password/')->name('change.password'); // show password change page
    Route::post('/admin/update-password/')->name('update.password'); // password update process
    Route::get('/admin/logout')->name('admin.logout'); // logout process
    Route::get('/admin/all')->name('test.all'); // logout process
    Route::get('/admin/add')->name('test.add'); // logout process



