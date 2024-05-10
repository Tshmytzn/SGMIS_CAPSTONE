function AdminLogin(route, dashboard) {
    document.getElementById("mainLoader").style.display = "flex";
    const formData = $("form#admin_login").serialize();

    $.ajax({
        type: "POST",
        url: route,
        data: formData,
        success: (r) => {
            document.getElementById("mainLoader").style.display = "none";
            alertify.set('notifier','position', 'bottom-left');
            if (r.status === "success") {
                window.location.href = dashboard;
            }else if(r.status === "incorrect"){
              alertify.error('Incorrect Password').dismissOthers(); 
            }else{
              alertify.error('Username Not Found').dismissOthers(); 
            }
            
        },
        error: (xhr) => {
            console.log(xhr.responseText);
        },
    });
}
function getDays(date) {
  var dateStr1 = '';
  var dateStr2 = '';
  if (date.id === 'ev_start') {
      dateStr1 = date.value;
      dateStr2 = document.getElementById('ev_end').value;
  } else {
      dateStr1 = document.getElementById('ev_start').value;
      dateStr2 = date.value;
  }
  
  // Check if either date is empty
  if (!dateStr1 || !dateStr2) {
      console.error('Both dates must be selected.');
      return; // Exit the function if either date is empty
  }

  const dateArr1 = dateStr1.split('-'); // Assuming input date format is "YYYY-MM-DD"
  const dateArr2 = dateStr2.split('-');

  const date1 = new Date(dateArr1[0], dateArr1[1] - 1, dateArr1[2]); // Month is 0-indexed
  const date2 = new Date(dateArr2[0], dateArr2[1] - 1, dateArr2[2]);

  // Check if either date is invalid
  if (isNaN(date1) || isNaN(date2)) {
      console.error('Invalid date format.');
      return; // Exit the function if either date is invalid
  }

  const differenceMs = Math.abs(date1 - date2);

  const differenceDays = Math.ceil(differenceMs / (1000 * 60 * 60 * 24));

  // Check if the duration input expects a string value
  document.getElementById('duration').value = differenceDays.toString() + ' Days Event';
}


function VerifyFormEvent(route){
  const evname = document.getElementById('ev_name');
  const dept = document.getElementById('dept');
  const ev_pic = document.getElementById('ev_pic');
  const ev_start = document.getElementById('ev_start');
  const ev_end = document.getElementById('ev_end');
  const ev_description = document.getElementById('ev_description');

  const ev_name_e = document.getElementById('ev_name_e');
  const dept_e = document.getElementById('dept_e');
  const ev_pic_e = document.getElementById('ev_pic_e');
  const ev_start_e = document.getElementById('ev_start_e');
  const ev_end_e = document.getElementById('ev_end_e');
  const ev_description_e = document.getElementById('ev_description_e');

  let validity = 0;

  if(evname.value === ""){
    ev_name_e.style.display = '';
  }else{
    ev_name_e.style.display = 'none';
    validity++;
  }

  if(dept.value === 'none'){
    dept_e.style.display = '';
  }else{
    dept_e.style.display = 'none';
    validity++;
  }

  if(ev_pic.files.length === 0){
    ev_pic_e.style.display = '';
  }else{
    ev_pic_e.style.display = 'none';
    validity++;
  }

  if(ev_start.value === ''){
    ev_start_e.style.display = '';
  }else{
    ev_start_e.style.display = 'none';
    validity++;
  }

  if(ev_end.value === ''){
    ev_end_e.style.display = '';
  }else{
    ev_end_e.style.display = 'none';
    validity++;
  }

  if(ev_description.value === ''){
    ev_description_e.style.display = '';
  }else{
    ev_description_e.style.display = 'none';
    validity++;
  }

  if(validity === 6){
    SaveEvent(route);
  }
}

function SaveEvent(route){
  document.getElementById('mainLoader').style.display = 'flex';
  const formData = new FormData($('#add_event')[0]);

  $.ajax({
     type:'POST',
     url: route,
     data: formData,
     contentType:false,
     processData:false,
     success: res => {
      document.getElementById('mainLoader').style.display = 'none';
      alertify.set('notifier','position', 'top-center');
      if(res.status=== 'success'){
        alertify.success('Event Created').dismissOthers(); 
      }else{
        alertify.error('Invalid Image type: Please provide an actual image').dismissOthers(); 
      }
     },
     error: xhr => {
      console.log(xhr.responseText);
     }
  });
}