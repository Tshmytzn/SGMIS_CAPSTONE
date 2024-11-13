<script>
    function updateEventDetails() {
        const selectElement = document.getElementById('budgetEvent');
        const selectedOption = selectElement.options[selectElement.selectedIndex];

        // Get start and end dates from data attributes
        const startDate = selectedOption.getAttribute('data-start');
        const endDate = selectedOption.getAttribute('data-end');

        // Set values in the respective input fields
        document.getElementById('budgetPeriodStart').value = startDate;
        document.getElementById('budgetPeriodEnd').value = endDate;

        // Calculate number of days
        const start = new Date(startDate);
        const end = new Date(endDate);
        const timeDiff = end - start;
        const numberOfDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); // Convert milliseconds to days

        document.getElementById('BudgetDays').value = numberOfDays + ' Days';
    }

    function validateForm(formId) {
        let isValid = true;
        let errorMessage = "Please fill out the following fields:\n";

        let formElement = document.getElementById(formId);

        $(formElement).find('input[required], textarea[required], select[required]').each(function() {
            if ($(this).val().trim() === '') {
                isValid = false;
                errorMessage += "- " + $(this).prev('label').text() + "\n";
            }
        });

        let budgetEvent = document.getElementById('budgetEvent');
        if (budgetEvent && budgetEvent.value === "Select Event") {
            isValid = false;
            errorMessage += "- Associated Event (Please select an event)\n";
        }

        if (!isValid) {
            alertify.alert("Form Incomplete", errorMessage, function() {
                alertify.message('Please fill all the required fields.');
            });
        }

        return isValid;
    }


    function createBudgetProposal(formId) {

        if (!validateForm(formId)) {
            return;
        }

        var formElement = document.getElementById(formId);
        var formData = new FormData(formElement); // Create a FormData object from the form element
        formData.append('_token', '{{ csrf_token() }}');

        $.ajax({
            type: "POST",
            url: '{{ route('getBudgetProposal') }}',
            data: formData,
            contentType: false, // Important for file uploads
            processData: false, // Important for file uploads
            success: function(response) {
                location.reload();
                if (response.status == 'error') {
                    alertify.alert("Warning", response.message, function() {
                        alertify.message('OK');
                    });
                } else {
                    formElement.reset();
                    $('#' + response.modal).modal('hide');
                    alertify.alert("Message", response.message, function() {
                        alertify.message('OK');
                    });
                    if (response.reload && typeof window[response.reload] === 'function') {
                        window[response.reload]();
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    function getBudgetingDetails() {

        var formData = new FormData();

        formData.append('process', 'get');
        formData.append('_token', '{{ csrf_token() }}');

        $.ajax({
            url: "{{ route('getBudgetProposal') }}",
            method: 'POST',
            dataType: 'json',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response)
                var budgetcard = document.getElementById('budgetingcard');
                budgetcard.innerHTML = ``;
                if (response.data.length === 0) {
                    budgetcard.innerHTML = `
                    <div class="empty">
                        <div class="empty-img"><img src="./static/photos/undraw_my_documents_re_13dc.svg"
                                height="128" alt="">
                        </div>
                        <p class="empty-title">Budget Proposals Not Available</p>
                        <p class="empty-subtitle text-muted">
                        Looks like there are no budget proposals at the moment. Once proposals are submitted, you can review them here.                        </p>
                        <div class="empty-action">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#budgetProposalModal">
                                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>
                                Stay tuned!
                            </button>
                        </div>
                    </div>
                    `;

                } else {

                    const usertype = "<?php echo $usertype; ?>"; // Embed the PHP variable here

// Your JavaScript function
response.data.forEach(function(item, index) {
    // Build the initial card HTML structure
    let cardHTML = `
        <div class="col-md-6 col-lg-3">
            <div class="card">
                <div class="img-responsive img-responsive-21x10 card-img-top m-0"
                     style="background-image: url(./static/photos/Statistics.svg); background-size: cover; background-position: center;">
                </div>
                <div class="card-body p-0 m-0">
                    <h3 class="card-title text-center mb-2">${item.title}</h3>
                </div>
                <div class="d-flex">`;

    // Conditionally add content based on user type
    if (usertype === 'USG PRESIDENT' || usertype === 'USG SECRETARY'|| usertype === 'USG SENATE PRESIDENT'|| usertype === 'USG SENATE SECRETARY') {
        cardHTML += `
            <a href="/Budgeting/Expense/${item.id}" class="card-btn">
                View
            </a>`;
    }else if(usertype === 'USG BUDGET&FINANCE'){
        cardHTML += `
            <a href="/Budgeting/Details/${item.id}" class="card-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                    <path d="M16 5l3 3" />
                </svg>
                Edit
            </a>`;
    } else {
        cardHTML += `
            <a href="/Budgeting/Details/${item.id}" class="card-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                    <path d="M16 5l3 3" />
                </svg>
                Edit
            </a>`;
    }

    // Close the remaining tags
    cardHTML += `
                </div>
            </div>
        </div>`;

    // Append the entire card HTML for each item
    budgetcard.innerHTML += cardHTML;
});


                }

            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Error: " + textStatus + " " + errorThrown);
            }
        });
    }
// <a href="#" onclick="deleteBudgetProposal('${item.id}')" class="card-btn">
//                                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
//                                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
//                                         stroke-linecap="round" stroke-linejoin="round"
//                                         class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
//                                         <path stroke="none" d="M0 0h24v24H0z" fill="none" />
//                                         <path d="M4 7l16 0" />
//                                         <path d="M10 11l0 6" />
//                                         <path d="M14 11l0 6" />
//                                         <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
//                                         <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
//                                     </svg>
//                                     Delete
//                                 </a>
    function BudgetProposal(formId) {


        var formElement = document.getElementById(formId);
        var formData = $(formElement).serialize();

        $.ajax({
            type: "POST",
            url: '{{ route('getBudgetProposal') }}',
            data: formData,
            success: function(response) {
                if (response.status == 'error') {
                    alertify.alert("Warning", response.message, function() {
                        alertify.message('OK');
                    });
                } else {
                    formElement.reset();
                    $('#' + response.modal).modal('hide');
                    alertify.alert("Message", response.message, function() {
                        alertify.message('OK');
                    });
                    if (response.reload && typeof window[response.reload] === 'function') {
                        window[response.reload]();
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }


    function deleteBudgetProposal(id) {
        alertify.confirm(
            'Delete Budget Proposal',
            'Are you sure you want to delete this budget proposal?',
            function() {

                console.log(id);
                document.getElementById('budget_id').value = id;
                BudgetProposal('deleteBudgetProposalForm');
            },
            function() {

                alertify.error('Deletion Cancelled');
            }
        );
    }


    $(document).ready(function() {
        getBudgetingDetails()
    });
</script>
