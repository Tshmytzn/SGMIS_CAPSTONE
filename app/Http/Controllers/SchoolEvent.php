<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolEvents;
use App\Models\Admin;
class SchoolEvent extends Controller
{
    public function SaveEvent(Request $req){
        $pic = $req->file('ev_pic');

        if(!in_array($pic->getClientOriginalExtension(), ['jpeg', 'jpg', 'png', 'gif'])){
            return response()->json(['status'=>'invalid_img']);
        }
             
        $event = new SchoolEvents;
        $event->event_name  = $req->ev_name;
        $event->event_description = $req->ev_description;
        $event->event_start = $req->ev_start;
        $event->event_end = $req->ev_end;
        $event->event_facilitator = $req->ev_facilitator;
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

    public function EventDetailsLoad(Request $req){
        $ev_id = $req->event_id;
        $event = SchoolEvents::where('event_id', $ev_id)->first();
        $admin = Admin::where('admin_id', $event->admin_id)->first();

        return response()->json(['event'=>$event, 'admin'=>$admin]);
    }

    public function UpdateEventDetails(Request $req){
        $event = SchoolEvents::where('event_id', $req->event_id)->first();

        $pic = $req->file('ev_pic');

        if($pic) {
            if(!in_array($pic->getClientOriginalExtension(), ['jpeg', 'jpg', 'png', 'gif'])){
                return response()->json(['status'=>'invalid_img']);
            }else{
                $event->update([
                    'event_name'=> $req->ev_name,
                    'event_description'=>$req->ev_description,
                    'event_facilitator'=> $req->ev_facilitator,
                    'event_start'=> $req->ev_start,
                    'event_end'=>$req->ev_end,
                    'event_pic'=> "Event". $req->event_id .".".$pic->getClientOriginalExtension(),
                  ]);

                  $pic->move(public_path('event_images/'),  "Event". $req->event_id . ".". $pic->getClientOriginalExtension());
            }
        } 
         $event->update([
           'event_name'=> $req->ev_name,
           'event_description'=>$req->ev_description,
           'event_facilitator'=> $req->ev_facilitator,
           'event_start'=> $req->ev_start,
           'event_end'=>$req->ev_end,
         ]);
    }
}
