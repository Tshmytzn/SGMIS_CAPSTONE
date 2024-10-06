<script>
    let committeeIndex = 0; // To track committee count

    // Function to add a new committee row
    document.getElementById('addCommitteeRow').addEventListener('click', function() {
        committeeIndex++;
        const newRow = `
        <tr>
            <td>
                <input type="text" class="form-control" name="committees[${committeeIndex}][name]" placeholder="Enter committee name" required>
            </td>
            <td>
                <div class="person-in-charge-list">
                    <input type="text" class="form-control mb-2 person-in-charge-name" name="committees[${committeeIndex}][persons_in_charge][]" placeholder="Enter head(s)" required>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-primary add-person-in-charge-btn col-6">Add Another Person-in-Charge</button>&nbsp;
                    <button type="button" class="btn btn-danger remove-person-in-charge-btn col-6">Remove Person-in-Charge</button>
                </div>
            </td>
            <td>
                <button type="button" class="btn btn-danger remove-committee-btn col-12">Remove Committee</button>
            </td>
        </tr>`;
        document.getElementById('committeeTable').insertAdjacentHTML('beforeend', newRow);
    });

    // Event delegation for removing a committee row or person-in-charge input
    document.getElementById('committeeTable').addEventListener('click', function(e) {
        // Remove committee row
        if (e.target.classList.contains('remove-committee-btn')) {
            e.target.closest('tr').remove();
        }

        // Remove person-in-charge input
        if (e.target.classList.contains('remove-person-in-charge-btn')) {
            const personInChargeList = e.target.closest('td').querySelector('.person-in-charge-list');
            const inputs = personInChargeList.querySelectorAll('input');

            // Check if there is more than one input
            if (inputs.length > 1) {
                inputs[inputs.length - 1].remove();
            } else {
                alert("At least one person-in-charge must be present.");
            }
        }
    });

    // Event delegation for adding another person-in-charge
    document.getElementById('committeeTable').addEventListener('click', function(e) {
        if (e.target.classList.contains('add-person-in-charge-btn')) {
            const personInChargeList = e.target.closest('td').querySelector('.person-in-charge-list');
            const currentCommitteeIndex = e.target.closest('tr').querySelector('input[name^="committees"]').name
                .match(/\d+/)[0]; // Get current committee index
            const newPersonInChargeInput =
                `
            <input type="text" class="form-control mb-2 person-in-charge-name" name="committees[${currentCommitteeIndex}][persons_in_charge][]" placeholder="Enter head(s)" required>`;
            personInChargeList.insertAdjacentHTML('beforeend', newPersonInChargeInput);
        }
    });

    function submitForm() {
        // Validate that all fields are filled
        let allValid = true;

        // Variable to track if at least one person-in-charge is filled
        let atLeastOnePersonInCharge = false;

        // Check each committee row
        $('#committeeTable tr').each(function() {
            const committeeName = $(this).find('input[placeholder="Enter committee name"]').val();
            const personsInCharge = $(this).find('.person-in-charge-name').map(function() {
                return $(this).val();
            }).get();

            // Validate committee name
            if (!committeeName) {
                alertify.error('Committee name is required.');
                allValid = false;
                return false; // Exit the .each() loop
            }

            // Validate persons in charge
            personsInCharge.forEach((person, index) => {
                if (person) {
                    atLeastOnePersonInCharge = true; // Mark if at least one is filled
                } else {
                    alertify.error(`Person-in-charge #${index + 1} is required.`);
                    allValid = false; // Mark the form as invalid
                }
            });

            // If no persons in charge are filled, show an error
            if (!atLeastOnePersonInCharge) {
                alertify.error('At least one person-in-charge is required.');
                allValid = false;
            }
        });

        if (!allValid) {
            return; // Stop submission if validation fails
        }
        alertify.confirm("Would you like to save the committee data and continue to the next section?", function(e) {
            if (e) {
                // Proceed with the form submission via AJAX
                let formData = new FormData($('#committeeForm')[0]);
                formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

                $("#committeeForm button").prop('disabled', true); // Disable buttons inside the form
                $("#committeeForm button").hide(); // Hide all buttons

                $.ajax({
                    url: '{{ route('committees.store') }}', // Laravel route to store data
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        alertify.success('Committees saved successfully!');
                        console.log(response);

                    },
                    error: function(xhr, status, error) {
                        alertify.error('An error occurred: ' + xhr.responseText);
                        console.log(xhr.responseText);
                    }
                });
            } else {
                alertify.error("Action canceled.");
            }
        });
    }

    $(document).ready(function() {
        $("#committeeForm button").hide();
        $("#committeeForm button").prop('disabled', true);

        $("#committeemembers button").hide();
        $("#committeemembers button").prop('disabled', true);

        $('div[title="Edit Committtee"]').on('click', function() {

            $("#committeeForm button").prop('disabled', false); // Enable form buttons
            $("#committeeForm button").show(); // Show form buttons
        });
        $('div[title="Add Members"]').on('click', function() {

            $("#committeemembers button").prop('disabled', false); // Enable form buttons
            $("#committeemembers button").show(); // Show form buttons
        });
    });
</script>
