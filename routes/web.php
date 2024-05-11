<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeparmentData;
use App\Http\Controllers\SchoolEvent;
use App\Http\Controllers\Login;
use App\Http\Controllers\SessionDetect;
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


Route::get('/', [SessionDetect::class, 'Dashboard'])->name('AdminDashboard');
Route::get('/Accounts', [SessionDetect::class, 'Accounts'])->name('Accounts');
Route::get('/Events', [SessionDetect::class, 'Events'])->name('Events');
Route::get('/Documents', [SessionDetect::class, 'Documents'])->name('Documents');
Route::get('/blank', function () { return view('Admin.blank'); })->name('Blank');
Route::get('/Settings', [SessionDetect::class, 'Settings'])->name('Settings');
Route::get('/Login', function () { return view('Admin.login'); })->name('AdminLogin');
Route::get('/Programs', [SessionDetect::class, 'Programs'])->name('Programs');
Route::get('/Evaluation', [SessionDetect::class, 'Evaluation'])->name('Evaluation');




//Rheyan Route
Route::post('Admin/login',[Login::class,'AdminLogin'] )->name('adminLogin');
Route::post('Admin/logout',[Login::class,'AdminLogout'] )->name('AdminLogout');

Route::post('Admin/Event/Save',[SchoolEvent::class,'SaveEvent'] )->name('saveEvent');

// jpubas route post
Route::post('Admin/SaveDepartment',[DeparmentData::class,'SaveDepartment'] )->name('SaveDepartment');
Route::post('Admin/SaveCourse',[DeparmentData::class,'SaveCourse'] )->name('SaveCourse');
Route::post('Admin/SaveSection',[DeparmentData::class,'SaveSection'] )->name('SaveSection');
Route::post('/admin/EditDeptInfo', [DeparmentData::class,"EditDeptInfo"])->name('EditDeptInfo');
Route::post('/admin/EditCourseInfo', [DeparmentData::class,"EditCourseInfo"])->name('EditCourseInfo');
Route::post('/admin/EditSectionInfo', [DeparmentData::class,"EditSectionInfo"])->name('EditSectionInfo');
// jpubas route get
Route::get('/admin/GetDeptData', [DeparmentData::class,"GetDeptData"])->name('GetDeptData');
Route::get('/admin/GetDepartmentData', [DeparmentData::class,"GetDepartmentData"])->name('GetDepartmentData');
Route::get('/admin/GetCourseData', [DeparmentData::class,"GetCourseData"])->name('GetCourseData');
Route::get('/admin/GetSectionData', [DeparmentData::class,"GetSectionData"])->name('GetSectionData');


