<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Course;
use App\Models\Section;
use App\Models\StudentAccounts;
use Illuminate\Support\Facades\Hash;
class DeparmentData extends Controller
{
    public function SaveDepartment(Request $request)
    {
        if ($request->department == '') {
            return response()->json(['status' => 'empty']);
        } else {
            $check = Department::where('dept_name', $request->department)->first();
            if ($check) {
                return response()->json(['status' => 'exist']);
            } else {
                $data = new Department;
                $data->dept_name = $request->department;
                $data->save();
                return response()->json(['status' => 'success']);
            }
        }
    }

    public function SaveCourse(Request $request)
    {    $check = Course::where('dept_id', $request->selectedDept)->where('course_name', $request->coursename)->first();
        if ($request->selectedDept== ''||$request->coursename=='') {
            return response()->json(['status' => 'empty']);
        }
        else if($check){
         return response()->json(['status' => 'exist']);
    } else {
            $check2 = Course::where('course_name', $request->coursename)->first();
            if ($check2) {
                return response()->json(['status' => 'exist']);
            } else {
                $data = new Course;
                $data->dept_id = $request->selectedDept;
                $data->course_name = $request->coursename;
                $data->save();
                return response()->json(['status' => 'success']);
            }
        }
    }
   public function GetDeptData(Request $request){

    $check = Course::where('dept_id', $request->dept_id)->get();
    return response()->json(['data' =>  $check]);
   } 
   public function SaveSection(Request $request)
   {
       if ($request->selectdepartment== ''||$request->selectcourse=='' || $request->section=='') {
           return response()->json(['status' => 'empty']);
       } else {
           $check = Section::where('sect_name', $request->section)->where('course_id', $request->selectcourse)->where('year_level', $request->selectyear)->first();
           if ($check) {
               return response()->json(['status' => 'exist']);
           } else {
               $data = new Section;
               $data->course_id = $request->selectcourse;
               $data->sect_name = $request->section;
               $data->year_level = $request->selectyear;
               $data->save();
               return response()->json(['status' => 'success']);
           }
       }
   }
    public function GetDepartmentData( ){

    $check = Department::all();

    return response()->json(['data' =>  $check]);
   } 
   public function EditDeptInfo(Request $request){
    if($request->EditDeptName == ''){
          return response()->json(['status' => 'empty']);
    }else{
          $check = Department::where('dept_id', $request->EditDeptId)->first();
    $check->update([
        'dept_name'=>$request->EditDeptName,
    ]);
     return response()->json(['status' => 'success']);
    }
   }
   public function GetCourseData( ){

    $check = Course::join('department','course.dept_id','=','department.dept_id')->select('course.*','department.dept_name')->get();

    return response()->json(['data' =>  $check]);
   } 
     public function EditCourseInfo(Request $request){
       $check = Course::where('dept_id', $request->editcoursedept)->where('course_name', $request->editcoursename)->first();  
    if($request->editcoursedept == '' || $request->editcoursename == ''){
          return response()->json(['status' => 'empty']);
    }else if($check){
        return response()->json(['status' => 'exist']);
    }
    else{
    $update = Course::where('course_id', $request->editcourseid)->first();
    $update->update([
        'dept_id'=>$request->editcoursedept,
        'course_name'=>$request->editcoursename,
    ]);
     return response()->json(['status' => 'success']);
    }
   }
    public function GetSectionData( ){

$check = Section::join('course', 'section.course_id', '=', 'course.course_id')
                ->join('department', 'course.dept_id', '=', 'department.dept_id')
                ->select('section.*', 'department.dept_id', 'department.dept_name', 'course.course_id', 'course.course_name')
                ->get();
    return response()->json(['data' =>  $check]);
   } 
      public function EditSectionInfo(Request $request){
       $check = Section::where('course_id', $request->editsectioncourse)->where('sect_name', $request->editsectionname)->first();  
    if($request->editsectiondept == '' || $request->editsectioncourse == '' || $request->editsectionyear == '' || $request->editsectionname == ''){
          return response()->json(['status' => 'empty']);
    }else if($check){
        return response()->json(['status' => 'exist']);
    }
    else{
    $update = Section::where('sect_id', $request->editsectionid)->first();
    $update->update([
        'course_id'=>$request->editsectioncourse,
        'sect_name'=>$request->editsectionname,
        'year_level'=>$request->editsectionyear
    ]);
     return response()->json(['status' => 'success']);
    }
   }
   public function SaveStudent(Request $request){
    $check = StudentAccounts::where('school_id', $request->studentid)->first();  
    if($check){
        return response()->json(['status' => 'exist']);
    }else if($request->studentid == ''|| $request->firstname == ''|| $request->middlename == ''|| $request->lastname== ''){
        return response()->json(['status' => 'empty']);
    }else{
        $pass = Hash::make($request->firstname.'123');
        $data = new StudentAccounts;
        $data->school_id = $request->studentid;
        $data->sect_id = $request->AddStudentSectId;
        $data->student_firstname = $request->firstname;
        $data->student_middlename = $request->middlename;
        $data->student_lastname = $request->lastname;
        $data->student_ext = $request->ext;
        $data->student_pass = $pass;
        $data->save();
        return response()->json(['status' => 'success']);
    }
   }
   public function GetStudentData(Request $request){
    if($request->sect_id){
        $students = StudentAccounts::join('section','student_accounts.sect_id','=','section.sect_id')
        ->select('student_accounts.*','section.sect_name','section.year_level')
        ->where('student_accounts.sect_id',$request->sect_id)
        ->get();
    }else{
        $students = StudentAccounts::join('section','student_accounts.sect_id','=','section.sect_id')
    ->select('student_accounts.*','section.sect_name','section.year_level')
    ->where('section.course_id',$request->course_id)
    ->get();
    }
    

    return response()->json(['data' => $students]);
   }
}
