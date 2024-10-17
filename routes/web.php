<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeparmentData;
use App\Http\Controllers\SchoolEvent;
use App\Http\Controllers\Login;
use App\Http\Controllers\SessionDetect;
use App\Http\Controllers\AdminData;
use App\Http\Controllers\StudentData;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\CompendiumData;
use App\Http\Controllers\StudentAttendance;
use App\Http\Controllers\ElectionController;
use App\Http\Controllers\BudgetProposalController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CommitteeController;
use App\Http\Controllers\StudentAdmin;
;
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

Route::get('/calendar', [App\Http\Controllers\CalendarController::class, 'index']);

// ADMIN
// tish admin: get routes
Route::get('/', [SessionDetect::class, 'Dashboard'])->name('AdminDashboard');
Route::get('/Accounts', [SessionDetect::class, 'Accounts'])->name('Accounts');
Route::get('/Events', [SessionDetect::class, 'Events'])->name('Events');
Route::get('/Documents', [SessionDetect::class, 'Documents'])->name('Documents');
Route::get('/ViewCompendium', function () { return view('Admin.viewcompendium'); })->name('ViewCompendium');
Route::get('/blank', function () { return view('Admin.blank'); })->name('Blank');
Route::get('/Settings', [SessionDetect::class, 'Settings'])->name('Settings');
Route::get('/Login', function () { return view('Admin.login'); })->name('AdminLogin');
Route::get('/Programs', [SessionDetect::class, 'Programs'])->name('Programs');
Route::get('/Evaluation', [SessionDetect::class, 'Evaluation'])->name('Evaluation');
Route::get('/Evaluation/ViewEvaluations', [SessionDetect::class, 'EvaluationDetails'])->name('ViewEvaluations');
Route::get('/Evaluation/ViewEvaluations/results', [SessionDetect::class, 'EvaluationResult'])->name('evaluationResult');
Route::get('/Event/details', [SessionDetect::class, 'EventDetails'])->name('EventDetails');
Route::get('/Profile', [SessionDetect::class, 'AdminProfile'])->name('Profile');
Route::get('/Budgeting', [SessionDetect::class, 'Budgeting'])->name('Budgeting');
Route::get('/Budgeting/Details/{id}', [BudgetProposalController::class, 'show'])->name('viewbudget');
Route::get('/Budgeting/Expense/{id}', [BudgetProposalController::class, 'show2'])->name('setexpense');

Route::get('/landing', function () { return view('Admin.landing'); })->name('landing');

Route::get('/Attendance', function () { return view('Admin.attendance'); })->name('ViewAttendance');
Route::get('/Liquidation', function () { return view('Admin.liquidation'); })->name('Liquidation');
Route::get('/Election', function () { return view('Admin.election'); })->name('Election');
Route::get('/Edit/Election', function () { return view('Admin.addelectiondetails'); })->name('Editelection');
Route::get('/Party/Candidates', function () { return view('Admin.party_candidates'); })->name('partycandidates');
Route::get('/Election/Results', function () { return view('Admin.viewelectionresults'); })->name('viewelectionresults');

