<!doctype html>

<html lang="en">

@include('Admin.components.header', ['title' => 'Add Election Details'])
@include('Admin.components.adminstyle')
<style>
    .fade-card {
        opacity: 0;
        transform: scale(0.5);
        /* Make it slightly smaller */
        transition: opacity 0.5s ease, transform 0.5s ease;
    }

    /* Pop-up animation */
    .fade-card.show {
        opacity: 1;
        transform: scale(1);
    }
</style>

<body>
    <script src="{{ asset('./dist/js/demo-theme.min.js?1684106062') }}"></script>

    <div class="page">

        @include('Admin.components.nav', ['active' => ''])

        <div class="page-wrapper">

            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <!-- Page pre-title -->
                            <div class="page-pretitle">
                                Overview
                            </div>
                            <h2 class="page-title">
                                Election Details
                            </h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-body">
                <div class="container-xl">
                    @include('Admin.components.lineLoading', ['loadID' => 'formload'])
                    <form id="updateElectionForm" method="post">
                            @csrf
                    <div class="row bg-white p-4" id="formElect" style="display: none">
                        <div class="col-12 col-sm-6">
                            <input type="text" name="method" id="" value="update" hidden>
                            <input type="text" name="electID" id="electID" hidden>
                            <label for="election_name" class="form-label">Election Title</label>
                            <input name="election_name" class="form-control" id="election_name"
                                value="Student Government Elections SY-0000"
                                placeholder="Student Government Elections SY-0000">
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="election_desc" class="form-label">Election Description (optional)</label>
                            <textarea name="election_desc" id="election_desc" class="form-control"
                                placeholder="Enter brief overview of the election, and other notes...">Current election description...</textarea>
                        </div>

                        <hr class="my-4">
                        <h3 for="Voting Period">Voting Period</h3>

                        <div class="col-12 col-sm-6">
                            <label for="voting_start_date" class="form-label">Start Date</label>
                            <input type="datetime-local" name="voting_start_date" id="voting_start_date"
                                class="form-control" value="2024-09-01T09:00">
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="voting_end_date" class="form-label">End Date</label>
                            <input type="datetime-local" name="voting_end_date" id="voting_end_date"
                                class="form-control" value="2024-09-07T17:00">
                        </div>

                        <div class="col-12 col-sm-6 mt-2">
                            <button type="button" class="col-12 btn btn-primary" onclick="dynamicFunction('updateElectionForm','{{ route('createElection') }}')">Update</button>
                        </div>
                        <div class="col-12 col-sm-6 mt-2">
                            <button type="button" class="col-12 btn btn-primary bg-yellow" onclick="dynamicFunction('publishForm','{{ route('createElection') }}')">Publish</button>
                        </div>
                        </form>
                        <hr class="my-4">
                        <div class="col-12 d-flex justify-content-between align-items-center">
                            <h3 id="PartyDetails">Participating Party</h3>
                            <div class="col-auto ms-auto d-print-none">
                                <div class="d-flex">
                                    <a href="" data-bs-toggle="modal" data-bs-target="#createparty">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                            <path
                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                            <path d="M16 5l3 3" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @include('Admin.components.lineLoading', ['loadID' => 'cardload'])
                        <div class="row row-cards" id="cards">



                        </div>

                    </div>

                </div>
            </div>
            <form action="" id="publishForm" hidden>
                <input type="text" name="method" value="update">
                <input type="text" name="status" value="1">
                <input type="text" name="elect_id" id="elect_idS">
            </form>
            <form action="" id="removePartyForm" hidden>
                <input type="text" name="method" value="delete">
                <input type="text" name="party_id" id="party_id">
            </form>

            {{-- Update Party Modal --}}
            <div class="modal modal-blur fade" id="updateparty" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header text-white" style="background-color: #3E8A34;">
                            <h5 class="modal-title" id="staticBackdropLabel">Update Party Form</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @include('Admin.components.lineLoading', ['loadID' => 'modalload'])
                            <form class="row g-3" id="updatepartyform" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row g-2">
                                    <div class="col-12">

                                        <div class="mb-2">
                                            <label for="party" class="form-label">Party Title</label>
                                            <input type="text" id="party_id_update" name="party_id_update" hidden>
                                            <input type="text" name="method" id="" value="update"
                                                hidden>
                                            <input name="party_name_update" class="form-control"
                                                id="party_name_update" placeholder="Kasanag Party">
                                        </div>

                                        <div class="mb-2">
                                            <label for="party_desc" class="form-label">Party Description
                                            </label>
                                            <textarea name="party_desc_update" id="party_desc_update" class="form-control"
                                                placeholder="Enter brief description of the party..."></textarea>
                                        </div>

                                        <div class="mb-2">
                                            <label for="party_image" class="form-label">Party Image </label>
                                            <div class="img-responsive img-responsive-21x9 card-img-top"
                                                id="party_image_update1"></div>
                                            <br>
                                            <input type="file" name="party_image_update" id="party_image_update"
                                                class="form-control" accept="image/*">
                                        </div>

                                    </div>

                            </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" id="closeEvalForm" class="btn btn-danger"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary"
                                onclick="dynamicFunction('updatepartyform','{{ route('party') }}')">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Update Party modal --}}



            @include('Admin.components.footer')

        </div>
    </div>
    {{-- Create Party Modal --}}
    <div class="modal modal-blur fade" id="createparty" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #3E8A34;">
                    <h5 class="modal-title" id="staticBackdropLabel">Create Party Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" id="createpartyForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-2">
                            <div class="col-12">

                                <div class="mb-2">
                                    <label for="party" class="form-label">Party Title</label>
                                    <input type="text" id="elect_id" name="elect_id" hidden>
                                    <input type="text" name="method" id="" value="add" hidden>
                                    <input name="party_name" class="form-control" id="party_name"
                                        placeholder="Kasanag Party">
                                </div>

                                <div class="mb-2">
                                    <label for="party_desc" class="form-label">Party Description
                                    </label>
                                    <textarea name="party_desc" id="party_desc" class="form-control"
                                        placeholder="Enter brief description of the party..."></textarea>
                                </div>

                                <div class="mb-2">
                                    <label for="party_image" class="form-label">Party Image </label>
                                    <input type="file" name="party_image" id="party_image" class="form-control"
                                        accept="image/*">
                                </div>

                            </div>

                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" id="closeEvalForm" class="btn btn-danger"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary"
                        onclick="dynamicFunction('createpartyForm','{{ route('party') }}')">Save</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Create Party modal --}}
    @include('Admin.components.scripts')
    @include('admin.components.electiondscript')
</body>

</html>
