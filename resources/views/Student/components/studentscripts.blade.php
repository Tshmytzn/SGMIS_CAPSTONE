<script>
    function reloadElementById(elementId) {
        var element = document.getElementById(elementId);
        if (element) {
            $(element).load(window.location.href + ' #' + elementId);
        }
    }

    function LoginStudent() {
    const formData = $("form#studentloginform").serialize();

    $.ajax({
        type: "POST",
        url: "{{ route('LoginStudent') }}",
        data: formData,
        success: function(response) {
            if (response.status === "success") {
                    window.location.href = "{{ route('StudentDashboard') }}";
            } else if (response.status === "incorrect") {
                alertify.alert("Message", "Incorrect Username or Password!", function() {
                    alertify.message('OK');
                });
            } else if (response.status === "not_found") {
                alertify.alert("Message", "Student Not Found", function() {
                    alertify.message('OK');
                });
            } else {
                alertify.alert("Message", "An unexpected error occurred. Please try again.", function() {
                    alertify.message('OK');
                });
            }
        },
        error: function(xhr, status, error) {
            alertify.alert("Message", "An error occurred while processing your request. Please try again.", function() {
                alertify.message('OK');
            });
            console.error(xhr.responseText);
        }
    });
}

function ChangePass() {
    // Get the password input fields
    const first = document.getElementById('newpass');
    const second = document.getElementById('repass');

    // Check if the passwords match or if any of the fields are empty
    if (first.value === second.value && first.value !== '' && second.value !== '') {
        // Serialize the form data
        const formData = $("form#UpdateStudentPassForm").serialize();

        // Send the data via AJAX
        $.ajax({
            type: "POST",
            url: "{{ route('updatestudentPass') }}",  // Assuming the route is correct
            data: formData,
            success: function(response) {
                $('#updatepassword').modal('hide');
                alertify.success('Password updated successfully');
            },
            error: function(xhr, status, error) {
                // Handle error
                alertify.alert("Message", "An error occurred while processing your request. Please try again.", function() {
                    alertify.message('OK');
                });
                console.error(xhr.responseText);
            }
        });
    } else {
        // If passwords do not match or are empty, apply red border
        first.style.border = "2px solid red";
        second.style.border = "2px solid red";
        alertify.error('Passwords do not match or are empty');
    }
}



    function UpdateStudentDetails() {
        var formData = $("form#Studentdetailsform").serialize();

        $.ajax({
            type: "POST",
            url: "{{ route('UpdateStudentDetails') }}",
            data: formData,
            success: function(response) {
                if (response.status == "success") {
                    reloadElementById('Studentdetailsform');
                    alertify.alert("Message", "Student Successfully Updated", function() {
                        alertify.message('OK');
                    });
                } else if (response.status == "empty") {
                    alertify.alert("Message", "Please Fill in all Fields", function() {
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


    function UpdateStudentimage() {
        const pic = document.getElementById('updatestudentpic');
        if (pic.files.length == 0) {
            alertify
                .alert("Warning", "Image Required", function() {
                    alertify.message('OK');
                });
        } else {
            var formData = new FormData();
            formData.append('image', $('#updatestudentpic')[0].files[0]);
            formData.append('_token', '{{ csrf_token() }}');

        $.ajax({
            type: "POST",
            url: "{{ route('UpdateStudentDetails') }}",
            data: formData,
            success: function(response) {
                if (response.status == "success") {
                    reloadElementById('Studentdetailsform');
                    alertify.alert("Message", "Student Successfully Updated", function() {
                        alertify.message('OK');
                    });
                } else if (response.status == "empty") {
                    alertify.alert("Message", "Please Fill in all Fields", function() {
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
    }






</script>
