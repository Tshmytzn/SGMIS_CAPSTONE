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
                            <div class="row row-deck row-cards mt-4" id="cards">

                            </div>
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
    {{-- @include('Admin.components.liquidationdetailscript') --}}
    <script>
    let event_id='';
    let allDateStart = '';
    let allDateEnd = '';
    function getLiquidationData(){
        const id = document.getElementById('liquidation_id').value;
        var formData = new FormData();
        // Append the CSRF token to the FormData
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('id', id);
        // Send the AJAX request
        $.ajax({
            type: "POST",
            url: "{{ route('liquidationDetailsData') }}" + '?process=' + 'get',
            data: formData,
            contentType: false, // Important for file uploads
            processData: false, // Important for file uploads
            success: function(response) {
                event_id = response.data.event_id;

                // const receipt_image = response.data.receipt

                // const image = document.getElementById('receipt-image');
                // if (image && receipt_image) {
                //     image.src = '/party_image/' + receipt_image;
                // } else {
                //     console.error("Image element or receipt data is missing.");
                // }

                getBudgetData()
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                // You can also add custom error handling here if needed
            }
        });
    }
    function getLiquidationEvent(){
        const id = document.getElementById('liquidation_id').value;
        var formData = new FormData();
        // Append the CSRF token to the FormData
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('id', id);
        // Send the AJAX request
        $.ajax({
            type: "POST",
            url: "{{ route('liquidationDetailsData') }}" + '?process=' + 'getLiquidationEvent',
            data: formData,
            contentType: false, // Important for file uploads
            processData: false, // Important for file uploads
            success: function(response) {
                allDateStart=response.data.event_start
                allDateEnd=response.data.event_end

                // document.getElementById('CommitteDateAll').textContent=response.data.event_start+'-'+response.data.event_end
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                // You can also add custom error handling here if needed
            }
        });
    }
    function getBudgetData(){
        var formData = new FormData();
        // Append the CSRF token to the FormData
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('id', event_id);
        // Send the AJAX request
        $.ajax({
            type: "POST",
            url: "{{ route('liquidationDetailsData') }}" + '?process=' + 'getB',
            data: formData,
            contentType: false, // Important for file uploads
            processData: false, // Important for file uploads
            success: function(response) {
                
                const Lid = document.getElementById('liquidation_id').value;
                
                function fetchDataAndProcess(callback) {
                    var formData2 = new FormData();
                    formData2.append('_token', '{{ csrf_token() }}');
                    $.ajax({
                        type: "POST",
                        url: "{{ route('liquidationDetailsData') }}" + '?process=getBudgetLiq&Lid=' + Lid,
                        data: formData2,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            callback(response.data); // Pass the data to the callback
                        },
                        error: function(xhr, status, error) {
                            console.log("Error:", error);
                            callback(null); // Pass null or handle error
                        }
                    });
                }

                // Usage
                fetchDataAndProcess(function(dataArray) {
                    if (Array.isArray(dataArray)) {
                       let preloader = document.getElementById('preloadTableCommittee');
                        preloader.innerHTML = ``;  // Clear previous content

                        let table = ''; // Initialize table as an empty string
                        let numTotal = 0;
                        dataArray.forEach(element => {
                            const items = element.item.split(', ').map(item => item.trim()).join('<br/>');
                            const totals = element.total.split(', ').map(total => total.trim()).join('<br/>');
                            const totalValues = element.total.split(', ').map(total => parseFloat(total.trim().replace(/,/g, ''))); // Convert to numbers
                            const sumOfTotals = totalValues.reduce((acc, value) => acc + value, 0); // Sum the values
                            numTotal += sumOfTotals;// Add to numTotal
                            table += `
                                <tr>
                                    <td>${element.bdate}</td>
                                    <td>${element.supplier}</td>
                                    <td>${items}</td>
                                    <td>${element.invoice}</td>
                                    <td>${totals}</td>
                                </tr>
                            `;
                        });
                        document.getElementById('budgetTotal').textContent = numTotal.toFixed(2)
                        
                        // Update the inner HTML of the preloader with the constructed table
                        preloader.innerHTML = `<table>${table}</table>`;
                        $('#svebudgetButton').hide()
                        }
                        else{
                        const preloadCom = document.getElementById('preloadTableCommittee');

            let tableContent = '';
            let budgetTotal = 0;
            let autoIn =1
            response.data.forEach(element => {
                tableContent += `
                <tr>
                    <td><input name="bdate[${autoIn}]" hidden value="${element.meal_date}">${element.meal_date}</td>
                    <td>
                        <input name="supplier[${autoIn}]" class="form-control">
                    </td>
                    <th>
                `;

                const mealMembersCount = new Map();

                // Populate the map with total committee members for each meal
                element.meal_date_data.forEach(item => {
                    item.meal.forEach(meal => {
                        const currentCount = mealMembersCount.get(meal.meal) || 0;
                        mealMembersCount.set(meal.meal, currentCount + item.committee_members.length);
                    });
                });
                let joinItems ='';
                // Display each unique meal with the total committee members count
                mealMembersCount.forEach((count, mealName) => {
                    joinItems+=`${mealName} (Members: ${count}), `;
                    tableContent += `
                    <span>${mealName} (Members: ${count})</span><br>`;
                });

                tableContent += `
                <input name="items[${autoIn}]" hidden value="${joinItems}">
                    </th>
                    <td>
                    <input name="invoice[${autoIn}]" class="form-control">
                    </td>
                    <td>
                `;

                const mealCosts = {};
                element.meal_date_data.forEach(item => {
                    item.meal.forEach(meal => {
                        const costForThisMeal = meal.price * item.committee_members.length;
                        mealCosts[meal.meal] = (mealCosts[meal.meal] || 0) + costForThisMeal; // Sum costs for meals
                    });
                });
                let jointotal = ``;
                // Display the total cost for each unique meal
                for (const [mealName, totalCost] of Object.entries(mealCosts)) {
                    jointotal+=`${totalCost}, `;
                    tableContent += `

                    <span>${totalCost}</span><br>`;
                    budgetTotal += totalCost; // Update the budget total
                }

                tableContent += `
                <input name="total[${autoIn}]" hidden value="${jointotal}">
                    </td>
                </tr>`;
                autoIn++
            });

            // Update the table's HTML once after looping
            preloadCom.innerHTML += tableContent;

            let otherContent = '';
            let otherTotal = 0;
            let autoIn2 = autoIn;
            response.data2.forEach(element => {
                const date = new Date(element.created_at);
                const formattedDate = date.toISOString().split('T')[0];
                otherContent += `
                <tr>
                    <td><input name="bdate[${autoIn2}]" hidden value="${formattedDate}">${formattedDate}</td>
                    <td>
                        <input name='supplier[${autoIn2}]' class='form-control'>
                    </td>
                    <td>
                        <input name="items[${autoIn2}]" hidden value="${element.description} - ${element.quantity}">
                        ${element.description} - ${element.quantity}</td>
                    <td>
                        <input name='invoice[${autoIn2}]' class='form-control'>
                    </td>
                    <td><input name="total[${autoIn2}]" hidden value="${parseFloat(element.total).toFixed(2)}">
                        ${parseFloat(element.total).toFixed(2)}</td>
                </tr>`;
                otherTotal += parseFloat(element.total);
                autoIn2++;
            });

            preloadCom.innerHTML += otherContent;

            // Correctly update the budget total in the designated element
            document.getElementById('budgetTotal').textContent = (budgetTotal + otherTotal).toFixed(2); // Ensure total is formatted
            // document.getElementById('committeTotL').textContent= (budgetTotal + otherTotal).toFixed(2);
            document.getElementById('summary_total').value = (budgetTotal + otherTotal).toFixed(2);
                    }
                });
                calculateResult2();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                // You can also add custom error handling here if needed
            }
        });
    }
    function editBudgetingTable(){

    const formData = new FormData();
    formData.append('_token', '{{ csrf_token() }}');

    $.ajax({
        type: "POST",
        url: "{{ route('liquidationDetailsData') }}" + '?process=' + 'getBudgetingData',
        data: formData,
        contentType: false, // Important for file uploads
        processData: false, // Important for file uploads
        success: function(response) {
            console.log(response)
            document.getElementById('updateBudgetingData').style.display='';
            let preloader = document.getElementById('preloadTableCommittee');
                        preloader.innerHTML = ``;  // Clear previous content

                        let table = ''; // Initialize table as an empty string
                        let numTotal = 0;
                        let count = 1;
                        response.data.forEach(element => {
                            const items = element.item.split(', ').map(item => item.trim()).join('<br/>');
                            const totals = element.total.split(', ').map(total => total.trim()).join('<br/>');
                            const totalValues = element.total.split(', ').map(total => parseFloat(total.trim().replace(/,/g, ''))); // Convert to numbers
                            const sumOfTotals = totalValues.reduce((acc, value) => acc + value, 0); // Sum the values
                            numTotal += sumOfTotals;// Add to numTotal
                            table += `
                                <tr><input name="budgetingID[${count}]" value='${element.id}' hidden>
                                    <td>${element.bdate}</td>
                                    <td><input class="form-control" name=supplier[${count}] value="${element.supplier}"></td>
                                    <td>${items}</td>
                                    <td><input class="form-control" name="invoice[${count}]" value="${element.invoice}"></td>
                                    <td>${totals}</td>
                                </tr>
                            </form>
                            `;
                            count++;
                        });
                        document.getElementById('budgetTotal').textContent = numTotal.toFixed(2)
                        // Update the inner HTML of the preloader with the constructed table
                        preloader.innerHTML = `<table>${table}</table>`;
                        $('#svebudgetButton').hide()

        },
        error: function(xhr, status, error) {
            const message = xhr.responseJSON ? xhr.responseJSON.message : "An unexpected error occurred.";
            console.error(message);
            alertify.alert("Warning", message, function() {
                alertify.message('OK');
            });
        }
    });
        

    }
    function updateBudgetingDataF(){
        const form = document.getElementById('updateBudgetData');
        const formData = new FormData(form);
        formData.append('_token', '{{ csrf_token() }}');

    //     for (let [key, value] of formData.entries()) {
    //     console.log(key, value);
    // }

    $.ajax({
        type: "POST",
        url: "{{ route('liquidationDetailsData') }}" + '?process=' + 'updateBudgetingDataC',
        data: formData,
        contentType: false, // Important for file uploads
        processData: false, // Important for file uploads
        success: function(response) {
            console.log(response)
            document.getElementById('updateBudgetingData').style.display='none';
            getBudgetData();
            alertify.success(response.message);
        },
        error: function(xhr, status, error) {
            const message = xhr.responseJSON ? xhr.responseJSON.message : "An unexpected error occurred.";
            console.error(message);
            alertify.alert("Warning", message, function() {
                alertify.message('OK');
            });
        }
    });


    }
    function saveBudgeting(event) {
        const formData = new FormData();

        // Select all input elements within the tbody with id preloadTableCommittee
        const inputs = document.querySelectorAll('#preloadTableCommittee input');

        // Loop through the NodeList of inputs
        inputs.forEach(input => {
            // Append the input's name and value to the FormData object
            formData.append(input.name, input.value);
        });
    // Append the CSRF token to the FormData
    const ID = document.getElementById('liquidation_id').value
    const totals = document.getElementById('summary_total').value
    formData.append('_token', '{{ csrf_token() }}');
    formData.append('liquidation_id',ID);
    formData.append('summary_total',totals);

    $.ajax({
        type: "POST",
        url: "{{ route('liquidationDetailsData') }}" + '?process=' + 'saveBudgeting',
        data: formData,
        contentType: false, // Important for file uploads
        processData: false, // Important for file uploads
        success: function(response) {
            getBudgetData();
            getSaveTable();
            getLiquidationAllTotal()
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            // You can also add custom error handling here if needed
        }
    });
}

