<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentAccounts;
use Illuminate\Support\Facades\Hash;

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

  public function UpdateStudentImage(Request $request)
  {
    // Check if a file is present
    if (!$request->hasFile('updatestudentpic')) {
      return response()->json(['error' => 'No file uploaded']);
    }

    $file = $request->file('updatestudentpic');

    // Check file size (max 10 MB)
    if ($file->getSize() > 10485760) {
      return response()->json(['error' => 'exceed']);
    }

    // Check file type (only jpeg, png, jpg)
    if (!in_array($file->getClientOriginalExtension(), ['jpeg', 'png', 'jpg'])) {
      return response()->json(['error' => 'invalid_type']);
    }

    // Find the student record based on session ID
    $updatestudentimg = StudentAccounts::where('student_id', session('student_id'))->first();

    // Generate a unique filename to avoid overwriting
    $filename = uniqid() . '_' . $file->getClientOriginalName();

    // Update student image path in the database
    $updatestudentimg->student_pic = $filename;
    $updatestudentimg->save();
    
    $file->move(public_path('student_images'), name: $filename);

    // Redirect to account settings route
    return redirect()->route('accountsettings');
  }
  public function updatestudentPass(request $request){
    $updatestudentpass = StudentAccounts::where('student_id',session('student_id'))->first();
    $updatestudentpass->update([
      'student_pass' => Hash::make($request->repass),
      ]);
      return response()->json(['status'=>'success']);
  }
}
