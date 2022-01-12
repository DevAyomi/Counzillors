<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Counsellee\Auth\RegisterController;
use App\Http\Controllers\Counsellee\Auth\LoginController;
use App\Http\Controllers\Counsellee\Profile\ProfileController;
use App\Http\Controllers\Counsellor\Auth\LoginControllers;
use App\Http\Controllers\Counsellor\Auth\RegisterControllers;


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

Route::get('/', function(){
    return view('welcome');
});

//Counsellees Routes
Route::group(['namespace' => 'Counsellee','prefix' => 'counsellees'], function() {
    Route::get('/view', [RegisterController::class, 'viewRegister'])->name('counsellee.register-view');
    Route::post('/register', [RegisterController::class, 'register'])->name('counsellee.register');
    Route::get('/login', [LoginController::class, 'loginView'])->name('counsellee.login-view');
    Route::post('/login-post', [LoginController::class, 'login'])->name('counsellee.login');
    Route::get('/profile', [ProfileController::class, 'getProfile'])->name('counsellee.profile');
});

//Counsellors Routes
Route::group(['namespace' => 'Counsellor','prefix' => 'counsellors'], function() {
    Route::get('/register', [RegisterControllers::class, 'viewRegister'])->name('counsellor.register-view');
    Route::post('/register-post', [RegisterControllers::class, 'register'])->name('counsellor.register');
    Route::get('/login-view', [LoginControllers::class, 'loginView'])->name('counsellors.login-view');
    Route::post('/login-post', [LoginControllers::class, 'login'])->name('counsellor.logins');
});