<!doctype html>

<html lang="en">

@include('Admin.components.header', ['title' => 'Election'])
@include('Admin.components.adminstyle')
<body>
    <script src="{{ asset('./dist/js/demo-theme.min.js?1684106062') }}"></script>

    <div class="page">

        @include('Admin.components.nav', ['active' => 'Election'])

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
                                Election
                            </h2>
                        </div>

                        <div class="col-auto ms-auto d-print-none">
                            <div class="d-flex">
                                <div class="me-3">
                                    <div class="input-icon">
                                        <input type="text" value="" class="form-control" placeholder="Search…">
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
                                        </span>
                                    </div>
                                </div>

                                <button class="btn" style="background-color: #DF7026; color: white;"
                                    data-bs-toggle="modal" data-bs-target="#createelection">Create New Election
                                </button>

                            </div>
                        </div>


                    </div>
                </div>
            </div>



            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-deck row-cards">

                        <div class="col-md-6 col-lg-3">
                            <div class="card card-stacked">
                              <div class="card-status-start bg-success"></div>
                              <div class="ribbon bg-green">Ongoing</div>
                                <div class="card-body">
                                    <h3 class="card-title"> Elections SY-2024 </h3>
                                    <hr class="my-4 mt-1">

                                    <p class="text-secondary">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                        Architecto at consectetur culpa ducimus eum fuga fugiat, ipsa iusto, modi
                                        nostrum recusandae reiciendis saepe.</p>
                                </div>
                                <div class="card-footer card-footer-transparent" >
                                    <a href="{{route('Editelection')}}"class="btn btn-outline-green"
                                        style="display: flex; align-items: center; justify-content: center;">
                                        Update Details <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-edit"
                                            style="margin-left: 8px;">

                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                            <path
                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                            <path d="M16 5l3 3" />
                                        </svg></a>
                                </div>
                            </div>
                        </div>
                        
                    </div>


                    {{-- This is a no search results illustration --}}
                    {{-- <div class="empty">
                    <div class="empty-img"><img src="./static/illustrations/undraw_voting_nvu7.svg" height="128" alt="">
                    </div>
                    <p class="empty-title">No Election Results Available</p>
                    <p class="empty-subtitle text-secondary">
                      Try adjusting your filters or search criteria to find specific election results or candidates.
                    </p>
                  </div> --}}

                </div>
            </div>
        </div>

        @include('Admin.components.footer')

        {{-- Modal --}}


        {{-- Create Election Modal --}}
        <div class="modal modal-blur fade" id="createelection" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header text-white" style="background-color: #3E8A34;">
                        <h5 class="modal-title" id="staticBackdropLabel">Create Election Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3" id="createelect" method="POST">
                            @csrf
                            <div class="row g-2">
                                <div class="col-12">

                                    <div class="mb-2">
                                        <label for="firstname" class="form-label">Election Title</label>
                                        <input name="election_name" class="form-control" id="election_name" placeholder="Student Government Elections SY-0000">
                                    </div>

                                    <div class="mb-2">
                                        <label for="election_desc" class="form-label">Election Description(optional)</label>
                                        <textarea name="election_desc" id="election_desc" class="form-control"
                                            placeholder="Enter brief overview of the election, and other notes..."></textarea>
                                    </div>

                                    <hr class="my-4">
                                    <h3 for="Voting Period">Voting Period</h3>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="voting_start_date" class="form-label">Start Date</label>
                                            <input type="datetime-local" name="voting_start_date"
                                                id="voting_start_date" class="form-control">
                                        </div>
                                        <div class="col-6">
                                            <label for="voting_end_date" class="form-label">End Date</label>
                                            <input type="datetime-local" name="voting_end_date" id="voting_end_date"
                                                class="form-control">
                                        </div>
                                    </div>

                                </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" id="closeEvalForm" class="btn btn-danger"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary"
                            onclick="dynamicFuction('createelect','{{route('createElection')}}')">Save</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- Create Election modal --}}

        {{-- Modal --}}

    </div>
    </div>


    @include('Admin.components.scripts')
    @include('admin.components.electionscript')
</body>

</html>
