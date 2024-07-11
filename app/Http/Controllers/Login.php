<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\StudentAccounts;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
class Login extends Controller
{
   public function AdminLogin(Request $req){
    $admin = Admin::where('admin_username', $req->username)->first();

    if($admin){
      if(Hash::check($req->password, $admin->admin_password)){
          Session::put('admin_id', $admin->admin_id);
          return response()->json(['status'=>'success']);
      }else{
          return response()->json(['status'=>'incorrect']);
      }
    }else{
      return response()->json(['status'=>'not_found']);
    }
   }

   public function AdminLogout(Request $req){
    Session::forget('admin_id');
    return redirect()->route('AdminLogin');
   }

   public function LoginStudent (Request $req) {

    $student = StudentAccounts::where('school_id', $req->studentusername)->first();

    if($student) {
    if(Hash::check($req->studentpass, $student->student_pass)){
          Session::put('student_id', $student->student_id);
          return response()->json(['status'=>'success']);
      }else{
          return response()->json(['status'=>'incorrect']);
      }
    }else{
      return response()->json(['status'=>'not_found']);
    }
    }

    public function LogoutStudent()
    {
        Session::forget('student_id');
        return redirect()->route('Userlogin');
    }

}

