<script>
    function GetDeptDataSavestudent() {
        const dept = document.getElementById('selectdepartment').value;
        document.getElementById('lineLoading').style.display=''
        $('#selectcourse').hide();
        console.log(dept);
        $.ajax({
            type: "GET",
            url: "{{ route('GetDeptData') }}?dept_id=" + dept,
            success: function(response) {
                document.getElementById('lineLoading').style.display='none'
                $('#selectcourse').show();
                $('#selectcourse').empty();
                $('#selectcourse').append('<option>Select Course</option>');
                response.data.forEach(function(course) {
                    $('#selectcourse').append('<option value="' + course.course_id + '">' + course
                        .course_name + '</option>');
                });
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
    function GetSectData() {
    const crs = document.getElementById('selectcourse').value;
    const yearLevel = document.getElementById('selectYearLevel').value;
    document.getElementById('lineLoading2').style.display=''
    $('#selectsection').hide();

    $.ajax({
        type: "GET",
        url: "{{ route('GetSectData') }}",
        data: {
            course_id: crs,
            year_level: yearLevel,
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            document.getElementById('lineLoading2').style.display='none'
            $('#selectsection').show();
            $('#selectsection').empty();
            if(response.data.length>0){
                response.data.forEach(function(course) {
                $('#selectsection').append('<option value="' + course.sect_id + '">' + course.sect_name + '</option>');
            });
            }else{
                $('#selectsection').append('<option disabled selected>No Section Available</option>');
            }
            
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}
function SaveStudent() {
        var formData = $("form#SaveStudentForm").serialize();
        $.ajax({
            type: "POST",
            url: "{{ route('SaveStudent') }}",
            data: formData,
            success: function(response) {
                if (response.status == 'success') {
                    alertify
                        .alert("Message", "Student Successfully Saved", function() {
                            alertify.message('OK');
                            clearFormInputs('SaveStudentForm');
                            GetStudentData();
                            closeModal();

                        });
                } else if (response.status == 'exist') {
                    alertify
                        .alert("Alert", "Student Already Exist", function() {
                            alertify.message('OK');
                        });
                } else if (response.status == 'empty') {
                    alertify
                        .alert("Warning", "Enter Student Name First!", function() {
                            alertify.message('OK');
                        });
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
    function GetStudentData(id) {
        if (typeof id === 'undefined') {
            document.getElementById('yearTitle').textContent = 'All Year Level';
            const courseId = document.getElementById('AutoCourse').value;
            $('#GetStudentTable').DataTable({
                destroy: true,
                ajax: {
                    url: '{{ route('GetStudentData') }}?course_id=' + courseId,
                    type: 'GET'
                },
                columns: [{
                        data: 'school_id'
                    },
                    {
                        data: 'student_firstname'
                    },
                    {
                        data: 'student_middlename'
                    },
                    {
                        data: 'student_lastname'
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return row.year_level + ' - ' + row.sect_name;

                        }
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return '<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editstudentacc" onclick="editStudentinfo(`' +
                                row.student_id + '`,`' + row.school_id + '`,`' + row.student_firstname +
                                '`,`' + row.student_middlename + '`,`' + row.student_lastname + '`,`' +
                                row.student_ext + '`,`' + row.year_level + '`,`' + row.sect_name +
                                '`)">Edit</button>';
                        }
                    },
                ]
            });
        } else {
            const sectId = document.getElementById('selectSectId').value
            const sectIdArray = sectId.split(',');
            document.getElementById('yearTitle').textContent = sectIdArray[2] + ' ' + '-' + ' ' + sectIdArray[1];
            $('#GetStudentTable').DataTable({
                destroy: true,
                ajax: {
                    url: '{{ route('GetStudentData') }}?sect_id=' + id,
                    type: 'GET'
                },
                columns: [{
                        data: 'school_id'
                    },
                    {
                        data: 'student_firstname'
                    },
                    {
                        data: 'student_middlename'
                    },
                    {
                        data: 'student_lastname'
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return row.year_level + ' - ' + row.sect_name;

                        }
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return '<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editstudentacc" onclick="editStudentinfo(`' +
                                row.student_id + '`,`' + row.school_id + '`,`' + row.student_firstname +
                                '`,`' + row.student_middlename + '`,`' + row.student_lastname + '`,`' +
                                row.student_ext + '`,`' + row.year_level + '`,`' + row.sect_name +
                                '`)">Edit</button>';
                        }
                    },

                ]
            });
        }
    }
    function editStudentinfo(id, sch_id, sf, sm, sl, se, yl, sc_n) {
        console.log(sc_n);
        document.getElementById('EditStudentID').value = id;
        document.getElementById('editfirstname').value = sf;
        document.getElementById('editmiddlename').value = sm;
        document.getElementById('editlastname').value = sl;
        document.getElementById('editext').value = se;
        document.getElementById('editstudentschoolid').value = sch_id;
        document.getElementById('EditModalTitle').textContent = yl + ' - ' + sc_n;
    }
    function EditStudent() {
        var formData = $("form#EditStudentForm").serialize();
        $.ajax({
            type: "POST",
            url: "{{ route('EditStudent') }}",
            data: formData,
            success: function(response) {
                if (response.status == 'success') {
                    alertify
                        .alert("Message", "Student Successfully Edited", function() {
                            alertify.message('OK');
                            clearFormInputs('EditStudentForm');
                            GetStudentData();
                            closeModal();

                        });
                } else if (response.status == 'exist') {
                    alertify
                        .alert("Alert", "Student Already Exist", function() {
                            alertify.message('OK');
                        });
                } else if (response.status == 'empty') {
                    alertify
                        .alert("Warning", "Enter Student Name First!", function() {
                            alertify.message('OK');
                        });
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
    function closeModal() {
        var modalElements = document.getElementsByClassName('modal');
        for (var i = 0; i < modalElements.length; i++) {
            if (modalElements[i].classList.contains('show')) {
                var closeButton = modalElements[i].querySelector('[data-bs-dismiss="modal"]');
                if (closeButton) {
                    closeButton.click();
                }
            }
        }
    }
    function clearFormInputs(formId) {
        var form = document.getElementById(formId);
        var inputs = form.getElementsByTagName('input');
        for (var i = 0; i < inputs.length; i++) {
            // Check if the input type is not 'hidden' and its name is not '_token'
            if (inputs[i].type !== 'hidden' && inputs[i].name !== '_token') {
                inputs[i].value = '';
            }
        }
        var textareas = form.getElementsByTagName('textarea');
        for (var i = 0; i < textareas.length; i++) {
            textareas[i].value = '';
        }

    }
    function selectSect(id, name, year) {
        document.getElementById('selectSectId').value = id + ',' + name + ',' + year;
        GetStudentData(id);
        document.getElementById('yeardropdown').textContent= year  + ' - ' + name;
    }
     $(document).ready(function() {
        GetStudentData()

    });
</script>