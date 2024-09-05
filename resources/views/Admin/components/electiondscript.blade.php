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
    document.getElementById('lineLoading').style.display = '';
     $.ajax({
        url: "{{route('getElection')}}?elect_id="+electId,  
        method: 'GET',         
        dataType: 'json',     
        success: function(response) {
            document.getElementById('formElect').style.display = '';
            document.getElementById('lineLoading').style.display = 'none';
            const data = response.data;
            document.getElementById('election_name').value=data.elect_name;
            document.getElementById('election_desc').value=data.elect_description;
            document.getElementById('voting_start_date').value=data.elect_start;
            document.getElementById('voting_end_date').value=data.elect_end;
             },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error("Error: " + textStatus + " " + errorThrown);
             }
        });
}
</script>