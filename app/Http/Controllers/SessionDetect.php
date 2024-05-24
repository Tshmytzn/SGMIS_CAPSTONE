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

    public function EventDetails(Request $req){
        if(Session::has('admin_id')){
            if (!$req->has('event_id') || empty($req->event_id)) {
                return view('error');
            }else{
                return view('Admin.eventdetails', ['event_id'=>$req->event_id]);
            }
        }else{
            return view('Admin.login');
        }
    }

    public function EvaluationDetails(Request $req){
        if(Session::has('admin_id')){
            if (!$req->has('eval_id') || empty($req->eval_id)) {
                return view('error');
            }else{
                return view('Admin.viewevaluations', ['eval_id'=>$req->eval_id]);
            }
        }else{
            return view('Admin.login');
        }
    }

    public function AdminProfile(Request $req){
        if(Session::has('admin_id')){
            return view('Admin.Profile', ['event_id'=>$req->event_id]); 
        }else{
            return view('Admin.login');
        }
    }

    public function Budgeting(Request $req){
        if(Session::has('admin_id')){
            return view('Admin.budgeting', ['event_id'=>$req->event_id]); 
        }else{
            return view('Admin.login');
        }
    }
    public function StudentViewEventDetails(Request $req){
        return view('Student.EventDetails', ['event_id'=>$req->event_id]); 
    }
}
