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

function getElection(){
    document.getElementById('formload').style.display = '';
     $.ajax({
        url: "{{route('getElection')}}?elect_id="+electId,  
        method: 'GET',         
        dataType: 'json',     
        success: function(response) {
            document.getElementById('formElect').style.display = '';
            document.getElementById('formload').style.display = 'none';
            const data = response.data;
            document.getElementById('election_name').value=data.elect_name;
            document.getElementById('election_desc').value=data.elect_description;
            document.getElementById('voting_start_date').value=data.elect_start;
            document.getElementById('voting_end_date').value=data.elect_end;
            document.getElementById('elect_id').value=electId;
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
                 if (response.reload && typeof window[response.reload] === 'function') {
                    window[response.reload]();  // Safe dynamic function call
                }
                document.getElementById(formId).reset();
                $('#createparty').modal('hide');
                alertify
                        .alert("Message", response.message, function() {
                            alertify.message('OK');
                           
                        });
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
                cardsContainer.innerHTML = '<h1>No data</h1>';
            } else {
                        // Iterate through the data array and create card elements
                        response.data.forEach(function(item, index) {
                            var cardHtml = `
                            <div class="col-md-6 col-lg-3 fade-card" id="card-${index}">
                              <div class="card card-link card-link-pop folder2">
                                <div class="img-responsive img-responsive-21x9 card-img-top" style="background-image: url(/party_image/${item.party_picture})"></div>
                                <div class="card-body">
                                  <h3 class="card-title">${item.party_name}</h3>
                                    <div class="d-flex justify-content-between">
                                      <button class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-edit"
                                            style="margin-left: 8px;">

                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                            <path
                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                            <path d="M16 5l3 3" />
                                        </svg>Update</button>
                                      <button class="btn btn-danger" onclick="removeParty('${item.party_id}')">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash-x">
                                          <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7h16" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                          <path d="M10 12l4 4m0 -4l-4 4" />
                                        </svg>Remove</button>
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
                                $card.addClass('show');  // Add class to trigger the CSS transition
                            }, index * 100);  // 300ms delay between each card
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

function removeParty(id){
    document.getElementById('party_id').value=id;
    alertify.confirm("Warning","Are you sure you want to remove this party",
  function(){
     dynamicFunction('removePartyForm',`{{ route('party') }}`)
  },
  function(){
    alertify.error('Cancel');
  });
   
}
</script>