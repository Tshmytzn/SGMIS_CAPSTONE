<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;

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
}
