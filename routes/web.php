<?php

use App\Http\Controllers\AboutLinkController;
use App\Http\Controllers\AboutUserController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\ExperienceLanguageController;
use App\Http\Controllers\PageSummaryController;
use App\Http\Controllers\PageSummaryLinkController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SocialMediaLinkController;
use App\Http\Controllers\UserController;
use App\Models\AboutLink;
use App\Models\AboutUser;
use App\Models\Experience;
use App\Models\ExperienceLanguage;
use App\Models\PageSummary;
use App\Models\PageSummaryLink;
use App\Models\Project;
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

Route::get('/dashboard', function () {
    $socialMediaLinks = SocialMediaLink::all();
    $pageSummaries = PageSummary::all();
    $pageSummaryLinks = PageSummaryLink::all();
    $aboutUsers = AboutUser::all();
    $aboutLinks = AboutLink::all();
    $experiences = Experience::all();
    $experienceLanguages = ExperienceLanguage::all();
    $projects = Project::all();

    return view('dashboard', [
        'socialMediaLinks' => $socialMediaLinks,
        'pageSummaries' => $pageSummaries,
        'pageSummaryLinks' => $pageSummaryLinks,
        'aboutUsers' => $aboutUsers,
        'aboutLinks' => $aboutLinks,
        'experiences' => $experiences,
        'experienceLanguages' => $experienceLanguages,
        'projects' => $projects,
    ]);
});

Route::get('/', function () {
    $socialMediaLinks = SocialMediaLink::all();
    $pageSummaries = PageSummary::all();
    $pageSummaryLinks = PageSummaryLink::all();
    $aboutUsers = AboutUser::all();
    $aboutLinks = AboutLink::all();
    $experiences = Experience::all();
    $experienceLanguages = ExperienceLanguage::all();
    $projects = Project::all();

    return view('home', [
        'socialMediaLinks' => $socialMediaLinks,
        'pageSummaries' => $pageSummaries,
        'pageSummaryLinks' => $pageSummaryLinks,
        'aboutUsers' => $aboutUsers,
        'aboutLinks' => $aboutLinks,
        'experiences' => $experiences,
        'experienceLanguages' => $experienceLanguages,
        'projects' => $projects,
    ]);
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

Route::post('/add-page-summary', [PageSummaryController::class, 'addPageSummary']);
Route::put('/update-page-summary/{pageSummary}', [PageSummaryController::class, 'updatePageSummary']);
Route::delete('/delete-page-summary/{pageSummary}', [PageSummaryController::class, 'deletePageSummary']);

Route::post('/add-page-summary-link', [PageSummaryLinkController::class, 'addPageSummaryLink']);
Route::put('/update-page-summary-link/{pageSummaryLink}', [PageSummaryLinkController::class, 'updatePageSummaryLink']);
Route::delete('/delete-page-summary-link/{pageSummaryLink}', [PageSummaryLinkController::class, 'deletePageSummaryLink']);

Route::post('/add-about-user', [AboutUserController::class, 'addAboutUser']);
Route::put('/update-about-user/{aboutUser}', [AboutUserController::class, 'updateAboutUser']);
Route::delete('/delete-about-user/{aboutUser}', [AboutUserController::class, 'deleteAboutUser']);

Route::post('/add-about-link', [AboutLinkController::class, 'addAboutLink']);
Route::put('/update-about-link/{aboutLink}', [AboutLinkController::class, 'updateAboutLink']);
Route::delete('/delete-about-link/{aboutLink}', [AboutLinkController::class, 'deleteAboutLink']);

Route::post('/add-experience', [ExperienceController::class, 'addExperience']);
Route::put('/update-experience/{experience}', [ExperienceController::class, 'updateExperience']);
Route::delete('/delete-experience/{experience}', [ExperienceController::class, 'deleteExperience']);

Route::post('/add-experience-language', [ExperienceLanguageController::class, 'addExperienceLanguage']);
Route::put('/update-experience-language/{experienceLanguage}', [ExperienceLanguageController::class, 'updateExperienceLanguage']);
Route::delete('/delete-experience-language/{experienceLanguage}', [ExperienceLanguageController::class, 'deleteExperienceLanguage']);

Route::post('/add-project', [ProjectController::class, 'addProject']);
Route::put('/update-project/{project}', [ProjectController::class, 'updateProject']);
Route::delete('/delete-project/{project}', [ProjectController::class, 'deleteProject']);
