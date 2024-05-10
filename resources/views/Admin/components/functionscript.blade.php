<script>
    console.log('connect');

    function SaveDepartment() {

        var formData = $("form#adddepartmentform").serialize();
        
        $.ajax({
            type: "POST",
            url: "{{ route('SaveDepartment') }}",
            data: formData,
            success: function(response) {
              console.log('success');
            },
            error: function(xhr, status, error) {

                console.error(xhr.responseText);
            }
        });
    }
</script>
