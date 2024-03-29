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

    Route::get('get-building-types', 'BuildingTypesController@getBuildingTypeArray');
    Route::get('visitor-registration/{id}', 'BuildingController@getBuilding');

    Route::apiResources([
        'building-types' => 'BuildingTypesController',
        'email-template' => 'EmailTemplateController',
        'sms-template' => 'SMSTemplateController',
        'building' => 'BuildingController',
        'visitors' => 'VisitorsController',
    ]);
});

