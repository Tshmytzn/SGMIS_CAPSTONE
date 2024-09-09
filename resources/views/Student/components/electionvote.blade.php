<script>


function getCandi(num,group,pos) {
        // Show the loader
        document.getElementById('cardload'+num).style.display = '';
        document.getElementById('cards'+num).style.display = 'none';
        // Create FormData object
        var formData = new FormData();
        // Append the CSRF token to the FormData
        formData.append('method', 'get');
        formData.append('group_of',group);
        formData.append('position',pos);
        formData.append('vote','vote');
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
                document.getElementById('cardload'+num).style.display = 'none';
                document.getElementById('cards'+num).style.display = '';
                var cardsContainer = document.getElementById('cards'+num);
                const data = response.data;
                cardsContainer.innerHTML = ``;
                if (data.length === 0) {
                    // No data available
                    cardsContainer.innerHTML = `<div class="empty">
                    <div class="empty-img"><img src="{{ asset('./static/illustrations/undraw_voting_nvu7.svg') }}" height="128" alt="">
                    </div>
                    <p class="empty-title">No Party Results Available</p>
                    <p class="empty-subtitle text-secondary">
                      Try adjusting your filters or search criteria to find specific election results.
                    </p>
                  </div>`;
                } else {
                    // Iterate through the data array and create card elements
                    data.forEach(function(item, index) {
                        var cardHtml = `
                            <div class="col-md-6 col-lg-3 fade-card" onclick="selectCandi('${item.candi_id}','${item.party_id}','${item.student_name}','${num}','${pos}')">
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
            error: function(xhr, textStatus, errorThrown) {
                // Hide the loader on error
                document.getElementById('cardload'+num).style.display = 'none';
                console.error(xhr.responseText);
            }
        });
    }
function selectCandi(canid,partid,studname,num,pos){
    if(pos == 'Senator'){
    document.getElementById('canLabel'+num).textContent+=studname+', '
    document.getElementById('candi_id'+num).value+=canid+','
    document.getElementById('party_id'+num).value+=partid+','
}else{
    document.getElementById('candi_id'+num).value=canid
    document.getElementById('party_id'+num).value=partid
    document.getElementById('canLabel'+num).textContent=studname;
}

document.getElementById('button'+num).style.backgroundColor='#3E8A34'

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
                console.log(response)
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
        getCandi('1','1','President')
    });

</script>