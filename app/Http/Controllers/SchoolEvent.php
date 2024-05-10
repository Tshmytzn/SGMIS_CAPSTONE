<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolEvents;

class SchoolEvent extends Controller
{
    public function SaveEvent(Request $req){
        $event = new SchoolEvents;
        $event->dept_id = $req->dept;
        $event->event_name  = $req->ev_name;
        $event->event_description = $req->ev_description;
        $event->event_start = $req->ev_start;
        $event->event_end = $req->ev_end;
        $event->event_pic = $pic;
        $event->event_pic = $req->admin_id;
        $event->save();

        return response()->json(['status'=>'success']);
    }
}
