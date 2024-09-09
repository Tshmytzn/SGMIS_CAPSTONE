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
                    getCandi2()
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
        console.log(party_id)
        // Create FormData object
        var formData = new FormData();
        // Append the CSRF token to the FormData
        formData.append('party_id', party_id);
        formData.append('method', 'get');
        formData.append('group_of','1');
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
                console.log(response)
                document.getElementById('cardload').style.display = 'none';
                document.getElementById('cards').style.display = '';
                var cardsContainer = document.getElementById('cards');
                cardsContainer.innerHTML = '<h4>USG OFFICERS</h4>'; // Clear previous content

                if (response.data.length === 0) {
                    // No data available
                    cardsContainer.innerHTML = `
            <div class="col-md-6 col-lg-3 fade-card"   data-bs-toggle="modal" data-bs-target="#addCandi"> <!-- Fixed height -->
                <div class="card card-link card-link-pop folder2" style="height: 100%;"> <!-- Full height for the card -->
                  <div style="width: 100%; height: 100%; border: 2px dashed #000; padding: 2px; box-sizing: border-box;"> <!-- Dashed border and padding -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user-plus" style="width: 100%; height: 100%;"> <!-- Make SVG fill the container -->
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                      <path d="M16 19h6" />
                      <path d="M19 16v6" />
                      <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                    </svg>
                  </div>
                </div>
              </div>`;
                } else {
                    // Iterate through the data array and create card elements
                    response.data.forEach(function(item, index) {
                        var cardHtml = `
                            <div class="col-md-6 col-lg-3 fade-card">
                              <div class="card card-link card-link-pop ">
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
                      cardsContainer.innerHTML += `
            <div class="col-md-6 col-lg-3 fade-card"   data-bs-toggle="modal" data-bs-target="#addCandi"> <!-- Fixed height -->
                <div class="card card-link card-link-pop " style="height: 100%;"> <!-- Full height for the card -->
                  <div style="width: 100%; height: 100%; border: 2px dashed #000; padding: 2px; box-sizing: border-box;"> <!-- Dashed border and padding -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user-plus" style="width: 100%; height: 100%;"> <!-- Make SVG fill the container -->
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                      <path d="M16 19h6" />
                      <path d="M19 16v6" />
                      <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                    </svg>
                  </div>
                </div>
              </div>`;
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
        getCandi2()
        getCandi3()
    }

    function getCandi2() {
        // Show the loader
        // document.getElementById('cardload').style.display = '';
        document.getElementById('cards2').style.display = 'none';
        // Create FormData object
        var formData = new FormData();
        // Append the CSRF token to the FormData
        formData.append('party_id', party_id);
        formData.append('method', 'get');
        formData.append('group_of','2');
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
                // document.getElementById('cardload').style.display = 'none';
                document.getElementById('cards2').style.display = '';
                var cardsContainer = document.getElementById('cards2');
                cardsContainer.innerHTML = '<h4>DEPARMENT OFFICERS</h4>'; // Clear previous content

                if (response.data.length === 0) {
                    // No data available
                    cardsContainer.innerHTML = `<h4>DEPARMENT OFFICERS</h4>
            <div class="col-md-6 col-lg-3 fade-card"  data-bs-toggle="modal" data-bs-target="#addCandi2" onclick="groupBy('2')"> <!-- Fixed height -->
                <div class="card card-link card-link-pop folder2" style="height: 100%;"> <!-- Full height for the card -->
                  <div style="width: 100%; height: 100%; border: 2px dashed #000; padding: 2px; box-sizing: border-box;"> <!-- Dashed border and padding -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user-plus" style="width: 100%; height: 100%;"> <!-- Make SVG fill the container -->
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                      <path d="M16 19h6" />
                      <path d="M19 16v6" />
                      <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                    </svg>
                  </div>
                </div>
              </div>`;
                } else {
                    // Iterate through the data array and create card elements
                    response.data.forEach(function(item, index) {
                        var cardHtml = `
                            <div class="col-md-6 col-lg-3 fade-card">
                              <div class="card card-link card-link-pop ">
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
                      cardsContainer.innerHTML += `
            <div class="col-md-6 col-lg-3 fade-card"  data-bs-toggle="modal" data-bs-target="#addCandi2" onclick="groupBy('2')"> <!-- Fixed height -->
                <div class="card card-link card-link-pop " style="height: 100%;"> <!-- Full height for the card -->
                  <div style="width: 100%; height: 100%; border: 2px dashed #000; padding: 2px; box-sizing: border-box;"> <!-- Dashed border and padding -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user-plus" style="width: 100%; height: 100%;"> <!-- Make SVG fill the container -->
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                      <path d="M16 19h6" />
                      <path d="M19 16v6" />
                      <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                    </svg>
                  </div>
                </div>
              </div>`;
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

    function getCandi3() {
        // Show the loader
        // document.getElementById('cardload').style.display = '';
        document.getElementById('cards3').style.display = 'none';
        // Create FormData object
        var formData = new FormData();
        // Append the CSRF token to the FormData
        formData.append('party_id', party_id);
        formData.append('method', 'get');
        formData.append('group_of','3');
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
                // document.getElementById('cardload').style.display = 'none';
                document.getElementById('cards3').style.display = '';
                var cardsContainer = document.getElementById('cards3');
                cardsContainer.innerHTML = '<h4>COURSE REPRESENTATIVES</h4>'; // Clear previous content

                if (response.data.length === 0) {
                    // No data available
                    cardsContainer.innerHTML = `<h4>COURSE REPRESENTATIVES</h4>
            <div class="col-md-6 col-lg-3 fade-card"  data-bs-toggle="modal" data-bs-target="#addCandi2" onclick="groupBy('3')"> <!-- Fixed height -->
                <div class="card card-link card-link-pop folder2" style="height: 100%;"> <!-- Full height for the card -->
                  <div style="width: 100%; height: 100%; border: 2px dashed #000; padding: 2px; box-sizing: border-box;"> <!-- Dashed border and padding -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user-plus" style="width: 100%; height: 100%;"> <!-- Make SVG fill the container -->
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                      <path d="M16 19h6" />
                      <path d="M19 16v6" />
                      <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                    </svg>
                  </div>
                </div>
              </div>`;
                } else {
                    // Iterate through the data array and create card elements
                    response.data.forEach(function(item, index) {
                        var cardHtml = `
                            <div class="col-md-6 col-lg-3 fade-card">
                              <div class="card card-link card-link-pop ">
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
                      cardsContainer.innerHTML += `
            <div class="col-md-6 col-lg-3 fade-card"  data-bs-toggle="modal" data-bs-target="#addCandi2" onclick="groupBy('3')"> <!-- Fixed height -->
                <div class="card card-link card-link-pop " style="height: 100%;"> <!-- Full height for the card -->
                  <div style="width: 100%; height: 100%; border: 2px dashed #000; padding: 2px; box-sizing: border-box;"> <!-- Dashed border and padding -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user-plus" style="width: 100%; height: 100%;"> <!-- Make SVG fill the container -->
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                      <path d="M16 19h6" />
                      <path d="M19 16v6" />
                      <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                    </svg>
                  </div>
                </div>
              </div>`;
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

    function groupBy(num) {
    document.getElementById('groupBy').value = num;

    const select = document.getElementById('selectP'); // Moved this outside the if-else block

    if (num == 2) {
        select.innerHTML = `
            <label for="student_position" class="form-label">Position</label>
            <select name="student_position" class="form-control" id="student_position">
                <option value="" disabled selected>Select Position</option>
                <option value="Governor">Governor</option>
                <option value="Vice Governor">Vice Governor</option>

            </select>
        `;
    } else {
        select.innerHTML = `
            <label for="student_position" class="form-label" >Representative</label>
            <input type="text" class="form-control" name="student_position" value="Representative" id="student_position" readOnly>
        `;
    }
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
    function GetAllStudentData2() {
    $('#SelectStundentTable2').DataTable({
        pageLength: 2,
        scrollCollapse: true,
        destroy: true,
        ajax: {
            url: '{{ route('GetAllStudentData') }}?dept=dept', // Ensure this route is correct
            type: 'GET',
            dataSrc: 'data', // Make sure 'data' is the correct key
            error: function(xhr, error, thrown) {
                console.log('AJAX Error: ', thrown);
            }
        },
        columns: [
            // { data: 'student_firstname'+' '+'student_lastname', title: ' Name' },
            {
                    data: null,
                    render: function(data, type, row) {
                        return row.student_firstname + ' ' + row.student_lastname;
                    }
                },
            { data: 'school_id', title: 'School ID' },
            { data: 'dept_name', title: 'Department' },
            { data: 'course_name', title: 'Course' },
            { data: 'year_level', title: 'Section' },
            {
                    data: null,
                    render: function(data, type, row) {
                        const fullname = row.student_firstname + ' ' + row.student_lastname;
                        return '<button type="button" class="btn btn-warning btn-sm" onclick="SelectStudent(`' + row
                            .student_id + '`,`' + fullname + '`,`' + row.school_id +
                            '`)">Select</button>';
                    }, title: 'Action'
                },
        ],
    });
}


    function SelectStudent(id,name){
        document.getElementById('party_id').value=party_id
        document.getElementById('student_id').value=id
        document.getElementById('student_name').value=name
        document.getElementById('party_id2').value=party_id
        document.getElementById('student_id2').value=id
        document.getElementById('student_name2').value=name

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
        GetAllStudentData2()

    });
</script>
