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
                            <div class="card">
                                <div class="ribbon bg-green">ONGOING</div>
                                <div class="img-responsive img-responsive-21x9 card-img-top"
                                    style="background-image: url({{ asset('./static/photos/beautiful-blonde-woman-relaxing-with-a-can-of-coke-on-a-tree-stump-by-the-beach.jpg') }})">
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">University Week Evaluation Form</h3>
                                    <p class="text-muted">Provide your feedback on CHMSU University Week events and
                                        activities. Your input will help us improve future events.
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
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#vieweval"
                                        class="card-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-eye-check">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                            <path
                                                d="M11.102 17.957c-3.204 -.307 -5.904 -2.294 -8.102 -5.957c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6a19.5 19.5 0 0 1 -.663 1.032" />
                                            <path d="M15 19l2 2l4 -4" />
                                        </svg>
                                        &nbsp; View</a>
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
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#vieweval"
                                        class="card-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-eye-check">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                            <path
                                                d="M11.102 17.957c-3.204 -.307 -5.904 -2.294 -8.102 -5.957c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6a19.5 19.5 0 0 1 -.663 1.032" />
                                            <path d="M15 19l2 2l4 -4" />
                                        </svg>
                                        &nbsp; View</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-3">
                            <div class="card">
                                <div class="ribbon bg-red">EVENT ENDED</div>
                                <div class="img-responsive img-responsive-21x9 card-img-top"
                                    style="background-image: url({{ asset('./static/sports.png') }})"></div>
                                <div class="card-body">
                                    <h3 class="card-title">Sports Day Evaluation Form
                                    </h3>
                                    <p class="text-muted">Evaluate Sports Day by commenting on the activities, event
                                        management, and enjoyment level.
                                    </p>
                                </div>
                                <div class="d-flex">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#editeval"
                                        class="card-btn">
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
                                        &nbsp; Edit
                                    </a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#vieweval"
                                        class="card-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-eye-check">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                            <path
                                                d="M11.102 17.957c-3.204 -.307 -5.904 -2.294 -8.102 -5.957c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6a19.5 19.5 0 0 1 -.663 1.032" />
                                            <path d="M15 19l2 2l4 -4" />
                                        </svg>
                                        &nbsp; View</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-3">
                            <div class="card">
                                <div class="ribbon bg-red">EVENT ENDED</div>
                                <div class="img-responsive img-responsive-21x9 card-img-top"
                                    style="background-image: url({{ asset('./static/carfest.jpg') }})"></div>
                                <div class="card-body">
                                    <h3 class="card-title">Car Show Evaluation Form</h3>
                                    <p class="text-muted">Share your feedback on the Car Show, including the variety
                                        and quality of vehicles, event organization, and overall experience.
                                    </p>
                                </div>
                                <div class="d-flex">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#editeval"
                                        class="card-btn">
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
                                        &nbsp; Edit
                                    </a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#vieweval"
                                        class="card-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-eye-check">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                            <path
                                                d="M11.102 17.957c-3.204 -.307 -5.904 -2.294 -8.102 -5.957c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6a19.5 19.5 0 0 1 -.663 1.032" />
                                            <path d="M15 19l2 2l4 -4" />
                                        </svg>
                                        &nbsp; View</a>
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
                                    <div class="col-11">
                                        <label for="evalname" class="form-label">Evaluation Questions</label>
                                    </div>
                                    <div class="col-1" id="addQuestion">
                                        <span class="add-question-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-pencil-plus">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                                <path d="M13.5 6.5l4 4" />
                                                <path d="M16 19h6" />
                                                <path d="M19 16v6" />
                                            </svg>
                                        </span>
                                    </div>

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

            {{-- View Evaluation Modal --}}
            <div class="modal modal-blur fade" id="vieweval" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header text-white" style="background-color: #3E8A34;">
                            <h5 class="modal-title" id="staticBackdropLabel">View Evaluation Form</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="row g-3" id="createeval" method="POST" enctype="multipart/form-data">@csrf
                                <div class="row g-2">
                                    <div class="col-12">
                                        <label for="firstname" class="form-label">Associated Event</label>
                                        <select name="" class="form-select" id="">
                                            <option selected>Select Event</option>
                                            <option value="">event #1</option>
                                            <option value="">event #1</option>
                                            <option value="">event #1</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label for="evalname" class="form-label">Evaluation Name</label>
                                        <input type="text" class="form-control" name="viewevalname"
                                            id="viewevalname" placeholder="Evaluation Name">
                                    </div>
                                    <div class="col-12">
                                        <label for="evaldesc" class="form-label">Evaluation Description</label>
                                        <textarea class="form-control" name="viewevaldesc" id="viewevaldesc" placeholder="Add Short Description here..."
                                            cols="10" rows="2"></textarea>
                                    </div>
                                    <hr class="my-4 mt-3 mb-2">
                                    <div class="col-11">
                                        <label for="evalname" class="form-label">Evaluation Questions</label>
                                    </div>
                                    <input type="text" class="form-control" name="viewevalname" id="viewevalname"
                                        placeholder="Question #1">
                                    <input type="text" class="form-control" name="viewevalname" id="viewevalname"
                                        placeholder="Question #2">
                                    <input type="text" class="form-control" name="viewevalname" id="viewevalname"
                                        placeholder="Question #3">
                                    <input type="text" class="form-control" name="viewevalname" id="viewevalname"
                                        placeholder="Question #4">
                                    <input type="text" class="form-control" name="viewevalname" id="viewevalname"
                                        placeholder="Question #5">


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
            {{-- View Evaluation modal --}}
            {{-- Modal --}}


            @include('Admin.components.footer')

        </div>
    </div>


    @include('Admin.components.scripts')
    {{-- scripts --}}
    <script>
     var promptInstance;
     const addQuestionBtn = document.querySelector('.add-question-btn');
     const form = document.getElementById('createeval');
           
        document.addEventListener("DOMContentLoaded", function() {
          
            addQuestionBtn.addEventListener('click', function() {
              promptInstance = alertify.prompt()
                .setHeader('Select Scale for this Question')
                .setContent(`
                    <label for="select_scale">Scale Types</label>
                    <select onchange="selectedScale(this)" id="select_scale" class="form-control">
                        <option selected disabled>------Select One to proceed-------</option>
                        <option value="1">Likert Scale(1-5) Strongly Disagree-Strongly Agree</option>   
                        <option value="2">Rating Scale(1-5) Poor-Excellent</option>
                        <option value="3">Performance Scale(1-5) Needs Improvement-Excellent</option>
                        <option value="4">Close Ended (Yes/No)</option>  
                        <option value="5">Open Ended (Describe)</option> 
                    </select>
                `)
                .set('onok', function() {}) 
                .set('oncancel', function() {}) 
                .set('closable', false)
                .show();
             
            });
        });
        function selectedScale(el){
                  var selectedValue = el.value;
                  console.log('Selected ID:', selectedValue);
                  if (promptInstance) {
                  promptInstance.close(); 
                  }
                const questionInputs = form.querySelectorAll('.question-input');
                const lastQuestionInput = questionInputs[questionInputs.length - 1];
                const newQuestionInput = document.createElement('input');
                const q_label = document.createElement('label');
                q_label.setAttribute('for', 'eval_q' + questionInputs.length );
                q_label.textContent = 'hgasdasd';
                newQuestionInput.setAttribute('type', 'text');
                newQuestionInput.setAttribute('class', 'form-control question-input');
                newQuestionInput.setAttribute('name', 'evalname[]');
                newQuestionInput.setAttribute('id', 'eval_q' + questionInputs.length );
                newQuestionInput.setAttribute('placeholder', 'Question ' + (questionInputs.length + 1));
                form.appendChild(q_label);
                form.appendChild(newQuestionInput); 
               }
    </script>

    {{-- scripts --}}

</body>

</html>
