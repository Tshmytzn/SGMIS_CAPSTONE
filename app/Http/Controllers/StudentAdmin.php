<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentAccounts;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
class StudentAdmin extends Controller
{
    public function StudentAdminLogin(Request $req)
    {
        $acc = StudentAccounts::where('school_id', $req->username)->where('student_position','!=',null)->first();

        if ($acc) {
            if (Hash::check($req->password, $acc->student_pass)) {
                Session::put('admin_id', $acc->student_id);
                return response()->json(['status' => 'success']);
            } else {
                return response()->json(['status' => 'incorrect']);
            }
        } else {
            return response()->json(['status' => 'not_found']);
        }
    }

    public function StudentAdminLogout(Request $req)
    {
        Session::forget('admin_id');
        return redirect()->route(route: 'studentAdminLogin');
    }
}
