<script>
    // Function to update the total member count
    function updateMemberCount(committeeRow) {
        const totalMembersInput = committeeRow.querySelector('.total-members');
        const membersCount = committeeRow.querySelectorAll('.member-name').length;
        const personInChargeCount = committeeRow.querySelectorAll('.person-in-charge-name').length;
        totalMembersInput.value = membersCount + personInChargeCount;
    }

    // Function to add remove button functionality
    function createRemoveButton(inputElement, memberList, committeeRow) {
        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.className = 'btn btn-danger w-100 mb-2 remove-member-btn';
        removeBtn.innerText = 'Remove';

        removeBtn.addEventListener('click', function() {
            memberList.removeChild(inputElement);
            memberList.removeChild(removeBtn);
            updateMemberCount(committeeRow);
        });

        return removeBtn;
    }

    // Add a new committee row
    document.getElementById('addCommitteeRow').addEventListener('click', function() {
        const committeeTable = document.getElementById('committeeTable');
        const row = committeeTable.insertRow();

        // Committee Name
        const cell1 = row.insertCell(0);
        cell1.innerHTML =
            `<input type="text" class="form-control" placeholder="Enter committee name" required>`;

        // Expense Type
        const cell2 = row.insertCell(1);
        const expenseTypeListDiv = document.createElement('div');
        expenseTypeListDiv.className = 'expense-type-list';

        expenseTypeListDiv.innerHTML = `
            <label><input type="checkbox" class="expense-type" value="Morning Snacks"> Morning Snacks</label><br>
            <label><input type="checkbox" class="expense-type" value="Lunch"> Lunch</label><br>
            <label><input type="checkbox" class="expense-type" value="Afternoon Snacks"> Afternoon Snacks</label><br>
            <label><input type="checkbox" class="expense-type" value="Dinner"> Dinner</label><br>
        `;

        cell2.appendChild(expenseTypeListDiv);

        // Person-in-Charge
        const cell3 = row.insertCell(2);
        const personInChargeListDiv = document.createElement('div');
        personInChargeListDiv.className = 'person-in-charge-list';
        personInChargeListDiv.innerHTML =
            `<input type="text" class="form-control mb-2 person-in-charge-name" placeholder="Enter head(s)" required>`;

        const addPersonInChargeButton = document.createElement('button');
        addPersonInChargeButton.type = 'button';
        addPersonInChargeButton.className = 'btn btn-primary add-person-in-charge-btn';
        addPersonInChargeButton.innerText = 'Add Another Person-in-Charge';

        cell3.appendChild(personInChargeListDiv);
        cell3.appendChild(addPersonInChargeButton);

        // Members
        const cell4 = row.insertCell(3);
        const memberListDiv = document.createElement('div');
        memberListDiv.className = 'member-list';
        memberListDiv.innerHTML =
            `<input type="text" class="form-control mb-2 member-name" placeholder="Enter member name" required>`;

        const addMemberButton = document.createElement('button');
        addMemberButton.type = 'button';
        addMemberButton.className = 'btn btn-primary w-100 add-member-btn';
        addMemberButton.innerText = 'Add Member';

        cell4.appendChild(memberListDiv);
        cell4.appendChild(addMemberButton);

        // Total Members (auto-calculated)
        const cell5 = row.insertCell(4);
        const totalMembersInput = document.createElement('input');
        totalMembersInput.type = 'number';
        totalMembersInput.className = 'form-control total-members';
        totalMembersInput.value = 2;
        totalMembersInput.readOnly = true;

        cell5.appendChild(totalMembersInput);

        // Remove Committee Button
        const cell6 = row.insertCell(5);
        const removeCommitteeButton = document.createElement('button');
        removeCommitteeButton.type = 'button';
        removeCommitteeButton.className = 'btn btn-danger w-100 remove-committee-btn';
        removeCommitteeButton.innerText = 'Remove Committee';

        removeCommitteeButton.addEventListener('click', function() {
            row.remove(); // Remove the entire row
        });

        cell6.appendChild(removeCommitteeButton);

        // Add member event for this row
        addMemberButton.addEventListener('click', function() {
            const newMemberInput = document.createElement('input');
            newMemberInput.type = 'text';
            newMemberInput.className = 'form-control mb-2 member-name';
            newMemberInput.placeholder = 'Enter member name';

            const removeMemberBtn = createRemoveButton(newMemberInput, memberListDiv, row);
            memberListDiv.appendChild(newMemberInput);
            memberListDiv.appendChild(removeMemberBtn);

            updateMemberCount(row);
        });

        // Add person-in-charge event for this row
        addPersonInChargeButton.addEventListener('click', function() {
            const newPersonInChargeInput = document.createElement('input');
            newPersonInChargeInput.type = 'text';
            newPersonInChargeInput.className = 'form-control mb-2 person-in-charge-name';
            newPersonInChargeInput.placeholder = 'Enter head(s)';

            const removePersonInChargeBtn = createRemoveButton(newPersonInChargeInput,
                personInChargeListDiv, row);
            personInChargeListDiv.appendChild(newPersonInChargeInput);
            personInChargeListDiv.appendChild(removePersonInChargeBtn);

            updateMemberCount(row);
        });
    });

    // Add initial event listeners for the first committee row's members and person-in-charge
    document.querySelectorAll('.add-member-btn').forEach(button => {
        button.addEventListener('click', function() {
            const memberListDiv = this.previousElementSibling;
            const committeeRow = this.closest('tr');

            const newMemberInput = document.createElement('input');
            newMemberInput.type = 'text';
            newMemberInput.className = 'form-control mb-2 member-name';
            newMemberInput.placeholder = 'Enter member name';

            const removeMemberBtn = createRemoveButton(newMemberInput, memberListDiv, committeeRow);
            memberListDiv.appendChild(newMemberInput);
            memberListDiv.appendChild(removeMemberBtn);

            updateMemberCount(committeeRow);
        });
    });

    // Add initial event listeners for the first committee row's person-in-charge button
    document.querySelectorAll('.add-person-in-charge-btn').forEach(button => {
        button.addEventListener('click', function() {
            const personInChargeListDiv = this.previousElementSibling;
            const committeeRow = this.closest('tr');

            const newPersonInChargeInput = document.createElement('input');
            newPersonInChargeInput.type = 'text';
            newPersonInChargeInput.className = 'form-control mb-2 person-in-charge-name';
            newPersonInChargeInput.placeholder = 'Enter head(s)';

            const removePersonInChargeBtn = createRemoveButton(newPersonInChargeInput,
                personInChargeListDiv, committeeRow);
            personInChargeListDiv.appendChild(newPersonInChargeInput);
            personInChargeListDiv.appendChild(removePersonInChargeBtn);

            updateMemberCount(committeeRow);
        });
    });

    updateMemberCount(document.querySelector('tr'));


    function submitCommitteeForm(formId) {
        var formElement = document.getElementById(formId);
        var formData = $(formElement).serialize();
        console.log(formData);
        $.ajax({
            type: "POST",
            url: '{{ route('committees.store') }}',
            data: formData,
            success: function(response) {
                if (response.status === 'error') {
                    alertify.alert("Warning", response.message, function() {
                        alertify.message('OK');
                    });
                } else {
                    formElement.reset();
                    alertify.alert("Message", response.message, function() {
                        alertify.message('OK');
                    });

                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alertify.alert("Error",
                    "An error occurred while processing your request. Please try again.");
            }
        });
    }
</script>