function removeDiv(id) {
    // Remove the specific div by ID
    const divToRemove = document.getElementById(id);
    if (divToRemove) {
        divToRemove.remove();
    }
}
let otherAutoIn = 1; // Initialize the row counter

function generateTable() {
    const div = document.getElementById('generateTable');
    const tableId = `table_${Date.now()}`; // Unique ID for each table

    div.innerHTML += `
        <form id="${tableId}Form">
            <div class="col-12 border mb-6" id="${tableId}">
                <div class="card-header">
                    <input type="text" class="form-control" placeholder="Enter Liquidation Title" name="liquidation_title">
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
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody_${tableId}">
                            <!-- Rows will be added here -->
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-right"><strong>TOTAL EXPENSES:</strong></td>
                                <td id="budgetTotal_${tableId}">0</td>
                            </tr>
                        </tfoot>
                    </table>
                    <button type="button" class="btn btn-warning col-12 m-2" style="width: 130px;" id="addFieldBtn_${tableId}">Add Field</button>
                </div>
                <input type="hidden" name="total_expenses" id="totalExpenses_${tableId}" value="0">
                <button type="submit" class="btn btn-primary col-12 m-2" style="width: 130px;">Save</button>
                <button onclick="removeDiv('${tableId}Form')" class="btn btn-danger col-12 m-2" style="width: 130px;">Remove</button>
            </div>
        </form>
    `;

    // Add event listener for the "Add Field" button
    const addFieldBtn = div.querySelector(`#addFieldBtn_${tableId}`);
    let staticaut;
    addFieldBtn.addEventListener('click', function() {
        const tableBody = div.querySelector(`#tableBody_${tableId}`);
        staticaut=otherAutoIn
        // Create a new row and its cells
        const newRow = document.createElement('tr');
        // When adding new rows in the table
        newRow.innerHTML = `
            <td><input type="date" class="form-control" name="date[${otherAutoIn}]"></td>
            <td><input type="text" class="form-control" placeholder="Supplier" name="supplier[${otherAutoIn}]"></td>
            <td>
                <div id='generatebox${otherAutoIn}'>
                    <div class="input-group mb-2">
                    <input type="text" class="form-control itemInput" placeholder="Item" name="items[${otherAutoIn}]">
                    <button type="button" class="btn btn-secondary addItemBtn" onclick="generateInput('generatebox${otherAutoIn}','${otherAutoIn}','${tableId}')">Add Item</button>
                    </div>
                    </div>
            </td>
            <td><input type="text" class="form-control" placeholder="Invoice / OR No." name="invoice_or_no[${otherAutoIn}]"></td>
            <td>
                <div class="input-group mb-2">
                    <input type="number" class="form-control amountInput" placeholder="Amount" name="amount[${otherAutoIn}]">
                </div>
            </td>
            <td><button type="button" class="btn btn-danger removeBtn">Remove</button></td>
        `;

        // Append the new row to the tbody
        tableBody.appendChild(newRow);

        // Update total expenses after adding the row
        updateTotal(tableId);

        // Add event listener for the remove button
        const removeBtn = newRow.querySelector('.removeBtn');
        removeBtn.addEventListener('click', function() {
            tableBody.removeChild(newRow);
            updateTotal(tableId);
        });

        // Add event listener for the add item button
        // const addItemBtn = newRow.querySelector('.addItemBtn');
        // addItemBtn.addEventListener('click', function() {
        //     const itemInputGroup = document.createElement('div');
        //     itemInputGroup.className = 'input-group mb-2';
        //     itemInputGroup.innerHTML = `
        //         <input type="text" class="form-control itemInput" placeholder="Item" name="items[${staticaut}]">
        //         <input type="number" class="form-control amountInput" placeholder="Amount" name="amount[${staticaut}]" value="0">
        //         <button type="button" class="btn btn-danger removeItemBtn">Remove</button>
        //     `;
        //     newRow.querySelector('td:nth-child(3)').appendChild(itemInputGroup);

        //     // Add event listener for the amount input change
        //     const newAmountInput = itemInputGroup.querySelector('.amountInput');
        //     newAmountInput.addEventListener('input', function() {
        //         updateTotal(tableId);
        //     });

        //     // Add event listener for removing an item input
        //     const removeItemBtn = itemInputGroup.querySelector('.removeItemBtn');
        //     removeItemBtn.addEventListener('click', function() {
        //         itemInputGroup.remove();
        //         updateTotal(tableId);
        //     });
        // });

        // Add event listener for the amount input change
        const amountInput = newRow.querySelector('.amountInput');
        amountInput.addEventListener('input', function() {
            updateTotal(tableId);
        });

        // Increment otherAutoIn after adding a new row
         otherAutoIn++;
        // Increment the counter
    });

    // Add event listener for the form submission
    const form = document.getElementById(`${tableId}Form`);
    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission
        const inputs = form.querySelectorAll('input');
    const values = {};

    // Collect and consolidate values for each name
    inputs.forEach(input => {
      const name = input.name;
      if (values[name]) {
        values[name] += `, ${input.value}`;
      } else {
        values[name] = input.value;
      }
    });

    // Convert consolidated values into FormData
    const formData = new FormData();
    for (const name in values) {
      formData.append(name, values[name]);
    }

    // Log the FormData
    // for (let pair of formData.entries()) {
    //   console.log(`${pair[0]}: '${pair[1]}'`);
    // }
        const ID = document.getElementById('liquidation_id').value
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('liquidation_id', ID);

        $.ajax({
            type: "POST",
            url: "{{ route('liquidationDetailsData') }}" + '?process=' + 'insertOtherSummary',
            data: formData,
            contentType: false, // Important for file uploads
            processData: false, // Important for file uploads
            success: function(response) {
                const div = document.getElementById('generateTable');
                div.innerHTML = ``;
                getSaveTable();
                getLiquidationAllTotal();
                alertify.success('Data SuccessFully Added');
                calculateResult2();
            },
            error: function(xhr, status, error) {
        const message = xhr.responseJSON ? xhr.responseJSON.message : "An unexpected error occurred.";
        console.error(message);
        alertify.alert("Warning", message, function() {
            alertify.message('OK');
        });
    }
        });
         calculateResult2();
    });
}

