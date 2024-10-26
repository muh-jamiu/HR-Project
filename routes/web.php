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

Route::get('/browse-jobs', [UserController::class, 'browse_job']);

Route::get('/my-jobs', [UserController::class, 'my_job']);

Route::post('/search-jobs', [UserController::class, 'searchJob']);

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

Route::get('/blogs', function () {
    return view("pages.blogs");
});

Route::get('/login', function () {
    return view("pages.login");
})->middleware("isLogin");

Route::get('/signup', function () {
    return view("pages.register");
})->middleware("isLogin");

Route::get('/', [UserController::class, 'index']);

Route::get('/job/{job_title}/{id}', [UserController::class, 'job_single']);

Route::get('/application/{job_title}/{id}', [UserController::class, 'application_single']);

Route::get('/candidate/{unique_id}/{candidate_name}', [UserController::class, 'candidateSingle']);

Route::get('/employer/{unique_id}/{employer_username}', [UserController::class, 'employersSingle']);

Route::get('/candidate-dashboard', [UserController::class, 'candidateDash'])->middleware("notLogin");

Route::get('/employer-dashboard', [UserController::class, 'employersDash'])->middleware("notLogin");

Route::get('/account-check', [UserController::class, 'check'])->middleware("notLogin");

Route::post('/login', [UserController::class, 'loginUser']);

Route::get('/logOut', [UserController::class, 'logOut']);

Route::get('/admin-panel', [UserController::class, 'admin']);

Route::get('/admin-login', [UserController::class, 'admin_login']);

Route::get('/delete-user/{id}', [UserController::class, 'deleteUser']);

Route::get('/delete-job/{id}', [UserController::class, 'deleteJob']);

Route::get('/delete-application/{id}', [UserController::class, 'deleteApplc']);

Route::get('/automated-questions/{job_title}/{job_id}', [UserController::class, 'automated_questions'])->middleware("notLogin");

Route::get('/technical-questions/{job_title}/{job_id}', [UserController::class, 'technical_questions'])->middleware("notLogin");

Route::get('/skills-questions/{job_title}/{job_id}', [UserController::class, 'skills_questions'])->middleware("notLogin");

// Route::get('/technical-questions/{job_title}/{job_id}', [UserController::class, 'technical_questions']);

Route::post('/register', [UserController::class, 'registerUser']);

Route::post('/branch', [UserController::class, 'createBranch']);

Route::post('/work', [UserController::class, 'createWork']);

Route::post('/education', [UserController::class, 'createEducation']);

Route::post('/delete-branch', [UserController::class, 'deleteBranch']);

Route::post('/update-profile', [UserController::class, 'updateUser']);

Route::post('/create-job', [UserController::class, 'createJob']);

Route::post('/create-application', [UserController::class, 'createApplication']);
Route::get('/create-application', [UserController::class, 'createApplication'])->middleware("notLogin");

Route::get('/stripe-sucess', [UserController::class, 'paypalSuccess'])->name("stripe_succss")->middleware("notLogin");
Route::get('/stripe-fail', [UserController::class, 'paypalSuccess'])->name("stripe_fail")->middleware("notLogin");

Route::post('/search/{type}', [UserController::class, 'searchUser']);

Route::post('/automated-questions', [UserController::class, 'post_automated_questions']);
Route::post('/technical-questions', [UserController::class, 'post_technical_questions']);
Route::post('/skills-questions', [UserController::class, 'post_skills_questions']);

Route::post('/stripe', [UserController::class, 'pay_with_stripe']);

Route::post('/stripe-transfer', [UserController::class, 'stripeTransfer']);

Route::get('subscription', [UserController::class, 'createPaypalTransaction'])->name('paypal.transaction');

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'de', 'fr'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
});