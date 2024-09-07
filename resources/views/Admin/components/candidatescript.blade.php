<script>


    function getQueryParam(param) {
        let urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }

    // Example usage to get the elect_id
    let party_id = getQueryParam('party_id');

    function getParty() {
        document.getElementById('cardload').style.display = '';
        
        var formData = new FormData();
        // Append the CSRF token to the FormData
        formData.append('party_id', party_id);
        formData.append('method', 'get');
        formData.append('_token', '{{ csrf_token() }}');

        $.ajax({
            url: "{{ route('party') }}", // Include query parameter in the URL
            method: 'POST', // Using POST method
            dataType: 'json',
            data: formData,
            contentType: false, // Disable setting content type for FormData
            processData: false,
            success: function(response) {
                const data = response.data
                document.getElementById('partyGroup').textContent=data.party_name
                document.getElementById('partyCover').style.backgroundImage = "url('/party_image/" + data
                    .party_picture + "')"
                    getCandi();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Error: " + textStatus + " " + errorThrown);
            }
        });
    }

    function getCandi() {
        // Show the loader
        document.getElementById('cardload').style.display = '';
        document.getElementById('cards').style.display = 'none';
        // Create FormData object
        var formData = new FormData();
        // Append the CSRF token to the FormData
        formData.append('party_id', party_id);
        formData.append('method', 'get');
        formData.append('_token', '{{ csrf_token() }}');

        $.ajax({
            url: "{{ route('Candidate') }}", // Include query parameter in the URL
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
                      Try adjusting your filters or search criteria to find specific candidates.
                    </p>
                  </div>`;
                } else {
                    // Iterate through the data array and create card elements
                    response.data.forEach(function(item, index) {
                        var cardHtml = `
                            <div class="col-md-6 col-lg-3 fade-card" id="card-${index}" style="width: 25%">
                              <div class="card card-link card-link-pop folder2">
                                <a href="#" class="d-block">
                                    <img src="{{ asset('/student_images/${item.candi_picture}') }}" style="height: 40vh" class="card-img-top"
                                        alt="Event image">
                                </a>
                                <div class="card-body">
                                  <div class="d-flex align-items-center">
                                        <div>
                                            <div>${item.student_name}</div>
                                            <div class="text-muted">${item.candi_position}</div>
                                        </div>
                                    <div class="ms-auto">
                                            <a href="#" title="View event" class="text-muted" onclick="updatePic('${item.candi_picture}','${item.candi_id}')" data-bs-toggle="modal" data-bs-target="#updateCandi">
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
                                            <button class="ms-3 text-muted border-0 bg-body" title="Delete event" onclick="deleteCanid(${item.candi_id})">
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

    function updatePic(pic,id){
        document.getElementById('candi_id').value=id
       document.getElementById('stud_pic').src = '/student_images/'+pic;
    }
    function deleteCanid(id){
        document.getElementById('student_m').value=id
        dynamicFunction('deleteMemberform',"{{ route('Candidate') }}")
    }

    function GetAllStudentData() {
        $('#SelectStundentTable').DataTable({
            // scrollY: '150px',
            pageLength: 2,
            scrollCollapse: true,
            // paging: false,
            destroy: true,
            ajax: {
                url: '{{ route('GetAllStudentData') }}',
                type: 'GET'
            },
            columns: [{
                    data: null,
                    render: function(data, type, row) {
                        return row.student_firstname + ' ' + row.student_lastname;
                    }
                },
                {
                    data: 'school_id'
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        const fullname = row.student_firstname + ' ' + row.student_lastname;
                        return '<button type="button" class="btn btn-warning btn-sm" onclick="SelectStudent(`' + row
                            .student_id + '`,`' + fullname + '`,`' + row.school_id +
                            '`)">Select</button>';
                    }
                },
            ],
        });
    }
    function SelectStudent(id,name){
        document.getElementById('party_id').value=party_id
        document.getElementById('student_id').value=id
        document.getElementById('student_name').value=name

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

        $(document).ready(function() {
        getParty()
        GetAllStudentData()
       
        
    });
</script>
