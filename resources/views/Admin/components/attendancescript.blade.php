<script>
    function getAct(){
       const event_id = document.getElementById('EventId').value
         $.ajax({
        url: `{{ route('getAttendance') }}?getAttendance=Act&event_id=`+event_id,
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            console.log(response)
            const data = response.data
            const select = $('#ActId'); // Change to the ID of your <select> element
            
            // Clear the existing options
            select.empty();
            
            // Optionally, add a placeholder or default option
            select.append(`<option value="" selected>Select Activity</option>`);
            
            // Iterate over the response data and add each activity as an option
            data.forEach(function(activity) {
                select.append(`<option value="${activity.eact_id}">${activity.eact_name}</option>`);
            });
            },
        error: function(xhr) {
            console.error(xhr.response);
        }
    });
    }


    $(document).ready(function() {
    // Your code here
    });
</script>