<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\StudentAccounts;
use App\Models\Department;
use App\Models\Course;
use App\Models\Section;
use Illuminate\Support\Facades\Hash;

class AdminData extends Controller
{
    public function EditAdminInfo(Request $request){
          $check = Admin::where('admin_name',$request->adminname)->where('admin_school_id',$request->adminschoolid)->first();
        if($check){
             return response()->json(['status' => 'exist']);
        }else if($request->adminname == ''|| $request->adminschoolid ==''){
             return response()->json(['status' => 'empty']);
        }else{
        $adminAcc = Admin::where('admin_id',session('admin_id'))->first();
        $adminAcc->update([
            'admin_name'=>$request->adminname,
            'admin_school_id'=>$request->adminschoolid,
        ]);
        return response()->json(['status' => 'success']);
        }
    }
    public function ChangeAdminPic(Request $request){

         $file = $request->file('image');
        if ($file->getSize() > 10485760) {
            return response()->json([ 'exceed']);
        }else   if (!in_array($file->getClientOriginalExtension(), ['jpeg', 'png', 'jpg'])) {
            return response()->json(['invalid_type']);
        }
        else{
        $check = Admin::where('admin_id',session('admin_id'))->first();
        $spiltimage = explode('.',$check->admin_pic)[0];
        $imageName =  $spiltimage. '.' . $file->getClientOriginalExtension();
        $file->move(public_path('dept_image/'), $imageName);

    $check->update([
        'admin_pic'=>$imageName,
    ]);
     return response()->json(['status' => 'success']);
    }
    }
    public function ChangeAdminPass(Request $request){

    $check = Admin::where('admin_id',session('admin_id'))->first();
    if($request->newpass !== $request->repass){
    return response()->json(['status' => '!match']);
    }else {
        if($request->newpass == ''|| $request->repass == '' || $request->oldpass == ''){
    return response()->json(['status' => 'empty']);
    }else {
        if(Hash::check($request->oldpass,$check->admin_password)){
               $check->update([
        'admin_password'=>Hash::make($request->newpass),
        ]);
        return response()->json(['status' => 'success']);
    }
    else{
         return response()->json(['status' => 'old!match']);
    }
    }
    }
    }

    public function AddAdministrator(Request $request){
        $check = Admin::where('admin_name',$request->administratorname)->where('admin_username',$request->administratoruser)->first();
        if($request->administratorname==''||$request->administratoruser==''||$request->administratorpass==''){
            return response()->json(['status' => 'empty']);
        }else if($check){
            return response()->json(['status' => 'exist']);
        }else{
        $add = new Admin;
        $add->admin_name = $request->administratorname;
        $add->admin_username = $request->administratoruser;
        $add->admin_password = Hash::make($request->administratorpass);
        $add->admin_type = 'Super Admin';
        $add->admin_pic = 'default.jpg';
        $add->save();
        return response()->json(['status' => 'success']);
        }


    }
    public function GetAdministratorData(){
        $check = Admin::where('admin_type','Super Admin')->get();

        return response()->json(['data' => $check]);
    }

    public function GetAdministratorDataToEdit(Request $request){
        $check = Admin::where('admin_id',$request->id)->first();

        return response()->json(['data' => $check]);
    }
    public function EditAdministratorInfo(Request $request){

        if( $request->aditadministratorname == '' || $request->aditadministratoruser == ''){

            return response()->json(['status' => 'empty']);
        }else if($request->aditadministratorpass){
            $check = Admin::where('admin_id',$request->administratorId)->first();
            $check->update([
                'admin_name'=>$request->aditadministratorname,
                'admin_username'=>$request->aditadministratoruser,
                'admin_password'=>Hash::make($request->aditadministratorpass),
                ]);
            return response()->json(['status' => 'success']);
        }else{
        $check = Admin::where('admin_id',$request->administratorId)->first();
        $check->update([
            'admin_name'=>$request->aditadministratorname,
            'admin_username'=>$request->aditadministratoruser,

            ]);
        return response()->json(['status' => 'success']);
        }

    }
    public function GetAllStudentData(request $request){
        if($request->dept==='dept'){

// Fetch all departments
$departments = Department::all();

// Initialize an empty array to hold the results
$results = [];

// Loop through each department
foreach ($departments as $department) {
    // Fetch courses for the current department
    $courses = Course::where('dept_id', $department->dept_id)->get();

    foreach ($courses as $course) {
        // Fetch sections for the current course
        $sections = Section::where('course_id', $course->course_id)->get();

        foreach ($sections as $section) {
            // Fetch students for the current section
            $students = StudentAccounts::where('sect_id', $section->sect_id)->get();

            foreach ($students as $student) {
                // Collect the data
                $results[] = [
                    'dept_name' => $department->dept_name,
                    'course_name' => $course->course_name,
                    'year_level' => $section->year_level.'-'.$section->sect_name,
                    'student_firstname' => $student->student_firstname,
                    'student_lastname' => $student->student_lastname,
                     'school_id' => $student->school_id,
                     'student_id' => $student->student_id
                ];
            }
        }
    }
}
            return response()->json(['data' => $results]);
        }
        $data = StudentAccounts::All();
        return response()->json(['data' => $data]);
    }
     public function GetAllStudentAdminData(){
        $data = StudentAccounts::where('student_type','Administrator')->get();
        return response()->json(['data' => $data]);
    }
    public function SetStudentAdmin(Request $request){
        if($request->studentadminid == ''){
             return response()->json(['status' => 'empty']);
        }else{
        $data = StudentAccounts::where('student_id',$request->studentadminid)->first();
        $data->update([
            'student_position'=>$request->studentposition,
            'student_type'=>'Administrator',
            ]);
        return response()->json(['status' => 'success']);
        }

    }
    public function EditStudentAdminPosition(Request $request){

        $data = StudentAccounts::where('student_id',$request->editstudentadminid)->first();
        $data->update([
            'student_position'=>$request->editstudentposition,
            ]);
        return response()->json(['status' => 'success']);
    }
    public function DemoteAdmin(Request $request){
        $data = Admin::where('admin_id',$request->demoteadminid)->first();
        $data->update([
            'admin_type'=>'Demoted',
        ]);
            return response()->json(['status' => 'success']);
    }
    public function DemoteStudentAdmin(Request $request){
        $data = StudentAccounts::where('student_id',$request->demotestudentid)->first();
        $data->update([
            'student_type'=>'Student',
            'student_position'=>null,
        ]);
            return response()->json(['status' => 'success']);
    }
}
