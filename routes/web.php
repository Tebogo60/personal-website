<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    return view('home');
});

Route::get('/register', function () {
    return view('register');
});
Route::post('/user-register', [UserController::class, 'createUser']);

Route::get('/login', function () {
    return view('login');
});
Route::post('/user-login', [UserController::class, 'loginUser']);
Route::post('/logout', [UserController::class, 'logoutUser']);
