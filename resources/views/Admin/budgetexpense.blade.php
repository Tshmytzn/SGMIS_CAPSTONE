<!doctype html>

<html lang="en">

@include('Admin.components.header', ['title' => 'Budgeting Details'])
@include('Admin.components.adminstyle')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>


<style>
    .input-error {
        border: 2px solid red;
        /* Adjust the border thickness and color */
    }
.members-list {
    padding-left: 20px; /* Adjust to control space between list number and text */
    margin: 5px 0; /* Optional: Adjust spacing around the list */
}

.members-list li {
    padding-left: 5px; /* Reduce space between number and member name */
    margin-bottom: 2px; /* Control space between list items */
    list-style-position: inside; /* Ensure the number is closer to the text */
}
.tryellow {
        background-color: lightyellow !important;
    }

    .trgreeen {
        background-color: lightgreen !important;
    }
    * {
        color-adjust: exact; /* Attempt to print colors as they are shown */
    }
 @media print {
            /* Hide the print button when printing */
            #download {
                display: none;
            }
.tryellow {
        background-color: lightyellow !important;
    }

    .trgreeen {
        background-color: lightgreen !important;
    }
                * {
        color-adjust: exact; /* For browsers that support this, ensures colors are printed as they appear on screen */
    }
        }
</style>
<body>
    <script src="{{ asset('./dist/js/demo-theme.min.js?1684106062') }}"></script>

    <div class="page">



        <div class="page-wrapper">

            <!-- Page header -->


            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">

                    
                    {{-- set meal expenses table --}}
                    <div class="row row-deck row-cards mb-2">
                        
                       <div class="card p-5">
                        <img src="{{asset('party_image/chmsuheader.png')}}" alt="" class="w-100">
                            {{-- <div class="row justify-content-center m-2">
                                <h3 class="text-center">PROJECT PROPOSAL</h3>
                            </div>
                            <div class="d-flex flex-column gap-2">
                                <h3 class="fw-normal">
                                    Project Name: <span class="fw-bold">{{ $budget->title }}</span>
                                </h3>
                                <h3 class="fw-normal">
                                    Project Theme: <span class="fw-bold">"{{ $budget->theme }}"</span>
                                </h3>
                                <div>
                                    <h3 class="fw-normal mb-2">Project Objectives:</h3>
                                    <div class="ms-8 me-8">
                                        <h3>{{ $budget->objective }}</h3>
                                    </div>
                                </div>
                                 <div>
                                    <h3 class="fw-normal mb-2">Project Locations:</h3>
                                    <div class="ms-8 me-8">
                                        <h3>{{ $budget->location }}</h3>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="fw-normal mb-2">Project Proponent:</h3>
                                    <div class="ms-8 me-8">
                                        <h3>{{ $budget->project_proponent }}</h3>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="fw-normal mb-2">Contact Person:</h3>
                                    <div class="ms-8 me-8">
                                        <h3>{{ $budget->contact_person }}</h3>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="fw-normal mb-2">Project Participant:</h3>
                                    <div class="ms-8 me-8">
                                        <h3>{{ $budget->project_participant }}</h3>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="fw-normal mb-2">Project Dates:</h3>
                                    <div class="ms-8 me-8">
                                        <h3>{{ $budget->budget_period_start }} - {{ $budget->budget_period_end }}</h3>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="fw-normal mb-2">Funding Source:</h3>
                                    <div class="ms-8 me-8">
                                        <h3>{{ $budget->funding_source }}</h3>
                                    </div>
                                </div>
                            </div> --}}
                        </div>


                        <div class="card">
                            <div class="card-header">
                                <div class="container mx-3" style="margin-bottom: -1%;">
                                    <div class="row">
                                        <div class="col d-flex justify-content-between mt-2">
                                            <h3 style="margin-left: -3%">Meal Expenses </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="table">
                                    <table class="table table-bordered table-hover" id="committeeMealTable">
                                        <thead>
                                            <tr>
                                                <th>NO.</th>
                                                <th>QTY</th>
                                                <th>DESCIPTION</th>
                                                <th>UNIT PRICE</th>
                                                <th>AMOUNT</th>
                                            </tr>
                                        </thead>
                                        <tbody id="committeeMealTableBody" style="text-align: center;">

                                        </tbody>
                                        <tbody id="committeeMealTableBody2" style="text-align: center;">

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- set meal expenses table --}}
                    <div class="row row-deck row-cards mb-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="table">
                                    <table class="table table-bordered table-hover">
                                        <tbody id="committeeMealTableBody3" style="text-align: center;">

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>


                    <a>
                        <button class="btn btn-primary w-100" id="download" onclick="saveTotal('{{ $budget->id }}')">Print</button>
                    </a>
                </div>
                <input type="hidden" name="bDateStart" id="bDateStart" value="{{ $budget->budget_period_start }}">
                <input type="hidden" name="bDateEnd" id="bDateEnd" value="{{ $budget->budget_period_end }}">
                <form action="" method="POST" id="getCommetteeDataForm" hidden>
                    @csrf
                    <input type="text" name="budget_id" id="" value="{{ $budget->id }}">
                </form>
                <form action="" method="POST" id="randomForm" hidden>
                    @csrf
                    <input type="text" name="data_id" id="data_id" value="">
                </form>
                <form action="" method="POST" id="getBudgetDateForm" hidden>
                    @csrf
                    <input type="text" name="budget_id" id="" value="{{ $budget->id}}">
                </form>
                <input type="text" name="" id="temp_id"hidden>

        </div>
    </div>

    @include('Admin.components.footer')

    </div>

    @include('Admin.components.scripts')
    @include('Admin.components.budgetExpensesscript')
</body>

</html>
