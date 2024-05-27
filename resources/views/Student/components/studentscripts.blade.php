<script>

function LoginStudent() {
    var formData = $("form#studentloginform").serialize();

    $.ajax({
            type: "POST",
            url: "{{ route('LoginStudent') }}",
            data: formData,
            success: function(response) {
                if(response.status=="success"){
                    alertify.alert("Message", "Student Successfully Logged in", function() {
                            alertify.message('OK');
                            window.location.href = "{{ route('StudentDashboard') }}";
                        });
                    } else if (response.status=="incorrect"){
                        alertify.alert("Message", "Incorrect Username or Password!", function() {
                            alertify.message('OK');
                        });
                    } else {
                        alertify.alert("Message", "Student Not Found", function() {
                            alertify.message('OK');
                        });
                    }
 },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
}

</script>
