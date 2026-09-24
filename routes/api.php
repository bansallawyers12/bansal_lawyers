<?php

use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\CrmAppointmentApiController;
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

Route::get('/blogs/list', [BlogController::class, 'list']);

Route::middleware('appointments.api.token')->group(function () {
    // Legal CRM pull-sync (same contract Migration Manager uses against immigration).
    // Static paths must be registered before /appointments/{appointment}.
    Route::get('/appointments/recent', [CrmAppointmentApiController::class, 'recent']);
    Route::post('/appointments/add-appointment', [CrmAppointmentApiController::class, 'addAppointment']);
    Route::post('/appointments/update-appointment', [CrmAppointmentApiController::class, 'updateAppointment']);
    Route::post('/appointments/{id}/status', [CrmAppointmentApiController::class, 'updateStatus'])
        ->whereNumber('id');

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



