<script>
    let i = 1; // Global counter for committee rows

    function addCommentteeField() {
        var commentteeField = document.getElementById("committeeTable2");

        // Create a new div for the committee row
        var committeeRow = document.createElement('div');
        committeeRow.className = "row border p-2 rounded mb-3";
        committeeRow.id = `committeeRow${i}`;

        // Create the inner HTML structure
        committeeRow.innerHTML = `
        <div class="col-3">
            <input type="text" class="form-control"
                name="committee[${i}][name]"
                placeholder="Enter committee name"
                value="" required>
                </div>
                <div class="col-6">
                    <div id="committeeInput${i}">
                        <div class="row mb-2">
                        <div class="col-6">
                    <input type="text" class="form-control" name="committee[${i}][members][${i}][name]" placeholder="Enter head(s)" required>
                </div>
                <div class="col-4">
                    <select class="form-control" name="committee[${i}][members][${i}][role]">
                        <option value="Head">Head</option>
                        <option value="Member">Member</option>
                    </select>
                </div>
            </div>
            </div>
            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-primary col-12" onclick="addcommitteeInput(${i})">Add Member</button>
            </div>
        </div>
        <div class="col-3">
            <button type="button" class="btn btn-danger col-12" onclick="removeCommittee('committeeRow${i}')">Remove Committee</button>
        </div>
    `;

        // Append the new committee row to the committee table
        commentteeField.appendChild(committeeRow);
        i++; // Increment the counter for the next row
    }
    let e = 2;

    function addcommitteeInput(committeeIndex) {
        // Locate the div where person-in-charge inputs will be added
        var committeeInput = document.getElementById(`committeeInput${committeeIndex}`);

        // Create a new div for the person input fields
        var personInput = document.createElement('div');
        personInput.className = "row mb-2";
        personInput.id = `personInput${e}`;

        // Create the inner HTML structure for person input
        personInput.innerHTML = `
        <div class="col-6">
            <input type="text" class="form-control" name="committee[${committeeIndex}][members][${e}][name]" placeholder="Enter head(s)" required>
        </div>
        <div class="col-4">
            <select class="form-control" name="committee[${committeeIndex}][members][${e}][role]">
                <option value="Head">Head</option>
                <option value="Member">Member</option>
            </select>
        </div>
        <div class="col-2 text-center">
            <button type="button" class="btn btn-danger" onclick="removecommitteeInput('personInput${e}')">
                &nbsp;&nbsp;&nbsp;<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-circle-minus">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                    <path d="M9 12l6 0" />
                </svg>
            </button>
        </div>
    `;

        // Append the new person input fields to the committee input div
        committeeInput.appendChild(personInput);
        e++;
    }

    function removecommitteeInput(committeeId) {
        // Locate and remove the entire committee row
        var element = document.getElementById(committeeId);
        if (element) {
            element.remove(); // Removes the entire committee row
        } else {
            console.log("Committee row not found.");
        }
    }

    function removeCommittee(committeeId) {
        // Locate and remove the entire committee row
        var element = document.getElementById(committeeId);
        if (element) {
            element.remove(); // Removes the entire committee row
        } else {
            console.log("Committee row not found.");
        }
    }

    function addComitteeData(formId, routeUrl, process) {

        validateCommittees()
        if (validateCommittees()) {
            document.getElementById('adminloader').style.display = 'grid';
            // Create a new FormData object from the form
            var formElement = document.getElementById(formId);
            var formData = new FormData(formElement);

            // Append the CSRF token to the FormData
            formData.append('_token', '{{ csrf_token() }}');

            // Send the AJAX request
            $.ajax({
                type: "POST",
                url: routeUrl + '?process=' + process,
                data: formData,
                contentType: false, // Important for file uploads
                processData: false, // Important for file uploads
                success: function(response) {
                    document.getElementById('adminloader').style.display = 'none';
                    if (response.status == 'error') {
                        alertify
                            .alert("Warning", response.message, function() {
                                alertify.message('OK');
                            });
                    } else {

                        document.getElementById(formId).reset();
                        $('#' + response.modal).modal('hide');
                        alertify
                            .alert("Message", response.message, function() {
                                alertify.message('OK');

                            });
                        if (response.reload && typeof window[response.reload] === 'function') {
                            window[response.reload](); // Safe dynamic function call
                            loadBudgetDataTable()
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    // You can also add custom error handling here if needed
                }
            });
        }
    }

    function validateCommittees() {
        // Get all committee name inputs
        let isValid;
        const committeeNames = document.querySelectorAll("input[name^='committee'][name$='[name]']");
        if (committeeNames.length > 0) {
            isValid = true;
        }
        // Flag to track the validity of committee names
        let emptyCommittees = []; // Array to store empty committee names

        // Loop through each committee name input
        committeeNames.forEach((input, index) => {
            // Remove error class from all inputs before validation
            input.classList.remove("input-error");

            if (input.value.trim() === "") {
                isValid = false; // Mark as invalid if any input is empty
                emptyCommittees.push(`Committee ${index + 1}`); // Store the index of the empty input
                input.classList.add("input-error"); // Add error class to highlight empty input
            }
        });

        // If any committee names are empty, alert the user
        if (!isValid) {
            return false; // Prevent form submission
        } else {
            return true;
        }
    }

    function loadMembers() {

        var formElement = document.getElementById('getCommetteeDataForm');
        var formData = new FormData(formElement);

        // Append the CSRF token to the FormData
        formData.append('_token', '{{ csrf_token() }}');

        // Send the AJAX request
        $.ajax({
            type: "POST",
            url: "{{ route('budgetingProcess') }}" + '?process=get',
            data: formData,
            contentType: false, // Important for file uploads
            processData: false, // Important for file uploads
            success: function(response) {
                let g = 1;
                var committeeField = document.getElementById("committeeTable2");
                committeeField.innerHTML = ``;

                response.data.forEach(element => {

                    // Append committee row
                    committeeField.innerHTML += `
        <div class="row border p-2 rounded mb-3">
            <div class="col-3">
                <input type="text" class="form-control"
                    name=""
                    placeholder="Enter committee name"
                    value="${element.name}"  readonly>
            </div>
            <div class="col-6">
                <div id="displayfield${g}">
                </div>
            </div>
        </div>
    `;

                    // Append members to each committee
                    element.members.forEach(member => {
                        var displayField = document.getElementById("displayfield" +
                            g); // No need for `${g}`

                        displayField.innerHTML += `
            <div class="row mb-2">
                <div class="col-6">
                    <input type="text" readonly class="form-control" name="" placeholder="Enter head(s)" value="${member.member_name}" required>
                </div>
                <div class="col-4">
                    <input class="form-control" value="${member.member_role}" readonly>
                </div>
            </div>
        `;
                    });

                    g++; // Increment g for each new committee
                });

            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                // You can also add custom error handling here if needed
            }
        });
    }

    function loadEditCommittee() {
        $('#formBtn').hide();
        $('#formBtn2').show();

        $('#view1').hide();
        $('#view2').show();

        var formElement = document.getElementById('getCommetteeDataForm');
        var formData = new FormData(formElement);

        // Append the CSRF token to the FormData
        formData.append('_token', '{{ csrf_token() }}');

        // Send the AJAX request
        $.ajax({
            type: "POST",
            url: "{{ route('budgetingProcess') }}" + '?process=get',
            data: formData,
            contentType: false, // Important for file uploads
            processData: false, // Important for file uploads
            success: function(response) {
                let g = 1; // Global counter for committees
                let committeeField = document.getElementById("committeeTable2");
                committeeField.innerHTML = ``; // Clear the field before appending

                response.data.forEach(element => {
                    // Create committee row
                    let committeeRow = document.createElement('div');
                    committeeRow.classList.add('row', 'border', 'p-2', 'rounded', 'mb-3');

                    // Create input for committee ID (hidden)
                    committeeRow.innerHTML += `
        <input value="${element.id}" type="hidden" name="committee[${g}][id]">  <!-- Include committee ID -->
    `;

                    // Create input for committee name
                    let committeeNameCol = document.createElement('div');
                    committeeNameCol.classList.add('col-3');
                    let committeeNameInput = document.createElement('input');
                    committeeNameInput.type = 'text';
                    committeeNameInput.className = 'form-control';
                    committeeNameInput.name = `committee[${g}][name]`; // Name with committee index
                    committeeNameInput.placeholder = 'Enter committee name';
                    committeeNameInput.value = element.name;
                    committeeNameInput.readOnly = true; // Readonly
                    committeeNameCol.appendChild(committeeNameInput);

                    // Create column for members
                    let memberCol = document.createElement('div');
                    memberCol.classList.add('col-6');
                    let displayField = document.createElement('div');
                    displayField.id = `displayfield${g}`; // Unique ID for display field
                    memberCol.appendChild(displayField);

                    let deleteC = document.createElement('div');
                    deleteC.classList.add('col-3');
                    let editMemC = document.createElement('button');
                    editMemC.type = 'button';
                    editMemC.className = 'btn btn-primary';
                    editMemC.innerHTML = 'Add Member';
                    editMemC.setAttribute('onclick',
                        `addEditFieldCom('displayfield${g}',${g},'${element.id}')`);
                    deleteC.appendChild(editMemC);
                    let deleteMemC = document.createElement('button');
                    deleteMemC.type = 'button';
                    deleteMemC.className = 'btn btn-danger';
                    deleteMemC.innerHTML = 'Remove Committee';
                    deleteMemC.setAttribute('onclick', `deleteCom('${element.id}')`);
                    deleteC.appendChild(deleteMemC);
                    // Append columns to the committee row
                    committeeRow.appendChild(committeeNameCol);
                    committeeRow.appendChild(memberCol);
                    committeeRow.appendChild(deleteC);
                    committeeField.appendChild(committeeRow);

                    // Counter for members within the current committee
                    let o = 1;
                    element.members.forEach(member => {
                        // Create member row
                        let memberRow = document.createElement('div');
                        memberRow.classList.add('row', 'mb-2');

                        // Create input for member name
                        let memberNameCol = document.createElement('div');
                        memberNameCol.classList.add('col-6');
                        let memberNameInput = document.createElement('input');
                        memberNameInput.type = 'text';
                        memberNameInput.className = 'form-control';
                        memberNameInput.value = member.member_name;
                        memberNameInput.name =
                            `committee[${g}][members][${o}][name]`; // Name includes committee and member index
                        memberNameInput.placeholder = 'Enter head(s)';
                        memberNameInput.required = true; // Make it required
                        memberNameCol.appendChild(memberNameInput);

                        // Create column for member role selection
                        let memberRoleCol = document.createElement('div');
                        memberRoleCol.classList.add('col-4');
                        let selectElement = document.createElement('select');
                        selectElement.className = 'form-control';
                        selectElement.name =
                            `committee[${g}][members][${o}][role]`; // Name includes committee and member index

                        // Create and append the options
                        let headOption = document.createElement('option');
                        headOption.value = 'Head';
                        headOption.textContent = 'Head';
                        let memberOption = document.createElement('option');
                        memberOption.value = 'Member';
                        memberOption.textContent = 'Member';

                        // Append options to the select
                        selectElement.appendChild(headOption);
                        selectElement.appendChild(memberOption);

                        // Set the value of the select element
                        selectElement.value = member.member_role;

                        // Create column for delete button
                        let divD = document.createElement('div');
                        divD.classList.add('col-2');
                        let deleteMem = document.createElement('button');
                        deleteMem.type = 'button';
                        deleteMem.className = 'btn btn-danger';

                        // Add SVG inside the button
                        deleteMem.innerHTML = `
            &nbsp;&nbsp;&nbsp;<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M4 7l16 0" />
                <path d="M10 11l0 6" />
                <path d="M14 11l0 6" />
                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
            </svg>
        `;

                        deleteMem.setAttribute('onclick',
                            `deleteMem('${member.id}')`
                        ); // Passing committee and member index as arguments

                        // Append the delete button to its column
                        divD.appendChild(deleteMem);

                        // Append select to member role column
                        memberRoleCol.appendChild(selectElement);
                        // Append columns to member row
                        memberRow.appendChild(memberNameCol);
                        memberRow.appendChild(memberRoleCol);
                        memberRow.appendChild(divD);
                        // Append member row to display field
                        displayField.appendChild(memberRow);

                        o++; // Increment member counter
                    });

                    g++; // Increment committee counter
                });


            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                // You can also add custom error handling here if needed
            }
        });

    }

    function deleteMem(id) {

        document.getElementById('data_id').value = id;
        var formElement = document.getElementById('randomForm');
        var formData = new FormData(formElement);
        document.getElementById('adminloader').style.display = '';
        // Append the CSRF token to the FormData
        formData.append('_token', '{{ csrf_token() }}');

        // Send the AJAX request
        $.ajax({
            type: "POST",
            url: "{{ route('budgetingProcess') }}" + '?process=delete',
            data: formData,
            contentType: false, // Important for file uploads
            processData: false, // Important for file uploads
            success: function(response) {
                document.getElementById('adminloader').style.display = 'none';
                if (response.status == 'error') {
                    alertify
                        .alert("Warning", response.message, function() {
                            alertify.message('OK');
                        });
                } else {
                    alertify
                        .alert("Success", response.message, function() {
                            alertify.message('OK');
                        });
                    $('#' + response.modal).modal('hide');
                    alertify
                        .alert("Message", response.message, function() {
                            alertify.message('OK');

                        });
                    if (response.reload && typeof window[response.reload] === 'function') {
                        window[response.reload](); // Safe dynamic function call
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                // You can also add custom error handling here if needed
            }
        });
    }

    function deleteCom(id) {

        document.getElementById('data_id').value = id;
        var formElement = document.getElementById('randomForm');
        var formData = new FormData(formElement);
        document.getElementById('adminloader').style.display = '';
        // Append the CSRF token to the FormData
        formData.append('_token', '{{ csrf_token() }}');

        // Send the AJAX request
        $.ajax({
            type: "POST",
            url: "{{ route('budgetingProcess') }}" + '?process=delete2',
            data: formData,
            contentType: false, // Important for file uploads
            processData: false, // Important for file uploads
            success: function(response) {
                document.getElementById('adminloader').style.display = 'none';
                if (response.status == 'error') {
                    alertify
                        .alert("Warning", response.message, function() {
                            alertify.message('OK');
                        });
                } else {
                    alertify
                        .alert("Success", response.message, function() {
                            alertify.message('OK');
                        });
                    $('#' + response.modal).modal('hide');
                    alertify
                        .alert("Message", response.message, function() {
                            alertify.message('OK');

                        });
                    if (response.reload && typeof window[response.reload] === 'function') {
                        window[response.reload](); // Safe dynamic function call
                        loadBudgetDataTable()
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                // You can also add custom error handling here if needed
            }
        });
    }

    function addEditFieldCom(id, num, data_id) {

        var div = document.getElementById(id);
        // Get all input and select elements inside the div
        var inputs = div.querySelectorAll("input");
        var selects = div.querySelectorAll("select");

        // Check if there are any input elements
        if (inputs.length === 0) {
            var h = 0;
        } else {
            var lastInputName = inputs[inputs.length - 1].getAttribute("name");

            // Extract the number from the name attribute using regex
            var matches = lastInputName.match(/\d+/g);

            // Check if there was a match for the number
            if (matches && matches.length >= 2) {
                var secondNumber = matches[1];
                var h = parseInt(secondNumber, 10) + 1; // Increment the index for the new input
            } else {
                console.error("No valid index found in the input name.");
                return;
            }
        }

        // Create a new div element for the person input
        var personInput = document.createElement('div');
        personInput.className = "row mb-2";
        personInput.id = `personInput${h}`;

        // Create the inner HTML structure for person input
        personInput.innerHTML = `
        <div class="col-6">
            <input type="text" class="form-control" name="committee[${num}][members][${h}][name]" placeholder="Enter head(s)" required>
        </div>
        <div class="col-4">
            <select class="form-control" name="committee[${num}][members][${h}][role]">
                <option value="Head">Head</option>
                <option value="Member">Member</option>
            </select>
        </div>
        <div class="col-1 text-center">
            <button type="button" class="btn btn-danger" onclick="removecommitteeInput('personInput${h}')">
                &nbsp;&nbsp;&nbsp;<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-circle-minus">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                    <path d="M9 12l6 0" />
                </svg>
            </button>
        </div>
    `;

        // Append the new person input fields to the committee input div
        div.appendChild(personInput);
    }


    function updateCommentteeField() {
        validateCommittees()
        if (validateCommittees()) {
            var formElement = document.getElementById('committeeForm');
            var formData = new FormData(formElement);
            document.getElementById('adminloader').style.display = '';
            // Append the CSRF token to the FormData
            formData.append('_token', '{{ csrf_token() }}');

            // Send the AJAX request
            $.ajax({
                type: "POST",
                url: "{{ route('budgetingProcess') }}" + '?process=update',
                data: formData,
                contentType: false, // Important for file uploads
                processData: false, // Important for file uploads
                success: function(response) {
                    document.getElementById('adminloader').style.display = 'none';
                    if (response.status == 'error') {
                        alertify
                            .alert("Warning", response.message, function() {
                                alertify.message('OK');
                            });
                    } else {
                        alertify
                            .alert("Success", response.message, function() {
                                alertify.message('OK');
                            });
                        $('#' + response.modal).modal('hide');
                        alertify
                            .alert("Message", response.message, function() {
                                alertify.message('OK');

                            });
                        if (response.reload && typeof window[response.reload] === 'function') {
                            window[response.reload](); // Safe dynamic function call
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    // You can also add custom error handling here if needed
                }
            });
        }
    }

    function submitData(id, route, process) {
        var formElement = document.getElementById(id);
        var formData = new FormData(formElement);
        document.getElementById('adminloader').style.display = '';
        // Append the CSRF token to the FormData
        formData.append('_token', '{{ csrf_token() }}');

        // Send the AJAX request
        $.ajax({
            type: "POST",
            url: route + '?process=' + process,
            data: formData,
            contentType: false, // Important for file uploads
            processData: false, // Important for file uploads
            success: function(response) {
                document.getElementById('adminloader').style.display = 'none';
                if (response.status == 'error') {
                    alertify
                        .alert("Warning", response.message, function() {
                            alertify.message('OK');
                        });
                        const resetHtml = document.getElementById('mealDateContainer');
                        if(resetHtml){
                            resetHtml.innerHTML='';
                        }

                       const resetHtml2 = document.getElementById('maelDateRow');
                       if(resetHtml2){
                        resetHtml2.innerHTML='';
                       }

                        if (response.reload && typeof window[response.reload] === 'function') {
                        window[response.reload]();
                    }
                } else {
                    if(response.budget_id){
                        const url = `/Budgeting/Details/${response.budget_id}`;
                        window.location.href = url;
                    }
                    alertify
                        .alert("Success", response.message, function() {
                            alertify.message('OK');
                        });
                    $('#' + response.modal).modal('hide');
                    alertify
                        .alert("Message", response.message, function() {
                            alertify.message('OK');

                        });
                    if (response.reload && typeof window[response.reload] === 'function') {
                        window[response.reload]();
                    }
                    const resetHtml = document.getElementById('mealDateContainer');
                        if(resetHtml){
                            resetHtml.innerHTML='';
                        }

                       const resetHtml2 = document.getElementById('maelDateRow');
                       if(resetHtml2){
                        resetHtml2.innerHTML='';
                       }
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                document.getElementById('adminloader').style.display = 'none';
                const parsedData = JSON.parse(xhr.responseText);
                alertify
                    .alert("Error", parsedData.message, function() {
                        alertify.message('OK');

                    });
                // You can also add custom error handling here if needed
            }
        });
    }

    function loadEditCommittee2() {
        $('#formBtn').show();
        $('#formBtn2').hide();

        $('#view1').show();
        $('#view2').hide();
        loadMembers()
    }

    function loadBudgetDataTable() {
        var formElement = document.getElementById('getBudgetDateForm');
        var formData = new FormData(formElement);
        // Append the CSRF token to the FormData
        formData.append('_token', '{{ csrf_token() }}');

        // Send the AJAX request
        $.ajax({
            type: "POST",
            url: "{{ route('mealProcess') }}" + '?process=' + 'get',
            data: formData,
            contentType: false, // Important for file uploads
            processData: false, // Important for file uploads
            success: function(response) {
                $('#committeeMealTable').DataTable({
                    data: response.data,
                    destroy: true,
                    columns: [
                        {
                            data: 'name'
                        },
                        {
                            data: null, // This will render the meal data
                            render: function(data, type, row) {
                             // Check if meals is null or empty
                                if (!row.meals || row.meals.length === 0) {
                                    return 'No meals'; // Return 'No meals' if null or empty
                                }
                                // Concatenate meal_date and meal for display
                                return row.meals.map(meal => `${meal.meal_date}: ${meal.meal}`).join('<br>'); // Use <br> for line breaks
                            }
                        },
                        {
                            data:'price'
                        },
                        {
                            data: 'id',
                            render: function(data) {
                                return `<button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#schedMealModal" onclick="schedMeal('${data}')">Schedule Meal</button>`; // Handle nulls here
                            }
                        },

                    ],
                    footerCallback: function(row, data, start, end, display) {
                        var api = this.api();

                        // Calculate the total price over all pages
                        var total = api
                            .column(2) // Index of the price column (third column, index starts at 0)
                            .data()
                            .reduce(function(a, b) {
                                return parseFloat(a) + parseFloat(b);
                            }, 0);

                        // Update footer with the total
                        $(api.column(2).footer()).html('Total: ' + total);
                    }
                });

            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                // You can also add custom error handling here if needed
            }
        });
    }

    function schedMeal(id) {
        document.getElementById('committee_id').value=id;
        document.getElementById('temp_id').value=id;
        temp(id)
    }
    function temp(id){
        const data_id = document.getElementById('temp_id').value
        autoloadCommitteeTable(data_id)
        loadBudgetDataTable()
    }
    function autoloadCommitteeTable(id){
        var formData = new FormData();
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('committee_id', id);
        $.ajax({
            type: "POST",
            url: "{{ route('mealProcess') }}" + '?process=' + 'get_specific',
            data: formData,
            contentType: false, // Important for file uploads
            processData: false, // Important for file uploads
            success: function(response) {
                const data = response.data;
                $('#committeeMealTable2').DataTable( {
                    data: data[0].meals,
                    destroy:true,
                    columns: [
                        { data: 'meal_date' },
                        { data: 'meal' },
                        {
                            data: 'id',
                            render: function(data) {
                                return `<button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#schedMealModal" onclick="removeSchedMeal('${data}')">Remove</button>`; // Handle nulls here
                            }
                         },
                    ]
                } );

            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                // You can also add custom error handling here if needed
            }
        });
    }
function removeSchedMeal(id){
    document.getElementById('data_id').value=id;
    submitData('randomForm',`{{ route('mealProcess') }}`,'remove_sched')
}
let indexCount = 1;
function addOtherExpensesInput() {
    const data = document.getElementById('otherExpensesInputs');
    const newRow = document.createElement('div');
    newRow.classList.add('row', 'mb-2');
    
    newRow.innerHTML = `
        <div class="col-2">
            <input type="number" min="1" value="1" class="form-control quantity" name="quantity[]" id="">
        </div>
        <div class="col-4">
            <input type="text" class="form-control" placeholder="Enter description" name="description[]" id="">
        </div>
        <div class="col-2">
            <input type="number" min="1" value="1" class="form-control price" name="price[]" id="">
        </div>
        <div class="col-2">
            <input type="text" min="0" value="0" class="form-control total" name="total[]" id="" readonly>
        </div>
        <div class="col-2">
            <button class="btn btn-danger remove-btn">Remove</button>
        </div>
    `;
    indexCount++;

    // Add event listener to remove the row when "Remove" button is clicked
    newRow.querySelector('.remove-btn').addEventListener('click', function() {
        newRow.remove();
    });

    // Function to calculate and update the total
    function updateTotal() {
        const quantity = newRow.querySelector('.quantity').value;
        const price = newRow.querySelector('.price').value;
        const total = newRow.querySelector('.total');
        total.value = (quantity * price).toFixed(2);  // Calculate total and set it
    }

    // Add event listeners for quantity and price inputs to auto-compute total
    newRow.querySelector('.quantity').addEventListener('input', updateTotal);
    newRow.querySelector('.price').addEventListener('input', updateTotal);

    data.appendChild(newRow);
}
function validateInputs() {
    const inputs = document.querySelectorAll('#otherExpensesInputs input');
    let allValid = true;

    inputs.forEach(input => {
        if (input.value.trim() === '') {
            input.style.borderColor = 'red'; // Set border to red if empty
            allValid = false;
        } else {
            input.style.borderColor = ''; // Reset border if not empty
        }
    });
    if(inputs){
        return allValid;
    }else{
        return false;
    }
    
}
function submitOtherExpenses(id, route, process) {

    if (validateInputs()) {
        var formElement = document.getElementById(id);
        var formData = new FormData(formElement);
        document.getElementById('adminloader').style.display = '';
        // Append the CSRF token to the FormData
        formData.append('_token', '{{ csrf_token() }}');

        // Send the AJAX request
        $.ajax({
            type: "POST",
            url: route + '?process=' + process,
            data: formData,
            contentType: false, // Important for file uploads
            processData: false, // Important for file uploads
            success: function(response) {
                document.getElementById('adminloader').style.display = 'none';
                if (response.status == 'error') {
                    alertify
                        .alert("Warning", response.message, function() {
                            alertify.message('OK');
                        });
                        const resetHtml = document.getElementById('mealDateContainer');
                        if(resetHtml){
                            resetHtml.innerHTML='';
                        }

                       const resetHtml2 = document.getElementById('maelDateRow');
                       if(resetHtml2){
                        resetHtml2.innerHTML='';
                       }

                        if (response.reload && typeof window[response.reload] === 'function') {
                        window[response.reload]();
                    }
                } else {
                    const data = document.getElementById('otherExpensesInputs');
                    data.innerHTML=``;
                    $('#' + response.modal).modal('hide');
                    alertify
                        .alert("Message", response.message, function() {
                            alertify.message('OK');

                        });
                    if (response.reload && typeof window[response.reload] === 'function') {
                        window[response.reload]();
                    }
                    const resetHtml = document.getElementById('mealDateContainer');
                        if(resetHtml){
                            resetHtml.innerHTML='';
                        }
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                document.getElementById('adminloader').style.display = 'none';
                const parsedData = JSON.parse(xhr.responseText);
                alertify
                    .alert("Error", parsedData.message, function() {
                        alertify.message('OK');

                    });
                // You can also add custom error handling here if needed
            }
        });
    } else {

    }
    
}
function loadOtherExpensesTable() {
    var formElement = document.getElementById('getCommetteeDataForm');
    var formData = new FormData(formElement);

    // Send the AJAX request
    $.ajax({
        type: "POST",
        url: `{{ route('otherExpensesProcess') }}` + '?process=get',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            const form = document.getElementById('otherExpensesTableBody');
            const route = `{{ route('otherExpensesProcess') }}`;
            form.innerHTML = ''; // Clear previous table contents
            response.data.forEach(element => {
                form.innerHTML += `
                    <tr data-id="${element.id}">
                        <td><input name="quantity" class="form-control quantity" value='${element.quantity}' data-price='${element.price}' oninput="calculateTotal(this)"></td>
                        <td><input name='description' class="form-control" value='${element.description}' readonly></td>
                        <td><input name='price' class="form-control price" value='${element.price}' oninput="calculateTotal(this)"></td>
                        <td><input name='total' class="form-control total" value='${element.total}' readonly></td>
                        <td>
                            <button class="btn btn-success update-btn" data-id="${element.id}">Update</button>
                            <button class="btn btn-danger" onclick="deleteOtherExpenses('${element.id}')">Delete</button>
                        </td>
                    </tr>
                `;
            });

            // Add event listener to all update buttons
            document.querySelectorAll('.update-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    submitData2(id, route, 'update');
                });
            });
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alertify.alert("Error", "An error occurred.", function() {
                alertify.message('OK');
            });
        }
    });
}
function deleteOtherExpenses(id){
document.getElementById('data_id').value=id;
submitData('randomForm',`{{ route('otherExpensesProcess') }}`,'delete');
}

function submitData2(id, route, process) {
    document.getElementById('adminloader').style.display = '';
    const row = document.querySelector(`tr[data-id="${id}"]`);
    const formData = new FormData();
    
    // Collect data from the row
    formData.append('id', id);
    formData.append('quantity', row.querySelector('input[name="quantity"]').value);
    formData.append('description', row.querySelector('input[name="description"]').value);
    formData.append('price', row.querySelector('input[name="price"]').value);
    formData.append('total', row.querySelector('input[name="total"]').value);

    // Append CSRF token
    formData.append('_token', '{{ csrf_token() }}');

    // Send the AJAX request
    $.ajax({
        type: "POST",
        url: route + '?process=' + process,
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            document.getElementById('adminloader').style.display = 'none';
                if (response.status == 'error') {
                    alertify
                        .alert("Warning", response.message, function() {
                            alertify.message('OK');
                        });
                } else {
                    alertify
                        .alert("Success", response.message, function() {
                            alertify.message('OK');
                        });
                    if (response.reload && typeof window[response.reload] === 'function') {
                        window[response.reload]();
                    }
                    
                }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alertify.alert("Error", "An error occurred.", function() {
                alertify.message('OK');
            });
        }
    });
}

function calculateTotal(input) {
    const row = input.closest('tr');
    const quantityInput = row.querySelector('.quantity');
    const priceInput = row.querySelector('.price');
    const totalInput = row.querySelector('.total');

    const quantity = parseFloat(quantityInput.value) || 0;
    const price = parseFloat(priceInput.value) || 0;

    const total = quantity * price;
    totalInput.value = total.toFixed(2); // Update total field
}

    $(document).ready(function() {
        loadMembers()
        loadBudgetDataTable()
        const bDateS = document.getElementById('bDateStart').value;
        const bDateE = document.getElementById('bDateEnd').value;
        let datePicker;

        datePicker = flatpickr("#multiDatePicker", {
            mode: "multiple", // Enables multiple date selection
            dateFormat: "Y-m-d", // Customize date format if needed
            minDate: bDateS.split(" ")[0], // Set your specific start date
            maxDate: bDateE.split(" ")[0], // Set your specific end date
            onClose: function(selectedDates) {
                const multidate = document.getElementById('multiDatePicker').value
                const form = document.getElementById('schedMealForm');

                // Get all checkboxes within the form
                const checkboxes = form.querySelectorAll('input[type="checkbox"]');

                // Filter to get only the checked checkboxes
                const checked = Array.from(checkboxes).filter(checkbox => checkbox.checked);

                // Get the values of the checked checkboxes
                const checkedValues = checked.map(checkbox => checkbox.value);

                const dataValue = multidate + ' / ' + checkedValues;
                if (!multidate || checkedValues.length === 0) {
                    document.getElementById('error_message_meal').style.display='';
                    form.reset();
                    datePicker.clear();
                } else {
                    document.getElementById('error_message_meal').style.display='none';
                    const div = document.getElementById('mealDateContainer');
                    const inputs = document.querySelectorAll('.mealDate');

                    // Split the multidate into individual dates
                    const multidateArray = multidate.split(','); // Example: ["2024-10-24", "2024-10-20"]

                    multidateArray.forEach(date => {
                        let exists = false;

                        // Check if any input already contains this date
                        inputs.forEach(input => {
                            if (input.value.includes(date.trim())) {
                                alertify
                                .alert("Message", 'Date: '+date.trim()+' Already Added', function() {
                                alertify.message('OK');

                    });
                                exists = true;
                            }
                        });

                        if (!exists) {
                            // Add new input only if the date doesn't exist
                            const dataValue = date + ' / ' + checkedValues;
                            div.innerHTML += `
                            <input type="text" class="mealDate" name="mealDate[]" value="${dataValue}">
                            `;
                            const MealRow = document.getElementById('maelDateRow');
                            const row = document.createElement('tr'); // Create a new table row
                            row.innerHTML = `
                                <td>${date}</td>
                                <td>${checkedValues.join(', ')}</td>
                                <td><button class="btn btn-danger remove-btn">Remove</button></td>
                            `;
                             MealRow.appendChild(row); // Append the new row to the table

            // Add event listener to the remove button
            const removeButton = row.querySelector('.remove-btn'); // Select the button in the current row
            removeButton.addEventListener('click', function() {
                // Remove the row containing this button
                const dateToRemove = row.cells[0].innerText; // Get the date from the first cell

                // Remove the corresponding input field with the same date
                const inputs = document.querySelectorAll('.mealDate');
                inputs.forEach(input => {
                    if (input.value.includes(dateToRemove.trim())) {
                        input.remove();
                    }
                });

                // Remove the row from the table
                row.remove();
            });
                        } else {
                            console.log(`The date ${date} is already added.`);
                        }
                    });
                    form.reset();
                    datePicker.clear();
                }
            }
        });
        $('#mealDataTable').DataTable();
        loadOtherExpensesTable()
    });
</script>
