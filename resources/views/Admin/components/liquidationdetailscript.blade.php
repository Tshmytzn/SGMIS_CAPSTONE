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

                document.getElementById('CommitteDateAll').textContent=response.data.event_start+'-'+response.data.event_end
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
            document.getElementById('committeTotL').textContent= (budgetTotal + otherTotal).toFixed(2);
            document.getElementById('summary_total').value= (budgetTotal + otherTotal).toFixed(2);
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                // You can also add custom error handling here if needed
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
            getBudgetData()
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            // You can also add custom error handling here if needed
        }
    });
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
                    <button type="button" class="btn btn-primary" id="addFieldBtn_${tableId}">Add Field</button>
                </div>
                <input type="hidden" name="total_expenses" id="totalExpenses_${tableId}" value="0">
                <button type="submit" class="btn btn-primary col-12">Save</button>
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
                <div class="input-group mb-2" id='generatebox${otherAutoIn}'>
                    <input type="text" class="form-control itemInput" placeholder="Item" name="items[${otherAutoIn}]">
                    <button type="button" class="btn btn-secondary addItemBtn" onclick="generateInput('generatebox${otherAutoIn}','${otherAutoIn}','${tableId}')">Add Item</button>
                </div>
            </td>
            <td><input type="text" class="form-control" placeholder="Invoice / OR No." name="invoice_or_no[${otherAutoIn}]"></td>
            <td>
                <div class="input-group mb-2">
                    <input type="number" class="form-control amountInput" placeholder="Amount" name="amount[${otherAutoIn}]">
                </div>
            </td>
            <td><button type="button" class="btn btn-danger btn-sm removeBtn">Remove</button></td>
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
    for (let pair of formData.entries()) {
      console.log(`${pair[0]}: '${pair[1]}'`);
    }
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
                console.log(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                // You can also add custom error handling here if needed
            }
        });
    });
}
function generateInput(boxid, name, tableId) {
    // Create and append CSS to the document head if it doesn't already exist
    let style = document.getElementById('dynamic-styles');
    if (!style) {
        style = document.createElement('style');
        style.id = 'dynamic-styles';
        style.innerHTML = `
            #${boxid} { /* Use the provided boxid for the container */
                width: 400px; /* Set a fixed width for the container */
                overflow: hidden; /* Prevent overflow */
            }

            .input-group2 {
                width: 100%; /* Ensure the input group takes the full width of the container */
                display: flex; /* Use flexbox for proper alignment */
                align-items: center; /* Align items vertically */
            }

            /* Styles for the input fields */
            .itemInput {
                width: 100%; /* Adjusted width for the item input */
            }

            .amountInput {
                width: 100%; /* Adjusted width for the amount input */
            }
        `;
        document.head.appendChild(style);
    }

    console.log(name);
    const div = document.getElementById(boxid);
    const itemInputGroup = document.createElement('div');
    itemInputGroup.className = 'input-group2 mb-2';
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
    $(document).ready(function() {
        getLiquidationData();
        getLiquidationEvent()
    });
</script>