function calculateResult() {
            // // Get values from the inputs
            // const input1 = parseFloat(document.getElementById('coh').value) || 0;
            // const input2 = parseFloat(document.getElementById('cob').value) || 0;
            
            // // Calculate the result (e.g., addition)
            // const result = input1 + input2;
            
            // // Display the result
            // document.getElementById('tbb').value = result;

            // document.getElementById('coh2').value=0;
            // document.getElementById('cob2').value=0;
            const input1 = document.getElementById("coh");
            const input2 = document.getElementById("cob");
            const input3Value = parseFloat(document.getElementById("tbb").value);

            // Get the current values, defaulting to 0 if empty
            const input1Value = parseFloat(input1.value) || 0;
            const input2Value = parseFloat(input2.value) || 0;

            // Calculate the remaining allowable amount based on the limit
            const remaining = input3Value - (input1Value + input2Value);

            // Adjust the max values for input fields dynamically
            input1.max = input1Value + remaining >= 0 ? input1Value + remaining : input1Value;
            input2.max = input2Value + remaining >= 0 ? input2Value + remaining : input2Value;

            // Ensure neither input exceeds the allowable remaining amount
            if (input1Value + input2Value > input3Value) {
                if (document.activeElement === input1) {
                    input1.value = input1.max;
                } else if (document.activeElement === input2) {
                    input2.value = input2.max;
                }
            }
            calculateResult2()
        }
