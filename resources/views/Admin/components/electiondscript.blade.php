<script>
    $(document).ready(function() {
        getElection()

    });

    function getQueryParam(param) {
        let urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }

    // Example usage to get the elect_id
    let electId = getQueryParam('elect_id');

    function getElection() {
        document.getElementById('formload').style.display = '';
        document.getElementById('formElect').style.display = 'none';
        $.ajax({
            url: "{{ route('getElection') }}?elect_id=" + electId,
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                document.getElementById('formElect').style.display = '';
                document.getElementById('formload').style.display = 'none';
                const data = response.data;
                document.getElementById('election_name').value = data.elect_name;
                document.getElementById('election_desc').value = data.elect_description;
                document.getElementById('voting_start_date').value = data.elect_start;
                document.getElementById('voting_end_date').value = data.elect_end;
                document.getElementById('elect_id').value = electId;
                document.getElementById('electID').value = electId;
                getParty()
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Error: " + textStatus + " " + errorThrown);
            }
        });
    }

    function dynamicFunction(formId, routeUrl) {
        // Show the loader
        document.getElementById('adminloader').style.display = 'grid';
        // Create a new FormData object from the form
        var formElement = document.getElementById(formId);
        var formData = new FormData(formElement);

        // Append the CSRF token to the FormData
        formData.append('_token', '{{ csrf_token() }}');

        // Send the AJAX request
        $.ajax({
            type: "POST",
            url: routeUrl,
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

    function getParty() {
        // Show the loader
        document.getElementById('cardload').style.display = '';
        document.getElementById('cards').style.display = 'none';
        // Create FormData object
        var formData = new FormData();
        // Append the CSRF token to the FormData
        formData.append('elect_id', electId);
        formData.append('_token', '{{ csrf_token() }}');

        $.ajax({
            url: "{{ route('party') }}?method=get", // Include query parameter in the URL
            method: 'POST', // Using POST method
            dataType: 'json',
            data: formData,
            contentType: false, // Disable setting content type for FormData
            processData: false, // Disable processing data (FormData)
            success: function(response) {
                // Hide the loader on success
                document.getElementById('cardload').style.display = 'none';
                document.getElementById('cards').style.display = '';
                var cardsContainer = document.getElementById('cards');
                cardsContainer.innerHTML = ''; // Clear previous content

                if (response.data.length === 0) {
                    // No data available
                    cardsContainer.innerHTML = `<div class="empty">
                    <div class="empty-img"><img src="{{ asset('./static/illustrations/undraw_voting_nvu7.svg') }}" height="128" alt="">
                    </div>
                    <p class="empty-title">No Party Results Available</p>
                    <p class="empty-subtitle text-secondary">
                      Try adjusting your filters or search criteria to find specific party results or candidates.
                    </p>
                  </div>`;
                } else {
                    // Iterate through the data array and create card elements
                    response.data.forEach(function(item, index) {
                        var cardHtml = `
                            <div class="col-md-6 col-lg-3 fade-card" id="card-${index}" >
                              <div class="card card-link card-link-pop folder2">
                                <div class="img-responsive img-responsive-21x9 card-img-top" style="background-image: url(/party_image/${item.party_picture})"></div>
                                <div class="card-body">
                                  <h3 class="card-title">${item.party_name}</h3>
                                    <div class="d-flex align-items-center">
                                    <div class="ms-auto">
                                        <button type="button" class="me-3 text-muted border-0 bg-body" data-bs-toggle="modal" data-bs-target="#updateparty" onclick="getPartyByID(${item.party_id})">
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                            </button>
                                            <a href="{{ route('partycandidates') }}?party_id=${item.party_id}" title="View event" class="text-muted">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icon-tabler-eye">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                    <path
                                                        d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                </svg>
                                            </a>
                                            <button type="button" class="ms-3 text-muted border-0 bg-body" title="Delete event" onclick="removeParty('${item.party_id}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icon-tabler-trash">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M4 7l16 0" />
                                                    <path d="M10 11l0 6" />
                                                    <path d="M14 11l0 6" />
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                </svg>
                                            </button>
                                        </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            `;
                        // Append the card HTML to the container
                        cardsContainer.innerHTML += cardHtml;
                    });
                }

                // Pop up cards one by one
                $('.fade-card').each(function(index) {
                    var $card = $(this);
                    setTimeout(function() {
                        $card.addClass('show'); // Add class to trigger the CSS transition
                    }, index * 100); // 300ms delay between each card
                });

                // Process the response data here
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Hide the loader on error
                document.getElementById('cardload').style.display = 'none';
                console.error("Error: " + textStatus + " " + errorThrown);
            }
        });
    }

    function getPartyByID(id) {
        document.getElementById('modalload').style.display = '';
        document.getElementById('updatepartyform').style.display = 'none';
        var formData = new FormData();
        // Append the CSRF token to the FormData
        formData.append('method', 'get');
        formData.append('party_id', id)
        formData.append('_token', '{{ csrf_token() }}'); // Only works in Blade templates

        $.ajax({
            url: "{{ route('party') }}", // Ensure the 'party' route is correct
            method: 'POST', // Using POST method
            dataType: 'json',
            data: formData,
            contentType: false, // Necessary for FormData
            processData: false, // Prevent jQuery from processing data
            success: function(response) {
                const data = response.data
                console.log(data)
                document.getElementById('modalload').style.display = 'none';
                document.getElementById('updatepartyform').style.display = '';
                document.getElementById('party_id_update').value = data.party_id
                document.getElementById('party_name_update').value = data.party_name
                document.getElementById('party_desc_update').value = data.party_description
                document.getElementById('party_image_update1').style.backgroundImage =
                    "url('/party_image/" + data.party_picture + "')";
                console.log("Success Response:", response);
                // Handle the successful response here
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("AJAX Error: ", textStatus, errorThrown);
                console.log("Response Text: ", jqXHR
                    .responseText); // Check the detailed error message from server
                document.getElementById('cardload').style.display = 'none'; // Hide loader
            }
        });
    }


    function removeParty(id) {
        document.getElementById('party_id').value = id;
        alertify.confirm("Warning", "Are you sure you want to remove this party",
            function() {
                dynamicFunction('removePartyForm', `{{ route('party') }}`)
            },
            function() {
                alertify.error('Cancel');
            });

    }
</script>
