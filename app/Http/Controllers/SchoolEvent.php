<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolEvents;

class SchoolEvent extends Controller
{
    public function SaveEvent(Request $req){
        $pic = $req->file('ev_pic');

        if(!in_array($pic->getClientOriginalExtension(), ['jpeg', 'jpg', 'png', 'gif'])){
            return response()->json(['status'=>'invalid_img']);
        }
       
      
        $event = new SchoolEvents;
        $event->dept_id = $req->dept;
        $event->event_name  = $req->ev_name;
        $event->event_description = $req->ev_description;
        $event->event_start = $req->ev_start;
        $event->event_end = $req->ev_end;
        $event->event_pic = 'none';
        $event->admin_id = session('admin_id');
        $event->save();

        $picName = 'Event'.$event->event_id .".". $pic->getClientOriginalExtension();
        $pic->move(public_path('event_images/'), $picName);

        $eventUpdate = SchoolEvents::where('event_id', $event->event_id)->first();
        $eventUpdate->update(['event_pic'=>$picName]);

        return response()->json(['status'=>'success', 'ev_id'=>$event->event_id]);
    }

    public function GetAllEvents(){
        $event = SchoolEvents::all();

        return response()->json(['event'=>$event]);
    }

    public function GetEvent(Request $req){
        $id = $req->ev_id;
        $event = SchoolEvents::where('event_id', $id)->first();

        return response()->json(['event'=>$event]);
    }

    public function DeleteEvent(Request $req){
        $event_id = $req->event_id;

        $event = SchoolEvents::where('event_id', $event_id)->first();

        $image= public_path('event_images/'. $event->event_pic);
        if(file_exists($image)){
            unlink($image);
            $event->delete(); 
            return response()->json(['status'=>'success']);
        }else{
            return response()->json(['status'=>'fail']);
        }
    }
}
