<!doctype html>

<html lang="en">

@include('Student.components.head', ['title' => 'Dashboard'])
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
                                Dashboard
                            </h2>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl" id="eventList">


                    <div class="row row-cards">
                        <div class="col-sm-6 col-lg-4">
                            <div class="card card-sm">
                                <a href="{{ route('ViewDetails') }}" class="d-block">
                                    <div class="position-relative">
                                        <img src="{{ asset('./static/photos/beautiful-blonde-woman-relaxing-with-a-can-of-coke-on-a-tree-stump-by-the-beach.jpg') }}"
                                            class="card-img-top">
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <span class="avatar me-3 rounded"
                                                style="background-image: url({{ asset('./static/avatars/000m.jpg') }})"></span>
                                            <div class="me-4 text-dark">
                                                <div>Uweek Celebration</div>
                                                <div class="text-muted">3 days ago</div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                    <div class="page page-center" id="loading-events">
                        <div class="container container-slim py-4">
                          <div class="text-center">
                            <div class="mb-3">
                              <a href="." class="navbar-brand navbar-brand-autodark"><img src="./static/logoicon.png" height="36" alt=""></a>
                            </div>
                            <div class="text-muted mb-3">Loading Events</div>
                            <div class="progress progress-sm">
                              <div class="progress-bar progress-bar-indeterminate"></div>
                            </div>
                          </div>

                        </div>
                      </div>
                  </div>

            </div>
        </div>
    </div>
    @include('Student.components.footer')
    @include('Student.components.scripts')
    <script>
        window.onload = function(){
            LoadEvents("{{ route('getAllEvent') }}", "{{ asset('event_images/') }}", "{{ route('deleteEvent') }}", "{{ route('ViewDetails') }}", "student");
        }
    </script>
</body>

</html>
