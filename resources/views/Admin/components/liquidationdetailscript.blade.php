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
                console.log(response)
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
                console.log(response)
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
        console.log(event_id)
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
                console.log(response)
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
            console.log(response);
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            // You can also add custom error handling here if needed
        }
    });
}

function generateTable(){
    const div = document.getElementById('generateTable');
    div.innerHTML+=`
                                <div class="col-12 border mb-6">
                                    <div class="card-header">
                                        Committee And Additional Expenses
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
                                        <tbody id="">
                                            <input type="text" name="summary_total" id="summary_total"  value="">
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="4" class="text-right"><strong>TOTAL EXPENSES:</strong></td>
                                                <td id="budgetTotal"></td> <!-- This can be calculated dynamically if needed -->
                                            </tr>
                                        </tfoot>
                                    </table>
                                    </div>
                                    <button class="btn btn-primary col-12">Save</button>
                                </div>
    `
}

    $(document).ready(function() {
        getLiquidationData();
        getLiquidationEvent()
    });
</script>
