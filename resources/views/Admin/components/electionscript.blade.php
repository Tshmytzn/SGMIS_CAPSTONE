
<script>
    function dynamicFuction(formId, routeUrl) {
    // Show the loader
    document.getElementById('adminloader').style.display = 'grid';
    
    // Serialize the form data
    var formData = $("form#" + formId).serialize();

    // Send the AJAX request
    $.ajax({
        type: "POST",
        url: routeUrl,
        data: formData,
        success: function(response) {
            document.getElementById('adminloader').style.display = 'none';
            if(response.status=='error'){
                alertify
                        .alert("Warning", response.message, function() {
                            alertify.message('OK');
                        });
            }else{
            document.getElementById(formId).reset();
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
</script>