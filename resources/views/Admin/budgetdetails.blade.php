<!doctype html>

<html lang="en">

@include('Admin.components.header', ['title' => 'Budgeting Details'])
@include('Admin.components.adminstyle')

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
                                            data-bs-toggle="modal" data-bs-target="#budgetProposalUpdate" onclick="openEditModal({{ $budget->id }})">
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
                                            <div title="Edit Committtee"
                                                style="border: none; background: none; margin-right:1%; cursor: pointer;"
                                                data-bs-toggle="modal" data-bs-target="#editEventDetails">
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
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="card-body">
                                <form id="committeeForm">
                                    @csrf
                                    <input type="hidden" name="budget_id" value="{{ $budget->id }}">
                                    <div class="mb-3">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Committee</th>
                                                    <th>Person-in-Charge</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="committeeTable">

                                                @foreach ($committees as $index => $committee)
                                                    <tr>
                                                        <td>
                                                            <input type="hidden"
                                                                name="committees[{{ $index }}][id]"
                                                                value="{{ $committee->id }}"> <!-- Hidden ID field -->
                                                            <input type="text" class="form-control"
                                                                name="committees[{{ $index }}][name]"
                                                                placeholder="Enter committee name"
                                                                value="{{ $committee->name }}" required>
                                                        </td>
                                                        <td>
                                                            <div class="person-in-charge-list">
                                                                @foreach ($committee->person_in_charge as $personIndex => $person)
                                                                    <input type="text"
                                                                        class="form-control mb-2 person-in-charge-name"
                                                                        name="committees[{{ $index }}][persons_in_charge][]"
                                                                        placeholder="Enter head(s)"
                                                                        value="{{ $person }}" required>
                                                                @endforeach
                                                            </div>
                                                            <div class="d-flex justify-content-between">
                                                                <button type="button" id="addpersonbtn"
                                                                    class="btn btn-primary add-person-in-charge-btn col-6">Add
                                                                    Another Person-in-Charge</button>
                                                                &nbsp;
                                                                <button type="button" id="removepersonbtn"
                                                                    class="btn btn-danger remove-person-in-charge-btn col-6">Remove
                                                                    Person-in-Charge</button>
                                                            </div>
                                                        </td>
                                                        <td class="d-flex justify-content-center">
                                                            <button type="button" id="removecommitteebtn"
                                                                class="btn btn-danger remove-committee-btn col-12">Remove
                                                                Committee</button>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                        <button type="button" class="btn btn-primary w-100" id="addCommitteeRow">Add
                                            Committee</button>
                                        <button type="button" id="savebtn"
                                            style="background-color: #0065a0 !important; color: #ffffff"
                                            onclick="submitForm()" class="btn w-100 mt-2">Save Committee</button>
                                    </div>
                                </form>
                            </div>
                        </div>


                        {{-- Add committees card --}}
                        <div class="card">
                            <div class="card-header">

                                <div class="container mx-3" style="margin-bottom: -1%;">
                                    <div class="row">
                                        <div class="col d-flex justify-content-between mt-2">
                                            <h3 style="margin-left: -3%">Committee Members</h3>
                                            <div title="Add Members"
                                                style="border: none; background: none; margin-right:1%; cursor: pointer;"
                                                data-bs-toggle="modal" data-bs-target="#editEventDetails">
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form id="committeemembers">
                                    @csrf
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Committee Name</th>
                                                <th>Add Member</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="committeeMembersTable">
                                            @foreach ($committees as $committee)
                                                <tr data-committee-id="{{ $committee->id }}">
                                                    <td>{{ $committee->name }}</td>
                                                    <td>
                                                        <div class="member-inputs">
                                                            <input type="text" class="form-control mb-2"
                                                                placeholder="Enter member name"
                                                                name="members[{{ $committee->id }}][]">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary add-member-btn"
                                                            data-committee-id="{{ $committee->id }}">Add Member</button>
                                                        <button type="button" class="btn btn-danger remove-member-btn"
                                                            data-committee-id="{{ $committee->id }}">Remove Member</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <button type="button" class="btn w-100"
                                        style="background-color: #0065a0 !important; color: #ffffff"
                                        onclick="submitCommitteeMembers()">Save Members</button>
                                </form>
                            </div>


                            </div>
                        </div>


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
