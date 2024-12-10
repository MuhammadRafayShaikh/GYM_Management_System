<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StaffMemberController;
use App\Http\Controllers\SpecializationController;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [ReportController::class, 'dashboard'])->name('dashboard');
    Route::view('footer', 'footer')->middleware(['auth', 'verified']);
    Route::get('createCategory', [CategoryController::class, 'create'])->name('addCategory');
    Route::get('showCategory', [CategoryController::class, 'category'])->name('showCategory');
    Route::get('editCategory/{id}', [CategoryController::class, 'edit'])->name('editCategory');
    Route::get('createMembership', [MembershipController::class, 'create'])->name('createMembership');
    Route::get('showMembership', [MembershipController::class, 'membership'])->name('showMembership');
    Route::get('editShowMembership/{id}', [MembershipController::class, 'edit'])->name('editShowMembership');
    Route::get('createRole', [RoleController::class, 'create'])->name('createRole');
    Route::get('showRole', [RoleController::class, 'role'])->name('showRole');
    Route::get('editRole/{id}', [RoleController::class, 'edit'])->name('editRole');
    Route::get('createspecial', [SpecializationController::class, 'create'])->name('createspecial');
    Route::get('showspecial', [SpecializationController::class, 'special'])->name('showspecial');
    Route::get('editspecial/{id}', [SpecializationController::class, 'edit'])->name('editspecial');
    Route::get('createGroup', [GroupController::class, 'create'])->name('createGroup');
    Route::get('showGroup', [GroupController::class, 'group'])->name('showGroup');
    Route::get('editGroup/{id}', [GroupController::class, 'edit'])->name('editGroup');
    Route::get('createStaff', [StaffMemberController::class, 'create'])->name('createStaff');
    Route::get('showStaff', [StaffMemberController::class, 'staffmember'])->name('showStaff');
    Route::get('editStaff/{id}', [StaffMemberController::class, 'edit'])->name('editStaff');
    Route::get('createMember', [MemberController::class, 'create'])->name('createMember');
    Route::get('showMember', [MemberController::class, 'member'])->name('showMember');
    Route::get('editMember/{id}', [MemberController::class, 'edit'])->name('editMember');
    Route::get('memberAttendance', [MemberController::class, 'memberAttendance'])->name('memberAttendance');
    Route::post('/api/saveAttendance', [MemberController::class, 'saveAttendance'])->name('saveAttendance');
    Route::get('staffAttendance', [StaffMemberController::class, 'staffAttendance'])->name('staffAttendance');
    Route::get('reportView', [ReportController::class, 'reportView'])->name('reportView');
    Route::get('categoryPDF', [CategoryController::class, 'categoryPDF'])->name('categoryPDF');
    Route::get('memberPDF', [MemberController::class, 'memberPDF'])->name('memberPDF');
    Route::get('getmemberPDF', [MemberController::class, 'getmemberPDF'])->name('getmemberPDF');
    // Route::view('pdf.memberPDF', 'pdf.memberPDF')->name('getmemberPDF');
    Route::get('staffPDF', [StaffMemberController::class, 'staffPDF'])->name('staffPDF');
    Route::get('memberAttendancePDF', [ReportController::class, 'memberAttendancePDF'])->name('memberAttendancePDF');
    // Route::get('getmemberAttendancePDF',[MemberController::class,'getmemberAttendancePDF'])->name('getmemberAttendancePDF');
});
