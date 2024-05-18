<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeparmentData;
use App\Http\Controllers\SchoolEvent;
use App\Http\Controllers\Login;
use App\Http\Controllers\SessionDetect;
use App\Http\Controllers\AdminData;
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

// ADMIN
// tisha's routes
Route::get('/', [SessionDetect::class, 'Dashboard'])->name('AdminDashboard');
Route::get('/Accounts', [SessionDetect::class, 'Accounts'])->name('Accounts');
Route::get('/Events', [SessionDetect::class, 'Events'])->name('Events');
Route::get('/Documents', [SessionDetect::class, 'Documents'])->name('Documents');
Route::get('/blank', function () { return view('Admin.blank'); })->name('Blank');
Route::get('/Settings', [SessionDetect::class, 'Settings'])->name('Settings');
Route::get('/Login', function () { return view('Admin.login'); })->name('AdminLogin');
Route::get('/Programs', [SessionDetect::class, 'Programs'])->name('Programs');
Route::get('/Evaluation', [SessionDetect::class, 'Evaluation'])->name('Evaluation');
Route::get('/Event/details', [SessionDetect::class, 'EventDetails'])->name('EventDetails');
Route::get('/Profile', function () { return view('Admin.Profile'); })->name('Profile');
Route::get('/Budgeting', function () { return view('Admin.budgeting'); })->name('Budgeting');

//Rheyan Post Route
Route::post('Admin/login',[Login::class,'AdminLogin'] )->name('adminLogin');
Route::post('Admin/logout',[Login::class,'AdminLogout'] )->name('AdminLogout');
Route::post('Admin/Event/Save',[SchoolEvent::class,'SaveEvent'] )->name('saveEvent');
Route::post('Admin/Event/Delete',[SchoolEvent::class,'DeleteEvent'] )->name('deleteEvent');
Route::post('Admin/Event/Update',[SchoolEvent::class,'UpdateEventDetails'] )->name('updateEventDetails');
Route::post('Admin/Event/AddActivity',[SchoolEvent::class,'AddEventActivity'] )->name('addEventActivity');
Route::post('Admin/Event/DeleteActivity',[SchoolEvent::class,'DeleteEventActivities'] )->name('deleteEventActivities');
Route::post('Admin/Event/UpdateActivity',[SchoolEvent::class,'UpdateEventActivities'] )->name('updateEventActivities');
Route::post('Admin/Event/UploadProgramme',[SchoolEvent::class,'UploadProgrammeImages'] )->name('uploadProgrammeImages');
Route::post('Admin/Event/AddDept',[SchoolEvent::class,'AddDeptEvent'] )->name('AddDeptEvent');
Route::post('Admin/Event/RemoveDept',[SchoolEvent::class,'RemoveDeptEvent'] )->name('RemoveDeptEvent');
//Rheyan Get Route
Route::get('Events/allEvent/',[SchoolEvent::class,'GetAllEvents'] )->name('getAllEvent');
Route::get('Events/getEvent/',[SchoolEvent::class,'GetEvent'] )->name('getEvent');
Route::get('Events/getEvent/eventdetails',[SchoolEvent::class,'EventDetailsLoad'] )->name('getEventDetails');
Route::get('Events/getEvent/eventActivities',[SchoolEvent::class,'GetAllEventActivities'] )->name('getEventAct');
Route::get('Events/getEvent/actDetails',[SchoolEvent::class,'GetActDetails'] )->name('getActDetails');
Route::get('Events/getEvent/getDept',[SchoolEvent::class,'GetDeptEvent'] )->name('GetDeptEvent');
Route::get('Events/getEvent/getDepartment',[SchoolEvent::class,'GetDepartment'] )->name('getDepartment');
Route::get('Events/getEvent/getCourse',[SchoolEvent::class,'GetCourse'] )->name('getCourse');
// jpubas route post
Route::post('Admin/SaveDepartment',[DeparmentData::class,'SaveDepartment'] )->name('SaveDepartment');
Route::post('Admin/SaveCourse',[DeparmentData::class,'SaveCourse'] )->name('SaveCourse');
Route::post('Admin/SaveSection',[DeparmentData::class,'SaveSection'] )->name('SaveSection');
Route::post('/admin/EditDeptInfo', [DeparmentData::class,"EditDeptInfo"])->name('EditDeptInfo');
Route::post('/admin/EditCourseInfo', [DeparmentData::class,"EditCourseInfo"])->name('EditCourseInfo');
Route::post('/admin/EditSectionInfo', [DeparmentData::class,"EditSectionInfo"])->name('EditSectionInfo');
Route::post('/admin/SaveStudent', [DeparmentData::class,"SaveStudent"])->name('SaveStudent');
Route::post('/admin/EditStudent', [DeparmentData::class,"EditStudent"])->name('EditStudent');
Route::post('/admin/EditAdminInfo', [AdminData::class,"EditAdminInfo"])->name('EditAdminInfo');
Route::post('/admin/ChangeAdminPic', [AdminData::class,"ChangeAdminPic"])->name('ChangeAdminPic');
Route::post('/admin/ChangeAdminPass', [AdminData::class,"ChangeAdminPass"])->name('ChangeAdminPass');
Route::post('/admin/AddAdministrator', [AdminData::class,"AddAdministrator"])->name('AddAdministrator');
Route::post('/admin/EditAdministratorInfo', [AdminData::class,"EditAdministratorInfo"])->name('EditAdministratorInfo');
Route::post('/admin/SetStudentAdmin', [AdminData::class,"SetStudentAdmin"])->name('SetStudentAdmin');
// jpubas route get
Route::get('/admin/GetDeptData', [DeparmentData::class,"GetDeptData"])->name('GetDeptData');
Route::get('/admin/GetDepartmentData', [DeparmentData::class,"GetDepartmentData"])->name('GetDepartmentData');
Route::get('/admin/GetCourseData', [DeparmentData::class,"GetCourseData"])->name('GetCourseData');
Route::get('/admin/GetSectionData', [DeparmentData::class,"GetSectionData"])->name('GetSectionData');
Route::get('/admin/GetStudentData', [DeparmentData::class,"GetStudentData"])->name('GetStudentData');
Route::get('/admin/GetAdministratorData', [AdminData::class,"GetAdministratorData"])->name('GetAdministratorData');
Route::get('/admin/GetAdministratorDataToEdit', [AdminData::class,"GetAdministratorDataToEdit"])->name('GetAdministratorDataToEdit');
Route::get('/admin/GetAllStudentData', [AdminData::class,"GetAllStudentData"])->name('GetAllStudentData');
Route::get('/admin/GetAllStudentAdminData', [AdminData::class,"GetAllStudentAdminData"])->name('GetAllStudentAdminData');



//fallback Route to display error if user entered invalid route
Route::fallback(function () {
    return view('error');
});


// STUDENT
// tisha's routes
Route::get('/Userlogin', function () { return view('Student.login'); })->name('Userlogin');
Route::get('/Blank', function () { return view('Student.blank'); })->name('Blank');