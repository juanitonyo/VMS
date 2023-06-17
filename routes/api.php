<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::namespace('App\Http\Controllers\API')->group(function() {
    Route::post('login', 'AuthController@login');

    Route::get('get-visit-types', 'VisitTypesController@getVisitTypeArray');
    Route::get('get-building-types', 'BuildingTypesController@getBuildingTypeArray');
    Route::get('get-buildings', 'BuildingController@getBuildingsArray');
    Route::get('sync-visitor', 'VisitorsController@syncVisitor');
    Route::get('visitor-registration', 'BuildingController@getBuilding');
    Route::get('visitor-query', 'VisitorsController@existingVisitor');
    Route::get('validate-form', 'VisitorsController@validateForm');
    Route::get('check-otp', 'VisitorsController@checkOTP');
    Route::get('send-otp', 'VisitorsController@sendOTP');
    Route::get('send-email', 'VisitorsController@sendEmail');
    Route::get('check-log', 'VisitorLogsController@queryLog');
    Route::get('get-hosts', 'HostController@getHostQuery');
    Route::get('get-checkouts', 'VisitorLogsController@totalCheckOut');
    Route::get('get-logs', 'VisitorLogsController@getVisitorLogs');
    Route::get('get-visitor-log', 'VisitorLogsController@getVisitorLog');
    Route::get('get-roles', 'RolesController@getRoles');

    Route::post('sync-building', 'BuildingController@syncBuilding');

    Route::apiResources([
        'user' => 'UserController',
        'building-types' => 'BuildingTypesController',
        'email-template' => 'EmailTemplateController',
        'sms-template' => 'SMSTemplateController',  
        'building' => 'BuildingController',
        'visitors' => 'VisitorsController',
        'hostreg' => 'HostController',
        'visit-type' => 'VisitTypesController',
        'visitor-logs' => 'VisitorLogsController',
        'delivery' => 'DeliveryController',
        'roles' => 'RolesController'
    ]);
});

