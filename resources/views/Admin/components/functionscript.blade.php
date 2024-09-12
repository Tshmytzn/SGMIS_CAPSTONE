<script>
    console.log('connect');
    $(document).ready(function() {
        GetDepartmentData();
        GetCourseData();
        GetSectionData();
        GetStudentData()

    });

    document.addEventListener('DOMContentLoaded', function() {
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {  // Check if the pressed key is "Enter"
            event.preventDefault();   // Prevent the default action for the "Enter" key
        }
    });
});


    function selectSect(id, name, year) {
        document.getElementById('selectSectId').value = id + ',' + name + ',' + year;
        GetStudentData(id);
        document.getElementById('yeardropdown').textContent= year  + ' - ' + name;
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

    // function AddStudentModal(id) {
    //     const sectId = document.getElementById('selectSectId').value
    //     const sectIdArray = sectId.split(',');
    //     if (sectId !== '') {
    //         document.getElementById('ModalTitle').textContent = sectIdArray[2] + ' ' + sectIdArray[1];
    //         document.getElementById('AddStudentSectId').value = sectIdArray[0];
    //     } else {
    //         alertify
    //             .alert("Warning", "Please Select Year And Section First!", function() {

    //                 closeModal();

    //             });
    //     }
    // }

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

    function GetDepartmentData() {
        $('#GetDepTable').DataTable({
            destroy: true,
            ajax: {
                url: '{{ route('GetDepartmentData') }}',
                type: 'GET'
            },
            columns: [{
                    data: 'dept_name'
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editdepartment" onclick="editDeptData(`' +
                            row.dept_id + '`,`' + row.dept_name + '`,`' + row.dept_image +
                            '`)">Edit</button>';
                    }
                }
            ]
        });
    }

    function editDeptData(id, name, image) {
        document.getElementById('EditDeptId').value = id;
        document.getElementById('EditDeptName').value = name;
        document.getElementById('deptImage').src = '{{ asset('dept_image/') }}/' + image;
    }

    function editdeptpic() {
        document.getElementById('deptpicid').value = document.getElementById('EditDeptId').value;
    }

    function reloadElementById(elementId) {
        var element = document.getElementById(elementId);
        if (element) {
            $(element).load(window.location.href + ' #' + elementId);
        }
    }

    function EditDeptInfo() {
        document.getElementById('adminloader').style.display = 'grid';
        const deptid = document.getElementById('EditDeptId').value;
        const deptname = document.getElementById('EditDeptName').value;
        //    const pic = document.getElementById('avatar-upload');
        //             if (pic.files.length == 0) {
        //                 alertify
        //                     .alert("Warning", "Department Image Required", function() {
        //                         alertify.message('OK');
        //                     });
        //             } else {
        var formData = new FormData();
        formData.append('deptid', deptid);
        formData.append('deptname', deptname);
        // formData.append('image', $('#avatar-upload')[0].files[0]);
        formData.append('_token', '{{ csrf_token() }}');
        $.ajax({
            type: "POST",
            url: "{{ route('EditDeptInfo') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.status == 'success') {
                    document.getElementById('adminloader').style.display = 'none';
                    clearFormInputs('editdeptform');

                    alertify
                        .alert("Message", "Department Successfully Updated", function() {
                            GetDepartmentData();
                            alertify.message('OK');
                            GetCourseData();
                            GetSectionData();
                            clearFormInputs('editdeptform');
                            closeModal();
                            reloadElementById('addcourseform');
                            reloadElementById('editcourseform');
                            reloadElementById('addsectionform');
                            reloadElementById('editsectionform');
                        });
                } else if (response.status == 'exist') {
                    document.getElementById('adminloader').style.display = 'none';
                    alertify
                        .alert("Alert", "Department Already Exist", function() {
                            alertify.message('OK');
                        });
                } else if (response.status == 'empty') {
                    document.getElementById('adminloader').style.display = 'none';
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
        // }
    }

    function EditDeptPicInfo() {
        const deptid = document.getElementById('deptpicid').value;
        const pic = document.getElementById('avatar-upload');
        if (pic.files.length == 0) {
            alertify
                .alert("Warning", "Department Image Required", function() {
                    alertify.message('OK');
                });
        } else {
            var formData = new FormData();
            formData.append('deptid', deptid);
            formData.append('image', $('#avatar-upload')[0].files[0]);
            formData.append('_token', '{{ csrf_token() }}');

            $.ajax({
                type: "POST",
                url: "{{ route('EditDeptPicInfo') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status == 'success') {
                        const imgElement = document.getElementById('deptImage');
                        const currentSrc = imgElement.src;
                        const newSrc = currentSrc.split('?')[0] + '?' + new Date().getTime();
                        imgElement.src = newSrc;
                        clearFormInputs('editdeptform');
                        GetCourseData();
                        GetSectionData();
                        clearFormInputs('editdeptform');
                        closeModal();
                        reloadElementById('addcourseform');
                        reloadElementById('editcourseform');
                        reloadElementById('addsectionform');
                        reloadElementById('editsectionform');

                        alertify
                            .alert("Message", "Department Successfully Updated", function() {
                                GetDepartmentData();
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
    }

    function GetCourseData() {
        $('#GetCourseTable').DataTable({
            destroy: true,
            ajax: {
                url: '{{ route('GetCourseData') }}',
                type: 'GET'
            },
            columns: [{
                    data: 'dept_name'
                },
                {
                    data: 'course_name'
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editcourse" onclick="editcoursedata(`' +
                            row.course_id + '`,`' + row.dept_id + '`,`' + row.course_name +
                            '`)">Edit</button>';
                    }
                }
            ]
        });
    }

    function editcoursedata(id, dept, course) {
        document.getElementById('editcourseid').value = id;
        document.getElementById('editcoursedept').value = dept;
        document.getElementById('editcoursename').value = course;
    }

    function EditCourseInfo() {
        document.getElementById('adminloader').style.display = 'grid';
        var formData = $("form#editcourseform").serialize();
        $.ajax({
            type: "POST",
            url: "{{ route('EditCourseInfo') }}",
            data: formData,
            success: function(response) {
                if (response.status == 'success') {
                    document.getElementById('adminloader').style.display = 'none';
                    alertify
                        .alert("Message", "Section Successfully Updated", function() {
                            GetDepartmentData();
                            alertify.message('OK');
                            GetCourseData();
                            GetSectionData();
                            clearFormInputs('editcourseform');
                            closeModal();
                            reloadElementById('addcourseform');
                            reloadElementById('editcourseform');
                            reloadElementById('addsectionform');
                            reloadElementById('editsectionform');

                        });
                } else if (response.status == 'exist') {
                    document.getElementById('adminloader').style.display = 'none';
                    alertify
                        .alert("Alert", "Section Already Exist", function() {
                            alertify.message('OK');
                        });
                } else if (response.status == 'empty') {
                    document.getElementById('adminloader').style.display = 'none';
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

    function GetSectionData() {
        $('#GetSectionTable').DataTable({
            destroy: true,
            ajax: {
                url: '{{ route('GetSectionData') }}',
                type: 'GET'
            },
            columns: [{
                    data: 'dept_name'
                },
                {
                    data: 'course_name'
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
                        return '<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editsection" onclick="editsectiondata(`' +
                            row.sect_id + '`,`' + row.course_id + '`,`' + row.dept_id + '`,`' + row
                            .year_level + '`,`' + row.sect_name + '`)">Edit</button>';
                    }
                }
            ]
        });
    }

    function editsectiondata(secid, courseid, deptid, year, sectname) {
        document.getElementById('editsectionid').value = secid;
        document.getElementById('editsectiondept').value = deptid;

        $.ajax({
            type: "GET",
            url: "{{ route('GetDeptData') }}?dept_id=" + deptid,
            success: function(response) {
                $('#editsectioncourse').empty();
                response.data.forEach(function(course) {
                    $('#editsectioncourse').append('<option value="' + course.course_id + '">' +
                        course.course_name + '</option>');
                });
                $('#editsectioncourse').val(courseid);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
        document.getElementById('editsectionyear').value = year;
        document.getElementById('editsectionname').value = sectname;
    }


    function GetDeptData2() {
        const dept = document.getElementById('editsectiondept').value;
        console.log(dept);
        $.ajax({
            type: "GET",
            url: "{{ route('GetDeptData') }}?dept_id=" + dept,
            success: function(response) {
                $('#editsectioncourse').empty();
                response.data.forEach(function(course) {
                    $('#editsectioncourse').append('<option value="' + course.course_id + '">' +
                        course
                        .course_name + '</option>');
                });
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    function EditSectionInfo() {
        document.getElementById('adminloader').style.display = 'grid';
        var formData = $("form#editsectionform").serialize();
        $.ajax({
            type: "POST",
            url: "{{ route('EditSectionInfo') }}",
            data: formData,
            success: function(response) {
                if (response.status == 'success') {
                    document.getElementById('adminloader').style.display = 'none';
                    alertify
                        .alert("Message", "Course Successfully Updated", function() {
                            GetDepartmentData();
                            alertify.message('OK');
                            GetCourseData();
                            GetSectionData();
                            clearFormInputs('editsectionform');
                            closeModal();
                            reloadElementById('addcourseform');
                            reloadElementById('editcourseform');
                            reloadElementById('addsectionform');
                            reloadElementById('editsectionform');

                        });
                } else if (response.status == 'exist') {
                    document.getElementById('adminloader').style.display = 'none';
                    alertify
                        .alert("Alert", "Course Already Exist", function() {
                            alertify.message('OK');
                        });
                } else if (response.status == 'empty') {
                    document.getElementById('adminloader').style.display = 'none';
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

    function SaveDepartment() {
        document.getElementById('adminloader').style.display = 'grid';
        const deptname = document.getElementById('department').value;
        const pic = document.getElementById('departmentimage');
        if (pic.files.length == 0) {
            document.getElementById('adminloader').style.display = 'none';
            alertify
                .alert("Warning", "Department Image Required", function() {
                    alertify.message('OK');
                });
        } else {
            var formData = new FormData();
            formData.append('deptname', deptname);
            formData.append('image', $('#departmentimage')[0].files[0]);
            formData.append('_token', '{{ csrf_token() }}');
            $.ajax({
                type: "POST",
                url: "{{ route('SaveDepartment') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status == 'success') {
                        document.getElementById('adminloader').style.display = 'none';
                        alertify
                            .alert("Message", "New Department Successfully Added", function() {
                                GetDepartmentData();
                                alertify.message('OK');
                                GetCourseData();
                                GetSectionData();
                                clearFormInputs('adddepartmentform');
                                closeModal();
                                reloadElementById('addcourseform');
                                reloadElementById('editcourseform');
                                reloadElementById('addsectionform');
                                reloadElementById('editsectionform');

                            });
                    } else if (response.status == 'exist') {
                        document.getElementById('adminloader').style.display = 'none';
                        alertify
                            .alert("Alert", "Department Already Exist", function() {
                                alertify.message('OK');
                            });
                    } else if (response.status == 'empty') {
                        document.getElementById('adminloader').style.display = 'none';
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
    }

    function SaveCourse() {
        document.getElementById('adminloader').style.display = 'grid';
        var formData = $("form#addcourseform").serialize();
        $.ajax({
            type: "POST",
            url: "{{ route('SaveCourse') }}",
            data: formData,
            success: function(response) {
                if (response.status == 'success') {
                    document.getElementById('adminloader').style.display = 'none';
                    alertify
                        .alert("Message", "New Course Successfully Added", function() {
                            GetDepartmentData();
                            alertify.message('OK');
                            GetCourseData();
                            GetSectionData();
                            clearFormInputs('addcourseform');
                            closeModal();
                            reloadElementById('addcourseform');
                            reloadElementById('editcourseform');
                            reloadElementById('addsectionform');
                            reloadElementById('editsectionform');

                        });
                } else if (response.status == 'exist') {
                    document.getElementById('adminloader').style.display = 'none';
                    alertify
                        .alert("Alert", "Course Already Exist", function() {
                            alertify.message('OK');
                        });
                } else if (response.status == 'empty') {
                    document.getElementById('adminloader').style.display = 'none';
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
                    $('#selectcourse').append('<option value="' + course.course_id + '">' + course
                        .course_name + '</option>');
                });
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    function GetDeptDataSavestudent() {
        const dept = document.getElementById('selectdepartment').value;
        console.log(dept);
        $.ajax({
            type: "GET",
            url: "{{ route('GetDeptData') }}?dept_id=" + dept,
            success: function(response) {
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

    // Log the values for debugging
    console.log(crs);
    console.log(yearLevel);

    $.ajax({
        type: "GET",
        url: "{{ route('GetSectData') }}",
        data: {
            course_id: crs,
            year_level: yearLevel,
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            $('#selectsection').empty();
            response.data.forEach(function(course) {
                $('#selectsection').append('<option value="' + course.sect_id + '">' + course.sect_name + '</option>');
            });
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}


    function SaveSection() {
        document.getElementById('adminloader').style.display = 'grid';
        var formData = $("form#addsectionform").serialize();
        $.ajax({
            type: "POST",
            url: "{{ route('SaveSection') }}",
            data: formData,
            success: function(response) {
                if (response.status == 'success') {
                    document.getElementById('adminloader').style.display = 'none';
                    alertify
                        .alert("Message", "New Section Successfully Added", function() {
                            GetDepartmentData();
                            alertify.message('OK');
                            GetCourseData();
                            GetSectionData();
                            clearFormInputs('addsectionform');
                            closeModal();
                            reloadElementById('addcourseform');
                            reloadElementById('editcourseform');
                            reloadElementById('addsectionform');
                            reloadElementById('editsectionform');

                        });
                } else if (response.status == 'exist') {
                    document.getElementById('adminloader').style.display = 'none';
                    alertify
                        .alert("Alert", "Section Already Exist", function() {
                            alertify.message('OK');
                        });
                } else if (response.status == 'empty') {
                    document.getElementById('adminloader').style.display = 'none';
                    alertify
                        .alert("Warning", "Fill All Field!", function() {
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
<script>
    document.getElementById('administrators-tab').addEventListener('click', function() {
        const cards = document.querySelectorAll('.admincardeffects');
        if (cards.length > 0) {
            cards.forEach(card => {
                card.classList.remove('animate__animated', 'animate__zoomIn'); // Reset animation
                void card.offsetWidth; // Trigger reflow to restart the animation
                card.classList.add('animate__animated', 'animate__zoomIn'); // Add animation classes
            });
        } else {
            console.error('No elements found with the class admincardeffects');
        }
    });

    function runCardAnimation() {
        const cards = document.querySelectorAll('.admincardeffects');
        if (cards.length > 0) {
            cards.forEach(card => {
                card.classList.remove('animate__animated', 'animate__zoomIn'); // Reset animation
                void card.offsetWidth; // Trigger reflow to restart the animation
                card.classList.add('animate__animated', 'animate__zoomIn'); // Add animation classes
            });
        } else {
            console.error('No elements found with the class admincardeffects');
        }
    }
</script>
<script>
    function EditAdminInfo() {
        document.getElementById('adminloader').style.display = 'grid';
        var formData = $("form#EditAdminInfoForm").serialize();
        $.ajax({
            type: "POST",
            url: "{{ route('EditAdminInfo') }}",
            data: formData,
            success: function(response) {
                if (response.status == 'success') {
                    clearFormInputs('EditAdminInfoForm');
                    reloadElementById('EditAdminInfoForm');
                    document.getElementById('adminloader').style.display = 'none';
                    alertify
                        .alert("Message", "Admin Info Successfully Updated", function() {
                            alertify.message('OK');
                        });
                } else if (response.status == 'exist') {
                    document.getElementById('adminloader').style.display = 'none';
                    alertify
                        .alert("Alert", "Admin Info Already Exist", function() {
                            alertify.message('OK');
                        });
                } else if (response.status == 'empty') {
                    document.getElementById('adminloader').style.display = 'none';
                    alertify
                        .alert("Warning", "Enter Admin Info First!", function() {
                            alertify.message('OK');
                        });
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    function ChangeAdminPic() {
        document.getElementById('adminloader').style.display = 'grid';
        var formData = $("form#editadminpicform").serialize();
        const pic = document.getElementById('editadminpic');
        if (pic.files.length == 0) {
            document.getElementById('adminloader').style.display = 'none';
            alertify
                .alert("Warning", "Department Image Required", function() {
                    alertify.message('OK');
                });
        } else {
            var formData = new FormData();
            formData.append('image', $('#editadminpic')[0].files[0]);
            formData.append('_token', '{{ csrf_token() }}');

            $.ajax({
                type: "POST",
                url: "{{ route('ChangeAdminPic') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status == 'success') {
                        document.getElementById('adminloader').style.display = 'none';
                        clearFormInputs('EditAdminInfoForm');
                        reloadElementById('EditAdminInfoForm');
                        const imgElement = document.getElementById('adminpicture');
                                const currentSrc = imgElement.src;
                                const newSrc = currentSrc.split('?')[0] + '?' + new Date().getTime();
                                imgElement.src = newSrc;
                        alertify
                            .alert("Message", "Admin Image Successfully Updated", function() {
                                alertify.message('OK');
                            });
                    } else if (response.status == 'exist') {
                        document.getElementById('adminloader').style.display = 'none';
                        alertify
                            .alert("Alert", "Admin Image Already Exist", function() {
                                alertify.message('OK');
                            });
                    } else if (response.status == 'empty') {
                        document.getElementById('adminloader').style.display = 'none';
                        alertify
                            .alert("Warning", "Enter Admin Image First!", function() {
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

    function ChangeAdminPass() {
        document.getElementById('adminloader').style.display = 'grid';
        var formData = $("form#UpdateAdminPassForm").serialize();
        $.ajax({
            type: "POST",
            url: "{{ route('ChangeAdminPass') }}",
            data: formData,
            success: function(response) {
                console.log(response.status);
                if (response.status == 'success') {
                    document.getElementById('adminloader').style.display = 'none';
                    clearFormInputs('EditAdminInfoForm');
                    reloadElementById('EditAdminInfoForm');
                    alertify
                        .alert("Message", "Admin Password Successfully Updated", function() {
                            alertify.message('OK');
                        });
                } else if (response.status == '!match') {
                    document.getElementById('adminloader').style.display = 'none';
                    alertify
                        .alert("Alert", "New Entered Password Did Not Match!", function() {
                            alertify.message('OK');
                        });
                } else if (response.status == 'empty') {
                    document.getElementById('adminloader').style.display = 'none';
                    alertify
                        .alert("Warning", "Enter Admin Password First!", function() {
                            alertify.message('OK');
                        });
                } else if (response.status == 'old!match') {
                    document.getElementById('adminloader').style.display = 'none';

                    alertify
                        .alert("Warning", "Old Admin Password Did Not Match!", function() {
                            alertify.message('OK');
                        });
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });

    }

    function AddAdministrator() {
        document.getElementById('adminloader').style.display = 'grid';
        var formData = $("form#addnewadministratorform").serialize();
        $.ajax({
            type: "POST",
            url: "{{ route('AddAdministrator') }}",
            data: formData,
            success: function(response) {
                if (response.status == 'success') {
                    document.getElementById('adminloader').style.display = 'none';
                    alertify
                        .alert("Message", "New Administrator Successfully Added", function() {

                            alertify.message('OK');
                            clearFormInputs('addnewadministratorform');
                            closeModal();
                            GetAdministratorData();
                            // reloadElementById('editsectionform');

                        });
                } else if (response.status == 'exist') {
                    document.getElementById('adminloader').style.display = 'none';
                    alertify
                        .alert("Alert", "Administrator Already Exist", function() {
                            alertify.message('OK');
                        });
                } else if (response.status == 'empty') {
                    document.getElementById('adminloader').style.display = 'none';
                    alertify
                        .alert("Warning", "Enter Administrator Name First!", function() {
                            alertify.message('OK');
                        });
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
    $(document).ready(function() {
        GetAdministratorData();
        GetAllStudentAdminData();
    });

    function GetAdministratorData() {
        $.ajax({
            type: "GET",
            url: "{{ route('GetAdministratorData') }}",
            success: function(response) {

                document.getElementById("adminCard").innerHTML = "";
                response.data.forEach(function(Data) {

                    var div = document.createElement("div");
                    div.setAttribute("id", "administrators-card");
                    div.setAttribute("class", "col-md-6 col-lg-4 admincardeffects");

                    div.innerHTML = `
        <div class="card">
            <div class="card-body p-4 text-center">
                <span class="avatar avatar-xl mb-3 rounded" ><img src="dept_image/${Data.admin_pic}" alt="">  </span>
                <h3 class="m-0 mb-1">${Data.admin_name}</h3>
                <div class="text-muted"></div>
                <div class="mt-3">
                    <span class="badge bg-green-lt">${Data.admin_type}</span>
                </div>
            </div>
            <div class="d-flex">
                <a href="#" data-bs-toggle="modal" data-bs-target="#editadmin" class="card-btn" onclick="EditAdministrator('${Data.admin_id}')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"/>
                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"/>
                        <path d="M16 5l3 3"/>
                    </svg>
                    &nbsp; Edit
                </a>
                <a href="#" data-bs-toggle="modal" data-bs-target="#demotemodal" class="card-btn" onclick="DemoteAdministrator('${Data.admin_id}')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-down-to-arc">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M12 3v12"/>
                        <path d="M16 11l-4 4l-4 -4"/>
                        <path d="M3 12a9 9 0 0 0 18 0"/>
                    </svg>
                    &nbsp; Demote
                </a>
            </div>
        </div>
    `;
                    document.getElementById("adminCard").appendChild(div);
                    runCardAnimation();
                });

            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    function DemoteAdministrator(id) {
        document.getElementById('demoteadminid').value = id;
    }

    function DemoteAdmin() {
        document.getElementById('adminloader').style.display = 'grid';
        var formData = $("form#demoteadminform").serialize();
        $.ajax({
            type: "POST",
            url: "{{ route('DemoteAdmin') }}",
            data: formData,
            success: function(response) {
                if (response.status == 'success') {
                    document.getElementById('adminloader').style.display = 'none';
                    closeModal();
                    GetAdministratorData();
                    alertify
                        .alert("Message", "Admin Successfully Demoted", function() {

                            alertify.message('OK');
                            clearFormInputs('demoteadminform');


                            // reloadElementById('editsectionform');

                        });
                } else if (response.status == 'exist') {
                    document.getElementById('adminloader').style.display = 'none';
                    alertify
                        .alert("Alert", "Administrator Already Exist", function() {
                            alertify.message('OK');
                        });
                } else if (response.status == 'empty') {
                    document.getElementById('adminloader').style.display = 'none';
                    alertify
                        .alert("Warning", "Select Administrator Name First!", function() {
                            alertify.message('OK');
                        });
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    function EditAdministrator(id) {
        $.ajax({
            type: "GET",
            url: "{{ route('GetAdministratorDataToEdit') }}?id=" + id,
            success: function(response) {
                document.getElementById('aditadministratorname').value = response.data.admin_name;
                document.getElementById('aditadministratoruser').value = response.data.admin_username;
                document.getElementById('administratorId').value = response.data.admin_id;
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    function EditAdministratorInfo() {
        document.getElementById('adminloader').style.display = 'grid';
        var formData = $("form#aditadministratorform").serialize();
        $.ajax({
            type: "POST",
            url: "{{ route('EditAdministratorInfo') }}",
            data: formData,
            success: function(response) {
                if (response.status == 'success') {
                    document.getElementById('adminloader').style.display = 'none';
                    alertify
                        .alert("Message", "Administrator Successfully Updated", function() {

                            alertify.message('OK');
                            clearFormInputs('aditadministratorform');
                            closeModal();
                            GetAdministratorData();
                            // reloadElementById('editsectionform');

                        });
                } else if (response.status == 'success') {
                    document.getElementById('adminloader').style.display = 'none';
                    alertify
                        .alert("Alert", "Administrator Already Exist", function() {
                            alertify.message('OK');
                        });
                } else if (response.status == 'empty') {
                    document.getElementById('adminloader').style.display = 'none';
                    alertify
                        .alert("Warning", "Enter Administrator Name First!", function() {
                            alertify.message('OK');
                        });
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    function GetAllStudentData() {
        $('#SelectStundentTable').DataTable({
            // scrollY: '150px',
            pageLength: 2,
            scrollCollapse: true,
            // paging: false,
            destroy: true,
            ajax: {
                url: '{{ route('GetAllStudentData') }}',
                type: 'GET'
            },
            columns: [{
                    data: null,
                    render: function(data, type, row) {
                        return row.student_firstname + ' ' + row.student_lastname;
                    }
                },
                {
                    data: 'school_id'
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        const fullname = row.student_firstname + ' ' + row.student_lastname;
                        return '<button class="btn btn-warning btn-sm" onclick="SelectStudent(`' + row
                            .student_id + '`,`' + fullname + '`,`' + row.school_id +
                            '`)">Select</button>';
                    }
                },
            ],
            //         columnDefs: [
            //     {
            //         title: 'Full Name',
            //         targets: 0
            //     },
            //     {
            //         title: 'SCHOOL ID No.',
            //         targets: 1
            //     },
            //     {
            //         title: 'Actions',
            //         targets: 2
            //     },
            // ]
        });
    }

    function SelectStudent(id, name, school) {
        document.getElementById('studentadminname').value = name;
        document.getElementById('studentadminschoolid').value = school;
        document.getElementById('studentadminid').value = id;
    }

    function SetStudentAdmin() {
        document.getElementById('adminloader').style.display = 'grid';
        var formData = $("form#addnewstudentadmin").serialize();
        $.ajax({
            type: "POST",
            url: "{{ route('SetStudentAdmin') }}",
            data: formData,
            success: function(response) {
                if (response.status == 'success') {
                    document.getElementById('adminloader').style.display = 'none';
                    closeModal();
                    GetAllStudentAdminData();
                    alertify
                        .alert("Message", "New Administrator Successfully Added", function() {

                            alertify.message('OK');
                            clearFormInputs('addnewstudentadmin');


                            // reloadElementById('editsectionform');

                        });
                } else if (response.status == 'exist') {
                    document.getElementById('adminloader').style.display = 'none';
                    alertify
                        .alert("Alert", "Administrator Already Exist", function() {
                            alertify.message('OK');
                        });
                } else if (response.status == 'empty') {
                    document.getElementById('adminloader').style.display = 'none';
                    alertify
                        .alert("Warning", "Select Administrator Name First!", function() {
                            alertify.message('OK');
                        });
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    function GetAllStudentAdminData() {
    $.ajax({
        type: "GET",
        url: "{{ route('GetAllStudentAdminData') }}",
        success: function(response) {
            document.getElementById("adminCard2").innerHTML = "";

            if (response.data.length === 0) {
                document.getElementById("adminCard2").innerHTML = `
                    <div class="page-body">
                        <div class="container-xl d-flex flex-column justify-content-center">
                            <div class="empty">
                                <div class="empty-img"><img src="./static/illustrations/undraw_collaborators_re_hont.svg" height="128" alt=""></div>
                                <p class="empty-title">No Student Admin Found!</p>
                                <p class="empty-subtitle text-muted">
                                    No student admin record found! Please select a student admin first. </p>

                            </div>
                        </div>
                    </div>
                `;
                return;
            }

            response.data.forEach(function(Data) {
                var div = document.createElement("div");
                div.setAttribute("id", "administrators-card2");
                div.setAttribute("class", "col-md-6 col-lg-4 admincardeffects");

                div.innerHTML = `
                    <div class="card">
                        <div class="card-body p-4 text-center">
                            <span class="avatar avatar-xl mb-3 rounded">
                                <img src="student_images/${Data.student_pic}" alt="picture">
                            </span>
                            <h3 class="m-0 mb-1">${Data.student_firstname} ${Data.student_lastname}</h3>
                            <div class="text-muted">${Data.student_position}</div>
                            <div class="mt-3">
                                <span class="badge bg-green-lt">${Data.student_type}</span>
                            </div>
                        </div>
                        <div class="d-flex">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#editstudentadmin" class="card-btn" onclick="editstudentadmin('${Data.student_id}', '${Data.student_firstname}', '${Data.student_lastname}', '${Data.school_id}', '${Data.student_position}')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"/>
                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"/>
                                    <path d="M16 5l3 3"/>
                                </svg>
                                &nbsp; Edit
                            </a>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#studentdemote" class="card-btn" onclick="DemoteStudent('${Data.student_id}')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-down-to-arc">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M12 3v12"/>
                                    <path d="M16 11l-4 4l-4 -4"/>
                                    <path d="M3 12a9 9 0 0 0 18 0"/>
                                </svg>
                                &nbsp; Demote
                            </a>
                        </div>
                    </div>
                `;
                document.getElementById("adminCard2").appendChild(div);
                runCardAnimation();
            });
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}


    function DemoteStudent(id) {
        document.getElementById('demotestudentid').value = id;
    }

    function DemoteStudentAdmin() {
        document.getElementById('adminloader').style.display = 'grid';
        var formData = $("form#demotestudentadminform").serialize();
        $.ajax({
            type: "POST",
            url: "{{ route('DemoteStudentAdmin') }}",
            data: formData,
            success: function(response) {
                if (response.status == 'success') {
                    document.getElementById('adminloader').style.display = 'none';
                    closeModal();
                    GetAllStudentAdminData();
                    alertify
                        .alert("Message", " Student Administrator Successfully Updated", function() {

                            alertify.message('OK');
                            clearFormInputs('demotestudentadminform');


                            // reloadElementById('editsectionform');

                        });
                } else if (response.status == 'exist') {
                    document.getElementById('adminloader').style.display = 'none';
                    alertify
                        .alert("Alert", "Administrator Already Exist", function() {
                            alertify.message('OK');
                        });
                } else if (response.status == 'empty') {
                    document.getElementById('adminloader').style.display = 'none';
                    alertify
                        .alert("Warning", "Select Administrator Name First!", function() {
                            alertify.message('OK');
                        });
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    function editstudentadmin(id, name, last, school, position) {
        document.getElementById('editstudentadminid').value = id;
        document.getElementById('editstudentadminname').value = name + ' ' + last;
        document.getElementById('editstudentadminschoolid').value = school;
        document.getElementById('editstudentposition').value = position;
    }

    function EditStudentAdminPosition() {
        document.getElementById('adminloader').style.display = 'grid';
        var formData = $("form#editnewstudentadminform").serialize();
        $.ajax({
            type: "POST",
            url: "{{ route('EditStudentAdminPosition') }}",
            data: formData,
            success: function(response) {
                if (response.status == 'success') {
                    document.getElementById('adminloader').style.display = 'none';
                    closeModal();
                    GetAllStudentAdminData();
                    alertify
                        .alert("Message", " Administrator Successfully Updated", function() {

                            alertify.message('OK');
                            clearFormInputs('editnewstudentadminform');


                            // reloadElementById('editsectionform');

                        });
                } else if (response.status == 'exist') {
                    document.getElementById('adminloader').style.display = 'none';
                    alertify
                        .alert("Alert", "Administrator Already Exist", function() {
                            alertify.message('OK');
                        });
                } else if (response.status == 'empty') {
                    document.getElementById('adminloader').style.display = 'none';
                    alertify
                        .alert("Warning", "Select Administrator Name First!", function() {
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