Route::post('/committees', [CommitteeController::class, 'saveCommittee'])->name('committees.store');
Route::post('/committees/members', [CommitteeController::class, 'saveMembers'])->name('committees.members');


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
Route::post('Admin/Event/DeleteProgramme',[SchoolEvent::class,'RemoveProgramme'] )->name('removeProgramme');
Route::post('Admin/Evaluation/CreateEvalForm',[EvaluationController::class,'CreateEvalForm'] )->name('createEvalForm');
Route::post('Admin/Evaluation/DeleteEvalForm',[EvaluationController::class,'DeleteEvalForm'] )->name('deleteEvalForm');
Route::post('Admin/Evaluation/EvalDetails/AddQuestion',[EvaluationController::class,'AddEvalQuestion'] )->name('addEvalQuestion');
Route::post('Admin/Evaluation/EvalDetails/SwitchQuestionNum',[EvaluationController::class,'SwitchQuestionNum'] )->name('switchQuestionNum');
Route::post('Admin/Evaluation/EvalDetails/DeleteEvalQuestion',[EvaluationController::class,'DeleteEvalQuestion'] )->name('deleteEvalQuestion');
Route::post('Admin/Evaluation/EvalDetails/UpdateEvalQuestion',[EvaluationController::class,'UpdateEvalQuestion'] )->name('updateEvalQuestion');
Route::post('Student/Evaluation/Evaluate/SaveResult',[EvaluationController::class,'EvaluationSaveResult'] )->name('saveEvaluationResult');
//Rheyan Get Route
Route::get('Admin/Event/allEvent/',[SchoolEvent::class,'GetAllEvents'] )->name('getAllEvent');
Route::get('Admin/Event/getEvent/',[SchoolEvent::class,'GetEvent'] )->name('getEvent');
Route::get('Admin/Event/getEvent/eventdetails',[SchoolEvent::class,'EventDetailsLoad'] )->name('getEventDetails');
Route::get('Admin/Event/getEvent/eventActivities',[SchoolEvent::class,'GetAllEventActivities'] )->name('getEventAct');
Route::get('Admin/Event/getEvent/actDetails',[SchoolEvent::class,'GetActDetails'] )->name(name: 'getActDetails');
Route::get('Admin/Event/getEvent/getDept',[SchoolEvent::class,'GetDeptEvent'] )->name('GetDeptEvent');
Route::get('Admin/Event/getEvent/getDepartment',[SchoolEvent::class,'GetDepartment'] )->name('getDepartment');
Route::get('Admin/Event/getEvent/getCourse',[SchoolEvent::class,'GetCourse'] )->name('getCourse');
Route::get('Admin/Event/getEvent/getProgramme',[SchoolEvent::class,'GetProgrammeList'] )->name('getProgramme');
Route::get('Admin/Evaluation/getEvalDetails',[EvaluationController::class,'GetEvalForm'] )->name('getEvalForm');
Route::get('Admin/Evaluation/getAllEval',[EvaluationController::class,'GetAllEvalForm'] )->name('getAllEvalForm');
Route::get('Admin/Evaluation/getAllEvalQuestion',[EvaluationController::class,'GetAllEvalQuestion'] )->name('getAllEvalQuestion');
Route::get('Admin/Evaluation/GetEvalQuestion',[EvaluationController::class,'GetEvalQuestion'] )->name('getEvalQuestion');
Route::get('Student/Evaluation/Evaluate/LoadQuestion',[EvaluationController::class,'LoadQuestionEvaluate'] )->name('loadQuestionEvaluate');
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
Route::post('Admin/EditDeptPicInfo',[DeparmentData::class,'EditDeptPicInfo'] )->name('EditDeptPicInfo');
Route::post('Admin/EditStudentAdminPosition',[AdminData::class,'EditStudentAdminPosition'] )->name('EditStudentAdminPosition');
Route::post('Admin/DemoteAdmin',[AdminData::class,'DemoteAdmin'] )->name('DemoteAdmin');
Route::post('Admin/DemoteStudentAdmin',[AdminData::class,'DemoteStudentAdmin'] )->name('DemoteStudentAdmin');
Route::post('Admin/AddCompendium',[CompendiumData::class,'AddCompendium'] )->name('AddCompendium');
Route::post('Admin/UploadCompendiumFile', [CompendiumData::class,'UploadCompendiumFile'])->name('UploadCompendiumFile');
Route::post('Admin/DeleteFile', [CompendiumData::class,'DeleteFile'])->name('DeleteFile');
Route::post('Admin/SubmitEventVenue', [SchoolEvent::class,'SubmitEventVenue'])->name('SubmitEventVenue');
Route::post('Admin/updateVenue', [SchoolEvent::class,'updateVenue'])->name('updateVenue');
Route::post('Admin/deleteVenue', [SchoolEvent::class,'deleteVenue'])->name('deleteVenue');
Route::post('Admin/createElection', [ElectionController::class,'createElection'])->name('createElection');
Route::post('Admin/party', [ElectionController::class,'party'])->name('party');
Route::post('Admin/Candidate', [ElectionController::class,'Candidate'])->name('Candidate');
Route::post('Admin/Attendance', [StudentAttendance::class, 'Attendance'])->name('Attendance');
Route::post('Admin/Vote', [ElectionController::class, 'vote'])->name('vote');
Route::post('Admin/saveResult', [ElectionController::class, 'saveResult'])->name('saveResult');


// tish budgeting controller: post routes
Route::post('admin/GetBudgetProposal', [BudgetProposalController::class, 'getBudgetProposal'])->name('getBudgetProposal');
Route::post('admin/budgetingProcess', [BudgetProposalController::class, 'budgetingProcess'])->name('budgetingProcess');

