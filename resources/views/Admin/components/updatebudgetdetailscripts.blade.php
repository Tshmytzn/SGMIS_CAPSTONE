<script>
 function updateBudgetProposal(formId) {

    var formElement = document.getElementById(formId);
    var formData = new FormData(formElement); 
    formData.append('_token', '{{ csrf_token() }}'); 

    $.ajax({
        type: "POST",
        url: '{{ route('updateBudgetProposal') }}',
        data: formData,
        contentType: false, 
        processData: false, 
        success: function(response) {
            if (response.status == 'error') {
                alertify.alert("Warning", response.message, function() {
                    alertify.message('OK');
                });
            } else {
                formElement.reset(); 
                // $('#budgetProposalUpdate').modal('hide');
                location.reload();
                alertify.alert("Message", response.message, function() {
                    alertify.message('OK');
                });

                if (response.reload && typeof window[response.reload] === 'function') {
                    window[response.reload]();
                }
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText); 
        }
    });
}

</script>
