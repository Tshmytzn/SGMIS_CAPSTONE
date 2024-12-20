<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ElectionCandidates;
use Illuminate\Http\Request;
use App\Models\Election;
use App\Models\ElectionParty;
use App\Models\ElectionVote;
use App\Models\StudentAccounts;
use App\Models\Course;
use App\Models\Section;
use Carbon\Carbon;
use Carbon\CarbonTimeZone;
use App\Models\ElectionResult;
use App\Models\ElectionMaterials;
use App\Models\ElectionBatchMember;

class ElectionController extends Controller
{
    public function createElection(request $request)
    {
        if ($request->method == 'update') {
            if($request->status=='1'){
                $check = election::where('elect_status','1')->get();
                if(count($check)>0){
                return response()->json(['message' => 'Active Election Found','status' => 'error']);
                }
                $elect = Election::where('elect_id', $request->elect_id)->first();
                $elect->update([
                'elect_status' => $request->status,
            ]);
             return response()->json(['message' => 'Election Successfully Updated', 'reload' => 'getElection',  'status' => 'success']);
            }else if ($request->status == '2'){
                $elect = Election::where('elect_id', $request->elect_id)->first();
                $elect->update([
                    'elect_status' => $request->status,
                ]);
                return response()->json([ 'status' => 'update']);
            }
            $elect = Election::where('elect_id', $request->electID)->first();
            $elect->update([
                'elect_name' => $request->election_name,
                'elect_description' => $request->election_desc,
                'elect_start' => $request->voting_start_date,
                'elect_end' => $request->voting_end_date,
            ]);
            return response()->json(['message' => 'Election Successfully Updated', 'reload' => 'getElection',  'status' => 'success']);
        }

        $check = Election::where('elect_end', '>=', $request->voting_start_date)->where('elect_status','1')->first();
        if($check){
            return response()->json(['message' => 'Can Not Add Election That Already Started','status' => 'error']);
        }
        if($request->voting_end_date <= $request->voting_start_date){
            return response()->json(['message' => 'Election Format Not Valid', 'status' => 'error']);
        }
        if ($request->election_name == '' || $request->voting_start_date == '' || $request->voting_end_date == '') {
            return response()->json(['message' => 'Fill in All Required Fields', 'status' => 'error']);
        }

        $data = new Election;
        $data->elect_name = $request->election_name;
        $data->elect_description = $request->election_desc;
        $data->elect_start = $request->voting_start_date;
        $data->elect_end = $request->voting_end_date;
        $data->save();

        return response()->json(['message' => 'Campaign Material Successfully Created', 'modal' => 'createelection', 'status' => 'success']);
    }
    public function getElection(request $request)
    {
        if ($request->elect_id) {
            $elect = Election::where('elect_id', $request->elect_id)->first();
            return response()->json(['data' => $elect, 'status' => 'success']);
        }
        $elect = Election::All();
        return response()->json(['data' => $elect, 'status' => 'success']);
    }
    public function party(request $request)
    {

        if ($request->method === 'add') {
            if ($request->elect_id == '' || $request->party_name == '' || $request->party_desc == '' || $request->party_image == '') {
                return response()->json(['message' => 'Fill Out Required Field', 'status' => 'error']);
            }
            // Handle the uploaded file
            if ($request->hasFile('party_image')) {
                $image = $request->file('party_image');

                // Store the image in the 'public/party_image' directory
                $length = 30; // Fixed length
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';

                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }

                // Extract the original name and extension, then combine them
                $imageNameWithExtension =  $randomString .'.'. $image->getClientOriginalExtension(); // Image name with extension
                $request->party_image->move(public_path('party_image/'), $imageNameWithExtension); // Save file and return path
                // Save data to the database
                $data = new ElectionParty;
                $data->elect_id = $request->elect_id;
                $data->party_name = $request->party_name;
                $data->party_description = $request->party_desc;
                $data->party_picture = $imageNameWithExtension; // Store the full name with extension
                $data->save();

                return response()->json(['message' => 'Party Successfully Created', 'reload' => 'getParty', 'modal' => 'createparty', 'status' => 'success']);
            }
        } else if ($request->method === 'update') {
            $party = ElectionParty::where('party_id', $request->party_id_update)->first();
            if (empty($request->party_image_update)) {
                $party->update([
                    'party_name' => $request->party_name_update,
                    'party_description' => $request->party_desc_update,
                ]);
                return response()->json([
                    'message' => 'Party Successfully Updated',
                    'modal' => 'updateparty',
                    'reload' => 'getParty',
                    'status' => 'success'
                ]);
            } else {
                if ($request->hasFile('party_image_update')) {
                    $image = $request->file('party_image_update');

                    // Get the existing image name without extension
                    $existingImageName = pathinfo($party->party_picture, PATHINFO_FILENAME);
                    $length = 30; // Fixed length
                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $charactersLength = strlen($characters);
                    $randomString = '';

                    for ($i = 0; $i < $length; $i++) {
                        $randomString .= $characters[rand(0, $charactersLength - 1)];
                    }

                    // Generate the new image name with the new extension
                    $newImageName = $randomString . '.' . $image->getClientOriginalExtension();

                    $oldImagePath = public_path('party_image/' . $party->party_picture);

                    unlink($oldImagePath); // Delete the old image


                    // Move the new image to the party_image folder and replace the old image
                    $image->move(public_path('party_image/'), $newImageName);

                    // Update the party record with new image name and other details
                    $party->update([
                        'party_name' => $request->party_name_update,
                        'party_description' => $request->party_desc_update,
                        'party_picture' => $newImageName,
                    ]);

                    return response()->json([
                        'message' => 'Party Successfully Updated',
                        'modal' => 'updateparty',
                        'reload' => 'getParty',
                        'status' => 'success'
                    ]);
                } else {
                    return response()->json([
                        'message' => 'No image file provided.',
                        'status' => 'error'
                    ]);
                }
            }
        } else if ($request->method === 'get') {
            if ($request->party_id) {
                $party = ElectionParty::where('party_id', $request->party_id)->first();
                return response()->json(['data' => $party, 'status' => 'success']);
            }
            $party = ElectionParty::where('elect_id', $request->elect_id)->where('party_status', null)->get();
            return response()->json(['data' => $party, 'status' => 'success']);
        } else if ($request->method === 'delete') {
            $party = ElectionParty::where('party_id', $request->party_id)->first();
            $candi = ElectionCandidates::where('party_id', $party->party_id)->get();
            foreach ($candi as $can) {
                $can->update([
                    'candi_status' => '1',
                ]);
            }
            $party->update([
                'party_status' => '1',
            ]);
            return response()->json(['message' => 'Party Successfully Removed', 'reload' => 'getParty', 'status' => 'success']);
        }
        return response()->json(['message' => 'Process failed', 'status' => 'error'], 400);
    }
    public function Candidate(request $request)
    {
        if ($request->method == 'get') {
            if ($request->group_of == '1') {
                if ($request->vote == 'vote') {
                    $elect = Election::where('elect_status', '1')->first();
                    $elect_party = ElectionParty::where('elect_id', $elect->elect_id)->get();
                    $data = [];
                    foreach ($elect_party as $electP) {
                        $candi = ElectionCandidates::where('party_id', $electP->party_id)->where('group_of', '1')->where('candi_position', $request->position)->where('candi_status', null)->get();

                        $data = array_merge($data, $candi->toArray());
                    }
                    return response()->json(['data' => $data, 'status' => 'success']);
                }
                $candi = ElectionCandidates::where('party_id', $request->party_id)->where('group_of', '1')->where('candi_status', null)->get();
                return response()->json(['data' => $candi, 'status' => 'success']);
            } else if ($request->group_of == '2') {
                if ($request->vote == 'vote') {
                    $elect = Election::where('elect_status', '1')->first();
                    $elect_party = ElectionParty::where('elect_id', $elect->elect_id)->get();
                    $data = [];
                    foreach ($elect_party as $electP) {
                        $candi = ElectionCandidates::where('party_id', $electP->party_id)->where('group_of', '2')->where('candi_position', $request->position)->where('candi_status', null)->get();
                        $data = array_merge($data, $candi->toArray());
                    }
                    return response()->json(['data' => $data, 'status' => 'success']);
                }
                $candi = ElectionCandidates::where('party_id', $request->party_id)->where('group_of', '2')->where('candi_status', null)->get();
                return response()->json(['data' => $candi, 'status' => 'success']);
            } else if ($request->group_of == '3') {
                if ($request->vote == 'vote') {
                    $elect = Election::where('elect_status', '1')->first();
                    $elect_party = ElectionParty::where('elect_id', $elect->elect_id)->get();
                    foreach($elect_party as $part){
                        $student = StudentAccounts::where('student_id', session('student_id'))->first();
                        $section1 = Section::where('sect_id', $student->sect_id)->first();
                        $course1 = Course::where('course_id', $section1->course_id)->first();
                        $data = [];
                        $candidate = ElectionCandidates::where('party_id', $part->party_id)->where('group_of', '3')->where('candi_position', $request->position)->where('candi_status', null)->get();
                        foreach ($candidate as $can) {
                            $student2 = StudentAccounts::where('student_id', $can->student_id)->first();
                            $section2 = Section::where('sect_id', $student2->sect_id)->first();
                            $course2 = Course::where('course_id', $section2->course_id)->first();
                            if ($course1->course_id == $course2->course_id) {
                                $candidate2 = ElectionCandidates::where('candi_id', $can->candi_id)->where('group_of', '3')->where('candi_position', $request->position)->where('candi_status', null)->first();
                                $data[] = $candidate2->toArray();
                            }
                        }
                        return response()->json(['data' => $data, 'status' => 'success']);
                    }
                    
                    // $elect = Election::where('elect_status','1')->first();
                    // $elect_party = ElectionParty::where('elect_id',$elect->elect_id)->get();
                    // $data=[];
                    // foreach($elect_party as $electP){
                    //      $candi = ElectionCandidates::where('party_id',$electP->party_id)->where('group_of','3')->where('candi_position',$request->position)->where('candi_status',null)->get();
                    //     $data = array_merge($data, $candi->toArray());
                    // }

                }
                $candi = ElectionCandidates::where('party_id', $request->party_id)->where('group_of', '3')->where('candi_status', null)->get();
                return response()->json(['data' => $candi, 'status' => 'success']);
            }

            $candi = ElectionCandidates::where('party_id', $request->party_id)->where('candi_status', null)->get();
            return response()->json(['data' => $candi, 'status' => 'success']);
        } else if ($request->method == 'add') {
            $check = ElectionCandidates::where('student_id', $request->student_id)->where('party_id', $request->party_id)->first();
            if ($request->student_id == '' || $request->student_position == '') {
                return response()->json([
                    'message' => 'Fill up required fields.',
                    'status' => 'error'
                ]);
            }

            if ($request->student_id == '' || $request->student_position == '') {
                return response()->json([
                    'message' => 'Fill up required fields.',
                    'status' => 'error'
                ]);
            }
            if ($check) {
                return response()->json([
                    'message' => 'Student Already Added.',
                    'status' => 'error'
                ]);
            }
            if ($request->hasFile('student_picture')) {
                $image = $request->file('student_picture');

                // Store the image in the 'public/party_image' directory
                if ($request->group == '1') {
                    $check2 = ElectionCandidates::where('party_id', $request->party_id)->where('candi_position', '!=','Senator')->where('candi_position', $request->student_position)->first();
                    if ($check2) {
                        return response()->json([
                            'message' => 'Position Already Taken.',
                            'status' => 'error'
                        ]);
                    }
                    $group = '1';
                } else if ($request->group == '2') {
                    $group = '2';
                } else if ($request->group == '3') {
                    $group = '3';
                }
                // Extract the original name and extension, then combine them
                $imageNameWithExtension =  $request->party_id . $request->student_id . '_student_picture.' . $image->getClientOriginalExtension(); // Image name with extension
                $request->student_picture->move(public_path('student_images/'), $imageNameWithExtension); // Save file and return path

                $data = new ElectionCandidates;
                $data->party_id = $request->party_id;
                $data->student_id = $request->student_id;
                $data->student_name = $request->student_name;
                $data->candi_picture = $imageNameWithExtension;
                $data->candi_position = $request->student_position;
                $data->group_of = $group;
                $data->save();

                return response()->json(['message' => 'Successfully Added Party Member', 'reload' => 'getCandi', 'modal' => 'addCandi', 'status' => 'success']);
            } else {
                return response()->json([
                    'message' => 'No image file provided.',
                    'status' => 'error'
                ]);
            }
        } else if ($request->method == 'update') {
            if ($request->hasFile('student_picture_update')) {
                $candi = ElectionCandidates::where('candi_id', $request->candi_id)->first();
                $image = $request->file('student_picture_update');

                $length = 30; // Fixed length
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';

                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }

                // Generate the new image name with the new extension
                $newImageName = $randomString . '.' . $image->getClientOriginalExtension();

                $oldImagePath = public_path('student_images/' . $candi->candi_picture);

                unlink($oldImagePath); // Delete the old image


                // Move the new image to the party_image folder and replace the old image
                $image->move(public_path('student_images/'), $newImageName);

                $candi->update([
                    'candi_picture' => $newImageName
                ]);
                return response()->json(['message' => ' Party Member Successfully Updated', 'reload' => 'getCandi', 'modal' => 'updateCandi', 'status' => 'success']);
            } else {
                return response()->json([
                    'message' => 'No image file provided.',
                    'status' => 'error'
                ]);
            }
        } else if ($request->method == 'delete') {
            $candi = ElectionCandidates::where('candi_id', $request->student_m)->first();
            $oldImagePath = public_path('student_images/' . $candi->candi_picture);
            unlink($oldImagePath); // Delete the old image
            $candi->delete();
            return response()->json(['message' => 'Party Member Successfully Removed', 'reload' => 'getCandi', 'status' => 'success']);
        }
    }

    public function vote(request $request)
    {

        $election_id = ElectionParty::select('elect_id')->where('party_id', $request->party_id1)->first();
        for ($i = 1; $i < 7; $i++) {
            // Perform some action for each iteration
            $candi = 'candi_id' . $i;
            $candi_id = $request->$candi;

            $party = 'party_id' . $i;
            $party_id = $request->$party;
            if ($party === 'party_id3') {
                $idArray = explode(',', trim($party_id, ',')); // Trim trailing commas, then explode into an array
                $length = count($idArray);
                $canArray = explode(',', trim($candi_id, ','));
                $data = []; // Initialize an empty array to store the split values

                // Loop through the array of IDs
                for ($a = 0; $a < $length; $a++) {
                     $idArray[$a]; // Add each ID to the $data array
                     $canArray[$a];
                $data = new ElectionVote;
                $data->elect_id = $election_id->elect_id;
                $data->party_id = $idArray[$a];
                $data->candi_id = $canArray[$a];
                $data->student_id = session('student_id');
                $data->vote_status = '1';
                $data->save();
                }
            }else{
                $data = new ElectionVote;
                $data->elect_id = $election_id->elect_id;
                $data->party_id = $party_id;
                $data->candi_id = $candi_id;
                $data->student_id = session('student_id');
                $data->vote_status = '1';
                $data->save();
            }
        }
        return response()->json(['message'=>'Successfully Voted!','reload'=>'redirect','status' => 'success']);
    }
    public function ElectionResult(Request $request)
    {   
        if($request->getResult){
            $election = Election::where('elect_id', $request->elect_id)->first();

            $providedDateTime = Carbon::createFromFormat('Y-m-d\TH:i', $election->elect_end, new CarbonTimeZone('Asia/Hong_Kong'));

            // Get the current time in the same timezone (or your app's timezone)
            $currentDateTime = Carbon::now(new CarbonTimeZone('Asia/Hong_Kong'));

            // Compare the two datetimes
            if ($providedDateTime->greaterThan($currentDateTime)) {
                return response()->json(['message' => 'Ongoing', 'status' => 'success']);
            } elseif ($providedDateTime->lessThan($currentDateTime)) {
                return response()->json(['message' => 'Ended', 'status' => 'success']);
           
            } else {
                return response()->json(['message' => 'Now', 'status' => 'success']);
            }
        } 
        $election = Election::where('elect_id', $request->elect_id)->first();
        $votes = ElectionVote::where('elect_id', $request->elect_id)->get();
        $result = [];

        foreach ($votes as $vot) {
            $candi = ElectionCandidates::where('candi_id', $vot->candi_id)->first();
            if ($candi) {
                $party = ElectionParty::where('party_id', $candi->party_id)->first();
                if ($party) {
                    // Check if the candidate is already in the result array
                    $isAlreadyAdded = false;
                    foreach ($result as $res) {
                        if ($res['candidate_id'] == $candi->candi_id) {
                            $isAlreadyAdded = true;
                            break;
                        }
                    }

                    // If the candidate is not already added, add them to the result array
                    if (!$isAlreadyAdded) {
                        $activeUserCount = ElectionVote::where('candi_id', $candi->candi_id)->count();
                        $result[] = [
                            'candidate_id' => $candi->candi_id,
                            'student_name' => $candi->student_name,
                            'candi_picture'=>$candi->candi_picture,
                            'candi_position' => $candi->candi_position,
                            'student_id' => $candi->student_id,
                            'party_name' => $party->party_name,
                            'party_id' => $party->party_id,
                            'vote_count' => $activeUserCount
                        ];
                    }
                }
            }
        }

        return response()->json(['data' => $result, 'status' => 'success']);
    }
    public function saveResult(Request $request){

        $validatedData = $request->validate([
            'candidates' => 'required|array', // Ensure candidates is an array
            'candidates.*' => 'required|string', // Each candidate must be a string
        ]);

        $candidates = array_map(function ($candidate) {
            return json_decode($candidate, true);
        }, $validatedData['candidates']);

        // Process each candidate and insert into the database
        foreach ($candidates as $candidate) {
            $candi = ElectionResult::where('candi_id', $candidate['student_id'])->where('party_id',$candidate['party_id'])->where('votes', $candidate['vote_count'])->first();
            if($candi){
                return response()->json(['data' => 'result', 'status' => 'success']);
            }
            $data = new ElectionResult;
            $data->party_id = $candidate['party_id']; // Set the party name
            $data->candi_id = $candidate['student_id']; // Assuming this session value is set correctly
            $data->votes = $candidate['vote_count']; // Set the vote count
            $data->save(); // Save to the database
        }


        return response()->json(['data' => 'result', 'status' => 'success']);
    }
    public function UploadElectionMaterialFiles(Request $request){
        $request->validate([
            'file' => 'required|file|max:20480', // Max file size of 20 MB (20480 KB)
        ]);

        // Get the uploaded file from the request
        $file = $request->file('file');

        // Ensure the 'id' is present in the request
        $id = $request->input('id');
        if (!$id) {
            return response()->json(['message' => 'ID is required'], 400); // Return an error if 'id' is missing
        }

        // Define a new filename with a timestamp to avoid overwriting
        $newImageName = $id . '_' . $file->getClientOriginalName();

        // Move the file to the public/election_materials directory
        $file->move(public_path('election_materials'), $newImageName);
        
        $save = new ElectionMaterials();
        $save->election_id = $id;
        $save->file_name = $newImageName;
        $save->save();
        // Return a JSON response with the file path and success message
        return response()->json([
            'path' => 'election_materials/' . $newImageName, // Update to reflect the correct directory
            'message' => 'File uploaded successfully!'
        ], 200);

    }
    public function GetMaterials(request $request){

        $data =  ElectionMaterials::where('election_id',$request->id)->get();
        return response()->json(['data' => $data, 'status' => 'success']);
    }

    public function DeleteMaterials(request $request)
    {

        $data =  ElectionMaterials::where('id',  $request->id)->first();

        $oldImagePath = public_path('election_materials/' . $data->file_name);

        unlink($oldImagePath);

        $data->delete();

        return response()->json(['status' => 'success']);
    }

    public Function AddElectedOfficer(request $request){
        $currentDate = Carbon::now('Asia/Hong_Kong');
        $data = new ElectionBatchMember();
        $data->election_id = $request->id;
        $data->batch_date = $currentDate->toDateString();
        $data->name = $request->name;
        $data->position = $request->position;
        $data->save();

        return response()->json(['status' => 'success','message'=>'Officer Successfully Recorded']);
    }

    public function getElectedOfficer(request $request){
        $data = ElectionBatchMember::where('election_id',$request->id)->get();
        return response()->json(['status' => 'success', 'data' => $data]);
    }
    public function updateElectedOfficer(request $request){
        $data = ElectionBatchMember::where('id', $request->up_id)->first();
        $data->position = $request->position;
        $data->name = $request->name;
        $data->save();
        return response()->json(['status' => 'success', 'message' => 'Officer Successfully Updated']);
    }
    public function deleteElectedOfficer(request $request){
        $data = ElectionBatchMember::where('id', $request->id)->first();
        $data->delete();
        return response()->json(['status' => 'success', 'message' => 'Officer Successfully Delete']);
    }
}
