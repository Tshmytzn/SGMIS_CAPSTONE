<!doctype html>

<html lang="en">
  
@include('Admin.components.header', ['title' => 'Events'])

  <body >
    <script src="{{asset('./dist/js/demo-theme.min.js?1684106062')}}"></script>

    <div class="page">
@include('Admin.components.nav', ['active' => 'Events'])

@include('Admin.components.loading')
            <div class="page-wrapper">

        <!-- Page header -->
        <div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                  Overview
                </div>
                <h2 class="page-title">
                  Events
                </h2>
              </div>
     <!-- Page title actions -->
        <div class="col-auto ms-auto d-print-none">
          <div class="d-flex">
            <div class="me-3">
              <div class="input-icon">
                <input type="text" value="" class="form-control" placeholder="Search…">
                <span class="input-icon-addon">
                 <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" /><path d="M21 21l-6 -6" /></svg>
                </span>
            </div>
            </div>

                <button class="btn" style="background-color: #DF7026; color: white;" data-bs-toggle="modal" data-bs-target="#modal-report"> Create Event</button> &nbsp; &nbsp;
                <button class="btn btn-secondary" style="" data-bs-toggle="modal" data-bs-target="#modal-setting"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                  <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0"/>
                  <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z"/>
                </svg></button>
        </div>
      </div>

        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">
            <form id="deleteEvent" method="POST">
              @csrf
              <input type="hidden" name="event_id" id="event_id">
            </form>
            <div class="row row-cards" id="eventList">
               
              <div class="page page-center" id="loading-events">
                <div class="container container-slim py-4">
                  <div class="text-center">
                    <div class="mb-3">
                      <a href="." class="navbar-brand navbar-brand-autodark"><img src="./static/logoicon.png" height="36" alt=""></a>
                    </div>
                    <div class="text-muted mb-3">Loading Events</div>
                    <div class="progress progress-sm">
                      <div class="progress-bar progress-bar-indeterminate"></div>
                    </div>
                  </div>
                </div>
              </div>

          </div>
        </div>
       </div>
     </div>
    </div>
        
    

      </div>
    </div>

      <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header text-white" style="background-color: #3E8A34;">
            <h5 class="modal-title">New Event</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form id="add_event" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="modal-body">
            
            <div class="mb-3">
              <label class="form-label">Event Name   <span style="display: none" id="ev_name_e" class="text-danger ">(Don't Leave this field empty)</span></label>
              <input type="text" class="form-control" id="ev_name" name="ev_name" placeholder="Event name">
            
            </div>
            <div class="mb-3">
              <label class="form-label">Event Facilitator   <span style="display: none" id="ev_facilitator_e" class="text-danger ">(Don't Leave this field empty)</span></label>
              <input type="text" class="form-control" id="ev_facilitator" name="ev_facilitator" placeholder="Event Facilitator">
            
            </div>
        <div class="mb-2">
          <label class="form-label">Event Photo   <span style="display: none;" id="ev_pic_e" class="text-danger ">(No Selected Photo! Please provide)</span></label>
          <input type="file" id="ev_pic" class="form-control" accept="image/*" name="ev_pic" placeholder="Choose Event Cover Photo">
      </div>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label">Event Start Date   <span style="display: none" id="ev_start_e" class="text-danger ">(Please Choose a date)</span></label>
                    <input type="date" onchange="getDays(this)" id="ev_start" name="ev_start" class="form-control">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  
                  <label class="form-label">Event End Date   <span style="display: none" id="ev_end_e" class="text-danger ">(Please Choose a date)</span></label>
                  <input type="date" id="ev_end" onchange="getDays(this)" name="ev_end" class="form-control">

                </div>
              </div>
              <div class="mb-3">
                <label class="form-label">Duration</label>
                <input type="text" class="form-control" disabled id="duration" placeholder="Event duration">
            </div>
              <div class="col-lg-12">
                <div>
                  <label class="form-label">Event Description   <span style="display: none" id="ev_description_e" class="text-danger ">(Please provide a description)</span></label>
                  <textarea id="ev_description" name="ev_description" class="form-control" rows="2"></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" id="close-button" data-bs-dismiss="modal">Cancel</button>
            <button type="button" onclick="VerifyFormEvent('{{route('saveEvent')}}', '{{ route('getEvent') }}', '{{ asset('event_images/') }}', '{{ route('deleteEvent') }}', '{{ route('EventDetails') }}', 'add')" class="btn btn-primary">Save</button>
          </div>
        </form>
        </div>
      </div>
    </div>
    {{-- setting modal --}}
    <div class="modal modal-blur fade" id="modal-setting" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header text-white" style="background-color: #3E8A34;">
            <h5 class="modal-title">Event Setting</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form id="add_event" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="modal-body">

            <div class="page-body">
              <div class="container-xl">
                <div class="card">
                  <div class="row g-0">
                    <div class="col-3 d-none d-md-block border-end">
                      <div class="card-body">
                        <h4 class="subheader">settings</h4>
                        <ul class="nav nav-pills flex-column">
                          <li class="nav-item">
                            <a class="nav-link active" id="my-account-tab" data-bs-toggle="pill" href="#map"><h3>Event Venue</h3></a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="administrators-tab" data-bs-toggle="pill" href="#sample1"><h3>Sample</h3></a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="studentadmins-tab" data-bs-toggle="pill" href="#sample2"><h3>Sample</h3></a>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="col d-flex flex-column">
                      <div class="card-body">
                        <div class="tab-content">
                          <div class="tab-pane fade show active" id="map">
                            <h2 class="mb-4">Venue</h2>
                            <div class="col d-flex flex-column">
                              <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="SelectStundentTable">
                                  <thead>
                                    <tr>
                                      <th>Name</th>
                                      <th>Actions</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    {{-- <tr>
                                      <td>Sample name</td>
                                      <td>34545469</td>
                                      <td>USG PRESIDENT</td>
                                      <td>
                                        <button class="btn btn-warning btn-sm">Select</button>
                                      </td>
                                    </tr> --}}
                                  </tbody>
                                </table>
                              </div>
                              <hr>


                              
                              <form class="row g-3" id="addnewstudentadmin" method="POST">@csrf
              
                              <div class="row g-2">
                                <div class="col-12">
                                  <div id="mapL" style="height: 340px;"></div>
  
                                </div>
                              </div>
              
                              </form>
                            </div>                      
                          </div>
                          {{-- administrator --}}
                          <div class="tab-pane fade" id="sample1">
                            <h2 class="mb-4">sample1 </h2>
                            <div class="col d-flex flex-column">
                              
                            </div>                      
                          </div>
                         {{-- administrator --}}
                         <div class="tab-pane fade" id="sample2">
                          <h2 class="mb-4">sample2 </h2>
                          <div class="col d-flex flex-column">
                            
                          </div>                      
                        </div>
                        
                        </div>
                      </div>
    
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" id="close-button" data-bs-dismiss="modal">Cancel</button>
            <button type="button" onclick="VerifyFormEvent('{{route('saveEvent')}}', '{{ route('getEvent') }}', '{{ asset('event_images/') }}', '{{ route('deleteEvent') }}', '{{ route('EventDetails') }}', 'add')" class="btn btn-primary">Save</button>
          </div>
        </form>
        </div>
      </div>
    </div>
    
@include('Admin.components.scripts')
@include('Admin.components.functionscript')


<script>
  window.onload = function(){
    LoadEvents("{{ route('getAllEvent') }}", "{{ asset('event_images/') }}", "{{ route('deleteEvent') }}", "{{ route('EventDetails') }}",'admin');
  }
</script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var map = L.map('mapL').setView([0, 0], 2); // Default center and zoom level

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var userMarker = null;

    // Function to handle setting user location
    function setUserLocation(latitude, longitude) {
      // Clear existing marker if any
      if (userMarker) {
        map.removeLayer(userMarker);
      }

      // Set new user marker
      userMarker = L.marker([latitude, longitude]).addTo(map);
      userMarker.bindPopup("Your Location").openPopup();

      // Optional: Adjust map view to user location
      map.setView([latitude, longitude], 15);
    }

    // Event listener for map click to set user location
    map.on('click', function(e) {
      var userLat = e.latlng.lat;
      var userLng = e.latlng.lng;
      setUserLocation(userLat, userLng);
    });

    // Check for geolocation support
    if (navigator.geolocation) {
      // Get current position
      navigator.geolocation.getCurrentPosition(function(position) {
        // Set map view to user's location
        var userLat = position.coords.latitude;
        var userLng = position.coords.longitude;
        setUserLocation(userLat, userLng);
      }, function(error) {
        console.error('Error getting the user location:', error);
      });
    } else {
      console.error('Geolocation is not supported by this browser.');
    }
  });
</script>


<!-- Leaflet JavaScript -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<!-- Leaflet.markercluster JavaScript -->
<script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>


  </body>
</html>