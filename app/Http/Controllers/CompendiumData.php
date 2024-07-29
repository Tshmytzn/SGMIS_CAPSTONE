<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Compendium;
use App\Models\CompendiumFile;
use Illuminate\Support\Facades\File;

class CompendiumData extends Controller
{
    public function AddCompendium(Request $request){
        $check = Compendium::where('event_id',$request->eventId)->first();
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
    public function UploadCompendiumFile(Request $request)
    {
        $file = $request->file('file');
        $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $fileName = $request->com_id . '.' . $originalFileName . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('compendium_file/'), $fileName);
    
        $data = new CompendiumFile;
        $data->com_id = $request->com_id;
        $data->file_name = $fileName;
        $data->save();
    
        return response()->json(['status' => 'success']);
    }
    public function GetCompendiumFiles(Request $request){
      $get = CompendiumFile::where('com_id',$request->id)->orderBy('created_at','desc')->get();
      return response()->json(['data' => $get]);
    }
    public function DeleteFile(Request $request){
        $file = CompendiumFile::where('com_file_id', $request->id)->first();

        if ($file) {
            $filePath = public_path('compendium_file/') . $file->file_name;
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
            $file->delete();
            
            return response()->json(['message' => 'File deleted successfully.'], 200);
        } else {
            return response()->json(['message' => 'File not found.'], 404);
        }
    }
}
