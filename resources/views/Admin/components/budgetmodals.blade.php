{{-- Modals --}}
<div class="modal fade" id="budgetProposalUpdate" tabindex="-1" aria-labelledby="budgetProposalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="budgetProposalModalLabel">Create Budget Proposal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="UpdatebudgetProposalForm"
                    onsubmit="event.preventDefault(); updateBudgetProposal('UpdatebudgetProposalForm');">
                    @csrf
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" id="modalTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="proposal-details-tab" data-bs-toggle="tab"
                                href="#proposal-details" role="tab" aria-controls="proposal-details"
                                aria-selected="true">Proposal Details</a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="submission-info-tab" data-bs-toggle="tab"
                                href="#submission-info" role="tab" aria-controls="submission-info"
                                aria-selected="false">Submission Information</a>
                        </li>
                    </ul>
                    <!-- Tab content -->
                    <div class="tab-content mt-3">

                        <input type="hidden" id="budget_id" name="budget_id" value="{{ $budget->id }}">
                        <!-- Proposal Details -->
                        <div class="tab-pane fade show active" id="proposal-details" role="tabpanel"
                            aria-labelledby="proposal-details-tab">
                            <!-- Proposal Title -->
                            <div class="row">

                            <div class="mb-3 col-6">
                                <label for="proposalTitle" class="form-label">Project Objective</label>
                                <textarea type="text" class="form-control" id="proposalTitle" name="objective" placeholder="Enter Project Objective" required>
    {{ old('objective', $budget->objective) }}
</textarea>

                            </div>
                            <div class="mb-3 col-6">
                                <label for="proposalTitle" class="form-label">Project Theme</label>
                                <input type="text" class="form-control" id="proposalTitle" value="{{ $budget->theme }}"
                                    name="theme" placeholder="Enter Project Theme" required>
                            </div>
                            <div class="mb-3 col-6">
                                <label for="proposalTitle" class="form-label">Project Location</label>
                                <input type="text" class="form-control" id="proposalTitle" value="{{ $budget->location }}"
                                    name="location" placeholder="Enter Project Location" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="projectparticipant" class="form-label">Aligned
                                    SDG</label>
                                <input type="text" class="form-control" id="projectparticipant" value="{{ $budget->project_participant }}"
                                    name="projectparticipant" placeholder="Enter Aligned SDG"
                                    required>
                            </div>
                            </div>

                            <!-- Event Related -->
                            <div class="row">
                               
                                <!-- Project Proponent -->
                                <div class="col-6 mb-3">
                                    <label for="projectproponent" class="form-label">Project
                                        Proponent</label>
                                    <input type="text" class="form-control" id="projectproponent" value="{{ $budget->project_proponent }}"
                                        name="projectproponent" placeholder="Enter Project Proponent"
                                        required>
                                </div>
                                <!-- Project Participant -->
                                <div class="col-6 mb-3">
                                    <label for="projectparticipant" class="form-label">Budget
                                        Allocated</label>
                                    <input type="number" class="form-control" id="projectparticipant" value="{{ $budget->total_budget }}"
                                        name="allocated" placeholder="Enter Budget Allocated"
                                        required>
                                </div>
                                <!-- Project Proponent -->
                                <div class="col-6 mb-3">
                                    <label for="projectproponent" class="form-label">Contact
                                        Person</label>
                                    <input type="text" class="form-control" id="projectproponent" value="{{ $budget->contact_person }}"
                                        name="contactperson" placeholder="Enter Contact Person"
                                        required>
                                </div>
                            <!-- Allocated Funds -->
                            <div class="col-6 mb-3">
                                <label for="fundingSource" class="form-label">Funding Source</label>
                                <input type="text" class="form-control" id="fundingSource" value="{{ $budget->funding_source }}"
                                    placeholder="Enter funding source" name="fundingSource" required>
                            </div>
                        </div>
                        </div>

                        <!-- Submission Information -->
                        <div class="tab-pane fade" id="submission-info" role="tabpanel"
                            aria-labelledby="submission-info-tab">

                            @php
                                $admin = App\Models\Admin::where('admin_id', session('admin_id'))->first();
                                $usertype = '';
                            @endphp
                            @php
                             $studentacc = App\Models\StudentAccounts::where('student_id', session('admin_id'))->first();
                             if ($studentacc) {
                              $usertype = $studentacc->student_position;
                             }
                            @endphp

                            @if ($admin)
                            <div class="mb-3">
                                <label for="proposedBy" class="form-label">Proposed By</label>
                                <input type="text" class="form-control" id="proposedBy"
                                    name="proposedBy" value="{{ $admin->admin_name }}" readonly>
                            </div>

                            @elseif ($studentacc)
                            <div class="mb-3">
                                <label for="proposedBy" class="form-label">Proposed By</label>
                                <input type="text" class="form-control" id="proposedBy"
                                    name="proposedBy" value="{{ $studentacc->student_firstname }}" readonly>
                            </div>
                            @endif
                            <!-- Proposed By -->

                            <!-- Submission Date -->
                            <div class="mb-3">
                                <label for="submissionDate" class="form-label">Submission Date</label>
                                <input type="date" class="form-control" id="submissionDate"
                                    name="submissionDate" value="<?php date_default_timezone_set('Asia/Hong_Kong'); echo date('Y-m-d'); ?>" readonly>
                            </div>
                            <!-- Additional Notes -->
                            <div class="mb-3">
                                <label for="additionalNotes" class="form-label">Additional Notes</label>
                                <textarea class="form-control" id="additionalNotes" name="additionalNotes" rows="3" value="{{ $budget->additional_notes }}"
                                    placeholder="Enter any additional details"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary"
                    onclick="updateBudgetProposal('UpdatebudgetProposalForm')">Submit Proposal</button>

            </div>
        </div>
    </div>
</div>
{{-- Modals --}}
