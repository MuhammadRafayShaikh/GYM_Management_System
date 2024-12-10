<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\StaffMemberController;
use App\Http\Controllers\SpecializationController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('category', CategoryController::class);

Route::apiResource('membership', MembershipController::class);

Route::apiResource('role', RoleController::class);

Route::apiResource('specialization', SpecializationController::class);

Route::apiResource('group', GroupController::class);

Route::apiResource('staffMember', StaffMemberController::class);

Route::apiResource('member', MemberController::class);

Route::get('getmemberAttendance', [MemberController::class, 'getmemberAttendance'])->name('getmemberAttendance');

// Route::post('saveAttendance', [MemberController::class, 'saveAttendance'])->name('saveAttendance');

// Route::post('/api/saveAttendance', [MemberController::class, 'saveAttendance'])->name('saveAttendance');
Route::post('/updateAttendance', [MemberController::class, 'updateAttendance']);

Route::get('getStaffAttendance', [StaffMemberController::class, 'getStaffAttendance'])->name('getStaffAttendance');

Route::post('/updateStaffAttendance', [StaffMemberController::class, 'updateStaffAttendance'])->name('updateStaffAttendance');

Route::post('login', [AuthController::class, 'login']);

Route::get('reports', [ReportController::class, 'reports'])->name('reports');
