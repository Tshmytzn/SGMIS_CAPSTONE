<!doctype html>

<html lang="en">

@include('Admin.components.header', ['title' => 'Liquidation'])

<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<style>
    /* Set specific widths for the columns */
    .t1 th:nth-child(1), /* First column (Description) */
    .t1 td:nth-child(1) {
        width: 50%; /* Adjust as needed */
    }

    .t1 th:nth-child(2), /* Second column (Amount) */
    .t1 td:nth-child(2) {
        width: 20%; /* Adjust as needed */
    }
</style>
<body>
    <script src="{{ asset('./dist/js/demo-theme.min.js?1684106062') }}"></script>
    @php
    $liquidation_id = $_GET['liquidation_id'];
    $data = \App\Models\BudgetProposal::where('eventid',$liquidation_id)->first();
@endphp
    <div class="page">

        @include('Admin.components.nav', ['active' => 'Liquidation'])

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
                                Liquidation Details
                            </h2>
                        </div>

                    </div>
                </div>
            </div>


            {{-- content --}}
            <div class="page-body">
                <div class="container-xl">
                    <div class="card">
                        <div class="card-body">

                            <form action="" id="saveFundForm" method="POST">
                                @csrf
                            <div class="col-12 border mb-6">
                                <div class="card-header">
                                    STATEMENT OF SOURCE OF FUND AND DISBURSEMENT
                                  </div>
                                  <div class="table-responsive">
                                    <table class="table t1 table-bordered table-hover text-center">
                                        <thead>
                                            <tr>
                                                <th>Description</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Cash on Hand</td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center">
                                                        <input type="number" class="form-control w-75 text-center" id="coh" oninput="calculateResult()" step="0.01" min="0" value="0" name="coh">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Cash on Bank</td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center">
                                                        <input type="number" class="form-control w-75 text-center" id="cob" oninput="calculateResult()" name="cob"  step="0.01" min="0" value="0">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Total Beginning Balance</td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center">
                                                        <input type="number" class="form-control w-75 text-center" name="tbb" oninput="calculateResult2()" id="tbb" readonly step="0.01" min="0" value="{{$data->total_budget}}">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Total Expenses</td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center">
                                                        <input type="number" class="form-control w-75 text-center" name="te"  oninput="calculateResult2()" id="te" readonly step="0.01" min="0" value="0">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Ending Balance</td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center">
                                                        <input type="number" class="form-control w-75 text-center" name="eb" id="eb" step="0.01" min="0" value="0" readonly>
                                                        
                                                    </div>
                                                    <span class="text-danger" id="exceedWarning" style="display: none">Total Expenses Exceed Total Budget</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <p class="fw-bold">BREAKDOWN OF ENDING BALANCE</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Cash on Hand</td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center">
                                                        <input type="number" class="form-control w-75 text-center" name="coh2" oninput="checkAndRestrictInput()" id="coh2" step="0.01" min="0" value="0">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Cash on Bank</td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center">
                                                        <input type="number" class="form-control w-75 text-center" name="cob2" oninput="checkAndRestrictInput()" id="cob2" step="0.01" min="0" value="0">
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button type="button" style="width: 130px;" class="btn btn-primary m-2" onclick="saveFundAndDis()">Save</button>
                                </div>
                            </div>
                            </form>

                            <div class="col-12 border mb-6">
                                <div class="card-header">
                                    SUMMARY OF EXPENSES
                                  </div>
                                <div class="table-responsive">
                                    {{-- <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddSummaryModal">add</button> --}}
                                <table class="table table-bordered table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Name of Event/Activity</th>
                                            <th>Expenses</th>
                                        </tr>
                                    </thead>
                                    <tbody id='summaryBody'>
                                        {{-- <tr>
                                            <td id="CommitteDateAll"></td>
                                            <td>Committee And Additional Expenses</td>
                                            <td id="committeTotL"></td>
                                        </tr> --}}
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2" class="text-right"><strong>TOTAL EXPENSES:</strong></td>
                                            <td id="totalSummary"></td> <!-- This can be calculated dynamically if needed -->
                                        </tr>
                                    </tfoot>
                                </table>
                                </div>
                            </div>

                            <form id="updateBudgetData">
                                @csrf
                            <div class="col-12 border mb-6">
                                <div class="card-header position-relative">
                                    Committee And Additional Expenses
                                    <button type="button" class="btn btn-primary position-absolute top-0 end-0 m-2" onclick="editBudgetingTable()">Edit</button>
                        
                                  </div>
                                <div class="table-responsive">
                                <table class="table table-bordered table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th>DATE</th>
                                            <th>SUPPLIER</th>
                                            <th>ITEMS</th>
                                            <th>INVOICE / OR NO.</th>
                                            <th>AMOUNT</th>
                                        </tr>
                                    </thead>
                                    <tbody id="preloadTableCommittee">
                                        <input type="text" name="liquidation_id" hidden value="{{ $liquidation_id }}">
                                        <input type="text" name="summary_total" id="summary_total" hidden>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" class="text-right"><strong>TOTAL EXPENSES:</strong></td>
                                            <td id="budgetTotal"></td> <!-- This can be calculated dynamically if needed -->
                                        </tr>
                                    </tfoot>
                                </table>
                                </div>
                                <button type="button" style="width: 130px;" class="btn btn-primary col-12 m-2" id="updateBudgetingData" onclick="updateBudgetingDataF()" style="display: none;">Update</button>
                                <button type="button" style="width: 130px;" class="btn btn-primary col-12 m-2" id="svebudgetButton" onclick="saveBudgeting()">Save</button>
                            </div>
                            </form>
                            <div id="generateSaveTable" class="mb-4">

                            </div>

                            <div id="generateTable" class="mb-4">

                                

                            </div>

                            <button class="btn btn-primary col-12 m-2" style="width: 130px;" onclick="generateTable()">Add Table</button>

                            <div class="card-header position-relative">
                               Liquidation Receipt
                            </div>

                            <div class="row row-deck row-cards mt-4" id="cards">

                            </div>
                            <form action="{{route('AddReceipt')}}" class="dropzone" id="my-awesome-dropzone">

                            </form>

                            <a href="{{route('liquidationdetailsprint')}}?liquidation_id={{ $liquidation_id }}"><button style="width: 130px;" class="btn btn-primary col-12 m-4" >Print</button></a>
                            
                        </div>
                    </div>
                </div>
            </div>

            {{-- end contente --}}

            <input type="text" name="liquidation_id" id="liquidation_id" hidden value="{{ $liquidation_id }}">

            {{-- <div class="modal fade" id="receipt-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Receipt</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   <input type="file" class="form-control" name="receipt" id="receipt-pic">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="AddReceipt()">Save changes</button>
                </div>
                </div>
            </div>
            </div> --}}


            @include('Admin.components.liquidationmodal')
            @include('Admin.components.footer')

        </div>
    </div>


    @include('Admin.components.scripts')
    @include('Admin.components.liquidationdetailscript')
</body>

</html>
