<script>
    function getAct(){
       const event_id = document.getElementById('EventId').value
       document.getElementById('lineLoading').style.display=''
       document.getElementById('lineLoading2').style.display=''
            const select = $('#ActId');
            select.hide();
            select.empty();
            const select2 = $('#DeptId');
            select2.hide();
            select2.empty();
         $.ajax({
        url: `{{ route('getAttendance') }}?getAttendance=Act&event_id=`+event_id,
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            const data = response.Act // Change to the ID of your <select> element
            const data2 = response.Dept
            document.getElementById('lineLoading').style.display='none'
            document.getElementById('lineLoading2').style.display='none'
            select.show();
            
            select.append(`<option value="" selected>All Activities</option>`);
            
            data.forEach(function(activity) {
                select.append(`<option value="${activity.eact_id}">${activity.eact_name}</option>`);
            });

            select2.show();
            
            data2.forEach(function(dept) {
                select2.append(`<option value="${dept.dept_id}">${dept.dept_name}</option>`);
            });
            getCourse()
            },
        error: function(xhr) {
            console.error(xhr.response);
        }
    });
    }
    function getCourse(){
       const dept_id = document.getElementById('DeptId').value
       document.getElementById('lineLoading3').style.display=''
       const select = $('#CourseId');
            select.hide();
            select.empty();
             $.ajax({
        url: `{{ route('getAttendance') }}?getAttendance=Course&dept_id=`+dept_id,
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            const data = response.Course
            document.getElementById('lineLoading3').style.display='none'
            select.show();
            
            data.forEach(function(course) {
                select.append(`<option value="${course.course_id}">${course.course_name}</option>`);
            });
            getSection()
                },
        error: function(xhr) {
            console.error(xhr.response);
        }
    });
    }
    function getSection(){
        const course_id = document.getElementById('CourseId').value
        document.getElementById('lineLoading4').style.display=''
        const select = $('#SectionId');
        select.hide();
        select.empty();
        $.ajax({
            url: `{{ route('getAttendance') }}?getAttendance=Section&course_id=`
            +course_id,
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                const data = response.Section
                document.getElementById('lineLoading4').style.display='none'
                select.show();
                data.forEach(function(section) {
                    select.append(`<option value="${section.sect_id}"> ${section.year_level}-${section.sect_name}</option>`
                    );
                    });
                    attendanceTable()
                    },
                    error: function(xhr) {
                        console.error(xhr.response);
                        }
                        });
                        
    }
    function attendanceTable(){
        const event_id = document.getElementById('EventId').value
        const dept_id = document.getElementById('DeptId').value
        const course_id = document.getElementById('CourseId').value
        const act = document.getElementById('ActId').value
        const sect_id = document.getElementById('SectionId').value
        document.getElementById('lineLoading5').style.display=''
        $('#containerTable').hide();
     $.ajax({
            url: `{{ route('getAttendance') }}?getAttendance=Attendance&event_id=` + event_id + `&act_id=` + act + `&dept_id=` + dept_id + `&course_id=` + course_id + `&sect_id=` + sect_id,
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                document.getElementById('lineLoading5').style.display='none'
                $('#containerTable').show();
                const data = response.data;
                // Initialize DataTable and store the instance in a variable
                const table = $('#attendanceTable').DataTable({
                    destroy: true,
                    data: data, // Use response data as the source
                    columns: [
                        { data: 'event.event_name', title: 'Event Name' },
                        { data: 'activity', title: 'Activity' },
                        { data: 'dept.dept_name', title: 'Department' },
                        { data: 'course.course_name', title: 'Course' },
                        { data: 'section', title: 'Section' },
                        { data: 'student.school_id', title: 'Student School ID' },
                        {
                            data: null,
                            render: function(data) {
                                const middleInitial = data.student.student_middlename ? data.student.student_middlename.charAt(0) + '.' : '';
                                return `${data.student.student_firstname} ${middleInitial} ${data.student.student_lastname}`;
                            },
                            title: 'Student Name'
                        },
                        {
                            data: null,
                            render: function(data) {
                                return data.attendance.start && data.attendance.end ? '<span class="text-success">Complete</span>' : '<span class="text-danger">Incomplete</span>';
                            },
                            title: 'Attendance Status'
                        },
                        {
                            data: null,
                            render: function(data) {
                                return `<button onclick="viewProof('${data.attendance.in_proof}','${data.attendance.out_proof}')" class="btn btn-info w-75" data-bs-toggle="modal" data-bs-target="#proofModal">&nbsp;&nbsp;&nbsp;<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-zoom-check">
  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
  <path d="M14 3.072a8 8 0 0 1 2.617 11.424l4.944 4.943a1.5 1.5 0 0 1 -2.008 2.225l-.114 -.103l-4.943 -4.944a8 8 0 0 1 -12.49 -6.332l-.006 -.285l.005 -.285a8 8 0 0 1 11.995 -6.643zm-.293 4.22a1 1 0 0 0 -1.414 0l-3.293 3.294l-1.293 -1.293l-.094 -.083a1 1 0 0 0 -1.32 1.497l2 2l.094 .083a1 1 0 0 0 1.32 -.083l4 -4l.083 -.094a1 1 0 0 0 -.083 -1.32z" />
</svg></button>`;
                            },
                            title: 'Proof'
                        },
                    ],
                    paging: true,
                    searching: true, // Disable the default search bar
                    info: false,
                    "dom": 't'
                });

                // Custom search input logic
                $('#customSearchInput').on('keyup', function() {
                    table.search(this.value).draw(); // Use the value from custom input to filter the table
                });
            },
            error: function(xhr) {
                console.error(xhr.response);
            }
        });

    }
function viewProof(inImage, outImage) {
    
    const imgElement = document.getElementById('myImage');
    imgElement.src = 'student_attendance/' + (inImage === 'null'||'' ? 'absent.jpg' : inImage);
    // Assign the new image source to the second image element
    const imgElement2 = document.getElementById('myImage2');
    imgElement2.src = 'student_attendance/' + (outImage === 'null'||'' ? 'absent.jpg' : outImage);
}

function printTable() {
  var table = document.getElementById("attendanceTable");

  // Check if the table exists
  if (table) {
    // Clone the table so we don't modify the original one
    var clonedTable = table.cloneNode(true);

    // Exclude the third column (index 2) from both header and body rows
    var headerCells = clonedTable.querySelectorAll("th:nth-child(9), td:nth-child(9)");
    headerCells.forEach(function(cell) {
      cell.style.display = "none";
    });

    var printWindow = window.open('', '', 'height=600,width=800');
    printWindow.document.write('<html><head><title>Print Table</title>');
    printWindow.document.write('<style>table { width: 100%; border-collapse: collapse; }');
    printWindow.document.write('th, td { border: 1px solid black; padding: 8px; text-align: left; }</style>');
    printWindow.document.write('</head><body>');
    printWindow.document.write(clonedTable.outerHTML); // Insert the modified (cloned) table
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
  } else {
    console.error("Table with id 'myTable' not found.");
  }
}

    $(document).ready(function() {
        $('#containerTable').hide();
    });
</script>