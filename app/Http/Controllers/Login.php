<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
class Login extends Controller
{
   public function AdminLogin(Request $req){
      $admin = Admin::where('admin_username', $req->username)->first();

      if($admin){
        if(Hash::check($req->password, $admin->admin_password)){
            return response()->json(['status'=>'success']);
        }else{
            return response()->json(['status'=>'incorrect']);
        }
      }else{
        return response()->json(['status'=>'not_found']);
      }
   }
}
