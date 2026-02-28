<?php

use App\Http\Controllers\SocialMediaLinkController;
use App\Http\Controllers\UserController;
use App\Models\SocialMediaLink;
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
    $socialMediaLinks = SocialMediaLink::all();

    return view(
        'home',
        [
            'socialMediaLinks' => $socialMediaLinks
        ]
    );
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

Route::post('/add-social-media-link', [SocialMediaLinkController::class, 'addSocialMediaLink']);
Route::put('/update-social-media-link/{socialMediaLink}', [SocialMediaLinkController::class, 'updateSocialMediaLink']);
Route::delete('/delete-social-media-link/{socialMediaLink}', [SocialMediaLinkController::class, 'deleteSocialMediaLink']);
