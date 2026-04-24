<?php

use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('appointments.api.token')->group(function () {
    Route::get('/appointments', [AppointmentController::class, 'index']);
    Route::match(['get', 'post'], '/appointments/get-datetime-backend', [HomeController::class, 'appointmentsGetDatetimeBackend']);
    Route::get('/appointments/timeslot-labels', [HomeController::class, 'appointmentsTimeSlotLabels']);
    Route::match(['get', 'post'], '/getdisableddatetimenewapi', [HomeController::class, 'getdisableddatetimenewapi']);
    Route::get('/appointments/{appointment}', [AppointmentController::class, 'show'])
        ->whereNumber('appointment');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