// jpubas route get
Route::get('/admin/GetDeptData', [DeparmentData::class,"GetDeptData"])->name('GetDeptData');
Route::get('/admin/GetSectData', [DeparmentData::class,"GetSectData"])->name('GetSectData');
Route::get('/admin/GetDepartmentData', [DeparmentData::class,"GetDepartmentData"])->name('GetDepartmentData');
Route::get('/admin/GetCourseData', [DeparmentData::class,"GetCourseData"])->name('GetCourseData');
Route::get('/admin/GetSectionData', [DeparmentData::class,"GetSectionData"])->name('GetSectionData');
Route::get('/admin/GetStudentData', [DeparmentData::class,"GetStudentData"])->name('GetStudentData');
Route::get('/admin/GetAdministratorData', [AdminData::class,"GetAdministratorData"])->name('GetAdministratorData');
Route::get('/admin/GetAdministratorDataToEdit', [AdminData::class,"GetAdministratorDataToEdit"])->name('GetAdministratorDataToEdit');
Route::get('/admin/GetAllStudentData', [AdminData::class,"GetAllStudentData"])->name('GetAllStudentData');
Route::get('/admin/GetAllStudentAdminData', [AdminData::class,"GetAllStudentAdminData"])->name('GetAllStudentAdminData');
Route::get('/admin/GetAllCompendium', [CompendiumData::class,"GetAllCompendium"])->name('GetAllCompendium');
Route::get('/admin/GetCompendiumFiles', [CompendiumData::class,"GetCompendiumFiles"])->name('GetCompendiumFiles');
Route::get('/admin/GetVenue', [SchoolEvent::class,"GetVenue"])->name('GetVenue');
Route::get('/admin/getVenueByID', [StudentAttendance::class,"getVenueByID"])->name('getVenueByID');
Route::get('Admin/getElection', [ElectionController::class,'getElection'])->name('getElection');
Route::get('Admin/ElectionResult', [ElectionController::class, 'ElectionResult'])->name('ElectionResult');
Route::get('/Admin/getAttendance', [StudentAttendance::class, "getAttendance"])->name('getAttendance');

//fallback Route to display error if user entered invalid route
Route::fallback(function () {
    return view('error');
});


// STUDENT
// tish student: get routes
Route::get('/Student/Login', function () { return view('Student.login'); })->name('Userlogin');
Route::get('/Blank', function () { return view('Student.blank'); })->name('Blank');
Route::get('Student/Dashboard', [SessionDetect::class, 'StudentDashboard'])->name('StudentDashboard');
Route::get('Student/Event', function () { return view('Student.event'); })->name('EventDashboard');
Route::get('Student/Evaluation', function () { return view('Student.evaluations'); })->name('EventEvaluation');
Route::get('Student/Evaluation/View', [SessionDetect::class, 'StudentViewEventDetails'])->name('ViewDetails');
Route::get('Student/Evaluation/Evaluate', [SessionDetect::class, 'StudentEvaluateEvent'])->name('studentEvaluate');
Route::get('Account/Settings', function () { return view('Student.accsettings'); })->name('accountsettings');
Route::get('/Student/Election', function () { return view('Student.electionvote'); })->name('electionvote');

// tish student: post routes
Route::post('Student/LoginStudent', [Login::class,'LoginStudent'])->name('LoginStudent');
Route::post('Student/LogoutStudent', [Login::class, 'LogoutStudent'])->name('LogoutStudent');
Route::post('Student/UpdateStudentDetails', [StudentData::class,'UpdateStudentDetails'])->name('UpdateStudentDetails');



// student Admin
Route::get('/Student_Admin/Login', function () {
    return view('StudentAdmin.Login');
})->name('studentAdminLogin');
Route::post('Student/StudentAdminLogin', [StudentAdmin::class, 'StudentAdminLogin'])->name('StudentAdminLogin');
Route::post('Student/StudentAdminLogout', [StudentAdmin::class, 'StudentAdminLogout'])->name('StudentAdminLogout');


Route::get('/Student_Admin/Dashboard', action: function () {
    return view('StudentAdmin.index');
})->name('studentAdminDashboard');

Route::get('/Student_Admin/Attendance', function () {
    return view('StudentAdmin.attendance');
})->name('StudentAdminViewAttendance');

Route::get('/Student_Admin/Liquidation', function () {
    return view('StudentAdmin.liquidation');
})->name('StudentAdminLiquidation');

Route::get('/Student_Admin/Election', function () {
    return view('StudentAdmin.election');
})->name('StudentAdminElection');

Route::get('/Student_Admin/Edit/Election', function () {
    return view('StudentAdmin.addelectiondetails');
})->name('StudentAdminEditelection');

Route::get('/Student_Admin/Election/Results', function () {
    return view('StudentAdmin.viewelectionresults');
})->name('StudentAdminviewelectionresults');

Route::get('/Student_Admin/Events/', action: function () {
    return view('StudentAdmin.events');
})->name('StudentAdminevents');

Route::get('/Student_Admin/Evaluation/', action: function () {
    return view('StudentAdmin.evaluation');
})->name('StudentAdminevaluation');

Route::get('/Student_Admin/Budgeting/', action: function () {
    return view('StudentAdmin.budgeting');
})->name('StudentAdminbudgeting');

Route::get('/Student_Admin/Liquidation/', action: function () {
    return view('StudentAdmin.liquidation');
})->name('StudentAdminliquidation');

Route::get('/Student_Admin/Document/', action: function () {
    return view('StudentAdmin.documents');
})->name('StudentAdmindocuments');

Route::get('/Student_Admin/Election/Results/', action: function () {
    return view('StudentAdmin.viewelectionresults');
})->name('StudentAdminelectionresult');