<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use Sentinel;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



use App\Http\Middleware\AdminMiddleware;
//use Illuminate\Support\Facades\Route;
//
//
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return ph$request->user();
//});
//
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});





// Route::post('login','RegisterLoginPasswordResetController@login');
Route::post('api/complains','ComplainController@index')->middleware('auth:api');

Route::post('api/register','RegisterLoginPasswordResetController@register');

Route::get('api/get-training-center-type','OthersController@trainingType');
Route::get('api/get-designation','OthersController@designation');
Route::get('api/get-agency','OthersController@agency');
Route::get('api/get-agency-tree','OthersController@agencyTree');
Route::get('api/get-country','OthersController@country');
Route::get('api/get-country-2','OthersController@country2');
Route::get('api/get-country-tree','OthersController@countryTree');
Route::get('api/get-division','OthersController@division');
Route::get('api/get-district','OthersController@district');
Route::get('api/get-district/{id}','OthersController@districtById');
Route::get('api/get-subdistrict/{id}','OthersController@subdistrict');
Route::get('api/get-union/{id}','OthersController@union');
Route::get('api/get-training-center','OthersController@trainingCenter');
Route::get('api/get-desired-job','OthersController@desiredJob');
Route::get('api/get-desired-job-tree','OthersController@desiredJobTree');

Route::get('api/get-guide','OthersController@guide');
Route::get('api/get-language','OthersController@language');
Route::get('api/get-board','OthersController@board');
Route::get('api/get-p-year','OthersController@passingYear');

Route::post('applicant-agency/validation','RegisterLoginPasswordResetController@validation');
Route::post('applicant-agency','RegisterLoginPasswordResetController@applicantAgency');
Route::post('admin-registration','RegisterLoginPasswordResetController@admin');

Route::post('applicant-agency','RegisterLoginPasswordResetController@applicantAgency');

Route::get('applicant-agency/activation/{phone}/{code}','RegisterLoginPasswordResetController@activateAccountByPhone');
Route::get('api/activate/{phone}/{code}','RegisterLoginPasswordResetController@activateAccount');

Route::post('applicant-agency/forgot-password','RegisterLoginPasswordResetController@forgotPassword');

Route::post('applicant-agency/reset-password','RegisterLoginPasswordResetController@postResetPassword');


// Route::post('api/get-district','OthersController@district');
// Route::post('/test23','RegisterLoginPasswordResetController@test23');


// })->middleware(AdminMiddleware::class);
// Route::post('/register','AuthController@register');


Route::post('api/get-gallery','ContactController@getGallery');
Route::post('api/get-gallery2','ContactController@getGallery2');
Route::post('api/get-agency-info','ContactController@getAgencyInfo');
Route::post('api/get/review','RatingController@getReview');

Route::prefix('contacts')->middleware(['auth:api'])->group(function() {
	Route::post('/','ContactController@store');

	Route::put('/','ContactController@store');
	Route::put('/personal-info','ContactController@personalInfo');
	Route::put('/address-info','ContactController@addresslInfo');
	Route::put('/nominee-info','ContactController@nomineeInfo');
	Route::put('/education-info','ContactController@educationInfo');
	Route::put('/language-info','ContactController@languageInfo');
	Route::put('/experience-info','ContactController@experienceInfo');
	Route::put('/training-info','ContactController@trainingInfo');
	Route::put('/basic-info','ContactController@basicInfo');
	Route::post('/gallery-info','ContactController@galleryInfo');
	Route::get('/gallery-delete/{id}','ContactController@galleryDelete');
	Route::delete('/{id}','ContactController@destroy');
});

Route::prefix('subscribe')->middleware(['auth:api'])->group(function() {
	Route::get('/agency','SubscribeController@getAgency');
	Route::get('/country','SubscribeController@getCountry');
	Route::get('/language','SubscribeController@getLanguage');
	Route::get('/job','SubscribeController@getJob');

	Route::post('/','SubscribeController@store');
	Route::post('/delete','SubscribeController@destroy');
});

// Route::prefix('category')->middleware(['auth:api','admin'])->group(function() {

// 	Route::post('/','ProjectCategoryController@store');
// 	Route::put('/','ProjectCategoryController@store');
// 	Route::delete('/{id}','ProjectCategoryController@destroy');

// });

// Route::prefix('project')->middleware(['auth:api','admin'])->group(function() {

// 	Route::post('/','ProjectController@store');
// 	Route::put('/','ProjectController@store');
// 	Route::delete('/{id}','ProjectController@destroy');

// });

// Route::prefix('purpose')->middleware(['auth:api','admin'])->group(function() {

// 	Route::post('/','PurposeController@store');
// 	Route::put('/','PurposeController@store');
// 	Route::delete('/{id}','PurposeController@destroy');

// });

// Route::prefix('income')->middleware(['auth:api','admin'])->group(function() {

// 	Route::post('/','IncomeController@store');
// 	Route::put('/','IncomeController@store');
// 	Route::delete('/{id}','IncomeController@destroy');

// });

