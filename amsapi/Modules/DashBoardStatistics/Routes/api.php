<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/dashboardstatistics', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:api', 'prefix' => 'dashboardstatistics'], function()
{
	Route::get('all-data','DashBoardStatisticsController@index');
	Route::get('all-data-statistics','DashBoardStatisticsController@allDataStatistics');
});

Route::get('test-link', function(){
	// $phone_no = '0088 02 8361282';
	// return preg_replace('/^\+?88|\|88|\D/', '', ($phone_no));
	$address = '180-181, Shahid Sayed Nazrul Islam Sharani, 6th Floor, Bijoynagar, Dhaka-1000';
	return '[{"address":"'.$address.'"}]';
	
});