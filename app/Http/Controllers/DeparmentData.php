<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;

class DeparmentData extends Controller
{
   public function SaveDepartment(Request $request){

    $data = new Department;
    $data->dept_name = $request->department;
    $data->save();
    return response()->json(['status'=>'success']);
   }
}
