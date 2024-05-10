<script>
    console.log('connect');

    function SaveDepartment() {
        var formData = $("form#adddepartmentform").serialize();
        $.ajax({
            type: "POST",
            url: "{{ route('SaveDepartment') }}",
            data: formData,
            success: function(response) {
                if (response.status == 'success') {
                    alertify
                        .alert("Message", "New Department Successfully Added", function() {
                            alertify.message('OK');
                        });
                } else if (response.status == 'exist') {
                    alertify
                        .alert("Alert", "Department Already Exist", function() {
                            alertify.message('OK');
                        });
                } else if (response.status == 'empty') {
                    alertify
                        .alert("Warning", "Enter Department Name First!", function() {
                            alertify.message('OK');
                        });
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    function SaveCourse() {
        var formData = $("form#addcourseform").serialize();
        $.ajax({
            type: "POST",
            url: "{{ route('SaveCourse') }}",
            data: formData,
            success: function(response) {
                if (response.status == 'success') {
                    alertify
                        .alert("Message", "New Course Successfully Added", function() {
                            alertify.message('OK');
                        });
                } else if (response.status == 'exist') {
                    alertify
                        .alert("Alert", "Course Already Exist", function() {
                            alertify.message('OK');
                        });
                } else if (response.status == 'empty') {
                    alertify
                        .alert("Warning", "Enter Course Name First!", function() {
                            alertify.message('OK');
                        });
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
    function GetDeptData() {
    const dept = document.getElementById('selectdepartment').value;
    console.log(dept); 
    $.ajax({
        type: "GET",
        url: "{{ route('GetDeptData') }}?dept_id=" + dept,
        success: function(response) {
            $('#selectcourse').empty(); 
            response.data.forEach(function(course) {
                $('#selectcourse').append('<option value="' + course.course_id + '">' + course.course_name + '</option>');
            });
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}
function SaveSection() {
        var formData = $("form#addsectionform").serialize();
        $.ajax({
            type: "POST",
            url: "{{ route('SaveSection') }}",
            data: formData,
            success: function(response) {
                if (response.status == 'success') {
                    alertify
                        .alert("Message", "New Section Successfully Added", function() {
                            alertify.message('OK');
                        });
                } else if (response.status == 'exist') {
                    alertify
                        .alert("Alert", "Section Already Exist", function() {
                            alertify.message('OK');
                        });
                } else if (response.status == 'empty') {
                    alertify
                        .alert("Warning", "Enter Section Name First!", function() {
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
