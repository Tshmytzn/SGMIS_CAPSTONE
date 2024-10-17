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
                console.log(data)
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

    $(document).ready(function() {
        $('#containerTable').hide();
    });
</script>