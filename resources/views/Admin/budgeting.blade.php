<!doctype html>

<html lang="en">

@include('Admin.components.header', ['title' => 'Budgeting'])

<body>
    <script src="{{ asset('./dist/js/demo-theme.min.js?1684106062') }}"></script>

    <div class="page">

        @include('Admin.components.nav', ['active' => 'Budgeting'])

        <div class="page-wrapper">

            <!-- Page header -->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">

                            <!-- Page pre-title -->
                            <div class="page-pretitle">
                                Overview
                            </div>
                            <h2 class="page-title">
                                Budgeting
                            </h2>
                        </div>

                        <div class="col-auto ms-auto d-print-none">
                            <div class="d-flex">
                                <div class="me-3">
                                    <div class="input-icon">
                                        {{-- <input type="text" value="" class="form-control" placeholder="Search…">
                                        <span class="input-icon-addon">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                                <path d="M21 21l-6 -6" />
                                            </svg>
                                        </span> --}}
                                    </div>
                                </div>
                                {{-- <button class="btn" style="background-color: #DF7026; color: white;"
                                    data-bs-toggle="modal" data-bs-target="#budgetProposalModal"> Create Budgeting
                                    Proposal</button> --}}

                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl d-flex flex-column justify-content-center" id="">
                    <div class="row row-deck row-cards" id="budgetingcard">
                    </div>
                </div>
            </div>

            <form id="deleteBudgetProposalForm" method="POST" action="" hidden>
                @csrf
                <input type="text" name="budget_id" id="budget_id">
                <input type="text" name="process" value="delete" id="process">

            </form>
            @include('Admin.components.footer')

            {{-- Modals --}}
            <div class="modal fade" id="budgetProposalModal" tabindex="-1" aria-labelledby="budgetProposalModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="budgetProposalModalLabel">Create Budget Proposal</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="budgetProposalForm"
                                onsubmit="event.preventDefault(); createBudgetProposal('budgetProposalForm');">
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
                                            href="#event-info" role="tab" aria-controls="submission-info"
                                            aria-selected="false">Event Information</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="submission-info-tab" data-bs-toggle="tab"
                                            href="#submission-info" role="tab" aria-controls="submission-info"
                                            aria-selected="false">Submission Information</a>
                                    </li>
                                </ul>
                                <!-- Tab content -->
                                <div class="tab-content mt-3">
                                    <!-- Proposal Details -->
                                    <div class="tab-pane fade show active" id="proposal-details" role="tabpanel"
                                        aria-labelledby="proposal-details-tab">
                                        <!-- Proposal Title -->
                                        <div class="row">
                                        <div class="mb-3 col-6">
                                            <label for="proposalTitle" class="form-label">Project Title</label>
                                            <input type="text" class="form-control" id="proposalTitle"
                                                name="proposalTitle" placeholder="Enter proposal title" required>
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label for="proposalTitle" class="form-label">Project Objective</label>
                                            <input type="text" class="form-control" id="proposalTitle"
                                                name="objective" placeholder="Enter proposal title" required>
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label for="proposalTitle" class="form-label">Project Theme</label>
                                            <input type="text" class="form-control" id="proposalTitle"
                                                name="theme" placeholder="Enter proposal title" required>
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label for="proposalTitle" class="form-label">Project Location</label>
                                            <input type="text" class="form-control" id="proposalTitle"
                                                name="location" placeholder="Enter proposal title" required>
                                        </div>
                                        </div>

                                        <!-- Event Related -->
                                        <div class="row">
                                            <div class="col-6 mb-3">
                                                <label for="projectparticipant" class="form-label">Aligned
                                                    SDG</label>
                                                <input type="text" class="form-control" id="projectparticipant"
                                                    name="projectparticipant" placeholder="Enter project participant"
                                                    required>
                                            </div>
                                            <!-- Project Proponent -->
                                            <div class="col-6 mb-3">
                                                <label for="projectproponent" class="form-label">Project
                                                    Proponent</label>
                                                <input type="text" class="form-control" id="projectproponent"
                                                    name="projectproponent" placeholder="Enter project proponent"
                                                    required>
                                            </div>
                                            <!-- Project Participant -->
                                            <div class="col-6 mb-3">
                                                <label for="projectparticipant" class="form-label">Budget
                                                    Allocated</label>
                                                <input type="text" class="form-control" id="projectparticipant"
                                                    name="allocated" placeholder="Enter project participant"
                                                    required>
                                            </div>
                                            <!-- Project Proponent -->
                                            <div class="col-6 mb-3">
                                                <label for="projectproponent" class="form-label">Contact
                                                    Person</label>
                                                <input type="text" class="form-control" id="projectproponent"
                                                    name="contactperson" placeholder="Enter project proponent"
                                                    required>
                                            </div>
                                        </div>
                                        <!-- Allocated Funds -->
                                        <div class="mb-3">
                                            <label for="fundingSource" class="form-label">Funding Source</label>
                                            <input type="text" class="form-control" id="fundingSource"
                                                placeholder="Enter funding source" name="fundingSource" required>
                                        </div>
                                    </div>


                                    <div class="tab-pane fade" id="event-info" role="tabpanel"
                                        aria-labelledby="submission-info-tab">

                                        <div class="row">
                                             <div class="col-12 mb-3">
                                                <label for="BudgetDays" class="form-label">Project Image</label>
                                                <input type="file" class="form-control" id="BudgetDays"
                                                    name="project_image" >
                                            </div>
                                            <div class="col-4 mb-3">
                                                <label for="budgetPeriodStart" class="form-label">Budget Period
                                                    Start</label>
                                                <input type="date" class="form-control" id="budgetPeriodStart"
                                                    name="budgetPeriodStart" >
                                            </div>
                                            <div class="col-4 mb-3">
                                                <label for="budgetPeriodEnd" class="form-label">Budget Period
                                                    End</label>
                                                <input type="date" class="form-control" id="budgetPeriodEnd"
                                                    name="budgetPeriodEnd" >
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
                                            <textarea class="form-control" id="additionalNotes" name="additionalNotes" rows="3"
                                                placeholder="Enter any additional details"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary"
                                onclick="createBudgetProposal('budgetProposalForm')">Submit Proposal</button>

                        </div>
                    </div>
                </div>
            </div>
            {{-- Modals --}}


        </div>
    </div>


    @include('Admin.components.scripts')
    @include('Admin.components.budgetingscripts')
</body>

</html>
