<?php

use App\Http\Controllers\AdminController;
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
    return view("index");
});

Route::get('/browse-jobs', function () {
    return view("pages.jobs");
});

Route::get('/employers', [UserController::class, 'employersAll']);

Route::get('/get-started', function () {
    return view("pages.biz_type");
})->middleware("isLogin");

Route::get('/candidates', [UserController::class, 'candidateAll']);

Route::get('/contact-us', function () {
    return view("pages.contact");
});

Route::get('/about-us', function () {
    return view("pages.about");
});

Route::get('/login', function () {
    return view("pages.login");
})->middleware("isLogin");

Route::get('/signup', function () {
    return view("pages.register");
})->middleware("isLogin");

Route::get('/job/{job_title}/{id}', function ($job_title) {
    $data["title"] = str_replace("_", " ", $job_title);
    return view("pages.job_single", compact("data"));
});

Route::get('/candidate/{id}/', [UserController::class, 'candidateSingle']);

Route::get('/employer/{employer_username}/', [UserController::class, 'employersSingle']);

Route::get('/candidate-dashboard', [UserController::class, 'candidateDash'])->middleware("notLogin");

Route::get('/employer-dashboard', [UserController::class, 'employersDash'])->middleware("notLogin");

Route::get('/account-check', [UserController::class, 'check'])->middleware("notLogin");

Route::post('/login', [UserController::class, 'loginUser']);

Route::get('/logOut', [UserController::class, 'logOut']);

Route::post('/register', [UserController::class, 'registerUser']);

Route::post('/update-profile', [UserController::class, 'updateUser']);