// Route::prefix('expense')->middleware(['auth:api','admin'])->group(function() {

// 	Route::post('/','ExpenseController@store');
// 	Route::put('/','ExpenseController@store');
// 	Route::delete('/{id}','ExpenseController@destroy');

// });

// Route::prefix('role')->middleware(['auth:api'])->group(function() {

// 	Route::post('/','RoleController@store');
// 	Route::put('/','RoleController@update');
// 	Route::delete('/{id}','RoleController@destroy');

// });

Route::prefix('invoice')->middleware(['auth:api','admin'])->group(function() {

	// Route::post('/','Invoice\InvoiceController@store');
	// Route::put('/','Invoice\InvoiceController@store');
	// Route::delete('/{id}','Invoice\InvoiceController@destroy');


});

Route::prefix('payment-receive')->middleware(['auth:api','admin'])->group(function() {

	// Route::post('/','PaymentReceiveController@store');
	// Route::put('/','PaymentReceiveController@store');
	// Route::delete('/{id}','PaymentReceiveController@destroy');

});

Route::post('oauth/login', 'AuthController@auth');

Route::prefix('api')->middleware(['auth:api'])->group(function() {

	Route::get('auth/me', 'AuthController@local');
    Route::get('oauth/me', 'AuthController@oauth');


	Route::get('/user/info','ContactController@user');
	Route::get('/contacts','ContactController@index');
	Route::post('/contacts/status/update','ContactController@statusUpdate');
	Route::get('/contacts/show/{id}','ContactController@show');
	Route::get('/contacts/details/{id}','ContactController@details');
	Route::get('/specific/contacts/{type}','ContactController@specificContact');
    Route::post('/contacts/pagination','ContactController@pagination');

    Route::get('/contacts/agency','ContactController@agency');
    Route::get('/contacts/applicant','ContactController@applicant');

    Route::get('/contacts/finacial-training','ContactController@finatialAndTraining');
    Route::post('/contacts/password-change','ContactController@passwordChange');

});

Route::prefix('api')->middleware(['auth:api'])->group(function() {
 	Route::get('/apply/{id}','ApplyController@apply');
 	Route::post('/get/applyed-apllicant','ApplyController@getApplicant');
 	Route::post('/update/applyed-apllicant','ApplyController@updateApplicant');
 	Route::get('/check-apply/{slug}','ApplyController@checkApply');
 	Route::get('/get-job-post','ApplyController@getJobPost'); //+++??
 	Route::get('/get/summary-applicant','ApplyController@summaryApplicant');
 	Route::get('/get/summary-admin','DashboardController@summaryAdmin');
 	Route::get('/get/admin-statistics','DashboardController@statisticsAdmin');
 	Route::post('/get/admin-upazila-statistics','DashboardController@getUpazillaStatistics');
 	Route::get('/get/summary-agency','DashboardController@summaryAgency');
 	Route::post('/get/migrate-applicant','DashboardController@getMigrateApplicant');
 	Route::post('/get-applicant','ApplicantController@get');
 	Route::post('/get-applicant-xl','ApplicantController@getXlData');
	Route::post('/applicant/training','ApplicantController@applicantTraining');


 	Route::post('/rate','RatingController@rate');
 	Route::post('/review-reply','RatingController@reply');
 	Route::get('/get/user-rating','RatingController@getUserRating');
 	Route::get('/cv','ApplyController@getCv');

 	Route::get('/add/favourite/{id}','ApplyController@addFavourite');
 	Route::get('/remove/favourite/{id}','ApplyController@removeFavourite');
 	Route::get('/get/favourite-list','ApplyController@favouriteList');
 	Route::post('/subscribe','SubscribeController@subscribe');
});

Route::prefix('api')->middleware(['auth:api'])->group(function() {
 	Route::get('/dynamic/field','OthersController@index');
 	Route::post('/dynamic/field','OthersController@store');
 	Route::put('/dynamic/field','OthersController@update');
 	Route::post('/dynamic/field/delete','OthersController@delete');
});

Route::prefix('api')->middleware(['auth:api'])->group(function() {
 	Route::post('/social-link','OthersController@changeSocialLink');
});

Route::prefix('api')->middleware(['cors'])->group(function() {
	Route::get('/social-link','OthersController@getSocialLink');
	Route::get('/download-cv/{id}','ApplyController@downloadCv');
 	Route::get('/test-xyz','ApplyController@testxyz');
 	Route::get('/get-applicant-pdf','ApplicantController@getPDFdata');
 	Route::get('/get-applied-applicant-pdf','ApplicantController@getAppliedPDFdata');
 	Route::get('/get-migrate-applicant-pdf','DashboardController@getMigratePDFdata');
 	// ?page='+this.search.page+'&search='+this.search.search+'&job_id='+this.search.job_id+'&country_id='+this.search.country_id+'&type='+this.search.type

});








//visa


Route::get('/test44','RegisterLoginPasswordResetController@test');

// custom route from moinul

Route::get('/job-category','CustomizationController@getJobType');
Route::get('/seniority-level','CustomizationController@getSeniorityLevel');






