<!doctype html>

<html lang="en">

@include('Student.components.head', ['title' => 'Documents'])
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
                                Documents
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    @include('Admin.components.lineLoading', ['loadID' => 'lineLoading'])
                    <div class="row row-deck row-cards" id="eventsContainer">

                        {{-- Document layout --}}
                        <div class="col-md-3 col-sm-4">
                            <div class="card card-link card-link-pop folder">
                                <div class="ribbon ribbon-top bg-yellow">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-pinned">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M9 4v6l-2 4v2h10v-2l-2 -4v-6" />
                                        <path d="M12 16l0 5" />
                                        <path d="M8 4l8 0" />
                                    </svg>
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">Compendium Name</h3>
                                    <p class="text-muted"> Event name and event details Event name and event details
                                        Event name and event details</p>
                                </div>
                                <!-- Card footer -->
                                <div class="card-footer">
                                    <a href="" class="btn btn-primary mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-files">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M15 3v4a1 1 0 0 0 1 1h4" />
                                            <path
                                                d="M18 17h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h4l5 5v7a2 2 0 0 1 -2 2z" />
                                            <path d="M16 17v2a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h2" />
                                        </svg>
                                        View Files</a>
                                </div>
                            </div>
                        </div>
                        {{-- Document layout --}}


                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('Student.components.footer')
    @include('Student.components.scripts')
</body>

</html>
