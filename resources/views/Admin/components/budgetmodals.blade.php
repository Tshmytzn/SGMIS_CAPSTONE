{{-- Modals --}}
<div class="modal fade" id="budgetProposalUpdate" tabindex="-1" aria-labelledby="budgetProposalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" id="" action="{{route('updatebudgetinginfo')}}">
            <div class="modal-header">
                <h5 class="modal-title" id="budgetProposalModalLabel">Update Budget Proposal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                    @csrf
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" id="modalTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="proposal-details-tab" data-bs-toggle="tab" href="#proposal-details" role="tab" aria-controls="proposal-details" aria-selected="true">Proposal Details</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="submission-info-tab" data-bs-toggle="tab" href="#submission-info" role="tab" aria-controls="submission-info" aria-selected="false">Submission Information</a>
                        </li>
                    </ul>
                    <!-- Tab content -->
                    <div class="tab-content mt-3">
                        <!-- Proposal Details -->
                        <div class="tab-pane fade show active" id="proposal-details" role="tabpanel" aria-labelledby="proposal-details-tab">
                            <!-- Proposal Title -->
                            <div class="mb-3">
                                <input type="text" name="id" value="{{$budget->id}}" hidden>
                                <label for="proposalTitle" class="form-label">Proposal Title</label>
                                <input type="text" class="form-control" id="proposalTitle" name="proposalTitle" value="{{ $budget->title }}" placeholder="Enter proposal title" required>
                            </div>
                            <!-- Event Related -->
                            <div class="mb-3">
                                <div class="col-12">
                                    <label for="budgetEvent" class="form-label">Associated Event</label>
                                    <select name="budgetEvent" class="form-select" id="budgetEvent">
                                        <option selected disabled>Select Event</option>
                                        @php
                                            $currentDate = date('Y-m-d');
                                            $event = App\Models\SchoolEvents::where('event_start', '>', $currentDate)->get();
                                        @endphp
                                        @foreach ($event as $eve)
                                            <option value="{{ $eve->event_id }}" {{ $eve->event_id === $budget->event_id ? 'selected' : '' }}>{{ $eve->event_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Project Proponent -->
                                <div class="col-6 mb-3">
                                    <label for="projectproponent" class="form-label">Project Proponent</label>
                                    <input type="text" class="form-control" id="projectproponent" name="projectproponent" value="{{ $budget->project_proponent }}" placeholder="Enter project proponent" required>
                                </div>
                                <!-- Project Participant -->
                                <div class="col-6 mb-3">
                                    <label for="projectparticipant" class="form-label">Project Participant</label>
                                    <input type="text" class="form-control" id="projectparticipant" name="projectparticipant" value="{{ $budget->project_participant }}" placeholder="Enter project participant" required>
                                </div>
                            </div>
                            <!-- Budget Period -->
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label for="budgetPeriodStart" class="form-label">Budget Period Start</label>
                                    <input type="datetime-local" class="form-control" id="budgetPeriodStart" name="budgetPeriodStart" value="{{ $budget->budget_period_start->format('Y-m-d\TH:i') }}" required>
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="budgetPeriodEnd" class="form-label">Budget Period End</label>
                                    <input type="datetime-local" class="form-control" id="budgetPeriodEnd" name="budgetPeriodEnd" value="{{ $budget->budget_period_end->format('Y-m-d\TH:i') }}" required>
                                </div>
                            </div>
                            <!-- Allocated Funds -->
                            <div class="mb-3">
                                <label for="fundingSource" class="form-label">Funding Source</label>
                                <input type="text" class="form-control" id="fundingSource" name="fundingSource" value="{{ $budget->funding_source }}" placeholder="Enter funding source" required>
                            </div>
                        </div>

                        <!-- Submission Information -->
                        <div class="tab-pane fade" id="submission-info" role="tabpanel" aria-labelledby="submission-info-tab">
                            @php
                                $admin = App\Models\Admin::where('admin_id', session('admin_id'))->first();
                            @endphp
                            <!-- Proposed By -->
                            <div class="mb-3">
                                <label for="proposedBy" class="form-label">Proposed By</label>
                                <input type="text" class="form-control" id="proposedBy" name="proposedBy" value="{{ $admin->admin_name }}" readonly>
                            </div>
                            <!-- Submission Date -->
                            <div class="mb-3">
                                <label for="submissionDate" class="form-label">Submission Date</label>
                                <input type="date" class="form-control" id="submissionDate" name="submissionDate" value="{{ date('Y-m-d') }}" readonly>
                            </div>
                            <!-- Additional Notes -->
                            <div class="mb-3">
                                <label for="additionalNotes" class="form-label">Additional Notes</label>
                                <textarea class="form-control" id="additionalNotes" name="additionalNotes" rows="3" placeholder="Enter any additional details">{{ $budget->additional_notes }}</textarea>
                            </div>
                        </div>
                    </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" >Submit Proposal</button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- Modals --}}
