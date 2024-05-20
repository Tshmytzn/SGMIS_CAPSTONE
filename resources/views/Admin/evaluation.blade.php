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
                <div class="container-xl" id="eval_list">

                    {{-- <div class="empty" id="empty_eval">
                        <div class="empty-img"><img src="./static/illustrations/reading.svg" height="128" alt="">
                        </div>
                        <p class="empty-title">No Evaluation Forms found</p>
                        <p class="empty-subtitle text-muted">
                          Try adding one to let students evaluate the event.
                        </p>
                        <div class="empty-action">
                          <button  data-bs-toggle="modal" data-bs-target="#createevaluation" class="btn btn-primary">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                            Add Evaluation Form
                          </button>
                        </div>
                      </div> --}}

                    {{-- <div class="page page-center" id="loading-eval">
                        <div class="container container-slim py-4">
                          <div class="text-center">
                            <div class="mb-3">
                              <a href="." class="navbar-brand navbar-brand-autodark"><img src="./static/logoicon.png" height="36" alt=""></a>
                            </div>
                            <div class="text-muted mb-3">Loading Evaluation Forms</div>
                            <div class="progress progress-sm">
                              <div class="progress-bar progress-bar-indeterminate"></div>
                            </div>
                          </div>
                        </div>
                      </div> --}}

                       

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
                            <form class="row g-3" id="createeval" method="POST" >
                                @csrf
                                <div class="row g-2">
                                    <div class="col-12">
                                        @php
                                         $currentDate = Carbon\Carbon::now();

                                         $event = App\Models\SchoolEvents::where('event_start', '>', $currentDate)->get();
                                        @endphp
                                        <label for="firstname" class="form-label">Associated Event</label>
                                        <select name="event_id"  class="form-select" onchange="DisplayAddForm()">
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
                                    <div class="col-12 mt-4" id="eval_name_div" style="display: none">
                                        <label for="evalname" class="form-label">Evaluation Name <span class="text-danger" style="display: none" id="eval_name_e">(Please fill this field)</span></label>
                                        <input type="text" class="form-control" name="evalname" id="evalname"
                                            placeholder="Evaluation Name">
                                    </div>
                                    <div class="col-12" id="eval_description_div" style="display: none">
                                        <label for="evaldesc" class="form-label">Evaluation Description  <span class="text-danger" style="display: none" id="eval_description_e">(Please fill this field)</span></label>
                                        <textarea class="form-control" name="evaldesc" id="evaldesc" placeholder="Add Short Description here..."
                                            cols="10" rows="2"></textarea>
                                    </div>
               
                                </div>
                            </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" id="closeEvalForm" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" onclick="VerifyCreateEvalForm('{{ route('createEvalForm') }}', '{{ route('getEvalForm') }}', '{{ route('ViewEvaluations') }}', '{{ asset('event_images') }}')">Save</button>
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