function calculateResult2() {
            // Get values from the inputs
            const input1 = parseFloat(document.getElementById('tbb').value) || 0;
            const input2 = parseFloat(document.getElementById('te').value) || 0;
            
            // Calculate the result (e.g., addition)
            const result =  input1 - input2 ;
            
            // Display the result
            document.getElementById('eb').value = result;
            if (result < 0) {
                document.getElementById('exceedWarning').style.display='';
            } else {
                document.getElementById('exceedWarning').style.display='none';
            }
}
function checkAndRestrictInput() {
            // Get input elements and their values
            const targetTotal = document.getElementById('eb').value
            const input1Element = document.getElementById('coh2');
            const input2Element = document.getElementById('cob2');
            const input1 = parseFloat(input1Element.value) || 0;
            const input2 = parseFloat(input2Element.value) || 0;

            // Calculate the current total
            const currentTotal = input1 + input2;

            // Check if the total exceeds the target total
            if (currentTotal > targetTotal) {
                // Restrict the input by resetting the last entered value
                if (input1Element === document.activeElement) {
                    input1Element.value = targetTotal - input2;
                } else if (input2Element === document.activeElement) {
                    input2Element.value = targetTotal - input1;
                }
                
            } else {
            }
        }
function getLiquidationAllTotal(){
    const liquidation_id = document.getElementById('liquidation_id').value;
    const formData = new FormData();
    formData.append('_token', '{{ csrf_token() }}');
    formData.append('liquidation_id', liquidation_id);

        $.ajax({
            type: "POST",
            url: "{{ route('liquidationDetailsData') }}" + '?process=' + 'getAllLiquidationTotal',
            data: formData,
            contentType: false, // Important for file uploads
            processData: false, // Important for file uploads
            success: function(response) {
                if(response.data == null||response.data==0){
                    document.getElementById('te').value = 0;
                }else{
                    document.getElementById('te').value = response.data;
                }
            },
            error: function(xhr, status, error) {
        const message = xhr.responseJSON ? xhr.responseJSON.message : "An unexpected error occurred.";
        console.error(message);
        alertify.alert("Warning", message, function() {
            alertify.message('OK');
        });
    }
        });
}
function saveFundAndDis(){
    const form =  document.getElementById('saveFundForm');
    const liquidation_id = document.getElementById('liquidation_id').value;
    const formData = new FormData(form);
    formData.append('_token', '{{ csrf_token() }}');
    formData.append('liquidation_id', liquidation_id);

     $.ajax({
            type: "POST",
            url: "{{ route('liquidationDetailsData') }}" + '?process=' + 'saveFund',
            data: formData,
            contentType: false, // Important for file uploads
            processData: false, // Important for file uploads
            success: function(response) {

                alertify.success(response.message);
            },
            error: function(xhr, status, error) {
        const message = xhr.responseJSON ? xhr.responseJSON.message : "An unexpected error occurred.";
        console.error(message);
        alertify.alert("Warning", message, function() {
            alertify.message('OK');
        });
    }
        });
}
function getFunds(){
    const liquidation_id = document.getElementById('liquidation_id').value;
    const formData = new FormData();
    formData.append('_token', '{{ csrf_token() }}');
    formData.append('liquidation_id', liquidation_id);

     $.ajax({
            type: "POST",
            url: "{{ route('liquidationDetailsData') }}" + '?process=' + 'getFund',
            data: formData,
            contentType: false, // Important for file uploads
            processData: false, // Important for file uploads
            success: function(response) {
                console.log(response)
                const data = response.data;
                if(data==null||data=='null'||data==''){

                }else{
                    
                document.getElementById('coh').value=data.coh
                document.getElementById('cob').value=data.cob
                document.getElementById('tbb').value=data.tbb
                document.getElementById('te').value=data.te
                document.getElementById('eb').value=data.eb
                document.getElementById('coh2').value=data.coh2
                document.getElementById('cob2').value=data.cob2
                }
            },
            error: function(xhr, status, error) {
        const message = xhr.responseJSON ? xhr.responseJSON.message : "An unexpected error occurred.";
        console.error(message);
        alertify.alert("Warning", message, function() {
            alertify.message('OK');
        });
    }
    });
}
function generateInput(boxid, name, tableId) {
    // Create and append CSS to the document head if it doesn't already exist
    // let style = document.getElementById('dynamic-styles');
    // if (!style) {
    //     style = document.createElement('style');
    //     style.id = 'dynamic-styles';
    //     style.innerHTML = `
    //         #${boxid} { /* Use the provided boxid for the container */
    //             width: 400px; /* Set a fixed width for the container */
    //             overflow: hidden; /* Prevent overflow */
    //         }

    //         .input-group2 {
    //             width: 100%; /* Ensure the input group takes the full width of the container */
    //             display: flex; /* Use flexbox for proper alignment */
    //             align-items: center; /* Align items vertically */
    //         }

    //         /* Styles for the input fields */
    //         .itemInput {
    //             width: 100%; /* Adjusted width for the item input */
    //         }

    //         .amountInput {
    //             width: 100%; /* Adjusted width for the amount input */
    //         }
    //     `;
    //     document.head.appendChild(style);
    // }

    console.log(name);
    const div = document.getElementById(boxid);
    const itemInputGroup = document.createElement('div');
    itemInputGroup.className = 'input-group mb-2';
    itemInputGroup.innerHTML = `
        <input type="text" class="form-control itemInput" placeholder="Item" name="items[${name}]">
        <input type="number" class="form-control amountInput" placeholder="Amount" name="amount[${name}]" value="0">
        <button type="button" class="btn btn-danger removeItemBtn">Remove</button>
    `;

    // Append the new item input group to the div
    div.appendChild(itemInputGroup);

    // Add event listener for the amount input change
    const newAmountInput = itemInputGroup.querySelector('.amountInput');
    newAmountInput.addEventListener('input', function() {
        updateTotal(tableId);
    });

    // Add event listener for removing an item input
    const removeItemBtn = itemInputGroup.querySelector('.removeItemBtn');
    removeItemBtn.addEventListener('click', function() {
        itemInputGroup.remove();
        updateTotal(tableId);
    });
}

