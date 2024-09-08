<script>
    // Function to update member count
    function updateMemberCount(memberListElement, totalMembersInput) {
        const membersCount = memberListElement.querySelectorAll('.member-name').length;
        totalMembersInput.value = membersCount;
    }

    // Add a new committee row
    document.getElementById('addCommitteeRow').addEventListener('click', function() {
        const committeeTable = document.getElementById('committeeTable');
        const row = committeeTable.insertRow();

        // Committee Name
        const cell1 = row.insertCell(0);
        cell1.innerHTML =
            `<input type="text" class="form-control" placeholder="Enter committee name" required>`;

        // Person-in-Charge
        const cell2 = row.insertCell(1);
        cell2.innerHTML = `<input type="text" class="form-control" placeholder="Enter head(s)" required>`;

        // Members
        const cell3 = row.insertCell(2);
        const memberListDiv = document.createElement('div');
        memberListDiv.className = 'member-list';
        memberListDiv.innerHTML =
            `<input type="text" class="form-control mb-2 member-name" placeholder="Enter member name" required>`;

        const addMemberButton = document.createElement('button');
        addMemberButton.type = 'button';
        addMemberButton.className = 'btn btn-secondary add-member-btn';
        addMemberButton.innerText = 'Add Member';

        cell3.appendChild(memberListDiv);
        cell3.appendChild(addMemberButton);

        // Total Members (auto-calculated)
        const cell4 = row.insertCell(3);
        const totalMembersInput = document.createElement('input');
        totalMembersInput.type = 'number';
        totalMembersInput.className = 'form-control total-members';
        totalMembersInput.value = 1; // Initially 1 member (the default input)
        totalMembersInput.readOnly = true;
        cell4.appendChild(totalMembersInput);

        // Add member event for this row
        addMemberButton.addEventListener('click', function() {
            const newMemberInput = document.createElement('input');
            newMemberInput.type = 'text';
            newMemberInput.className = 'form-control mb-2 member-name';
            newMemberInput.placeholder = 'Enter member name';
            memberListDiv.appendChild(newMemberInput);
            updateMemberCount(memberListDiv, totalMembersInput);
        });
    });

    // Add member for the first committee row
    document.querySelectorAll('.add-member-btn').forEach(button => {
        button.addEventListener('click', function() {
            const memberListDiv = this.previousElementSibling;
            const totalMembersInput = this.parentElement.nextElementSibling.querySelector(
                '.total-members');
            const newMemberInput = document.createElement('input');
            newMemberInput.type = 'text';
            newMemberInput.className = 'form-control mb-2 member-name';
            newMemberInput.placeholder = 'Enter member name';
            memberListDiv.appendChild(newMemberInput);
            updateMemberCount(memberListDiv, totalMembersInput);
        });
    });
</script>

<script>
    function createBudgetProposal(formId) {
        var formElement = document.getElementById(formId);

        // Serialize the form data
        var formData = $(formElement).serialize();

        // Send the AJAX request
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
                    formElement.reset(); // Reset form
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
    </script>
