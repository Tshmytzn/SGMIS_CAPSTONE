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


function VerifyFormEvent(route, events, images, deleteEvent) {
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

  if (evname.value === "") {
    ev_name_e.style.display = '';
    evname.classList.add("border", "border-danger");
  } else {
    evname.classList.remove("border", "border-danger");
    ev_name_e.style.display = 'none';
    validity++;
  }

  if (dept.value === 'none') {
    dept_e.style.display = '';
    dept.classList.add("border", "border-danger");
  } else {
    dept.classList.remove("border", "border-danger");
    dept_e.style.display = 'none';
    validity++;
  }

  if (ev_pic.files.length === 0) {
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
    SaveEvent(route, events, images, deleteEvent);
  }
}

function SaveEvent(route, events, images, deleteEvent) {
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
        AddEventsOnList(queryRoute, images, deleteEvent);
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


function LoadEvents(route, imageRoute, deleteEvent) {
  $.ajax({
    url: route,
    type: "GET",
    dataType: "json",
    success: function (response) {
      const eventList = document.getElementById('eventList');
      let html = '';
      eventList.innerHTML = '';
      response.event.forEach(ev => {
        html += `<div title="${ev.event_name}" style="transform: scale(0.01); display:none; transition:transform 0.6s" id="dataEvents${ev.event_id}" class="col-sm-6 col-lg-4 loadingEvents">
        <div class="card card-sm">
          <a href="#" class="d-block"><img src="${imageRoute}/${ev.event_pic}" class="card-img-top"></a>
          <div class="card-body">
            <div class="d-flex align-items-center">
              <span class="avatar me-3 rounded" style="background-image: url(./static/avatars/000m.jpg)"></span>
              <div>
                <div>${ev.event_name}</div>
                <div class="text-muted">3 days ago</div>
              </div>
              <div class="ms-auto">
                <a href="#" title="View" class="text-muted">
                  <!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                   
                </a>
                <button title="Delete" onclick="DeleteEvent('${deleteEvent}', '${ev.event_id}')" class="ms-3 text-muted border border-0 bg-body">
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
          }, 50);
          index++; 
        } else {
          clearInterval(intervalId); 
        }
      }, 600);

    },
    error: function (xhr) {
      console.error(xhr.responseText);
    }
  });
}

function AddEventsOnList(route, image, deleteEvent) {
  const btn = document.getElementById('close-button');
  btn.click();
  const eventList = document.getElementById('eventList');
  setTimeout(() => {
    $.ajax({
      type: "GET",
      url: route,
      dataType: "json",
      success: res => {
        const ev = res.event;
        eventList.innerHTML += `<div title="${ev.event_name}" style="transform: scale(0.01); display:none; transition:transform 0.6s" id="dataEvents${ev.event_id}" class="col-sm-6 col-lg-4">
        <div class="card card-sm">
          <a href="#" class="d-block"><img src="${image}/${ev.event_pic}" class="card-img-top"></a>
          <div class="card-body">
            <div class="d-flex align-items-center">
              <span class="avatar me-3 rounded" style="background-image: url(./static/avatars/000m.jpg)"></span>
              <div>
                <div>${ev.event_name}</div>
                <div class="text-muted">3 days ago</div>
              </div>
              <div class="ms-auto">
                <a href="#" class="text-muted">
                  <!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                
                </a>
                <button onclick="DeleteEvent('${deleteEvent}', '${ev.event_id}')" class="ms-3 text-muted border border-0 bg-body">
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
  }, 600);
}