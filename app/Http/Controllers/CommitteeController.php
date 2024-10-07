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
            $validated = $request->validate([
                'members' => 'required|array',
                'members.*' => 'required|array',
                'members.*.*' => 'required|string',
            ]);

            foreach ($validated['members'] as $committeeId => $members) {
                foreach ($members as $memberName) {
                    CommitteeMember::create([
                        'committee_id' => $committeeId,
                        'member_name' => $memberName,
                    ]);
                }
            }

            return response()->json(['success' => true, 'message' => 'Members saved successfully!']);
        }
}
