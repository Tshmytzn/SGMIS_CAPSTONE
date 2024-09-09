<!doctype html>
<html lang="en">

@include('Student.components.head', ['title' => 'Election'])
@include('Student.components.header')
@include('Student.components.nav')

<style>
    /* Styling for container */
    .position-relative {
        position: relative;
    }

    /* Card styling */
    .card-link {
        text-decoration: none;
        color: inherit;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .card-link:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    /* Initially hide the dropdown cards */
    .dropdown-card {
        display: none;
        width: 100%;
        opacity: 0;
        transform: translateY(-20px);
        /* Start from above */
        transition: opacity 0.3s ease, transform 0.3s ease;
        /* Smooth transition */
    }

    .dropdown-card.show {
        display: block;
        opacity: 1;
        transform: translateY(0);
    }

    /* Style for the submit button */
    .submit-button-container {
        text-align: center;
        margin-top: 20px;
        display: none;
        /* Initially hidden */
    }

    .submit-button-container .btn {
        border-radius: 20px;
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    .submit-button-container .btn:hover {
        background-color: #0056b3;
    }
</style>

<body>
    <div class="page">
        <div class="page-wrapper">
            <!-- Page header -->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <h2 class="page-title">Election</h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">

                    <div class="container mt-5">
                        <div class="accordion" id="accordionExample">
                            <!-- First Item -->

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        President
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">

                                        <div class="row row-cards" id="cards2">

                                            <div class="col-md-6 col-lg-3 fade-card">
                                                <div class="card card-link card-link-pop ">
                                                    <a href="#" class="d-block">
                                                        <img src="{{ asset('/student_images/161_student_picture.png') }}"
                                                            style="height: 40vh" class="card-img-top" alt="Event image">
                                                    </a>
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center">
                                                            <div>
                                                                <div>Candidate 1</div>
                                                                <div class="tex-t-muted">President</div>
                                                            </div>
                                                            <div class="ms-auto">
                                                                <a href="#" title="View event" class="text-muted"
                                                                    onclick="updatePic('${item.candi_picture}','${item.candi_id}')"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#updateCandi">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        width="24" height="24"
                                                                        viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="icon icon-tabler icon-tabler-eye">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                            fill="none" />
                                                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                                        <path
                                                                            d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                                    </svg>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-3 fade-card">
                                                <div class="card card-link card-link-pop ">
                                                    <a href="#" class="d-block">
                                                        <img src="{{ asset('/student_images/161_student_picture.png') }}"
                                                            style="height: 40vh" class="card-img-top" alt="Event image">
                                                    </a>
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center">
                                                            <div>
                                                                <div>Candidate 2</div>
                                                                <div class="tex-t-muted">President</div>
                                                            </div>
                                                            <div class="ms-auto">
                                                                <a href="#" title="View event" class="text-muted"
                                                                    onclick="updatePic('${item.candi_picture}','${item.candi_id}')"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#updateCandi">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        width="24" height="24"
                                                                        viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="icon icon-tabler icon-tabler-eye">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                            fill="none" />
                                                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                                        <path
                                                                            d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                                    </svg>
                                                                </a>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        VICE PRESIDENT
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">

                                        <div class="row row-cards" id="cards2">

                                            <div class="col-md-6 col-lg-3 fade-card">
                                                <div class="card card-link card-link-pop ">
                                                    <a href="#" class="d-block">
                                                        <img src="{{ asset('/student_images/161_student_picture.png') }}"
                                                            style="height: 40vh" class="card-img-top"
                                                            alt="Event image">
                                                    </a>
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center">
                                                            <div>
                                                                <div>Candidate 1</div>
                                                                <div class="tex-t-muted">VICE PRESIDENT</div>
                                                            </div>
                                                            <div class="ms-auto">
                                                                <a href="#" title="View event"
                                                                    class="text-muted"
                                                                    onclick="updatePic('${item.candi_picture}','${item.candi_id}')"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#updateCandi">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        width="24" height="24"
                                                                        viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="icon icon-tabler icon-tabler-eye">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                            fill="none" />
                                                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                                        <path
                                                                            d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                                    </svg>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-3 fade-card">
                                                <div class="card card-link card-link-pop ">
                                                    <a href="#" class="d-block">
                                                        <img src="{{ asset('/student_images/161_student_picture.png') }}"
                                                            style="height: 40vh" class="card-img-top"
                                                            alt="Event image">
                                                    </a>
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center">
                                                            <div>
                                                                <div>Candidate 2</div>
                                                                <div class="tex-t-muted">VICE PRESIDENT</div>
                                                            </div>
                                                            <div class="ms-auto">
                                                                <a href="#" title="View event"
                                                                    class="text-muted"
                                                                    onclick="updatePic('${item.candi_picture}','${item.candi_id}')"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#updateCandi">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        width="24" height="24"
                                                                        viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="icon icon-tabler icon-tabler-eye">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                            fill="none" />
                                                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                                        <path
                                                                            d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                                    </svg>
                                                                </a>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- SENATORS -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                        aria-expanded="false" aria-controls="collapseThree">
                                        SENATORS
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse"
                                    aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">

                                        <div class="row row-cards" id="cards2">

                                            <div class="col-md-6 col-lg-3 fade-card">
                                                <div class="card card-link card-link-pop ">
                                                    <a href="#" class="d-block">
                                                        <img src="{{ asset('/student_images/161_student_picture.png') }}"
                                                            style="height: 40vh" class="card-img-top"
                                                            alt="Event image">
                                                    </a>
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center">
                                                            <div>
                                                                <div>Candidate 1</div>
                                                                <div class="tex-t-muted">SENATOR</div>
                                                            </div>
                                                            <div class="ms-auto">
                                                                <a href="#" title="View event"
                                                                    class="text-muted"
                                                                    onclick="updatePic('${item.candi_picture}','${item.candi_id}')"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#updateCandi">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        width="24" height="24"
                                                                        viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="icon icon-tabler icon-tabler-eye">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                            fill="none" />
                                                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                                        <path
                                                                            d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                                    </svg>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-3 fade-card">
                                                <div class="card card-link card-link-pop ">
                                                    <a href="#" class="d-block">
                                                        <img src="{{ asset('/student_images/161_student_picture.png') }}"
                                                            style="height: 40vh" class="card-img-top"
                                                            alt="Event image">
                                                    </a>
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center">
                                                            <div>
                                                                <div>Candidate 2</div>
                                                                <div class="tex-t-muted">SENATOR</div>
                                                            </div>
                                                            <div class="ms-auto">
                                                                <a href="#" title="View event"
                                                                    class="text-muted"
                                                                    onclick="updatePic('${item.candi_picture}','${item.candi_id}')"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#updateCandi">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        width="24" height="24"
                                                                        viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="icon icon-tabler icon-tabler-eye">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                            fill="none" />
                                                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                                        <path
                                                                            d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                                    </svg>
                                                                </a>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- GOVERNOR -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFour">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                        aria-expanded="false" aria-controls="collapseFour">
                                        GOVERNOR
                                    </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse"
                                    aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">

                                        <div class="row row-cards" id="cards2">

                                            <div class="col-md-6 col-lg-3 fade-card">
                                                <div class="card card-link card-link-pop ">
                                                    <a href="#" class="d-block">
                                                        <img src="{{ asset('/student_images/161_student_picture.png') }}"
                                                            style="height: 40vh" class="card-img-top"
                                                            alt="Event image">
                                                    </a>
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center">
                                                            <div>
                                                                <div>Candidate 1</div>
                                                                <div class="tex-t-muted">GOVERNOR</div>
                                                            </div>
                                                            <div class="ms-auto">
                                                                <a href="#" title="View event"
                                                                    class="text-muted"
                                                                    onclick="updatePic('${item.candi_picture}','${item.candi_id}')"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#updateCandi">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        width="24" height="24"
                                                                        viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="icon icon-tabler icon-tabler-eye">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                            fill="none" />
                                                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                                        <path
                                                                            d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                                    </svg>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-3 fade-card">
                                                <div class="card card-link card-link-pop ">
                                                    <a href="#" class="d-block">
                                                        <img src="{{ asset('/student_images/161_student_picture.png') }}"
                                                            style="height: 40vh" class="card-img-top"
                                                            alt="Event image">
                                                    </a>
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center">
                                                            <div>
                                                                <div>Candidate 2</div>
                                                                <div class="tex-t-muted">GOVERNOR</div>
                                                            </div>
                                                            <div class="ms-auto">
                                                                <a href="#" title="View event"
                                                                    class="text-muted"
                                                                    onclick="updatePic('${item.candi_picture}','${item.candi_id}')"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#updateCandi">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        width="24" height="24"
                                                                        viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="icon icon-tabler icon-tabler-eye">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                            fill="none" />
                                                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                                        <path
                                                                            d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                                    </svg>
                                                                </a>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- VICE GOVERNOR -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFive">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseFive"
                                        aria-expanded="false" aria-controls="collapseFive">
                                        VICE GOVERNOR
                                    </button>
                                </h2>
                                <div id="collapseFive" class="accordion-collapse collapse"
                                    aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">

                                        <div class="row row-cards" id="cards2">

                                            <div class="col-md-6 col-lg-3 fade-card">
                                                <div class="card card-link card-link-pop ">
                                                    <a href="#" class="d-block">
                                                        <img src="{{ asset('/student_images/161_student_picture.png') }}"
                                                            style="height: 40vh" class="card-img-top"
                                                            alt="Event image">
                                                    </a>
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center">
                                                            <div>
                                                                <div>Candidate 1</div>
                                                                <div class="tex-t-muted">VICE GOVERNOR</div>
                                                            </div>
                                                            <div class="ms-auto">
                                                                <a href="#" title="View event"
                                                                    class="text-muted"
                                                                    onclick="updatePic('${item.candi_picture}','${item.candi_id}')"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#updateCandi">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        width="24" height="24"
                                                                        viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="icon icon-tabler icon-tabler-eye">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                            fill="none" />
                                                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                                        <path
                                                                            d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                                    </svg>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-3 fade-card">
                                                <div class="card card-link card-link-pop ">
                                                    <a href="#" class="d-block">
                                                        <img src="{{ asset('/student_images/161_student_picture.png') }}"
                                                            style="height: 40vh" class="card-img-top"
                                                            alt="Event image">
                                                    </a>
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center">
                                                            <div>
                                                                <div>Candidate 2</div>
                                                                <div class="tex-t-muted">VICE GOVERNOR</div>
                                                            </div>
                                                            <div class="ms-auto">
                                                                <a href="#" title="View event"
                                                                    class="text-muted"
                                                                    onclick="updatePic('${item.candi_picture}','${item.candi_id}')"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#updateCandi">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        width="24" height="24"
                                                                        viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="icon icon-tabler icon-tabler-eye">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                            fill="none" />
                                                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                                        <path
                                                                            d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                                    </svg>
                                                                </a>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- BSIS REPRESENTATIVE -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingSix">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false"
                                        aria-controls="collapseSix">
                                        BSIS REPRESENTATIVE
                                    </button>
                                </h2>
                                <div id="collapseSix" class="accordion-collapse collapse"
                                    aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">

                                        <div class="row row-cards" id="cards2">

                                            <div class="col-md-6 col-lg-3 fade-card">
                                                <div class="card card-link card-link-pop ">
                                                    <a href="#" class="d-block">
                                                        <img src="{{ asset('/student_images/161_student_picture.png') }}"
                                                            style="height: 40vh" class="card-img-top"
                                                            alt="Event image">
                                                    </a>
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center">
                                                            <div>
                                                                <div>Candidate 1</div>
                                                                <div class="tex-t-muted">BSIS REPRESENTATIVE</div>
                                                            </div>
                                                            <div class="ms-auto">
                                                                <a href="#" title="View event"
                                                                    class="text-muted"
                                                                    onclick="updatePic('${item.candi_picture}','${item.candi_id}')"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#updateCandi">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        width="24" height="24"
                                                                        viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="icon icon-tabler icon-tabler-eye">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                            fill="none" />
                                                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                                        <path
                                                                            d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                                    </svg>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-3 fade-card">
                                                <div class="card card-link card-link-pop ">
                                                    <a href="#" class="d-block">
                                                        <img src="{{ asset('/student_images/161_student_picture.png') }}"
                                                            style="height: 40vh" class="card-img-top"
                                                            alt="Event image">
                                                    </a>
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center">
                                                            <div>
                                                                <div>Candidate 2</div>
                                                                <div class="tex-t-muted">BSIS REPRESENTATIVE</div>
                                                            </div>
                                                            <div class="ms-auto">
                                                                <a href="#" title="View event"
                                                                    class="text-muted"
                                                                    onclick="updatePic('${item.candi_picture}','${item.candi_id}')"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#updateCandi">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        width="24" height="24"
                                                                        viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="icon icon-tabler icon-tabler-eye">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                            fill="none" />
                                                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                                        <path
                                                                            d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                                    </svg>
                                                                </a>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="text-center mt-4 col-12">
                            <Button class="btn btn-primary col-12" type="button"> Submit Vote</Button>
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
