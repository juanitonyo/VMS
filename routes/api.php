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
    Route::get('visitor-registration', 'BuildingController@getBuilding');
    Route::post('sync-building', 'BuildingController@syncBuilding');
    Route::post('sync-unit-owners', 'BuildingController@syncUnitOwners');
    Route::post('get-unit-owners-length', 'BuildingController@getUnitOwnersLength');
    
    Route::get('sync-visitor', 'VisitorsController@syncVisitor');
    Route::get('visitor-query', 'VisitorsController@existingVisitor');
    Route::get('validate-form', 'VisitorsController@validateForm');
    Route::get('get-index-by-user', 'VisitorsController@getIndexByUser');
    
    Route::get('send-email', 'EmailTemplateController@sendEmail');
    
    Route::get('check-log', 'VisitorLogsController@queryLog');
    Route::get('get-checkouts', 'VisitorLogsController@totalCheckOut');
    Route::get('get-logs', 'VisitorLogsController@getVisitorLogs');
    Route::get('get-visitor-log', 'VisitorLogsController@getVisitorLog');
    Route::get('get-visitors-by-user', 'VisitorLogsController@getVisitorLogsByUserID');
    Route::get('get-index-log-by-user-id', 'VisitorLogsController@getIndexByUserID');
    Route::get('get-checkouts-by-user', 'VisitorLogsController@getTotalCheckoutForUser');
    
    Route::get('get-roles', 'RolesController@getRoles');

    Route::get('get-invitation', 'InvitationLogsController@getInvitation');
    Route::get('sync-invitee', 'InvitationLogsController@syncInvitee');
    
    Route::get('get-unitowners-by-building', 'UserController@getUsersInBuildings');
    Route::get('fetch-realtime-data', 'UserController@getSyncedUnitOwners');

    Route::get('export-building', 'BuildingController@export');
    Route::get('export-building-type', 'BuildingTypesController@export');
    Route::get('export-user', 'UserController@export');
    Route::get('export-visit-type', 'VisitTypesController@export');
    Route::get('export-visitor-log', 'VisitorLogsController@export');
    // Route::get('export-expected-deliveries', 'Controller@export');
    Route::get('export-deliveries', 'DeliveryController@export');

    Route::apiResources([
        'user' => 'UserController',
        'building-types' => 'BuildingTypesController',
        'email-template' => 'EmailTemplateController',
        'sms-template' => 'SMSTemplateController',  
        'building' => 'BuildingController',
        'visitors' => 'VisitorsController',
        'hostp' => 'HostController',
        'visit-type' => 'VisitTypesController',
        'visitor-logs' => 'VisitorLogsController',
        'delivery' => 'DeliveryController',
        'roles' => 'RolesController',
        'invitation' => 'InvitationLogsController'
    ]);
});

