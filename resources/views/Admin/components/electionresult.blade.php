<script>
        function getQueryParam(param) {
        let urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }

    // Example usage to get the elect_id
    let electId = getQueryParam('elect_id');
    let data ='';
    function getResult(){
        document.getElementById('lineLoading').style.display='';
        $.ajax({
            url: "{{ route('ElectionResult') }}?elect_id="+electId,
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                document.getElementById('lineLoading').style.display='none';
                document.getElementById('table_id').style.display='';
                 data = response.data
                data.forEach(data => {
                    if(data.candi_position=='President'){
                        var pres = document.getElementById('president');
                        pres.innerHTML += `
                        <tr>
                        <td>${data.candi_position}</td>
                        <td>${data.student_name}</td>
                        <td>${data.party_name}</td>
                        <td class="text-success">${data.vote_count}</td>
                        </tr>
                        `; 
                       
                    }else if(data.candi_position=='Vice President'){
                        var pres = document.getElementById('vicepresident');
                        pres.innerHTML += `
                        <tr>
                        <td>${data.candi_position}</td>
                        <td>${data.student_name}</td>
                        <td>${data.party_name}</td>
                        <td class="text-success">${data.vote_count}</td>
                        </tr>`; 
                       
                    }else if(data.candi_position=='Senator'){
                        var pres = document.getElementById('senators');
                        pres.innerHTML += `
                        <tr>
                        <td>${data.candi_position}</td>
                        <td>${data.student_name}</td>
                        <td>${data.party_name}</td>
                        <td class="text-success">${data.vote_count}</td>
                        </tr>
                        `; 
                       
                    }else if(data.candi_position=="Governor"){
                        var pres = document.getElementById('governor');
                        pres.innerHTML += `
                        <tr>
                        <td>${data.candi_position}</td>
                        <td>${data.student_name}</td>
                        <td>${data.party_name}</td>
                        <td class="text-success">${data.vote_count}</td>
                        </tr>
                        `; 
                       
                    }else if(data.candi_position=='Vice Governor'){
                        var pres = document.getElementById('vicegovernor');
                        pres.innerHTML += `
                        <tr>
                        <td>${data.candi_position}</td>
                        <td>${data.student_name}</td>
                        <td>${data.party_name}</td>
                        <td class="text-success">${data.vote_count}</td>
                        </tr>
                        `; 
                       
                    }else if(data.candi_position=="Representative"){
                        var pres = document.getElementById('representatives');
                        pres.innerHTML += `
                        <tr>
                        <td>${data.candi_position}</td>
                        <td>${data.student_name}</td>
                        <td>${data.party_name}</td>
                        <td class="text-success">${data.vote_count}</td>
                        </tr>
                        `; 
                       
                    }
                });
                
         document.getElementById('cardload').style.display='';
                 },
            error: function(xhr, textStatus, errorThrown) {
                console.error(xhr.response);
            }
        });
    }
    function viewResult() {
    $.ajax({
        url: `{{ route('ElectionResult') }}?elect_id=${electId}&getResult=Result`,
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            const valid = response.message;
            const cardsContainer = document.getElementById('cards');
            const cardLoad = document.getElementById('cardload');

            // Hide elements if the election is ongoing
            if (valid === "Ongoing") {
                cardLoad.style.display = 'none';
                cardsContainer.style.display = 'none';
                return;
            }

            // Handle the case where the election has ended
            if (valid === "Ended") {
                const result = {};

                // Group candidates by position and select the highest votes
                data.forEach(candidate => {
                    const position = candidate.candi_position;
                    if (!result[position] || candidate.vote_count > result[position].vote_count) {
                        result[position] = candidate;
                    }
                });

                const highestVotedCandidates = Object.values(result);
                cardsContainer.innerHTML = ''; // Clear previous content

                // Check if there are any candidates to display
                if (highestVotedCandidates.length > 0) {
                    highestVotedCandidates.forEach(item => {
                        const cardHtml = `
                            <div class="col-md-4 col-lg-2 fade-card">
                                <div class="card card-link card-link-pop" style="height: 100%;">
                                    <a href="#" class="d-block">
                                        <img src="{{ asset('/student_images/${item.candi_picture}') }}" style="height: 40vh; object-fit: cover;" class="card-img-top" alt="Event image">
                                    </a>
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <div>${item.student_name}</div>
                                                <div class="text-muted">${item.candi_position}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                        cardsContainer.innerHTML += cardHtml; // Append the card HTML to the container
                    });

                    // Prepare the FormData for the AJAX request
                    const formData = new FormData();
                    formData.append('_token', '{{ csrf_token() }}'); // Append CSRF token

                    // Append candidates data to FormData
                    highestVotedCandidates.forEach(candidate => {
                        formData.append('candidates[]', JSON.stringify(candidate));
                    });

                    // Send the AJAX request to save the results
                    $.ajax({
                        url: "{{ route('saveResult') }}",
                        type: 'POST',
                        processData: false,
                        contentType: false,
                        data: formData,
                        success: function(response) {
                            console.log('Success:', response);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                            console.log('Response:', xhr.responseText); // For debugging
                        }
                    });

                    // Display the results
                    cardsContainer.style.display = '';
                } else {
                    // No candidates available
                    cardsContainer.innerHTML = '';
                }
                cardLoad.style.display = 'none'; // Hide loading indicator
            } else {
                // Hide elements if the election status is neither ongoing nor ended
                cardLoad.style.display = 'none';
                cardsContainer.style.display = 'none';
            }
        },
        error: function(xhr) {
            console.error(xhr.response);
        }
    });
}

    $(document).ready(function() {
       getResult()
       viewResult()
      
    });
</script>
