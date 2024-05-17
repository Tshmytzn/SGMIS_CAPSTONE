// @formatter:off
document.addEventListener("DOMContentLoaded", function() {
  let dropzone = new Dropzone("#dropzone-multiple", {
    paramName: "programmeImages", // The name that will be used to transfer the file
    maxFilesize: 10, // MB
    acceptedFiles: "image/*",
    autoProcessQueue: false,
    headers: {
        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
    },
    init: function() {
        let myDropzone = this;

        // Disable autoProcessQueue to manually handle the file upload
        document.getElementById("upload-button").addEventListener("click", function(e) {
            e.preventDefault();
            e.stopPropagation();

            if (myDropzone.getQueuedFiles().length > 0) {
                myDropzone.processQueue();
            } else {
                alert("No files to upload!");
            }
        });

        // Append additional data
        this.on("sending", function(file, xhr, formData) {
            let eventId = document.getElementById('event_id_programme').value;
            formData.append("event_id", eventId); // Append the event_id to the formData
        });

        // Handle the response
        this.on("successmultiple", function(files, response) {
            console.log("Successfully uploaded:", response);
            document.getElementById('mainLoader').style.display = 'none';
        });

        this.on("errormultiple", function(files, response) {
            console.error("Error uploading:", response);
            document.getElementById('mainLoader').style.display = 'none';
        });
    }
});
});

document.addEventListener("DOMContentLoaded", function () {
  var el;
  window.TomSelect && (new TomSelect(el = document.getElementById('select-tags'), {
    copyClassesToDropdown: false,
    dropdownParent: 'body',
    controlInput: '<input>',
    placeholder: 'Select Department',
    render:{
      item: function(data,escape) {
        if( data.customProperties ){
          return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
        }
        return '<div>' + escape(data.text) + '</div>';
      },
      option: function(data,escape){
        if( data.customProperties ){
          return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
        }
        return '<div>' + escape(data.text) + '</div>';
      },
    },
    onItemAdd: function(value) {
        AddDept(value)
    },
    onItemRemove: function(value) {
       RemoveDept(value)
    }
  }));
});

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
    if (meth === 'add') {
      SaveEvent(route, events, images, deleteEvent, eventDetails);
    } else {
      UpdateEvent(route, events, images)
    }
  }
}

