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
 @media print {
            /* Hide the print button when printing */
            #download {
                display: none;
            }
            /* Optional: Adjust styles for print */
            body {
                margin: 0; /* Remove margins for a cleaner print */
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
                        <button class="btn btn-primary w-100" id="download">Print Budget</button>
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
    @include('Admin.components.budgetmodals')
</body>

</html>
