<!doctype html>

<html lang="en">

@include('Admin.components.header', ['title' => 'Budgeting Details'])
@include('Admin.components.adminstyle')
<style>
    .input-error {
    border: 2px solid red; /* Adjust the border thickness and color */
}

</style>
<body>
    <script src="{{ asset('./dist/js/demo-theme.min.js?1684106062') }}"></script>

    <div class="page">

        @include('Admin.components.nav', ['active' => 'Budgetingdetails'])

        <div class="page-wrapper">

            <!-- Page header -->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">

                            <!-- Page pre-title -->
                            <div class="page-pretitle">
                                Budgeting Details
                            </div>
                            <h2 class="page-title">
                                {{ $budget->title }}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="card">
                        <div class="card-header">
                            <div class="container mx-3" style="margin-bottom: -1%;">
                                <div class="row">
                                    <div class="col d-flex justify-content-between mt-2">
                                        <h3 style="margin-left: -3%">More Information</h3>
                                        <div title="Edit Event"
                                            style="border: none; background: none; margin-right:1%; cursor: pointer;"
                                            data-bs-toggle="modal" data-bs-target="#budgetProposalUpdate"
                                            onclick="openEditModal({{ $budget->id }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                <path
                                                    d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                <path d="M16 5l3 3" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="datagrid">


                                <div class="datagrid-item">
                                    <div class="datagrid-title">Associated Event</div>
                                    <div class="datagrid-content">
                                        <!-- Display event name or fallback if event is not found -->
                                        {{ $event ? $event->event_name : 'No associated event found' }}
                                    </div>
                                </div>


                                <!-- Project Proponent -->
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Project Proponent</div>
                                    <div class="datagrid-content">{{ $budget->project_proponent }}</div>
                                </div>

                                <!-- Project Participant -->
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Project Participant</div>
                                    <div class="datagrid-content">{{ $budget->project_participant }}</div>
                                </div>

                                <!-- Budget Period Start -->
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Budget Period Start</div>
                                    <div class="datagrid-content">{{ $budget->budget_period_start }}</div>
                                </div>

                                <!-- Budget Period End -->
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Budget Period End</div>
                                    <div class="datagrid-content">{{ $budget->budget_period_end }}</div>
                                </div>

                                <!-- Funding Source -->
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Funding Source</div>
                                    <div class="datagrid-content">{{ $budget->funding_source }}</div>
                                </div>

                                <!-- Proposed By -->
                                {{-- <div class="datagrid-item">
                                        <div class="datagrid-title">Proposed By</div>
                                        <div class="datagrid-content">{{ $budget->proposed_by }}</div>
                                    </div> --}}

                                <!-- Submission Date -->
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Submission Date</div>
                                    <div class="datagrid-content">{{ $budget->submission_date }}</div>
                                </div>

                                <!-- Additional Notes -->
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Additional Notes</div>
                                    <div class="datagrid-content">
                                        {{ $budget->additional_notes ?? 'No additional notes provided' }}</div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <hr>

                    <div class="row row-deck row-cards">
                        <div class="card">
                            <div class="card-header">
                                <div class="container mx-3" style="margin-bottom: -1%;">
                                    <div class="row">
                                        <div class="col d-flex justify-content-between mt-2">
                                            <h3 style="margin-left: -3%">Committees and Performers</h3>
                                            <div title="Edit Committtee" id="view1" style="border: none; background: none; margin-right:1%; cursor: pointer;" onclick="loadEditCommittee()">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                    <path
                                                        d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                    <path d="M16 5l3 3" />
                                                </svg>
                                            </div>
                                            <div title="Edit Committtee" id="view2" style="border: none; background: none; margin-right:1%; cursor: pointer; display:none" onclick="loadEditCommittee2()">
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="card-body">
                                <form id="committeeForm">
                                    @csrf
                                    <div id="committeeTable" class="row border border-success p-2 rounded mb-2">
                                        <div class="col-4 text-center">Committee</div>
                                        <div class="col-4 text-center">Members</div>
                                        <div class="col-4 text-center">Action</div>
                                        <div class="col-12 mt-2">
                                            <form action="" method="POST" id="addComitteeForm">
                                                @csrf
                                                <input type="text" name='budget_id' value="{{ $budget->id }}" hidden>
                                            <div id="committeeTable2">
                                            
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                        <div id="formBtn">
                                            <button type="button" class="btn btn-primary w-100" id="addCommitteeRow" onclick="addCommentteeField()">Add Committee</button>
                                            <button type="button" style="background-color: #0065a0 !important; color: #ffffff" onclick="addComitteeData('committeeForm','{{route('budgetingProcess')}}','add')" class="btn w-100 mt-2">Save Committee</button>
                                        </div>
                                        <div id="formBtn2" style="display: none">
                                            <button type="button" class="btn btn-primary w-100" id="" onclick="updateCommentteeField()">Update Committee</button>
                                        </div>
                                        </div>
                                </form>
                            </div>
                        </div>
                        
                        <a href="/Budgeting/Expense/{{ $budget->id }}">
                            <button class="btn btn-primary w-100">Proceed to Expense Setup & Additional
                                Entries</button>
                        </a>
                    </div>
                    <form action="" method="POST" id="getCommetteeDataForm" hidden>
                        @csrf
                        <input type="text" name="budget_id" id="" value="{{ $budget->id }}">
                    </form>
                    <form action="" method="POST" id="randomForm" hidden>
                        @csrf
                        <input type="text" name="data_id" id="data_id" value="">
                    </form>
                </div>
            </div>
        </div>

        @include('Admin.components.footer')

    </div>
    </div>

    @include('Admin.components.scripts')
    @include('Admin.components.budgetdetailsscripts')
    @include('Admin.components.budgetmodals')
</body>

</html>