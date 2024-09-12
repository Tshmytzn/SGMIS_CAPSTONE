<script>
        function getQueryParam(param) {
        let urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }

    // Example usage to get the elect_id
    let electId = getQueryParam('elect_id');

    function getResult(){
        document.getElementById('lineLoading').style.display='';
        $.ajax({
            url: "{{ route('ElectionResult') }}?elect_id="+electId,
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log(response.data)
                document.getElementById('lineLoading').style.display='none';
                document.getElementById('table_id').style.display='';
                const data = response.data
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

                 },
            error: function(xhr, textStatus, errorThrown) {
                console.error(xhr.response);
            }
        });
    }
    $(document).ready(function() {
       getResult()
    });
</script>
