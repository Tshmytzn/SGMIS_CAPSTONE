<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Course;
use App\Models\Section;
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
    {
        if ($request->selectedDept== ''||$request->coursename=='') {
            return response()->json(['status' => 'empty']);
        } else {
            $check = Course::where('course_name', $request->department)->first();
            if ($check) {
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
           $check = Section::where('sect_name', $request->section)->where('course_id', $request->selectcourse)->first();
           if ($check) {
               return response()->json(['status' => 'exist']);
           } else {
               $data = new Section;
               $data->course_id = $request->selectcourse;
               $data->sect_name = $request->section;
               $data->save();
               return response()->json(['status' => 'success']);
           }
       }
   }
}
