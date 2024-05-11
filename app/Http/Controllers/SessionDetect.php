<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SessionDetect extends Controller
{
    public function Dashboard(){
        if(Session::has('admin_id')){
            return view('Admin.index');
        }else{
            return view('Admin.login');
        }
    }

    public function Accounts(){
        if(Session::has('admin_id')){
            return view('Admin.accounts');
        }else{
            return view('Admin.login');
        }
    }

    public function Events(){
        if(Session::has('admin_id')){
            return view('Admin.events');
        }else{
            return view('Admin.login');
        }
    }

    public function Documents(){
        if(Session::has('admin_id')){
            return view('Admin.documents');
        }else{
            return view('Admin.login');
        }
    }

    public function Settings(){
        if(Session::has('admin_id')){
            return view('Admin.settings');
        }else{
            return view('Admin.login');
        }
    }

    public function Programs(){
        if(Session::has('admin_id')){
            return view('Admin.programs');
        }else{
            return view('Admin.login');
        }
    }

    public function Evaluation(){
        if(Session::has('admin_id')){
            return view('Admin.evaluation');
        }else{
            return view('Admin.login');
        }
    }
}
