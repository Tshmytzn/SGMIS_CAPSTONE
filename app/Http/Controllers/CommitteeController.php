<?php

namespace App\Http\Controllers;

use App\Models\Committee;
use Illuminate\Http\Request;
use App\Models\CommitteeMember;


class CommitteeController extends Controller
{
    public function saveCommittee(Request $request)
    {
        // Validate the request
        $request->validate([
            'budget_id' => 'required|exists:budget_proposals,id',
            'committees.*.name' => 'required|string|max:255',
            'committees.*.persons_in_charge' => 'required|array',
            'committees.*.persons_in_charge.*' => 'required|string|max:255',
            'committees.*.id' => 'sometimes|exists:committees,id', // Validate if ID exists for updates
        ]);

        foreach ($request->committees as $committee) {
            if (isset($committee['id'])) {
                // Update existing committee
                $existingCommittee = Committee::findOrFail($committee['id']);
                $existingCommittee->update([
                    'name' => $committee['name'],
                    'person_in_charge' => $committee['persons_in_charge'],
                ]);
            } else {
                // Create new committee
                Committee::create([
                    'name' => $committee['name'],
                    'person_in_charge' => $committee['persons_in_charge'],
                    'budgeting_id' => $request->budget_id,
                ]);
            }
        }

        return response()->json(['message' => 'Committees saved successfully!']);
    }

    public function saveMembers(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'members' => 'required|array',
            'members.*' => 'required|array',
            'members.*.*' => 'required|string',
            'member_ids' => 'sometimes|array', // Member IDs for existing members
            'member_ids.*.*' => 'nullable|integer', // IDs of existing members, nullable if new
            'removed_member_ids' => 'nullable|array', // Optional: IDs of removed members
        ]);
    
        // Handle member removal
        if (!empty($validated['removed_member_ids'])) {
            foreach ($validated['removed_member_ids'] as $memberId) {
                CommitteeMember::find($memberId)?->delete(); // Delete the member if it exists
            }
        }
    
        // Save or update members
        foreach ($validated['members'] as $committeeId => $members) {
            foreach ($members as $index => $memberName) {
                // Check if a member_id exists for this committee and index
                if (isset($validated['member_ids'][$committeeId][$index])) {
                    // If the member ID exists, update the existing member
                    $memberId = $validated['member_ids'][$committeeId][$index];
                    $committeeMember = CommitteeMember::find($memberId);
    
                    if ($committeeMember) {
                        $committeeMember->member_name = $memberName;
                        $committeeMember->save(); // Update existing member
                    }
                } else {
                    // If no member ID, create a new member
                    CommitteeMember::create([
                        'committee_id' => $committeeId,
                        'member_name' => $memberName,
                    ]);
                }
            }
        }
    
        return response()->json(['success' => true, 'message' => 'Members saved successfully!']);
    }
    
    
}
