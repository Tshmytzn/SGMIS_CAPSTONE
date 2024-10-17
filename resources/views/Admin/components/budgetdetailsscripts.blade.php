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
        var displayField = document.getElementById("displayfield" + g); // No need for `${g}`
        
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

    function loadEditCommittee(){
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
            let g = 1;  // Global counter for committees
let committeeField = document.getElementById("committeeTable2");
committeeField.innerHTML = ``;  // Clear the field before appending

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
    committeeNameInput.name = `committee[${g}][name]`;  // Name with committee index
    committeeNameInput.placeholder = 'Enter committee name';
    committeeNameInput.value = element.name;
    committeeNameInput.readOnly = true;  // Readonly
    committeeNameCol.appendChild(committeeNameInput);

    // Create column for members
    let memberCol = document.createElement('div');
    memberCol.classList.add('col-6');
    let displayField = document.createElement('div');
    displayField.id = `displayfield${g}`;  // Unique ID for display field
    memberCol.appendChild(displayField);

    let deleteC = document.createElement('div');
    deleteC.classList.add('col-3');
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
        memberNameInput.name = `committee[${g}][members][${o}][name]`;  // Name includes committee and member index
        memberNameInput.placeholder = 'Enter head(s)';
        memberNameInput.required = true;  // Make it required
        memberNameCol.appendChild(memberNameInput);

        // Create column for member role selection
        let memberRoleCol = document.createElement('div');
        memberRoleCol.classList.add('col-4');
        let selectElement = document.createElement('select');
        selectElement.className = 'form-control';
        selectElement.name = `committee[${g}][members][${o}][role]`;  // Name includes committee and member index

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

        deleteMem.setAttribute('onclick', `deleteMem('${member.id}')`);  // Passing committee and member index as arguments
        
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

        o++;  // Increment member counter
    });

    g++;  // Increment committee counter
});


            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                // You can also add custom error handling here if needed
            }
        });

    }
    function deleteMem(id){

        document.getElementById('data_id').value=id;
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
    function deleteCom(id){

        document.getElementById('data_id').value=id;
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
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    // You can also add custom error handling here if needed
                }
            });
    }
    function loadEditCommittee2(){
        $('#formBtn').show();
        $('#formBtn2').hide();

        $('#view1').show();
        $('#view2').hide();
        loadMembers()
    }
    $(document).ready(function() {
        loadMembers()
    });
</script>
