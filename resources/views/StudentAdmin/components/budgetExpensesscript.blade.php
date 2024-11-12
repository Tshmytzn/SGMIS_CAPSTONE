<script>
    let allTotal = '';

    function loadBudgetDataTable() {
        var formElement = document.getElementById('getBudgetDateForm');
        var formData = new FormData(formElement);
        // Append the CSRF token to the FormData
        formData.append('_token', '{{ csrf_token() }}');

        // Send the AJAX request
        $.ajax({
            type: "POST",
            url: "{{ route('mealProcess') }}" + '?process=' + 'get2',
            data: formData,
            contentType: false, // Important for file uploads
            processData: false, // Important for file uploads
            success: function(response) {
                console.log(response)
                const com = document.getElementById('committeeMealTableBody');
                let no = 1;
                let summa = ''
                // Initialize grand total
                let grandTotal = 0;

                response.data.forEach(element => {
                    // Append the first row with meal date and date length
                    com.innerHTML += `
        <tr>
            <td colspan="5">${element.meal_date} (${element.date_length})</td>
        </tr>
    `;

                    // Initialize total for the entire meal_date
                    let mealDateTotal = 0;

                    element.meal_date_data.forEach(committee => {
                        // Count the number of members in the committee
                        const memberCount = committee.committee_members.length;

                        // Create a numbered list for members with their details (name and affiliation)
                        let memberNames = '<ol class="members-list">';
                        committee.committee_members.forEach((member) => {
                            memberNames += `<li>${member.member_name}</li>`;
                        });
                        memberNames += '</ol>';

                        // Insert the table row with committee information
                        com.innerHTML += `
            <tr class="tryellow">
                <td>${no}</td>
                <td></td>
                <td>${committee.committee_name}<br>${memberNames}</td>
                <td></td>
                <td></td>
            </tr>
        `;

                        // Initialize a total for this particular committee
                        let committeeTotal = 0;

                        // Check if 'meal' array exists for the committee
                        if (committee.meal && committee.meal.length > 0) {
                            committee.meal.forEach(item => {
                                // Calculate total for each meal (assuming price * memberCount)
                                let mealTotal = item.price * memberCount;
                                committeeTotal +=
                                mealTotal; // Accumulate committee total
                            });

                            // Display meals and their totals
                            committee.meal.forEach(item => {
                                com.innerHTML += `
                    <tr>
                        <td></td>
                        <td>${memberCount}</td> <!-- Member count displayed in pax -->
                        <td>${item.meal}</td>
                        <td>${item.price}</td>
                        <td>${(item.price * memberCount).toFixed(2)}</td> <!-- Display meal total price -->
                    </tr>
                `;
                            });
                        }

                        // Add committee's total to the meal date total
                        mealDateTotal += committeeTotal;

                        // Increment the committee counter
                        no++;
                    });

                    // After all committees for this meal date, display the meal date total
                    com.innerHTML += `
        <tr>
            <td colspan="5">Total for ${element.date_length}: ${mealDateTotal.toFixed(2)}</td>
        </tr>
    `;
                    summa += `<tr>
            <td>${element.date_length}</td>
            <td>${mealDateTotal.toFixed(2)}</td>
            </tr>`
                    // Add meal date total to grand total
                    grandTotal += mealDateTotal;
                });

                const other = document.getElementById('committeeMealTableBody2');
                com.innerHTML += `
        <tr>
            <td colspan="5">Additional Expenses</td>
        </tr>
    `;
                let otherNo = 1;
                let subtotal = 0;

                response.data2.forEach(expense => {
                    // Ensure total is treated as a number for the addition
                    const expenseTotal = parseFloat(expense.total);

                    com.innerHTML += `
        <tr>
            <td>${otherNo}</td>
            <td>${expense.quantity}</td>
            <td>${expense.description}</td>
            <td>${expense.price}</td>
            <td>${expenseTotal.toFixed(2)}</td>
        </tr>
    `;

                    // Add the total expense to subtotal
                    subtotal += expenseTotal;
                    otherNo++;
                });

                // Add the final row showing the subtotal of additional expenses
                com.innerHTML += `
    <tr>
       <td colspan="5">Additional Expenses: ${subtotal.toFixed(2)}</td>
    </tr>
`;
                summa += `<tr>
        <td>Additional Expenses</td>
        <td>${subtotal.toFixed(2)}</td>
        </tr>`
                // Calculate grand total and display it
                grandTotal += subtotal; // Include subtotal in grand total
                com.innerHTML += `
    <tr class="trgreeen">
        <td colspan="5"><strong>Overall Total: ${grandTotal.toFixed(2)}</strong></td>
    </tr>
`;
                allTotal = grandTotal.toFixed(2);
                summa += `<tr class="trgreeen">
        <td>Overall Total</td>
        <td>${grandTotal.toFixed(2)}</td>
        </tr>`

                const summary = document.getElementById('committeeMealTableBody3');
                summary.innerHTML += ` <tr >
        <td colspan="5">TOTAL BUDGET SUMMARY</td>
    </tr>`
                summary.innerHTML += summa;

            // saveTotal("<?php echo $budget->id; ?>")
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                // You can also add custom error handling here if needed
            }
        });
    }
    document.getElementById('download').addEventListener('click', () => {
        window.print();
    });

    // function saveTotal(id) {
    //     var formData = new FormData();
    //     // Append the CSRF token to the FormData
    //     formData.append('_token', '{{ csrf_token() }}');
    //     formData.append('id', id);
    //     formData.append('total', allTotal);
    //     // Send the AJAX request
    //     $.ajax({
    //         type: "POST",
    //         url: "{{ route('saveBudgetTotal') }}",
    //         data: formData,
    //         contentType: false, // Important for file uploads
    //         processData: false, // Important for file uploads
    //         success: function(response) {
    //             console.log(response)
    //         },
    //         error: function(xhr, status, error) {
    //             console.error(xhr.responseText);
    //             // You can also add custom error handling here if needed
    //         }
    //     });
    // }
    $(document).ready(function() {
        loadBudgetDataTable()
    });
</script>
