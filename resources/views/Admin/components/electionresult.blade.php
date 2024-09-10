<script>
        function getQueryParam(param) {
        let urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }

    // Example usage to get the elect_id
    let electId = getQueryParam('elect_id');
    console.log(electId)

    function getResult(){
        $.ajax({
            url: "{{ route('ElectionResult') }}?elect_id="+electId,
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log(response)
                 },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Error: " + textStatus + " " + errorThrown);
            }
        });
    }
    $(document).ready(function() {
       getResult()
    });
</script>