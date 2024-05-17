<script>
    console.log('connect');
    $(document).ready(function() {
        GetDepartmentData();
        GetCourseData();
        GetSectionData();
        GetStudentData()
    });
    function selectSect(id, name, year) {
    document.getElementById('selectSectId').value = id + ',' + name + ',' + year;
    GetStudentData(id);
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
    function AddStudentModal(id){
        const sectId = document.getElementById('selectSectId').value
        const sectIdArray = sectId.split(',');
        if(sectId !== ''){
            document.getElementById('ModalTitle').textContent=sectIdArray[2]+' '+sectIdArray[1];
            document.getElementById('AddStudentSectId').value=sectIdArray[0];
        }else{
            alertify
  .alert("Warning","Please Select Year And Section First!", function(){
   
    closeModal();
   
  });
        }
    }
    function SaveStudent(){
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
    function GetStudentData(id){
         if (typeof id === 'undefined') {
            document.getElementById('yearTitle').textContent='All Year Level';
           const courseId = document.getElementById('AutoCourse').value;
            $('#GetStudentTable').DataTable({
            destroy: true,
            ajax: {
                url: '{{ route('GetStudentData') }}?course_id='+courseId,
                type: 'GET'
            },
            columns: [
                {
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
                        return row.year_level+' - '+row.sect_name;
                    
                      }
                },
                {
                    data: null, 
                    render: function(data, type, row) {
                        return '<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editstudentacc" onclick="editStudentinfo(`'+row.student_id+'`,`'+row.school_id+'`,`'+row.student_firstname+'`,`'+row.student_middlename+'`,`'+row.student_lastname+'`,`'+row.student_ext+'`,`'+row.year_level+'`,`'+row.sect_name+'`)">Edit</button>';
                    }
                },
            ]
        });
    } else {
         const sectId = document.getElementById('selectSectId').value
        const sectIdArray = sectId.split(',');
         document.getElementById('yearTitle').textContent=sectIdArray[2]+' '+'-'+' ' + sectIdArray[1];
        $('#GetStudentTable').DataTable({
            destroy: true,
            ajax: {
                url: '{{ route('GetStudentData') }}?sect_id='+id,
                type: 'GET'
            },
            columns: [
                {
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
                        return row.year_level+' - '+row.sect_name;
                    
                      }
                },
                {
                    data: null, 
                    render: function(data, type, row) {
                      return '<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editstudentacc" onclick="editStudentinfo(`'+row.student_id+'`,`'+row.school_id+'`,`'+row.student_firstname+'`,`'+row.student_middlename+'`,`'+row.student_lastname+'`,`'+row.student_ext+'`,`'+row.year_level+'`,`'+row.sect_name+'`)">Edit</button>';
                     }
                },
                
            ]
        });
    }
    }
    function editStudentinfo(id,sch_id,sf,sm,sl,se,yl,sc_n){
        console.log(sc_n);
        document.getElementById('EditStudentID').value=id;
        document.getElementById('editfirstname').value=sf;
         document.getElementById('editmiddlename').value=sm;
          document.getElementById('editlastname').value=sl;
           document.getElementById('editext').value=se;
            document.getElementById('editstudentschoolid').value=sch_id;
            document.getElementById('EditModalTitle').textContent=yl+' - '+sc_n;
    }
    function EditStudent(){
        var formData = $("form#EditStudentForm").serialize();
        $.ajax({
            type: "POST",
            url: "{{ route('EditStudent')}}",
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
                            row.dept_id + '`,`' + row.dept_name + '`,`' + row.dept_image +'`)">Edit</button>';
                    }
                }
            ]
        });
    }

    function editDeptData(id,name,image) {
        document.getElementById('EditDeptId').value = id;
        document.getElementById('EditDeptName').value = name;
         document.getElementById('deptImage').src = '{{ asset('dept_image/') }}/' + image;
    }
    function reloadElementById(elementId) {
    var element = document.getElementById(elementId);
    if (element) {
        $(element).load(window.location.href + ' #' + elementId);
    }
}

    function EditDeptInfo() {
       const deptid = document.getElementById('EditDeptId').value;
       const deptname = document.getElementById('EditDeptName').value;
       const pic = document.getElementById('avatar-upload');
                if (pic.files.length == 0) {
                    alertify
                        .alert("Warning", "Department Image Required", function() {
                            alertify.message('OK');
                        });
                } else {
                    var formData = new FormData();
                    formData.append('deptid', deptid);
                    formData.append('deptname', deptname);
                    formData.append('image', $('#avatar-upload')[0].files[0]);
                    formData.append('_token', '{{ csrf_token() }}');
        $.ajax({
            type: "POST",
            url: "{{ route('EditDeptInfo') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.status == 'success') {
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
        var formData = $("form#editcourseform").serialize();
        $.ajax({
            type: "POST",
            url: "{{ route('EditCourseInfo') }}",
            data: formData,
            success: function(response) {
                if (response.status == 'success') {
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
function EditSectionInfo(){
  var formData = $("form#editsectionform").serialize();
        $.ajax({
            type: "POST",
            url: "{{ route('EditSectionInfo') }}",
            data: formData,
            success: function(response) {
                if (response.status == 'success') {
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

    function SaveDepartment() {
        document.getElementById('adminloader').style.display='grid';
        const deptname = document.getElementById('department').value;
       const pic = document.getElementById('departmentimage');
                if (pic.files.length == 0) {
                     document.getElementById('adminloader').style.display='none';
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
                      document.getElementById('adminloader').style.display='none';
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
                      document.getElementById('adminloader').style.display='none';
                    alertify
                        .alert("Alert", "Department Already Exist", function() {
                            alertify.message('OK');
                        });
                } else if (response.status == 'empty') {
                      document.getElementById('adminloader').style.display='none';
                    alertify
                        .alert("Warning", "Enter Department Name First!", function() {
                            alertify.message('OK');
                        });
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });}
    }

    function SaveCourse() {
        document.getElementById('adminloader').style.display='grid';
        var formData = $("form#addcourseform").serialize();
        $.ajax({
            type: "POST",
            url: "{{ route('SaveCourse') }}",
            data: formData,
            success: function(response) {
                if (response.status == 'success') {
                    document.getElementById('adminloader').style.display='none';
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
                    document.getElementById('adminloader').style.display='none';
                    alertify
                        .alert("Alert", "Course Already Exist", function() {
                            alertify.message('OK');
                        });
                } else if (response.status == 'empty') {
                    document.getElementById('adminloader').style.display='none';
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

    function SaveSection() {
        document.getElementById('adminloader').style.display='grid';
        var formData = $("form#addsectionform").serialize();
        $.ajax({
            type: "POST",
            url: "{{ route('SaveSection') }}",
            data: formData,
            success: function(response) {
                if (response.status == 'success') {
                    document.getElementById('adminloader').style.display='none';
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
                    document.getElementById('adminloader').style.display='none';
                    alertify
                        .alert("Alert", "Section Already Exist", function() {
                            alertify.message('OK');
                        });
                } else if (response.status == 'empty') {
                    document.getElementById('adminloader').style.display='none';
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
<script>
 function EditAdminInfo(){
         var formData = $("form#EditAdminInfoForm").serialize();
        $.ajax({
            type: "POST",
            url: "{{ route('EditAdminInfo') }}",
            data: formData,
            success: function(response) {
                if (response.status == 'success') {
                    clearFormInputs('EditAdminInfoForm');
                    reloadElementById('EditAdminInfoForm');
                    alertify
                        .alert("Message", "Admin Info Successfully Updated", function() {
                            alertify.message('OK');
                        });
                } else if (response.status == 'exist') {
                    alertify
                        .alert("Alert", "Admin Info Already Exist", function() {
                            alertify.message('OK');
                        });
                } else if (response.status == 'empty') {
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

       function ChangeAdminPic(){
         var formData = $("form#editadminpicform").serialize();
          const pic = document.getElementById('editadminpic');
                if (pic.files.length == 0) {
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
                    clearFormInputs('EditAdminInfoForm');
                    reloadElementById('EditAdminInfoForm');
                     reloadElementById('adminpicture');
                    alertify
                        .alert("Message", "Admin Image Successfully Updated", function() {
                            alertify.message('OK');
                        });
                } else if (response.status == 'exist') {
                    alertify
                        .alert("Alert", "Admin Image Already Exist", function() {
                            alertify.message('OK');
                        });
                } else if (response.status == 'empty') {
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
    function ChangeAdminPass(){

       var formData = $("form#UpdateAdminPassForm").serialize();
        $.ajax({
            type: "POST",
            url: "{{ route('ChangeAdminPass') }}",
            data: formData,
            success: function(response) {
               console.log(response.status);
                if (response.status == 'success') {
                    clearFormInputs('EditAdminInfoForm');
                    reloadElementById('EditAdminInfoForm');
                    alertify
                        .alert("Message", "Admin Password Successfully Updated", function() {
                            alertify.message('OK');
                        });
                } else if (response.status == '!match') {
                    alertify
                        .alert("Alert", "New Entered Password Did Not Match!", function() {
                            alertify.message('OK');
                        });
                } else if (response.status == 'empty') {
                    alertify
                        .alert("Warning", "Enter Admin Password First!", function() {
                            alertify.message('OK');
                        });
                }
                else if (response.status == 'old!match') {
                 
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
</script>