function UpdateEvent(route, load, image) {
  document.getElementById('mainLoader').style.display = 'flex';
  const formData = new FormData($('#update_event')[0]);

  $.ajax({
    type: 'POST',
    url: route,
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
      if (response.event.length > 0) {

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

      } else {
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
function openEvent() {
  const eventList = document.getElementById('eventList');
  eventList.style.animation = "fading 0.4s";
  setTimeout(() => {
    eventList.style.display = "none";
  }, 400);
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
        if (empty) {
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
    if (loadingEvents.length === 0) {
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

function EventDetailsLoad(Route, eventImage) {

  $.ajax({
    type: "GET",
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
      TextDisplayAnimate('event_created', data.created_at.substring(0, 10));
      AssVal('ev_name', data.event_name);
      AssVal('ev_facilitator', data.event_facilitator);
      document.getElementById('event_image').src = eventImage + "/" + data.event_pic;
      AssVal('ev_start', data.event_start);
      AssVal('ev_end', data.event_end);
      AssVal('duration', DayDuration(data.event_start, data.event_end));
      AssVal('ev_description', data.event_description);
      AssVal('event_id', data.event_id);
      AssVal('event_id_act', data.event_id);
      AssVal('event_id_programme', data.event_id);
      AssVal('dept_event_id', data.event_id);
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

function AssVal(eid, data) {
  document.getElementById(eid).value = data;
}


function VerifyAddEventActivity(route, deleteRoute, actDetails) {
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
  if (CheckForm(act_name)) {
    FormError(act_name, act_name_e);
  } else {
    FormValid(act_name, act_name_e);
    validity++;
  }

  if (CheckForm(act_fac)) {
    FormError(act_fac, act_fac_e);
  } else {
    FormValid(act_fac, act_fac_e);
    validity++;
  }

  if (CheckForm(act_venue)) {
    FormError(act_venue, act_venue_e);
  } else {
    FormValid(act_venue, act_venue_e);
    validity++;
  }

  if (CheckForm(act_date)) {
    FormError(act_date, act_date_e);
  } else {
    FormValid(act_date, act_date_e);
    validity++;
  }

  if (CheckForm(act_time)) {
    FormError(act_time, act_time_e);
  } else {
    FormValid(act_time, act_time_e);
    validity++;
  }

  if (CheckForm(act_description)) {
    FormError(act_description, act_description_e);
  } else {
    FormValid(act_description, act_description_e);
    validity++;
  }

  if (validity === 6) {
    
    AddEventActivity(route, deleteRoute, actDetails);
    act_name.value = '';
    act_fac.value = '';
    act_venue.value = '';
    act_date.value = '';
    act_time.value = '';
    act_description.value = '';
  }

}

function CheckForm(input) {
  if (input.value === '') {
    return true;
  } else {
    return false;
  }
}

function FormError(input, err) {
  input.classList.add("border", "border-danger");
  err.style.display = '';
}
function FormValid(input, err) {
  input.classList.remove("border", "border-danger");
  err.style.display = 'none';
}

function AddEventActivity(route, deleteRoute, actDetails) {
  document.getElementById('mainLoader').style.display = 'flex';
  var formData = $('form#addActForm').serialize();
  $.ajax({
    type: 'POST',
    url: route,
    data: formData,
    success: res => {
      if (res.status === 'success') {
        document.getElementById('close-button-act').click();
        alertify.set('notifier', 'position', 'top-center');
        document.getElementById('mainLoader').style.display = 'none';
        alertify.success('Activity Created').dismissOthers();
        if(document.getElementById('loading-act')){
          document.getElementById('loading-act').remove();
        }
        if(document.getElementById('empty_act')){
          document.getElementById('empty_act').remove();
        }
        document.getElementById('act_list').innerHTML += `<tr id="act_tr${res.data.eact_id}" class="act_tr">
        <td > ${res.data.eact_name}</td>
        <td class="text-muted" >
          ${res.data.eact_description.length < 15 ? res.data.eact_description : res.data.eact_description.substring(0, 15) + '....'}
        </td>
        <td class="text-muted" > ${res.data.eact_venue}</td>
        <td class="text-muted" >
        ${res.data.eact_facilitator}
        </td>
        <td class="text-muted" >
        ${res.data.eact_date} & ${convertToAmPm(res.data.eact_time)}
        </td>
        <td class="d-flex gap-1">
          <button  data-bs-toggle="modal" data-bs-target="#viewAct" onclick="ViewActivity('${res.data.eact_id}', '${actDetails}')" class="border-0 bg-body text-info" title="View Activity" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
          <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
        </svg></button>
          <button data-bs-toggle="modal" data-bs-target="#editAct" onclick="EditActEvent('${res.data.eact_id}', '${actDetails}')" class="border-0 bg-body text-success" title="Edit Activity"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
          <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
          <path d="M16 5l3 3" />
        </svg></button>
          <button onclick="DeleteActEvent('${res.data.eact_id}', '${deleteRoute}')" class="border-0 bg-body text-danger" title="Delete Activity" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
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
    }, error: xhr => {
      console.log(xhr.responseText);
    }
  });
}

function LoadEventActivities(route, deleteRoute, actDetails) {
  const act_list = document.getElementById('act_list');
  $.ajax({
    type: "GET",
    dataType: 'json',
    url: route,
    success: res => {
      document.getElementById('loading-act').style.display = 'none';
      if (res.act.length !== 0) {

        res.act.forEach(data => {
          act_list.innerHTML += `<tr id="act_tr${data.eact_id}" class="act_tr">
         <td > ${data.eact_name}</td>
         <td class="text-muted" >
           ${data.eact_description.length < 15 ? data.eact_description : data.eact_description.substring(0, 15) + '....'}
         </td>
         <td class="text-muted" > ${data.eact_venue}</td>
         <td class="text-muted" >
         ${data.eact_facilitator}
         </td>
         <td class="text-muted" >
         ${data.eact_date} & ${convertToAmPm(data.eact_time)}
         </td>
         <td class="d-flex gap-1">
           <button  data-bs-toggle="modal" data-bs-target="#viewAct" onclick="ViewActivity('${data.eact_id}', '${actDetails}')" class="border-0 bg-body text-info" title="View Activity" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
           <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
           <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
         </svg></button>
           <button data-bs-toggle="modal" data-bs-target="#editAct" onclick="EditActEvent('${data.eact_id}', '${actDetails}')" class="border-0 bg-body text-success" title="Edit Activity" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
           <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
           <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
           <path d="M16 5l3 3" />
         </svg></button>
           <button onclick="DeleteActEvent('${data.eact_id}', '${deleteRoute}')" class="border-0 bg-body text-danger" title="Delete Activity" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
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

      } else {
        act_list.innerHTML = `<tr id="empty_act">
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

function DeleteActEvent(ids, route) {
  alertify.confirm('Delete Activity', 'Are you sure you want to delete this activity?',
    function () {
      document.getElementById('mainLoader').style.display = 'flex';
    document.getElementById('delete_act_id').value = ids;
  
    var formData = $('form#deleteActEvent').serialize();
  
    $.ajax({
      type: "POST",
      url: route,
      data: formData,
      success: res => {
        if (res.status === 'success') {
          alertify.set('notifier', 'position', 'top-center');
          document.getElementById('mainLoader').style.display = 'none';
          alertify.success('Activity Deleted').dismissOthers();

          const nameId = "act_tr"+ids;
          document.getElementById(nameId).remove();
          
          const act_tr = document.querySelectorAll('.act_tr');
          if(act_tr.length === 0){
            document.getElementById('act_list').innerHTML = `<tr id="empty_act">
            <td colspan="6"  class="text-center text-muted">No Activity Found for this Event <button data-bs-toggle="modal" data-bs-target="#addActivity" style="text-decoration: underline !important" class="border-0 bg-body text-muted"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path d="M12 5l0 14" />
              <path d="M5 12l14 0" />
            </svg>Add</button></td>
          </tr>`;
          }
        }
      }, error: xhr => {
        console.log(xhr.responseText);
      }
    });},
    function () { console.log('cancel') });
  
}
function convertToAmPm(time) {
 
  var timeArray = time.split(':');
  var hours = parseInt(timeArray[0]);
  var minutes = parseInt(timeArray[1]);

 
  if (hours >= 0 && hours <= 23 && minutes >= 0 && minutes <= 59) {
   
      var ampm = hours >= 12 ? 'PM' : 'AM';
      hours = hours % 12;
      hours = hours ? hours : 12; 
      minutes = minutes < 10 ? '0' + minutes : minutes;
      var formattedTime = hours + ':' + minutes + ' ' + ampm;
      return formattedTime;
  } else {

      return 'Invalid time format';
  }
}

function EditActEvent(ids, route) {
   $.ajax({
     type:"GET",
     dataType: 'json',
     url: route + "?act_id=" + ids,
     success: res=>{
       const actTitle = document.getElementById('editActTitle');
       actTitle.textContent = res.act.eact_name;
       AssVal('act_name_edit', res.act.eact_name);
       AssVal('act_fac_edit', res.act.eact_facilitator);
       AssVal('act_venue_edit', res.act.eact_venue);
       AssVal('act_date_edit', res.act.eact_date);
       AssVal('act_time_edit', res.act.eact_time);
       AssVal('act_description_edit', res.act.eact_description);
       AssVal('act_id_edit', res.act.eact_id);
     },error: xhr => {
      console.log(xhr.responseText);
     }
   });
}

function VerifyEditEventActivity(route, getDetails, deleteAct){
  const act_name = document.getElementById('act_name_edit');
  const act_fac = document.getElementById('act_fac_edit');
  const act_venue = document.getElementById('act_venue_edit');
  const act_date = document.getElementById('act_date_edit');
  const act_time = document.getElementById('act_time_edit');
  const act_description = document.getElementById('act_description_edit');

  const act_name_e = document.getElementById('act_name_e_edit');
  const act_fac_e = document.getElementById('act_fac_e_edit');
  const act_venue_e = document.getElementById('act_venue_e_edit');
  const act_date_e = document.getElementById('act_date_e_edit');
  const act_time_e = document.getElementById('act_time_e_edit');
  const act_description_e = document.getElementById('act_description_e_edit');

  let validity = 0;
  if (CheckForm(act_name)) {
    FormError(act_name, act_name_e);
  } else {
    FormValid(act_name, act_name_e);
    validity++;
  }

  if (CheckForm(act_fac)) {
    FormError(act_fac, act_fac_e);
  } else {
    FormValid(act_fac, act_fac_e);
    validity++;
  }

  if (CheckForm(act_venue)) {
    FormError(act_venue, act_venue_e);
  } else {
    FormValid(act_venue, act_venue_e);
    validity++;
  }

  if (CheckForm(act_date)) {
    FormError(act_date, act_date_e);
  } else {
    FormValid(act_date, act_date_e);
    validity++;
  }

  if (CheckForm(act_time)) {
    FormError(act_time, act_time_e);
  } else {
    FormValid(act_time, act_time_e);
    validity++;
  }

  if (CheckForm(act_description)) {
    FormError(act_description, act_description_e);
  } else {
    FormValid(act_description, act_description_e);
    validity++;
  }

  if (validity === 6) {
    
    UpdateEventActivity(route, getDetails, deleteAct);

  }
}
//Finalize Update Event BAckend
function UpdateEventActivity(route, getDetails, deleteAct){
  document.getElementById('mainLoader').style.display = 'flex';
  var formData = $('form#editActForm').serialize();
  $.ajax({
    type:"POST",
    data: formData,
    url: route ,
    success: res=>{
     
     if(res.status === 'success'){
      $.ajax({
        type:"GET",
        dataType: 'json',
        url: getDetails + "?act_id=" + res.data,
        success: response=>{
          document.getElementById('close-button-act_edit').click();
          document.getElementById('mainLoader').style.display = 'none';
          const trName = 'act_tr' + res.data;
          document.getElementById(trName).remove();

          document.getElementById('act_list').innerHTML += `<tr id="act_tr${res.data}" class="act_tr">
          <td > ${response.act.eact_name}</td>
          <td class="text-muted" >
            ${response.act.eact_description.length < 15 ? response.act.eact_description : response.act.eact_description.substring(0, 15) + '....'}
          </td>
          <td class="text-muted" > ${response.act.eact_venue}</td>
          <td class="text-muted">
          ${response.act.eact_facilitator}
          </td>
          <td class="text-muted" >
          ${response.act.eact_date} & ${convertToAmPm(response.act.eact_time)}
          </td>
          <td class="d-flex gap-1">
            <button data-bs-toggle="modal" data-bs-target="#viewAct" onclick="ViewActivity('${response.act.eact_id}', '${getDetails}')" class="border-0 bg-body text-info" title="View Activity" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
            <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
          </svg></button>
            <button data-bs-toggle="modal" data-bs-target="#editAct" onclick="EditActEvent('${response.act.eact_id}', '${getDetails}')" class="border-0 bg-body text-success" title="Edit Activity" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
            <path d="M16 5l3 3" />
          </svg></button>
            <button onclick="DeleteActEvent('${response.act.eact_id}', '${deleteAct}')" class="border-0 bg-body text-danger" title="Delete Activity" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M4 7l16 0" />
            <path d="M10 11l0 6" />
            <path d="M14 11l0 6" />
            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
          </svg></button>
          </td>
        </tr>`
        },error: xhr => {
         console.log(xhr.responseText);
        }
      });
     }
    },error: xhr => {
     console.log(xhr.responseText);
    }
  });
}

function AssText(ids, data){
  document.getElementById(ids).textContent = data;
}
function ViewActivity(ids, route){
  $.ajax({
    type: "GET",
    url: route + "?act_id=" + ids,
    dataType: "json",
    success: res => {
      AssText('act_name_view', res.act.eact_name);
      AssText('act_fac_view', res.act.eact_facilitator);
      AssText('act_venue_view', res.act.eact_venue);
      AssText('act_date_time_view', res.act.eact_date + " & " + res.act.eact_time);
      AssText('act_description_view', res.act.eact_description);
    },error: xhr => {
      console.log(xhr.responseText);
    }
  });
}

function UploadProgrammeImages(route){
  document.getElementById('mainLoader').style.display = 'flex';
  var formData = new FormData($('#dropzone-multiple')[0]);
  $.ajax({
    type:"POST",
    url: route,
    data: formData,
    processData: false,
    contentType:false,
    success: res =>{
      console.log(res);
      document.getElementById('mainLoader').style.display = 'none';
    },error: xhr => {
      console.log(xhr.responseText);
    }
  });
}
function LoadDeptEvent(route, getDept, getCourse, image, empty){
  $.ajax({
    type:"GET",
    url: route,
    dataType: 'json',
    success: res=> {
      const deptList = document.getElementById('event_department_list');
      if(res.dept.length === 0){
        deptList.innerHTML = `<div class="empty" id="empty">
        <div class="empty-img"><img src="${empty}" height="128" alt="">
        </div>
        <p class="empty-title">No events found</p>
        <p class="empty-subtitle text-muted">
          No Department is Currently Added in this Event
        </p>
    
    </div>`;
      }else{
        if(document.getElementById('loading-dept')){
          document.getElementById('loading-dept').remove();
        }
        res.dept.forEach(dept => {
          $.ajax({
            type:"GET",
            url: getDept + "?dept_id=" + dept.dept_id,
            dataType: 'json',
            success: resp=> {
                
              $.ajax({
                type:"GET",
                url: getCourse + "?dept_id=" + dept.dept_id,
                dataType: 'json',
                success: response=> {
                  let course = '';
                  response.course.forEach(c=>{
                    course += `<li><a class="dropdown-item" href="#">${c.course_name}</a></li>`;
                  })
                  deptList.innerHTML += `<div class="col-sm-6 col-lg-4 mt-4"  id="dept_added_event${dept.dept_id}">
              <div class="card card-sm">
                <div class="custom-dropdown dropup">
                <a href="#" class="d-block"><img src="${image}/${resp.dept.dept_image}" class="card-img-top"></a>
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <button class="" type="button" id="dropdownMenuButton" aria-expanded="false" style="border: none; background:none;">
                          ${resp.dept.dept_name}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          ${course}
                        </ul>
                        <div class="ms-auto">
                            <button class="ms-3 text-muted border-0 bg-body">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-xbox-x">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 21a9 9 0 0 0 9 -9a9 9 0 0 0 -9 -9a9 9 0 0 0 -9 9a9 9 0 0 0 9 9z" />
                            <path d="M9 8l6 8" />
                            <path d="M15 8l-6 8" />
                          </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>`;
                }, error: xhr => {
                  console.log(xhr.responseText);
                }
              });
  
            }, error: xhr => {
              console.log(xhr.responseText);
            }
          });
        
          
        })
      }
    }, error: xhr => {
      console.log(xhr.responseText);
    }
  });
}
function AddDept(values){
document.getElementById('mainLoader').style.display = 'flex';
AssVal('selected_dept', values);
var formData = $('form#deptForm').serialize();
  $.ajax({
    type:"POST",
    url: document.getElementById('addDeptRoute').value,
    data: formData,
    success: res=>{
      const deptList = document.getElementById('event_department_list');
      if(document.getElementById('empty')){
        document.getElementById('empty').remove();
      }
      if(res.status === 'success'){

        document.getElementById('mainLoader').style.display = 'none';
        let course = '';
        res.course.forEach(c=>{
          course += `<li><a class="dropdown-item" href="#">${c.course_name}</a></li>`;
        });
         deptList.innerHTML += `<div class="col-sm-6 col-lg-4 mt-4" id="dept_added_event${res.dept.dept_id}">
         <div class="card card-sm">
           <div class="custom-dropdown dropup">
           <a href="#" class="d-block"><img src="${document.getElementById('imageRouteDept').value}/${res.dept.dept_image}" class="card-img-top"></a>
           <div class="card-body">
               <div class="d-flex align-items-center">
                   <button class="" type="button" id="dropdownMenuButton" aria-expanded="false" style="border: none; background:none;">
                     ${res.dept.dept_name}
                   </button>
                   <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      ${course}
                   </ul>
                   <div class="ms-auto">
                   <button class="ms-3 text-muted border-0 bg-body">
                   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-xbox-x">
                   <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                   <path d="M12 21a9 9 0 0 0 9 -9a9 9 0 0 0 -9 -9a9 9 0 0 0 -9 9a9 9 0 0 0 9 9z" />
                   <path d="M9 8l6 8" />
                   <path d="M15 8l-6 8" />
                 </svg>
                   </button>
                   </div>
               </div>
           </div>
       </div>
   </div>
 </div>
`;
      }
    }, error: xhr => {
      console.log(xhr.responseText);
    }
  });
}
function RemoveDept(value){
  document.getElementById('mainLoader').style.display = 'flex';
  AssVal('selected_dept', value);
  var formData = $('form#deptForm').serialize();
  $.ajax({
    type:"POST",
    url: document.getElementById('removeDeptRoute').value,
    data: formData,
    success: res=>{
      const deptName = `dept_added_event${value}`;
      document.getElementById(deptName).remove();

      const deptList = document.getElementById('event_department_list');
      if(res.dept === 0){
        deptList.innerHTML = `<div class="empty" id="empty">
        <div class="empty-img"><img src="${document.getElementById('emptyImage').value}" height="128" alt="">
        </div>
        <p class="empty-title">No events found</p>
        <p class="empty-subtitle text-muted">
          No Department is Currently Added in this Event
        </p>
    
    </div>`;
      }
      document.getElementById('mainLoader').style.display = 'none';
    }, error: xhr => {
      console.log(xhr.responseText);
    }
  });
}
