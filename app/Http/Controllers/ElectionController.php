<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ElectionCandidates;
use Illuminate\Http\Request;
use App\Models\Election;
use App\Models\ElectionParty;

class ElectionController extends Controller
{
    public function createElection(request $request)
    {
        if ($request->method == 'update') {
            $elect = Election::where('elect_id', $request->electID)->first();
            $elect->update([
                'elect_name' => $request->election_name,
                'elect_description' => $request->election_desc,
                'elect_start' => $request->voting_start_date,
                'elect_end' => $request->voting_end_date,
            ]);
            return response()->json(['message' => 'Election Successfully Updated', 'reload' => 'getElection',  'status' => 'success']);
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

        return response()->json(['message' => 'Election Successfully Created', 'status' => 'success']);
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
            if ($request->party_name == '' || $request->party_desc == '' || $request->party_image == '') {
                return response()->json(['message' => 'Fill Out Required Field', 'status' => 'error']);
            }
            // Handle the uploaded file
            if ($request->hasFile('party_image')) {
                $image = $request->file('party_image');

                // Store the image in the 'public/party_image' directory


                // Extract the original name and extension, then combine them
                $imageNameWithExtension =  $request->elect_id . '_party_image.' . $image->getClientOriginalExtension(); // Image name with extension
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
            $party = ElectionParty::where('elect_id', $request->elect_id)->where('party_status',null)->get();
            return response()->json(['data' => $party, 'status' => 'success']);
        } else if ($request->method === 'delete') {
            $party = ElectionParty::where('party_id', $request->party_id)->first();
            $candi = ElectionCandidates::where('party_id', $party->party_id)->get();
            foreach($candi as $can){
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
            $candi = ElectionCandidates::where('party_id', $request->party_id)->where('candi_status',null)->get();
            return response()->json(['data' => $candi, 'status' => 'success']);
        } else if ($request->method == 'add') {
            if ($request->student_id == '' || $request->student_position == '') {
                return response()->json([
                    'message' => 'Fill up required fields.',
                    'status' => 'error'
                ]);
            }
            if ($request->hasFile('student_picture')) {
                $image = $request->file('student_picture');

                // Store the image in the 'public/party_image' directory

                // Extract the original name and extension, then combine them
                $imageNameWithExtension =  $request->party_id . $request->student_id . '_student_picture.' . $image->getClientOriginalExtension(); // Image name with extension
                $request->student_picture->move(public_path('student_images/'), $imageNameWithExtension); // Save file and return path

                $data = new ElectionCandidates;
                $data->party_id = $request->party_id;
                $data->student_id = $request->student_id;
                $data->student_name = $request->student_name;
                $data->candi_picture = $imageNameWithExtension;
                $data->candi_position = $request->student_position;
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
}