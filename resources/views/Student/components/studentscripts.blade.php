<script>
    function reloadElementById(elementId) {
        var element = document.getElementById(elementId);
        if (element) {
            $(element).load(window.location.href + ' #' + elementId);
        }
    }

    function LoginStudent() {
        var formData = $("form#studentloginform").serialize();

        $.ajax({
            type: "POST",
            url: "{{ route('LoginStudent') }}",
            data: formData,
            success: function(response) {
                if (response.status == "success") {
                    alertify.alert("Message", "Student Successfully Logged in", function() {
                        alertify.message('OK');
                        window.location.href = "{{ route('StudentDashboard') }}";
                    });
                } else if (response.status == "incorrect") {
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
