<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\ConcordanceController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserManagementController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::resource('jurnal', JurnalController::class);
        Route::resource('user-management', UserManagementController::class);
    });
    Route::get('/', function () {
        return view('home');
    });
    Route::get('/concordance', [ConcordanceController::class, 'find'])->name('concordance.find');
    Route::get('change-password', [ChangePasswordController::class, 'index']);
    Route::post('change-password', [ChangePasswordController::class, 'store'])->name('change-password');
    Route::get('profile',[ProfileController::class,'index'])->name('profile');
    Route::put('profile',[ProfileController::class,'update'])->name('profile.update');
});