// Function to update the total expenses
function updateTotal(tableId) {
    const budgetTotalCell = document.getElementById(`budgetTotal_${tableId}`);
    const totalExpensesInput = document.getElementById(`totalExpenses_${tableId}`);
    const amountInputs = document.querySelectorAll(`#${tableId} .amountInput`);

    let total = 0;
    amountInputs.forEach(input => {
        const value = parseFloat(input.value) || 0; // Convert input value to a number, default to 0 if empty
        total += value; // Sum up the amounts
    });

    budgetTotalCell.innerText = total.toFixed(2); // Display the total with two decimal places
    totalExpensesInput.value = total.toFixed(2); // Set the total in the hidden input for submission
}

function getSaveTable(){
    const formData = new FormData();
    const ID = document.getElementById('liquidation_id').value;
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('liquidation_id', ID);

        $.ajax({
            type: "POST",
            url: "{{ route('liquidationDetailsData') }}" + '?process=' + 'getSaveTable',
            data: formData,
            contentType: false, // Important for file uploads
            processData: false, // Important for file uploads
            success: function(response) {

            let summaryBody = document.getElementById('summaryBody');
            let totalSummary = document.getElementById('totalSummary');
            let htmlContents = '';  
            let grandTotal = 0;  // Initialize a variable to accumulate the total

            response.data.forEach(element => {
                // Convert element.data1.total to a number and add it to grandTotal
                const itemTotal = parseFloat(element.data1.total) || 0; // Handle potential NaN values
                grandTotal += itemTotal;

                htmlContents += `
                    <tr>
                        <td>${allDateStart} - ${allDateEnd}</td>
                        <td>${element.data1.name}</td>
                        <td>${itemTotal.toFixed(2)}</td>    
                    </tr>
                `;
            });

            // Insert the accumulated rows into summaryBody
            summaryBody.innerHTML = htmlContents;

            // Display the grand total in the totalSummary element
            totalSummary.textContent = grandTotal.toFixed(2);  

            const filteredData = response.data.filter(item => item.data1.name !== "Committee And Additional Expenses");
            let tableHtml = document.getElementById('generateSaveTable');
            let htmlContent = ''; // Store all HTML content here first
            let idAuto = 0;
            filteredData.forEach(element => {
                let totalExpenses = 0; // Initialize total expenses for each table

                const elementJson = JSON.stringify(element).replace(/"/g, '&quot;');
                const tableId = `xtable_${idAuto}`; // Unique ID for each table

                htmlContent += `
                    <div class="col-12 border mb-6" id="${tableId}">
                        <div class="card-header position-relative">
                            ${element.data1.name}
                            <button type="button" class="btn btn-primary position-absolute top-0 end-0 m-2" onclick="editTableData('${elementJson}','${tableId}')">Edit</button>
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
                                <tbody>
                `;
                
                element.data2.forEach(value => {
                    // Sum the numbers in the total string
                    const itemTotal = value.total
                        .split(',')              // Split the string by commas
                        .map(num => parseFloat(num) || 0) // Convert each part to a number
                        .reduce((sum, num) => sum + num, 0); // Sum the numbers

                    totalExpenses += itemTotal;

                    htmlContent += `
                        <tr>
                            <td>${value.bdate}</td>
                            <td>${value.supplier}</td>
                            <td>${value.item.split(',').join('<br>')}</td>
                            <td>${value.invoice}</td>
                            <td>${value.total.split(',').join('<br>')}</td>
                        </tr>
                    `;
                });

                // Insert totalExpenses in the table footer
                htmlContent += `
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4" class="text-right"><strong>TOTAL EXPENSES:</strong></td>
                                        <td>${totalExpenses.toFixed(2)}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                `;
                idAuto++;
            });

            // Add all HTML at once
            tableHtml.innerHTML = htmlContent;
            calculateResult2();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                // You can also add custom error handling here if needed
            }
        });
         calculateResult2();
         getLiquidationAllTotal();
}
function editTableData(data, id) {
    // Check if `data` is a string, and parse it if so
    if (typeof data === "string") {
        data = JSON.parse(data);
    }
    console.log(data)
    let div = ``;

    // Input for the title
    div += `
    <form id="${id}_E">
        <div class="card-header position-relative">
            <input name="dataID" value="${data.data1.id}" hidden>
            <div class="input-group mb-2">
                <input name="liquidation_title" class="form-control" value="${data.data1.name}">
                <button type="button" class="btn btn-danger" onclick="deleteSummaryRecord('${data.data1.id}')">Delete</button>
            </div>
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
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody id="${id}_B">
    `;

    // Counter for group numbers
    let groupCounter = 1;

    data.data2.forEach(value => {
        // Split the total string and items string into arrays
        const amounts = value.total.split(',').map(num => num.trim());
        const items = value.item.split(',').map(item => item.trim());

        // Create input fields for each amount, with the unique `group[n]` in the name
        const amountInputs = amounts.map((amount, index) => `
            <input type="number" name="group[${groupCounter}][amount][${index}]" class="form-control" value="${amount}" oninput="updateTotalExpenses('${id}_B')">
        `).join('');

        // Create input fields for each item, with the unique `group[n]` in the name
        const itemInputs = items.map((item, index) => `
            <input type="text" name="group[${groupCounter}][item][${index}]" class="form-control" value="${item}">
        `).join('');

        div += `
            <tr>
                <td><input type="date" name="group[${groupCounter}][bdate]" class="form-control" value="${value.bdate}"></td>
                <td><input type="text" name="group[${groupCounter}][supplier]" class="form-control" value="${value.supplier}"></td>
                <td>${itemInputs}</td>
                <td><input type="text" name="group[${groupCounter}][invoice]" class="form-control" value="${value.invoice}"></td>
                <td>${amountInputs}</td>
                <td><button type="button" class="btn btn-danger" onclick="deleteOtherSummaryRow('${value.id}')">Remove</button></td>
            </tr>
        `;

        groupCounter++;
    });

    // Handle total expenses input
    const totalAmounts = data.data1.total.split(',').map(num => num.trim());
    const totalInputs = totalAmounts.map((total, index) => `
        <input type="text" name="total_expenses[${index}]" class="form-control" value="${total}" readonly>
    `).join('');

    div += `
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-right"><strong>TOTAL EXPENSES:</strong></td>
                        <td>${totalInputs}</td>
                    </tr>
                </tfoot>
            </table>
            <button type="button" class="btn btn-primary col-12 mb-2" onclick="addTrBody('${id}_B')">Add Field</button>
            <button type="button" class="btn btn-primary col-12 mb-2" onclick="saveEditedTable('${id}_E')">Save</button>
            <button type="button" class="btn btn-danger col-12" onclick="getSaveTable()">Cancel</button>
        </div>
    </form>
    `;

    document.getElementById(id).innerHTML = div;

    console.log("Full Data:", data);
}
function deleteSummaryRecord(id){
     const formData = new FormData();
formData.append('_token', '{{ csrf_token() }}');  // Ensure this is used in a Blade template
    formData.append('dataID', id);

    $.ajax({
        type: "POST",
        url: "{{ route('liquidationDetailsData') }}" + '?process=' + 'deleteSummaryRecord',
        data: formData,
        contentType: false, // Important for file uploads
        processData: false, // Important for file uploads
        success: function(response) {
            console.log(response)
           getSaveTable();
           calculateResult2();
           alertify.alert("Message", response.message, function() {
                alertify.message('OK');
                calculateResult2();
            });
            calculateResult2();
        },
        error: function(xhr, status, error) {
            const message = xhr.responseJSON ? xhr.responseJSON.message : "An unexpected error occurred.";
            console.error(message);
            alertify.alert("Warning", message, function() {
                alertify.message('OK');
            });
        }
    });
}
// Function to update total expenses
function updateTotalExpenses(tableId) {
    const table = document.getElementById(tableId);
    let totalExpenses = 0;

    // Loop through all the amount inputs in the table and sum them up
    const amountInputs = table.querySelectorAll('input[type="number"]');
    amountInputs.forEach(input => {
        if (input.value) {
            totalExpenses += parseFloat(input.value) || 0; // Add input value to total
        }
    });

    // Update total expenses input fields
    const totalInputs = document.querySelectorAll(`input[name^="total_expenses"]`);
    totalInputs.forEach(totalInput => {
        totalInput.value = totalExpenses.toFixed(2); // Set the total expenses with 2 decimal points
    });
}

function addTrBody(id) {
    const table = document.getElementById(id);
    const currentRows = table.getElementsByTagName("tr").length;
    const groupCounter = currentRows + 1;

    const newRow = `
    <tr>
        <td><input type="date" name="group[${groupCounter}][bdate]" class="form-control"></td>
        <td><input type="text" name="group[${groupCounter}][supplier]" class="form-control"></td>
        <td>
            <div id="item-container-${groupCounter}">
                <div class="input-group mb-2">
                <input type="text" name="group[${groupCounter}][item][0]" class="form-control" placeholder="Item">
                <button type="button" class='btn btn-success' onclick="addItemField(${groupCounter}, '${id}')">Add Item</button>
                </div>
            </div>
        </td>
        <td><input type="text" name="group[${groupCounter}][invoice]" class="form-control"></td>
        <td><input type="number" name="group[${groupCounter}][amount][0]" class="form-control" placeholder="Total Amount" oninput="updateTotalExpenses('${id}')"></td>
        <td><button type="button" class='btn btn-danger' onclick="removeRow(this)">Remove</button></td>
    </tr>
    `;

    table.insertAdjacentHTML("beforeend", newRow);
}
function removeRow(button) {
    // Get the row to remove
    const row = button.closest('tr');
    // Remove the row from the table
    if (row) {
        row.remove();
        // Optionally, call updateTotalExpenses if you want to recalculate the total expenses after a row is removed
        const tableId = row.closest('tbody').id; // Get the table body id
        updateTotalExpenses(tableId);
    }
}
function addItemField(groupCounter, id) {
    const itemContainer = document.getElementById(`item-container-${groupCounter}`);
    const currentItemCount = itemContainer.querySelectorAll('input[type="text"]').length;

    const newItem = `
        <div class="input-group mb-2 item-field">
            <input type="text" name="group[${groupCounter}][item][${currentItemCount}]" class="form-control" placeholder="Item">
            <input type="number" name="group[${groupCounter}][amount][${currentItemCount}]" class="form-control" placeholder="Amount" oninput="updateTotalExpenses('${id}')">
            <button type="button" class='btn btn-danger' onclick="removeItemField(this)">Remove</button>
        </div>
    `;

    itemContainer.insertAdjacentHTML("beforeend", newItem);
}
function removeItemField(button) {
    const itemField = button.closest('.item-field');
    if (itemField) {
        itemField.remove();
        // Optionally, update total expenses if necessary
        const tableId = button.closest('table').id; // Get the table id
        updateTotalExpenses(tableId);
    }
}
function deleteOtherSummaryRow(id){
    const formData = new FormData();
formData.append('_token', '{{ csrf_token() }}');  // Ensure this is used in a Blade template
    formData.append('dataID', id);

    $.ajax({
        type: "POST",
        url: "{{ route('liquidationDetailsData') }}" + '?process=' + 'deleteRow',
        data: formData,
        contentType: false, // Important for file uploads
        processData: false, // Important for file uploads
        success: function(response) {
            console.log(response)
           getSaveTable();
           alertify.alert("Message", response.message, function() {
                alertify.message('OK');
            });
            calculateResult2();
        },
        error: function(xhr, status, error) {
            const message = xhr.responseJSON ? xhr.responseJSON.message : "An unexpected error occurred.";
            console.error(message);
            alertify.alert("Warning", message, function() {
                alertify.message('OK');
            });
        }
    });

}
function saveEditedTable(formId) {
    const form = document.getElementById(formId);

    // Check if the form exists
    if (!form) {
        console.error('Form not found');
        return;
    }

    const formData = new FormData(form);
    const data = {};

    formData.forEach((value, key) => {
        // If the key already exists in the data object, convert it to an array
        if (data[key]) {
            // Check if it's already an array
            if (!Array.isArray(data[key])) {
                data[key] = [data[key]];
            }
            data[key].push(value); // Add the new value to the array
        } else {
            data[key] = value; // Otherwise, add the key-value pair
        }
    });

    // Serialize form data to JSON
    const json = JSON.stringify(data);
    console.log("Serialized Form Data as JSON:", json);

    // Get CSRF token and liquidation ID only once
    const ID = document.getElementById('liquidation_id')?.value;
    if (!ID) {
        console.error('Liquidation ID not found');
        return;
    }

    formData.append('_token', '{{ csrf_token() }}');  // Ensure this is used in a Blade template
    formData.append('liquidation_id', ID);

    $.ajax({
        type: "POST",
        url: "{{ route('liquidationDetailsData') }}" + '?process=' + 'updateOtherSummary',
        data: formData,
        contentType: false, // Important for file uploads
        processData: false, // Important for file uploads
        success: function(response) {
           getSaveTable();
           calculateResult2();
        },
        error: function(xhr, status, error) {
            const message = xhr.responseJSON ? xhr.responseJSON.message : "An unexpected error occurred.";
            console.error(message);
            alertify.alert("Warning", message, function() {
                alertify.message('OK');
            });
        }
    });
    calculateResult2();
}

function AddReceipt() {
    const receipt = document.getElementById('receipt-pic').files[0]; // Get the file object
    const l_id = document.getElementById('liquidation_id').value;

    const formData = new FormData();
    formData.append('_token', '{{ csrf_token() }}');
    formData.append('receipt', receipt); // Append the file correctly
    formData.append('id', l_id);

    $.ajax({
        url: `{{route('AddReceipt')}}`, // Ensure the route is correct
        type: 'POST',
        data: formData,
        contentType: false, // Required for FormData
        processData: false, // Prevent jQuery from processing data
        success: function(response) {
            getLiquidationData();
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        },
    });
}
const queryString = window.location.search;

    // Parse the query string
const urlParams = new URLSearchParams(queryString);

    // Get a specific parameter by name
const liqu_id = urlParams.get('liquidation_id');

    function getLiquidationReceipt(){
        $.ajax({
            url: "{{route('getLiquidationReceipt')}}",
            type: "get",
            data: {id: liqu_id},
            success: function(data) {
                console.log(data)
        const previewContainer = $('#preview-container'); // Assume you have a container for previews
        previewContainer.empty(); // Clear previous content

        if (data.length > 0) {
            const card = document.getElementById('cards');
            card.innerHTML = ''; // Clear existing cards

            data.forEach(file => {
                const fileName = file.liq_receipt;
                const cleanedFileName = fileName.replace(/^1_/, ''); // Remove the prefix "1_"
                const fileType = cleanedFileName.split('.').pop().toLowerCase(); // Get file extension
                const fileURL = `/party_image/${fileName}`;  // Adjust the path to your file storage

                // Create a card for each file
                let cardContent = `
                    <div class="card m-2" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">${cleanedFileName}</h5>
                            <p class="card-text">File type: ${fileType}</p>
                `;

                // Display content based on file type
                if (['jpg', 'jpeg', 'png', 'gif', 'ico'].includes(fileType)) {
                    cardContent += `<img src="${fileURL}" class="card-img-top" alt="${fileName}">`;
                } else if (['mp4', 'webm', 'ogg'].includes(fileType)) {
                    cardContent += `
                        <video class="card-img-top" controls>
                            <source src="${fileURL}" type="video/${fileType}">
                            Your browser does not support the video tag.
                        </video>
                    `;
                } else if (fileType === 'pdf') {
                    cardContent += `<img src="/compendium_file/icons/pdf-icon.png" class="card-img-top" alt="PDF Document">`;
                } else if (['doc', 'docx'].includes(fileType)) {
                    cardContent += `<img src="/compendium_file/icons/doc-icon.png" class="card-img-top" alt="Word Document">`;
                } else if (['xls', 'xlsx'].includes(fileType)) {
                    cardContent += `<img src="/compendium_file/icons/xls-icon.png" class="card-img-top" alt="Excel File">`;
                } else {
                    cardContent += `<img src="https://via.placeholder.com/150?text=Unsupported" class="card-img-top" alt="Unsupported File">`;
                }

                // Adding View/Download and Delete buttons
                cardContent += `
                            <div class="d-flex justify-content-between mt-2">
                                <a href="${fileURL}" class="btn btn-primary" target="_blank">View / Download</a>
                                <button class="btn btn-danger delete-btn" data-id="${file.id}">Delete</button>
                            </div>
                        </div>
                    </div>
                `;

                // Append the card content
                card.innerHTML += cardContent;
            });

            // Attach click event for delete buttons
            $('.delete-btn').on('click', function() {
                const fileId = $(this).data('id');
                deleteFile(fileId);
            });
        } else {
            const card = document.getElementById('cards');
            card.innerHTML = '';
            card.innerHTML += `<div class="empty">
                    <div class="empty-img"><img src="./static/illustrations/undraw_voting_nvu7.svg" height="128" alt="">
                    </div>
                    <p class="empty-title">No Liquidation Receipt Available</p>
                    <p class="empty-subtitle text-secondary">
                    </p>
                  </div>`;
        }
    },
    error: function(xhr, status, error) {
        console.error('AJAX Error:', status, error);
        $('#result').html('<p>Error fetching data.</p>'); // Display an error message
    }
});

    }

    $(document).ready(function() {
        getLiquidationEvent();
        getLiquidationData();
        getSaveTable();
        getLiquidationAllTotal();
        getFunds();
        getLiquidationReceipt()
    });
</script>

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
