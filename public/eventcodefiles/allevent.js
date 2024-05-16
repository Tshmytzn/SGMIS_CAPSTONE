function AdminLogin(route, dashboard) {
  document.getElementById("mainLoader").style.display = "flex";
  const formData = $("form#admin_login").serialize();

  $.ajax({
    type: "POST",
    url: route,
    data: formData,
    success: (r) => {

      alertify.set('notifier', 'position', 'bottom-left');
      if (r.status === "success") {
        window.location.href = dashboard;
      } else if (r.status === "incorrect") {
        document.getElementById("mainLoader").style.display = "none";
        alertify.error('Incorrect Password').dismissOthers();
      } else {
        document.getElementById("mainLoader").style.display = "none";
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

  if (!dateStr1 || !dateStr2) {
    console.error('Both dates must be selected.');
    return; 
  }

  const dateArr1 = dateStr1.split('-');
  const dateArr2 = dateStr2.split('-');

  const date1 = new Date(dateArr1[0], dateArr1[1] - 1, dateArr1[2]); 
  const date2 = new Date(dateArr2[0], dateArr2[1] - 1, dateArr2[2]);


  if (isNaN(date1) || isNaN(date2)) {
    console.error('Invalid date format.');
    return; 
  }

  const differenceMs = Math.abs(date1 - date2);

  const differenceDays = Math.ceil(differenceMs / (1000 * 60 * 60 * 24));


  document.getElementById('duration').value = differenceDays.toString() + ' Days Event';
}



function VerifyFormEvent(route, events, images, deleteEvent, eventDetails, meth) {
  const evname = document.getElementById('ev_name');
  const ev_pic = document.getElementById('ev_pic');
  const ev_start = document.getElementById('ev_start');
  const ev_end = document.getElementById('ev_end');
  const ev_facilitator = document.getElementById('ev_facilitator');
  const ev_description = document.getElementById('ev_description');

  const ev_name_e = document.getElementById('ev_name_e');
  const ev_pic_e = document.getElementById('ev_pic_e');
  const ev_facilitator_e = document.getElementById('ev_facilitator_e');
  const ev_start_e = document.getElementById('ev_start_e');
  const ev_end_e = document.getElementById('ev_end_e');
  const ev_description_e = document.getElementById('ev_description_e');

  let validity = 0;

  if (evname.value === "") {
    ev_name_e.style.display = '';
    evname.classList.add("border", "border-danger");
  } else {
    evname.classList.remove("border", "border-danger");
    ev_name_e.style.display = 'none';
    validity++;
  }


  if (ev_facilitator.value === "") {
    ev_facilitator_e.style.display = '';
    ev_facilitator.classList.add("border", "border-danger");
  } else {
    ev_facilitator.classList.remove("border", "border-danger");
    ev_facilitator_e.style.display = 'none';
    validity++;
  }



  if (ev_pic.files.length === 0 && meth === 'add') {
    ev_pic_e.style.display = '';
    ev_pic.classList.add("border", "border-danger");
  } else {
    ev_pic.classList.remove("border", "border-danger");
    ev_pic_e.style.display = 'none';
    validity++;
  }

  if (ev_start.value === '') {
    ev_start_e.style.display = '';
    ev_start.classList.add("border", "border-danger");
  } else {
    ev_start.classList.remove("border", "border-danger");
    ev_start_e.style.display = 'none';
    validity++;
  }

  if (ev_end.value === '') {
    ev_end_e.style.display = '';
    ev_end.classList.add("border", "border-danger");
  } else {
    ev_end.classList.remove("border", "border-danger");
    ev_end_e.style.display = 'none';
    validity++;
  }

  if (ev_description.value === '') {
    ev_description_e.style.display = '';
    ev_description.classList.add("border", "border-danger");
  } else {
    ev_description.classList.remove("border", "border-danger");
    ev_description_e.style.display = 'none';
    validity++;
  }

  if (validity === 6) {
    if(meth === 'add'){
      SaveEvent(route, events, images, deleteEvent, eventDetails);
    }else{
      UpdateEvent(route, events ,images)
    }
  }
}

function UpdateEvent(route, load, image){
  document.getElementById('mainLoader').style.display = 'flex';
  const formData = new FormData($('#update_event')[0]);

  $.ajax({
     type:'POST',
     url:route,
     data: formData,
     contentType: false,
     processData: false,
     success: res => {
      document.getElementById('mainLoader').style.display = 'none';
      document.getElementById('close-button').click();
      EventDetailsLoad(load, image)
     }, error: xhr => {
      console.log(xhr.responseText);
     }
  });
}
function SaveEvent(route, events, images, deleteEvent, eventDetails) {
  document.getElementById('mainLoader').style.display = 'flex';
  const formData = new FormData($('#add_event')[0]);

  $.ajax({
    type: 'POST',
    url: route,
    data: formData,
    contentType: false,
    processData: false,
    success: res => {
      document.getElementById('mainLoader').style.display = 'none';
      alertify.set('notifier', 'position', 'top-center');
      if (res.status === 'success') {
        
        const queryRoute = events + "?ev_id=" + res.ev_id;
        AddEventsOnList(queryRoute, images, deleteEvent, eventDetails);
        alertify.success('Event Created').dismissOthers();
      } else {
        alertify.error('Invalid Image type: Please provide an actual image').dismissOthers();
      }
    },
    error: xhr => {
      console.log(xhr.responseText);
    }
  });
}


function LoadEvents(route, imageRoute, deleteEvent, eventDetails) {
  $.ajax({
    url: route,
    type: "GET",
    dataType: "json",
    success: function (response) {
      const eventList = document.getElementById('eventList');
      if(response.event.length > 0){

      let html = '';
      eventList.innerHTML = '';
      response.event.forEach(ev => {
        html += `<div title="${ev.event_name}" style="transform: scale(0.01); display:none; transition:transform 0.6s" id="dataEvents${ev.event_id}" class="col-sm-6 col-lg-4 loadingEvents">
        <div class="card card-sm">
          <a onclick="openEvent()" href="${eventDetails}?event_id=${ev.event_id}" class="d-block"><img src="${imageRoute}/${ev.event_pic}" class="card-img-top"></a>
          <div class="card-body">
            <div class="d-flex align-items-center">
              <span class="avatar me-3 rounded" style="background-image: url(./static/avatars/000m.jpg)"></span>
              <div>
                <div>${ev.event_name}</div>
                <div class="text-muted">${ev.event_status === 0 ? 'Unpublished Event' : 'Published Event'}</div>
              </div>
              <div class="ms-auto">
                <a title="Edit ${ev.event_name}" onclick="openEvent()" href="${eventDetails}?event_id=${ev.event_id}" title="View" class="text-muted">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                <path d="M16 5l3 3" />
              </svg>
                   
                </a>
                <button title="Delete ${ev.event_name}" onclick="DeleteEvent('${deleteEvent}', '${ev.event_id}')" class="ms-3 text-muted  border-0 bg-body">
                  <!-- Download SVG icon from http://tabler-icons.io/i/heart -->
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
  <path d="M4 7l16 0" />
  <path d="M10 11l0 6" />
  <path d="M14 11l0 6" />
  <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
  <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
</svg>
                
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>`;
      });
      eventList.innerHTML = html;

      const loadingEvents = document.querySelectorAll('.loadingEvents');
      let index = 0; 

      const intervalId = setInterval(() => {
        const e = loadingEvents[index]; 

        if (index < loadingEvents.length) {
          e.style.display = '';
          setTimeout(() => {
            e.style.transform = "scale(1)";
          }, 25);
          index++; 
        } else {
          clearInterval(intervalId); 
        }
      }, 300);

      }else{
        eventList.innerHTML = `<div class="empty" id="empty">
        <div class="empty-img"><img src="./static/illustrations/undraw_quitting_time_dm8t.svg" height="128" alt="">
        </div>
        <p class="empty-title">No events found</p>
        <p class="empty-subtitle text-muted">
          Try adding event by clicking the add button below
        </p>
        <div class="empty-action">
          <button data-bs-toggle="modal" data-bs-target="#modal-report" class="btn btn-primary">
          
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
            Add Event
          </button>
        </div>
    </div>`;
      }
    },
    error: function (xhr) {
      console.error(xhr.responseText);
    }
  });
}
function openEvent(){
 const eventList = document.getElementById('eventList');
 eventList.style.animation = "fading 0.4s";
 setTimeout(()=>{
  eventList.style.display = "none";
 },400);
}
function AddEventsOnList(route, image, deleteEvent, eventDetails) {
  const btn = document.getElementById('close-button');
  btn.click();
  const eventList = document.getElementById('eventList');
  setTimeout(() => {
    $.ajax({
      type: "GET",
      url: route,
      dataType: "json",
      success: res => {
        const empty = document.getElementById('empty');
        if(empty){
          empty.remove();
        }
        const ev = res.event;
        eventList.innerHTML += `<div title="${ev.event_name}" style="transform: scale(0.01); display:none; transition:transform 0.6s" id="dataEvents${ev.event_id}" class="col-sm-6 col-lg-4">
        <div class="card card-sm">
          <a href="${eventDetails}?event_id=${ev.event_id}" class="d-block"><img src="${image}/${ev.event_pic}" class="card-img-top"></a>
          <div class="card-body">
            <div class="d-flex align-items-center">
              <span class="avatar me-3 rounded" style="background-image: url(./static/avatars/000m.jpg)"></span>
              <div>
                <div>${ev.event_name}</div>
                <div class="text-muted">${ev.event_status === 0 ? 'Unpublished Event' : 'Published Event'}</div>
              </div>
              <div class="ms-auto">
                <a title="Edit ${ev.event_name}" href="${eventDetails}?event_id=${ev.event_id}" class="text-muted">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                <path d="M16 5l3 3" />
              </svg>
                </a>
                <button title="Delete ${ev.event_name}" onclick="DeleteEvent('${deleteEvent}', '${ev.event_id}')" class="ms-3 text-muted  border-0 bg-body">
                  <!-- Download SVG icon from http://tabler-icons.io/i/heart -->
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M4 7l16 0" />
                  <path d="M10 11l0 6" />
                  <path d="M14 11l0 6" />
                  <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                  <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                </svg>
                
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>`;
        const eventName = "dataEvents" + ev.event_id;
        const eventId = document.getElementById(eventName);
        eventId.style.display = '';
        setTimeout(() => {
          eventId.style.transform = "scale(1)";
        }, 50);
      },
      error: xhr => {
        console.log(xhr.responseText);
      }
    });
  }, 400);

}

function DeleteEvent(route, ev_id) {

  alertify.confirm('Confirm Delete', 'Are you sure do you want to delete this event?',
    function () {
      document.getElementById('event_id').value = ev_id;
      var formData = $('form#deleteEvent').serialize();
      $.ajax({
        type: "POST",
        url: route,
        data: formData,
        success: res => {
          if (res.status === 'success') {
            RemoveEvent(ev_id);
          }

        }, error: xhr => {
          console.log(xhr.responseText);
        }
      })
    }
    , function () {
      console.log('close');
    });



}

function RemoveEvent(ev_id) {
  const ev_name = `dataEvents${ev_id}`;
  const event = document.getElementById(ev_name);

  event.style.transform = "scale(0.01)";
  setTimeout(() => {
    event.style.display = 'none';

    const loadingEvents = document.querySelectorAll('.loadingEvents');
    if(loadingEvents.length === 0){
      document.getElementById('eventList').innerHTML = `<div class="empty" id="empty">
      <div class="empty-img"><img src="./static/illustrations/undraw_quitting_time_dm8t.svg" height="128" alt="">
      </div>
      <p class="empty-title">No events found</p>
      <p class="empty-subtitle text-muted">
        Try adding event by clicking the add button below
      </p>
      <div class="empty-action">
        <button data-bs-toggle="modal" data-bs-target="#modal-report" class="btn btn-primary">
        
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
          Add Event
        </button>
      </div>
  </div>`;
    }
  }, 600);
}

function EventDetailsLoad(Route, eventImage){

  $.ajax({
    type:"GET",
    dataType: "json",
    url: Route,
    success: ev => {
      const data = ev.event;
      const admin = ev.admin;
      TextDisplayAnimate('event_name', data.event_name);
      TextDisplayAnimate('event_duration', DayDuration(data.event_start, data.event_end));
      TextDisplayAnimate('event_start', data.event_start);
      TextDisplayAnimate('event_end', data.event_end);
      TextDisplayAnimate('event_facilitator', data.event_facilitator);
      TextDisplayAnimate('admin_name', admin.admin_name);
      TextDisplayAnimate('event_description', data.event_description);
      TextDisplayAnimate('event_created', data.created_at.substring(0,10));
      AssVal('ev_name', data.event_name);
      AssVal('ev_facilitator', data.event_facilitator);
      document.getElementById('event_image').src = eventImage + "/" + data.event_pic;
      AssVal('ev_start', data.event_start);
      AssVal('ev_end', data.event_end);
      AssVal('duration', DayDuration(data.event_start, data.event_end));
      AssVal('ev_description', data.event_description);
      AssVal('event_id', data.event_id);
      AssVal('event_id_act', data.event_id);
    },
    error: xhr => {
      console.log(xhr.responseText);
    }
  });
}


function DayDuration(startDate, endDate) {
  if (!startDate || !endDate) {
    console.error('Both start date and end date must be provided.');
    return;
  }

  const dateArr1 = startDate.split('-');
  const dateArr2 = endDate.split('-');

  const date1 = new Date(dateArr1[0], dateArr1[1] - 1, dateArr1[2]);
  const date2 = new Date(dateArr2[0], dateArr2[1] - 1, dateArr2[2]);

  if (isNaN(date1) || isNaN(date2)) {
    console.error('Invalid date format.');
    return;
  }

  const differenceMs = Math.abs(date1 - date2);
  const differenceDays = Math.ceil(differenceMs / (1000 * 60 * 60 * 24));

  return differenceDays + ' Days Event';
}

function TextDisplayAnimate(elementId, text) {
  const element = document.getElementById(elementId);
  let index = 0;
  element.textContent = ''; 

  function addLetter() {
      if (index < text.length) {
          element.textContent += text.charAt(index);
          index++;
          setTimeout(addLetter, 100);
      }
  }

  addLetter();
}

function AssVal(eid, data){
  document.getElementById(eid).value = data;
}


function VerifyAddEventActivity(route){
  const act_name = document.getElementById('act_name');
  const act_fac = document.getElementById('act_fac');
  const act_venue = document.getElementById('act_venue');
  const act_date = document.getElementById('act_date');
  const act_time = document.getElementById('act_time');
  const act_description = document.getElementById('act_description');

  const act_name_e = document.getElementById('act_name_e');
  const act_fac_e = document.getElementById('act_fac_e');
  const act_venue_e = document.getElementById('act_venue_e');
  const act_date_e = document.getElementById('act_date_e');
  const act_time_e = document.getElementById('act_time_e');
  const act_description_e = document.getElementById('act_description_e');

  let validity = 0;
  if(CheckForm(act_name)){
    FormError(act_name, act_name_e);
  }else{
    FormValid(act_name, act_name_e);
    validity++;
  }

  if(CheckForm(act_fac)){
    FormError(act_fac, act_fac_e);
  }else{
    FormValid(act_fac, act_fac_e);
    validity++;
  }

  if(CheckForm(act_venue)){
    FormError(act_venue, act_venue_e);
  }else{
    FormValid(act_venue, act_venue_e);
    validity++;
  }

  if(CheckForm(act_date)){
    FormError(act_date, act_date_e);
  }else{
    FormValid(act_date, act_date_e);
    validity++;
  }

  if(CheckForm(act_time)){
    FormError(act_time, act_time_e);
  }else{
    FormValid(act_time, act_time_e);
    validity++;
  }

  if(CheckForm(act_description)){
    FormError(act_description, act_description_e);
  }else{
    FormValid(act_description, act_description_e);
    validity++;
  }

  if(validity === 6){
    act_name.value = '';
    act_fac.value = '';
    act_venue = '';
    act_date = '';
    act_time = '';
    act_description = '';
    AddEventActivity(route);
  }

}

function CheckForm(input){
   if(input.value === ''){
    return true;
   }else{
    return false;
   }
}

function FormError(input, err){
  input.classList.add("border", "border-danger");
  err.style.display = '';
}
function FormValid(input, err){
  input.classList.remove("border", "border-danger");
  err.style.display = 'none';
}

function AddEventActivity(route){
  document.getElementById('mainLoader').style.display = 'flex';
  var formData = $('form#addActForm').serialize();

  $.ajax({
     type:'POST',
     url: route,
     data: formData,
     success: res=>{
       if(res.status=== 'success'){
        document.getElementById('close-button-act').click();
        alertify.set('notifier', 'position', 'top-center');
        document.getElementById('mainLoader').style.display = 'none';
        alertify.success('Event Created').dismissOthers();
        document.getElementById('act_list').innerHTML += `<tr>
        <td > ${res.data.eact_name}</td>
        <td class="text-muted" >
          ${res.data.eact_description.length < 15 ? res.data.eact_description : res.data.eact_description.substring(0,15) + '....'}
        </td>
        <td class="text-muted" > ${res.data.eact_venue}</td>
        <td class="text-muted" >
        ${res.data.eact_facilitator}
        </td>
        <td class="text-muted" >
        ${res.data.eact_date} & ${res.data.eact_time}
        </td>
        <td class="d-flex gap-1">
          <button  class="border-0 bg-body text-info" title="View Activity" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
          <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
        </svg></button>
          <button  class="border-0 bg-body text-success" title="Edit Activity" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
          <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
          <path d="M16 5l3 3" />
        </svg></button>
          <button  class="border-0 bg-body text-danger" title="Delete Activity" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <path d="M4 7l16 0" />
          <path d="M10 11l0 6" />
          <path d="M14 11l0 6" />
          <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
          <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
        </svg></button>
        </td>
      </tr>`;
       }
     },error: xhr => {
      console.log(xhr.responseText);
     }
  });
}

function LoadEventActivities(route){
  const act_list = document.getElementById('act_list');
  $.ajax({
  type:"GET",
  dataType: 'json',
  url: route,
  success: res => {
    document.getElementById('loading-act').style.display = 'none';
    if(res.act.length !== 0){

      res.act.forEach(data => {
         act_list.innerHTML +=`<tr>
         <td > ${data.eact_name}</td>
         <td class="text-muted" >
           ${data.eact_description.length < 15 ? data.eact_description : data.eact_description.substring(0,15) + '....'}
         </td>
         <td class="text-muted" > ${data.eact_venue}</td>
         <td class="text-muted" >
         ${data.eact_facilitator}
         </td>
         <td class="text-muted" >
         ${data.eact_date} & ${data.eact_time}
         </td>
         <td class="d-flex gap-1">
           <button  class="border-0 bg-body text-info" title="View Activity" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
           <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
           <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
         </svg></button>
           <button  class="border-0 bg-body text-success" title="Edit Activity" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
           <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
           <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
           <path d="M16 5l3 3" />
         </svg></button>
           <button onclick="DeleteActEvent('${data.eact_id}')" class="border-0 bg-body text-danger" title="Delete Activity" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
           <path d="M4 7l16 0" />
           <path d="M10 11l0 6" />
           <path d="M14 11l0 6" />
           <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
           <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
         </svg></button>
         </td>
       </tr>`;
      });

    }else{
      act_list.innerHTML = `<tr>
      <td colspan="6"  class="text-center text-muted">No Activity Found for this Event <button data-bs-toggle="modal" data-bs-target="#addActivity" style="text-decoration: underline !important" class="border-0 bg-body text-muted"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <path d="M12 5l0 14" />
        <path d="M5 12l14 0" />
      </svg>Add</button></td>
    </tr>`;
    }
  }, error: xhr => {
    console.log(xhr.responseText);
  }
})
}

function DeleteActEvent(ids){
   document.getElementById('delete_act_d')
}

function EditActEvent(){

}

function ViewActEvent(){

}