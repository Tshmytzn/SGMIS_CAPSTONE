<!doctype html>

<html lang="en">

@include('Admin.components.header', ['title' => 'Budgeting'])

<body>
    <script src="{{ asset('./dist/js/demo-theme.min.js?1684106062') }}"></script>

    <div class="page">

        @include('Admin.components.nav', ['active' => 'Budgeting'])

        <div class="page-wrapper">

            <!-- Page header -->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">

                            <!-- Page pre-title -->
                            <div class="page-pretitle">
                                Overview
                            </div>
                            <h2 class="page-title">
                                Budgeting
                            </h2>
                        </div>

                        <div class="col-auto ms-auto d-print-none">
                            <div class="d-flex">
                                <div class="me-3">
                                    <div class="input-icon">
                                        <input type="text" value="" class="form-control" placeholder="Search…">
                                        <span class="input-icon-addon">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                                <path d="M21 21l-6 -6" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <button class="btn" style="background-color: #DF7026; color: white;"
                                    data-bs-toggle="modal" data-bs-target="#budgetProposalModal"> Create Budgeting
                                    Proposal</button>

                            </div>
                        </div>

                    </div>
                </div>
            </div>




            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl d-flex flex-column justify-content-center">
                    <div class="empty">
                        <div class="empty-img"><img src="./static/illustrations/undraw_under_construction_-46-pa.svg"
                                height="128" alt="">
                        </div>
                        <p class="empty-title">Feature Coming Soon!</p>
                        <p class="empty-subtitle text-muted">
                            This feature is not yet ready for the pre-oral defense stage. Stay tuned as it will be
                            available for the final defense. See you there!
                        </p>
                        <div class="empty-action">
                            <a href="./." class="btn btn-primary">
                                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>
                                Stay tuned!
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            @include('Admin.components.footer')

            {{-- Modals --}}
{{-- Modals --}}
<div class="modal fade" id="budgetProposalModal" tabindex="-1" aria-labelledby="budgetProposalModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="budgetProposalModalLabel">Create Budget Proposal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="budgetProposalForm">

                    <!-- Proposal Title -->
                    <div class="mb-3">
                        <label for="proposalTitle" class="form-label">Proposal Title</label>
                        <input type="text" class="form-control" id="proposalTitle" placeholder="Enter proposal title" required>
                    </div>

                    <!-- Event Related -->
                    <div class="mb-3">
                        <label for="event" class="form-label">Events</label>
                        <select class="form-select" id="department" required>
                            <option selected disabled value="">Select event</option>
                            <option value="Event 1">Event 1</option>
                            <option value="Event 2">Event 2</option>
                        </select>
                    </div>

                    <!-- Budget Period -->
                    <div class="mb-3">
                        <label for="budgetPeriod" class="form-label">Budget Period</label>
                        <input type="date" class="form-control" id="budgetPeriodStart" required> to 
                        <input type="date" class="form-control" id="budgetPeriodEnd" required>
                    </div>

                    <!-- Allocated Funds -->
                    <div class="mb-3">
                        <label for="allocatedFunds" class="form-label">Allocated Funds (Initial Estimate)</label>
                        <input type="number" class="form-control" id="allocatedFunds" placeholder="Enter estimated total budget" required>
                    </div>

                    <!-- Working Committees -->
                    <div class="mb-3">
                        <label class="form-label">Working Committees and Members</label>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Committee</th>
                                    <th>Person-in-Charge</th>
                                    <th>Members</th>
                                    <th>Total Members</th>
                                </tr>
                            </thead>
                            <tbody id="committeeTable">
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" placeholder="Enter committee name" required>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" placeholder="Enter head(s)" required>
                                    </td>
                                    <td>
                                        <div class="member-list">
                                            <input type="text" class="form-control mb-2 member-name" placeholder="Enter member name" required>
                                        </div>
                                        <button type="button" class="btn btn-secondary add-member-btn">Add Member</button>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control total-members" value="1" readonly>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-secondary" id="addCommitteeRow">Add Another Committee</button>
                    </div>

                    <!-- Proposed By -->
                    <div class="mb-3">
                        <label for="proposedBy" class="form-label">Proposed By</label>
                        <input type="text" class="form-control" id="proposedBy" value="John Doe" readonly>
                    </div>

                    <!-- Submission Date -->
                    <div class="mb-3">
                        <label for="submissionDate" class="form-label">Submission Date</label>
                        <input type="date" class="form-control" id="submissionDate" value="<?php echo date('Y-m-d'); ?>" readonly>
                    </div>

                    <!-- Additional Notes -->
                    <div class="mb-3">
                        <label for="additionalNotes" class="form-label">Additional Notes</label>
                        <textarea class="form-control" id="additionalNotes" rows="3" placeholder="Enter any additional details"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="budgetProposalForm">Submit Proposal</button>
            </div>
        </div>
    </div>
</div>
            {{-- Modals --}}
        </div>
    </div>

  
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
        cell1.innerHTML = `<input type="text" class="form-control" placeholder="Enter committee name" required>`;
        
        // Person-in-Charge
        const cell2 = row.insertCell(1);
        cell2.innerHTML = `<input type="text" class="form-control" placeholder="Enter head(s)" required>`;
        
        // Members
        const cell3 = row.insertCell(2);
        const memberListDiv = document.createElement('div');
        memberListDiv.className = 'member-list';
        memberListDiv.innerHTML = `<input type="text" class="form-control mb-2 member-name" placeholder="Enter member name" required>`;
        
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
            const totalMembersInput = this.parentElement.nextElementSibling.querySelector('.total-members');
            const newMemberInput = document.createElement('input');
            newMemberInput.type = 'text';
            newMemberInput.className = 'form-control mb-2 member-name';
            newMemberInput.placeholder = 'Enter member name';
            memberListDiv.appendChild(newMemberInput);
            updateMemberCount(memberListDiv, totalMembersInput);
        });
    });
</script>

    @include('Admin.components.scripts')

</body>

</html>
