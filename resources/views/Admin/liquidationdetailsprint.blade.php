<!doctype html>

<html lang="en">

@include('Admin.components.header', ['title' => 'Liquidation'])
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
    .btn {
    display: none;
}
.form-control{
    border: none;
}
 @media print {
            /* Hide the print button when printing */
            #download {
                display: none;
            }
        }
</style>
 <!-- Load jsPDF and html2canvas from CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
@include('Admin.components.adminstyle')
<body>
    <script src="{{ asset('./dist/js/demo-theme.min.js?1684106062') }}"></script>
    @php
        $liquidation_id = $_GET['liquidation_id'];
        $liquidationData = App\Models\Liquidation::where('id',$liquidation_id)->first();
        $budget = App\Models\BudgetProposal::where('eventid',$liquidationData->event_id)->first();
    @endphp
    <div class="page" id="contentprint">
        <div class="page-wrapper">

            <!-- Page header -->


            {{-- content --}}
            <div class="page-body">
                <div class="container-xl">
                    {{-- <div class="card p-5">
                        <img src="{{asset('party_image/chmsuheader.png')}}" alt="" class="w-100">
                            <div class="row justify-content-center m-2">
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
                            </div>
                        </div> --}}
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
                                                        <input type="number" class="form-control w-75 text-center" name="tbb" oninput="calculateResult2()" id="tbb" readonly step="0.01" min="0" value="0">
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
                                    <button type="button" class="btn btn-primary col-12" onclick="saveFundAndDis()">Save</button>
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
                                <button type="button" class="btn btn-primary col-12" id="updateBudgetingData" onclick="updateBudgetingDataF()" style="display: none;">Update</button>
                                <button type="button" class="btn btn-primary col-12" id="svebudgetButton" onclick="saveBudgeting()">Save</button>
                            </div>
                            </form>
                            <div id="generateSaveTable" class="mb-4">

                            </div>

                            <div id="generateTable" class="mb-4">

                                

                            </div>
                            <div class="card-header position-relative">
                               Liquidation Receipt
                            </div>
                            <img src="" class="img-fluid" alt="Responsive Image" id="receipt-image">
                            <button id="download" class=" btn-primary col-12 mt-4 mb-2" style="background-color:lightgreen;border-radius:10px; border-color:gray; height:40px;border: 1px solid gray;">Print and Save File</button></button>

                        </div>
                    </div>
                </div>
            </div>

            {{-- end contente --}}

            <input type="text" name="liquidation_id" id="liquidation_id" hidden value="{{ $liquidation_id }}">
            @include('Admin.components.liquidationmodal')
            @include('Admin.components.footer')

        </div>
    </div>


    @include('Admin.components.scripts')
    @include('Admin.components.liquidationdetailscript')
    <script>
document.getElementById('download').addEventListener('click', () => {
    const adminLoader = document.getElementById('adminloader');
    const downloadButton = document.getElementById('download');
    const contentPrint = document.getElementById('contentprint');
    const liquidationId = document.getElementById('liquidation_id').value;

    // Show loading indicator and hide download button
    adminLoader.style.display = 'grid';
    downloadButton.style.display = 'none';

    // Capture content and generate PDF
    html2canvas(contentPrint, {
        scale: 1.5,  // Set scale for decent quality
        useCORS: true // Enable cross-origin images
    }).then(canvas => {
        const { jsPDF } = window.jspdf;
        const pdf = new jsPDF('p', 'mm', 'a4');
        const imgData = canvas.toDataURL('image/png', 0.7);
        const pdfWidth = pdf.internal.pageSize.getWidth();
        const imgWidth = canvas.width;
        const imgHeight = canvas.height;
        const widthRatio = pdfWidth / imgWidth;
        const newHeight = imgHeight * widthRatio;

        let y = 0; // Position for image

        // Add image page by page
        while (y < newHeight) {
            pdf.addImage(imgData, 'PNG', 0, -y, pdfWidth, newHeight);
            y += pdf.internal.pageSize.getHeight();
            if (y < newHeight) pdf.addPage(); // Add new page if content overflows
        }

        const pdfBlob = pdf.output('blob');
        const formData = new FormData();

        formData.append('pdf', pdfBlob, 'document.pdf');
        formData.append('l_id', liquidationId);
        formData.append('_token', '{{ csrf_token() }}'); // CSRF token from Blade template

        // Submit via AJAX
        $.ajax({
            type: "POST",
            url: "{{ route('saveLiquidationDoc') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log('PDF saved successfully:', response);
            },
            error: function(xhr, status, error) {
                console.error('Error saving PDF:', xhr.responseText);
            },
            complete: function() {
                adminLoader.style.display = 'none';
                window.print();
                downloadButton.style.display = 'block';
            }
        });
    }).catch(err => {
        console.error('Error generating PDF:', err);
        adminLoader.style.display = 'none';
        downloadButton.style.display = 'block';
    });
});

   

    const inputs = document.querySelectorAll('.form-control');
            inputs.forEach(input => {
                input.readOnly  = true; // Set the disabled property to true
            });
    </script>
</body>

</html>
