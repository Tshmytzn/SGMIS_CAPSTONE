<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Compendium;
use App\Models\CompendiumFile;

class CompendiumData extends Controller
{
    public function AddCompendium(Request $request){
        $check = Compendium::where('event_id',$request->eventId)->where('com_name',$request->compendiumname)->first();
        if($request->eventId ==''|| $request->compendiumname==''){
        return response()->json(['status' => 'empty']);
        }else if($check){
        return response()->json(['status' => 'exist']);
        }else{
        $data = new Compendium;
        $data ->event_id=$request->eventId;
        $data ->com_name=$request->compendiumname;
        $data->save();
        return response()->json(['status' => 'success']);
        }

       
    }
    public function GetAllCompendium(){
        $data = Compendium::join('school_event','compendium.event_id','=','school_event.event_id')->select('compendium.*','school_event.event_name','school_event.event_description')->get();
        return response()->json(['data' => $data ]);
    }
}
