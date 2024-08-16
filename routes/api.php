<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OtreQuestController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\ApproverController;
use App\Http\Controllers\JWTAuthController;
use App\Http\Controllers\TimeOtController;
use App\Http\Controllers\TruAppMasController;
use App\Http\Controllers\TimeScanController;

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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [JWTAuthController::class, 'login']);
    Route::post('/register', [JWTAuthController::class, 'register']);
    Route::post('/logout', [JWTAuthController::class, 'logout']);
    Route::post('/refresh', [JWTAuthController::class, 'refresh']);
    Route::get('/user-profile', [JWTAuthController::class, 'userProfile']);    
});

Route::group([
    'middleware' => 'api'
], function ($router) {
    Route::get('/otrequests', [OtreQuestController::class, 'index']);
    Route::get('/otrequest/{id}', [OtreQuestController::class, 'show']);
    Route::post('/otrequest-create', [OtreQuestController::class, 'store']);
    Route::put('/otrequest-update/{id}', [OtreQuestController::class, 'update']);
    Route::put('/otrequest-update-report/{id}', [OtreQuestController::class, 'updateReport']);
    Route::put('/otrequest-update-point/{id}', [OtreQuestController::class, 'bus_point']);

    //approver 4 step
    Route::put('/otrequest-approve2/{id}', [OtreQuestController::class, 'approve_2']);
    Route::put('/otrequest-approve3/{id}', [OtreQuestController::class, 'approve_3']);
    Route::put('/otrequest-approve4/{id}', [OtreQuestController::class, 'approve_4']);
    Route::put('/otrequest-approve5/{id}', [OtreQuestController::class, 'approve_5']);
    Route::put('/otrequest-approve6/{id}', [OtreQuestController::class, 'approve_6']);

    //reject
    Route::put('/otrequest-reject/{id}', [OtreQuestController::class, 'reject']);

    Route::delete('/otrequest-delete/{id}', [OtreQuestController::class, 'destroy']);

    // export data to text
    Route::get('/otrequest-employees', [OtreQuestController::class, 'employees']);
    Route::get('/otrequest-export', [OtreQuestController::class, 'export']);

    // count ot request function
    Route::get('/otrequests-dept', [OtreQuestController::class, 'dept_filter']);
    Route::get('/otrequests-inprogress', [OtreQuestController::class, 'inprogress']);
    Route::get('/otrequests-approved', [OtreQuestController::class, 'approved']);
    Route::get('/otrequests-rejected', [OtreQuestController::class, 'rejected']);

    // filter function
    Route::get('/otrequests-filter-code', [OtreQuestController::class, 'code_filter']);
    Route::get('/otrequests-filter-name', [OtreQuestController::class, 'name_filter']);
    Route::get('/otrequests-filter-department', [OtreQuestController::class, 'department_filter']);
    Route::get('/otrequests-filter-status', [OtreQuestController::class, 'status_filter']);
    Route::get('/otrequests-filter-date', [OtreQuestController::class, 'date_filter']);
    Route::get('/otrequests-filter-all-date', [OtreQuestController::class, 'date_all_filter']);
    Route::get('/otrequests-filter-list', [OtreQuestController::class, 'ot_list_filter']);
    Route::get('/otrequests-filter-list_2', [OtreQuestController::class, 'ot_list_filter_2']);
    Route::get('/otrequests-filter-finish', [OtreQuestController::class, 'ot_finish_filter']);

});

// employee master
Route::group([
    'middleware'=>'api'
], function ($router){
    Route::get('/employees', [EmployeesController::class, 'index']);
    Route::get('/employee/{id}', [EmployeesController::class, 'show']);
    Route::get('/employees-role', [EmployeesController::class, 'role_filter']);
    Route::get('/employees-select', [EmployeesController::class, 'select_filter']);
    Route::post('/employees-import', [EmployeesController::class, 'importFile']);
});

// approver master
Route::group([
    'middleware'=>'api'
], function ($router){
    Route::get('/approver', [ApproverController::class, 'index']);
    Route::get('/approver/{id}', [ApproverController::class, 'show']);
    Route::get('/approver-dept', [ApproverController::class, 'dept_filter']);
    Route::get('/approver-role', [ApproverController::class, 'role_filter']);

    Route::get('/approve', [TruAppMasController::class, 'index']);
    Route::get('/approve-dept', [TruAppMasController::class, 'dept_filter']);
    Route::get('/approve-role', [TruAppMasController::class, 'role_filter']);
});
// time of finger scan
Route::group([
    'middleware'=>'api'
], function ($router){
    Route::get('/time-scan', [TimeScanController::class, 'index']);
    Route::get('/time-scan-first-time', [TimeScanController::class, 'filter_first_time']);
    Route::get('/time-scan-last-time', [TimeScanController::class, 'filter_last_time']);
    Route::post('/time-scan-import', [TimeScanController::class, 'importFile']);
});

// time of ot master
Route::group([
    'middleware'=>'api'
], function ($router){
    Route::get('/time', [TimeOtController::class, 'index']);
    Route::get('/time/{id}', [TimeOtController::class, 'show']);
});