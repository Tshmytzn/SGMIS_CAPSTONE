<!doctype html>

<html lang="en">

@include('Student.components.head', ['title' => 'Evaluations'])
@include('Student.components.header')
@include('Student.components.nav')

<body>

    <div class="page">
        <div class="page-wrapper">
            <!-- Page header -->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <h2 class="page-title">
                                Event
                            </h2>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl" id="eval_list">
                    
                    <div class="col-md-12 col-lg-12 col-sm-12 " id="loading-eval">
                        <div class="container container-slim  d-flex justify-content-center flex-column">
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
                      </div>

                    {{-- <div class="col-md-6 col-lg-3">
                        <div class="card">
                            <div class="ribbon bg-green">Ongoing</div>
                            <div class="img-responsive img-responsive-21x9 card-img-top"
                                style="background-image: url({{asset('./static/photos/beautiful-blonde-woman-relaxing-with-a-can-of-coke-on-a-tree-stump-by-the-beach.jpg')}})">
                            </div>
                            <div class="card-body">
                                <h3 class="card-title">University Week Evaluation Form</h3>
                                <p class="text-muted">Provide your feedback on CHMSU University Week events and
                                    activities. Your input will help us improve future events.
                                </p>
                            </div>
                            <hr style="margin-top: -1%; margin-bottom: -1%">
                            <div class="card-footer btn btn-outline-primary btn-block" style="border: none">
                                Evaluate
                            </div>
                        </div>
                    </div> --}}

                </div>

            </div>
        </div>
    </div>
    </div>
    @include('Student.components.footer')
    @include('Student.components.scripts')
    <script>
        var getAllEvalRoute = "{{ route('getAllEvalForm') }}";
        var emptyPlaceholder = "{{ asset('./static/illustrations/reading.svg') }}";
        var evalForm = "{{ route('getEvalForm') }}";
        var viewEval = "{{ route('ViewEvaluations') }}";
        var evalImage = "{{ asset('event_images') }}";
        var deleteEval = "{{ route('deleteEvalForm') }}"
       window.onload= ()=>{
        LoadEvaluationForm(getAllEvalRoute, emptyPlaceholder, evalForm, viewEval, evalImage, deleteEval, "student");
       }
    </script>
</body>

</html>
