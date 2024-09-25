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
        console.log(event_id)
       
        // $('#attendanceTable').DataTable({
        //     destroy: true,
        //     ajax: {
        //         url: `{{ route('getAttendance') }}?getAttendance=Attendance&event_id=`+event_id+`&act_id=`+act,
        //         type: 'GET',
        //          dataSrc: 'data'

        //     },
        //     columns: [{
        //             data: 'event_name'
        //         },
        //         ]
        //     });

             $.ajax({
        url: `{{ route('getAttendance') }}?getAttendance=Attendance&event_id=`+event_id+`&act_id=`+act+`&dept_id=`+dept_id+`&course_id=`+course_id+`&sect_id=`+sect_id,
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            console.log(response)
             },
                    error: function(xhr) {
                        console.error(xhr.response);
                        }
                        });
    }

    $(document).ready(function() {
    // Your code here
    // attendanceTable()
    });
</script>