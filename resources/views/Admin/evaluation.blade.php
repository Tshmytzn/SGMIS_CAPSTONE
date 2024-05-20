<!doctype html>

<html lang="en">

@include('Admin.components.header', ['title' => 'Evaluation'])

<body>
    <script src="{{ asset('./dist/js/demo-theme.min.js?1684106062') }}"></script>
    <script src="{{ asset('./js_components/evaluation.js') }}"></script>
    <div class="page">

        @include('Admin.components.nav', ['active' => 'Evaluation'])

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
                                Evaluations
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
                                    data-bs-toggle="modal" data-bs-target="#createevaluation">Create Evaluation
                                    Form</button>

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
                            <a href="{{ route('ViewEvaluations') }}" class="card-link">
                            <div class="card">
                                <div class="ribbon bg-green">ONGOING</div>
                                <div class="img-responsive img-responsive-21x9 card-img-top";
                                href="{{ route('ViewEvaluations') }}";
                                style="background-image: url({{ asset('./static/photos/beautiful-blonde-woman-relaxing-with-a-can-of-coke-on-a-tree-stump-by-the-beach.jpg') }})">
                            </div>                            
                                <div class="card-body" href="{{ route('ViewEvaluations') }}" >
                                    <h3 class="card-title">University Week Evaluation Form</h3>
                                    <p class="text-muted">Provide your feedback on CHMSU University Week events and
                                        activities. Your input will help us improve future events.
                                    </p>
                                </div>
                            </a>
                                <div class="d-flex">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#editeval"
                                        class="card-btn">
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
                                        &nbsp; Edit
                                    </a>
                                    <a href="#"
                                        class="card-btn">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                        &nbsp; Delete</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-3">
                            <div class="card">
                                <div class="ribbon bg-red">EVENT ENDED</div>
                                <div class="img-responsive img-responsive-21x9 card-img-top"
                                    style="background-image: url({{ asset('./static/cultural.jpg') }})"></div>
                                <div class="card-body">
                                    <h3 class="card-title">Cultural Festival Evaluation Form
                                    </h3>
                                    <p class="text-muted">Provide your thoughts on the Cultural Festival, focusing on
                                        performances, exhibits, and event coordination.
                                    </p>
                                </div>
                                <div class="d-flex">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#editeval"
                                        class="card-btn">
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
                                        &nbsp; Edit
                                    </a>
                                    <a href="#" 
                                        class="card-btn">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                        &nbsp; Delete</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- Modal --}}
            {{-- Create Evaluation Modal --}}
            <div class="modal modal-blur fade" id="createevaluation" data-bs-backdrop="static"
                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header text-white" style="background-color: #3E8A34;">
                            <h5 class="modal-title" id="staticBackdropLabel">Create Evaluation Form</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="row g-3" id="createeval" method="POST" enctype="multipart/form-data">@csrf
                                <div class="row g-2">
                                    <div class="col-12">
                                        @php
                                            $event = App\Models\SchoolEvents::all();
                                        @endphp
                                        <label for="firstname" class="form-label">Associated Event</label>
                                        <select name="" class="form-select" id="">
                                            @if (count($event) > 0)
                                                <option selected disables>--------Select Event--------</option>
                                                @foreach ($event as $ev)
                                                    <option value="{{ $ev->event_id }}">{{ $ev->event_name }}</option>
                                                @endforeach
                                            @else
                                                <option selected disables>No Event Created Yet</option>
                                            @endif



                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label for="evalname" class="form-label">Evaluation Name</label>
                                        <input type="text" class="form-control" name="evalname" id="evalname"
                                            placeholder="Evaluation Name">
                                    </div>
                                    <div class="col-12">
                                        <label for="evaldesc" class="form-label">Evaluation Description</label>
                                        <textarea class="form-control" name="evaldesc" id="evaldesc" placeholder="Add Short Description here..."
                                            cols="10" rows="2"></textarea>
                                    </div>
                                    <hr class="my-4 mt-3 mb-2">
                                   
                                 
                                </div>
                            </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" onclick="()">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Create Evaluation modal --}}

         
            {{-- Modal --}}


            @include('Admin.components.footer')

        </div>
    </div>


    @include('Admin.components.scripts')


</body>

</html>
