<!doctype html>

<html lang="en">

@include('Student.components.head', ['title' => 'Events'])
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
                <div class="container-xl">

                    <div class="row row-cards">
                        <div class="col-sm-6 col-lg-4">
                            <div class="card card-sm">
                                <a href="{{ route('ViewDetails') }}" class="d-block">
                                    <div class="position-relative">
                                        <img src="./static/photos/beautiful-blonde-woman-relaxing-with-a-can-of-coke-on-a-tree-stump-by-the-beach.jpg"
                                            class="card-img-top">
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <span class="avatar me-3 rounded"
                                                style="background-image: url(./static/avatars/000m.jpg)"></span>
                                            <div class="me-4">
                                                <div>Uweek Celebration</div>
                                                <div class="text-muted">3 days ago</div>
                                            </div> &nbsp;
                                        </div>
                                    </div>
                                </a>
                            </div>


                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    @include('Student.components.footer')
    @include('Student.components.scripts')
</body>

</html>
