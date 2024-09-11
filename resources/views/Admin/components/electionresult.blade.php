<script>
        function getQueryParam(param) {
        let urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }

    // Example usage to get the elect_id
    let electId = getQueryParam('elect_id');

    function getResult(){
        $.ajax({
            url: "{{ route('ElectionResult') }}?elect_id="+electId,
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log(response)
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
