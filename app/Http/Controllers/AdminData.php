<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
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
}
