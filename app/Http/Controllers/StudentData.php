<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentAccounts;

class StudentData extends Controller
{
    public function UpdateStudentDetails(Request $req){

      if($req->studentschoolid=='' || $req->studentfname == '' || $req->studentmname == '' || $req->studentlname == '' ){

        return response()->json(['status'=>'empty']);

      } else {

        $updatestudent = StudentAccounts::where('student_id',Session('student_id'))->first();

        $updatestudent->update([
            'school_id'=> $req->studentschoolid,
            'student_firstname'=> $req->studentfname,
            'student_middlename'=> $req->studentmname,
            'student_lastname'=> $req->studentlname,
        ]);

      return response()->json(['status'=>'success']);
    }
}

    public function UpdateStudentimage(Request $request) {

        $file = $request->file('image');
    if ($file->getSize() > 10485760) {
        return response()->json([ 'exceed']);
    }else   if (!in_array($file->getClientOriginalExtension(), ['jpeg', 'png', 'jpg'])) {
        return response()->json(['invalid_type']);
    }

    $updatestudentimg = StudentAccounts::where('student_id',Session('student_id'))->first();


    }
}
