<!doctype html>

<html lang="en">
  
@include('Admin.components.header', ['title' => 'Event Details'])
<link href="./dist/libs/dropzone/dist/dropzone.css?1684106062" rel="stylesheet"/>
<link href="./dist/css/tabler.min.css?1684106062" rel="stylesheet"/>
<link href="./dist/css/tabler-flags.min.css?1684106062" rel="stylesheet"/>
<link href="./dist/css/tabler-payments.min.css?1684106062" rel="stylesheet"/>
<link href="./dist/css/tabler-vendors.min.css?1684106062" rel="stylesheet"/>
<link href="./dist/css/demo.min.css?1684106062" rel="stylesheet"/>
<style>
  .custom-dropdown:hover .dropdown-menu {
    display: block;
    transform: translate(0, 0);
    visibility: visible;
  }

  .dropup .dropdown-menu {
        top: auto;
        bottom: 100%;
        left: 30%;  }
</style>

  <body >
    <script src="{{asset('./dist/js/demo-theme.min.js?1684106062')}}"></script>

    <div class="page">

@include('Admin.components.nav', ['active' => 'Event Details'])

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
                <h1 class="page-title">
                  Event Details
                </h1>
              </div>


        <!-- Page body -->        
        <div class="page-body">
          <div class="container-xl">
              <div class="card">

                <div class="card-header">
                <div class="container mx-3" style="margin-bottom: -1%;">
                  <div class="row">
                      <div class="col d-flex justify-content-between mt-2 ">
                          <div style="margin-left: -20px;">
                            <h3>More Information</h3>
                          </div>
                          <div style="border: none; background: none; margin-right:1%; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#editEventDetails">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                          </div>
                      </div>
                  </div>
              </div>    
            </div>    
 
                <div class="card-body">
                  <div class="datagrid">
                    <div class="datagrid-item">
                      <div class="datagrid-title">NAME</div>
                      <div id="event_name" class="datagrid-content"></div>
                    </div>
                    <div class="datagrid-item">
                      <div class="datagrid-title">Event duration</div>
                      <div class="datagrid-content" id="event_duration"></div>
                    </div>
                    <div class="datagrid-item">
                      <div class="datagrid-title">START DATE & TIME</div>
                      <div class="datagrid-content" id="event_start"></div>
                    </div>
                    <div class="datagrid-item">
                      <div class="datagrid-title">END DATE & TIME</div>
                      <div class="datagrid-content" id="event_end"></div>
                    </div>
                    <div class="datagrid-item">
                      <div class="datagrid-title">Creator</div>
                      <div class="datagrid-content">
                        <div  class="d-flex align-items-center">
                          <span  class="avatar avatar-xs me-2 rounded" style="background-image: url({{asset('./static/icon.jpg')}})"></span>
                           <span id="admin_name"></span>
                        </div>
                      </div>
                    </div>
                    <div class="datagrid-item">
                      <div class="datagrid-title">Date Created</div>
                      <div class="datagrid-content" id="event_created"></div>
                    </div>
                    <div class="datagrid-item">
                      <div class="datagrid-title">Facilitators</div>
                      <div class="datagrid-content" id="event_facilitator"></div>
                    </div>
                    <div class="datagrid-item">
                      <div class="datagrid-title">Description</div>
                      <div id="event_description" class="datagrid-content">
                        
                      </div>
                    </div>

                    
                    </div>
                
                  </div>
                </div>
              

                <div class="col-auto w-100 mt-4 d-flex justify-content-between align-items-center">
                <h3> Event Programme</h3>      
                 <div class="d-flex gap-4">
                  <button class="btn btn-primary " type="button" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-upload">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                    <path d="M7 9l5 -5l5 5" />
                    <path d="M12 4l0 12" />
                  </svg> Upload Event Programme </button>       
                  <button class="btn btn-primary " type="button" id="downloadAllBtn"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-download">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                    <path d="M7 11l5 5l5 -5" />
                    <path d="M12 4l0 12" />
                  </svg>  Download All </button>       
                 </div>
                </div>

           
                  {{-- event program download --}}
                  <div class="row row-cols-4 g-3 mx-3">
                    <div class="col mb-3" style="position: relative;">
                      <a class="image-link" data-fslightbox="gallery" href="{{asset('./static/icon.jpg')}}">
                        <div class="img-responsive img-responsive-1x1 rounded border" style="background-image: url({{asset('./static/icon.jpg')}})"></div>
                      </a>
                      <button class="downloadBtn" type="button" value="{{asset('./static/icon.jpg')}}" style="position: absolute; bottom: 2px; right: 6px; z-index: 1; background-color: transparent; border: none; padding: 5px;">
                        <i>
                          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-download">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                            <path d="M7 11l5 5l5 -5" />
                            <path d="M12 4l0 12" />
                          </svg>
                        </i>
                      </button>
                    </div>
                    <div class="col mb-3" style="position: relative;">
                      <a class="image-link" data-fslightbox="gallery" href="{{asset('./static/sgmis.png')}}">
                        <div class="img-responsive img-responsive-1x1 rounded border" style="background-image: url({{asset('./static/sgmis.png')}})"></div>
                      </a>
                      <button class="downloadBtn" type="button" value="{{asset('./static/sgmis.png')}}" style="position: absolute; bottom: 2px; right: 6px; z-index: 1; background-color: transparent; border: none; padding: 5px;">
                        <i>
                          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-download">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                            <path d="M7 11l5 5l5 -5" />
                            <path d="M12 4l0 12" />
                          </svg>
                        </i>
                      </button>
                    </div>
                  </div>


              </div>

              <div class="card mt-2">
                <div class="card-header">
                  <h3 class="card-title">Participating Departments</h3>
                </div>
              <div class="row row-cards ">

              {{-- DEPARTMENT #1 --}}
                <div class="col-sm-6 col-lg-4">
                  <div class="card card-sm">
                    <div class="custom-dropdown dropup">
                    <a href="#" class="d-block"><img src="{{asset('./static/icon.jpg')}}" class="card-img-top"></a>
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <button class="" type="button" id="dropdownMenuButton" aria-expanded="false" style="border: none; background:none;">
                              College of Arts and Sciences
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="#">Bachelor of Arts in Social Science</a></li>
                                <li><a class="dropdown-item" href="#">Bachelor of Science in Psychology</a></li>

                            </ul>
                            <div class="ms-auto">
                                <a href="#" class="text-muted">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                                    467
                                </a>
                                <a href="#" class="ms-3 text-muted">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/heart -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" /></svg>
                                    67
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>

          {{-- DEPARTMENT #2 --}}          
          <div class="col-sm-6 col-lg-4">
            <div class="card card-sm">
              <div class="custom-dropdown dropup">
              <a href="#" class="d-block"><img src="{{asset('./static/icon.jpg')}}" class="card-img-top"></a>
              <div class="card-body">
                  <div class="d-flex align-items-center">
                      <button class="" type="button" id="dropdownMenuButton" aria-expanded="false" style="border: none; background:none;">
                          College of Engineering
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <li><a class="dropdown-item" href="#">Bachelor of Science in Civil Engineering</a></li>

                      </ul>
                      <div class="ms-auto">
                          <a href="#" class="text-muted">
                              <!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                              467
                          </a>
                          <a href="#" class="ms-3 text-muted">
                              <!-- Download SVG icon from http://tabler-icons.io/i/heart -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" /></svg>
                              67
                          </a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>

    {{-- DEPARTMENT #3 --}}
    <div class="col-sm-6 col-lg-4">
      <div class="card card-sm">
        <div class="custom-dropdown dropup">
        <a href="#" class="d-block"><img src="{{asset('./static/icon.jpg')}}" class="card-img-top"></a>
        <div class="card-body">
            <div class="d-flex align-items-center">
                <button class="" type="button" id="dropdownMenuButton" aria-expanded="false" style="border: none; background:none;">
                    College of Education
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="#">Bachelor of Physical Education</a></li>
                    <li><a class="dropdown-item" href="#">Bachelor of Early Childhood Education </a></li>
                    <li><a class="dropdown-item" href="#">Bachelor of Elementary Education</a></li>

                </ul>
                <div class="ms-auto">
                    <a href="#" class="text-muted">
                        <!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                        467
                    </a>
                    <a href="#" class="ms-3 text-muted">
                        <!-- Download SVG icon from http://tabler-icons.io/i/heart -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" /></svg>
                        67
                    </a>
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
     </div>
    </div>

    {{-- MODALS --}}

    {{-- edit event details --}}
    <div class="modal modal-blur fade" id="editEventDetails" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header text-white" style="background-color: #3E8A34;">
            <h5 class="modal-title">New Event</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form id="update_event" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="event_id" id="event_id">
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
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Selected Event Photo</h3>
                </div>
                <div class="card-body p-0 d-flex justify-content-center">
                  <img id="event_image" alt="event image" height="200">
                </div>
              </div>
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
                  <label class="form-label">Additional information(Description)   <span style="display: none" id="ev_description_e" class="text-danger ">(Please provide a description)</span></label>
                  <textarea id="ev_description" name="ev_description" class="form-control" rows="2"></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" id="close-button" data-bs-dismiss="modal">Cancel</button>
            <button type="button" onclick="VerifyFormEvent('{{route('updateEventDetails')}}', '{{route('getEventDetails')}}?event_id={{$event_id}}', '{{ asset('event_images/') }}', '{{ route('deleteEvent') }}', '{{ route('EventDetails') }}', 'update')" class="btn btn-primary">Save</button>
          </div>
        </form>
        </div>
      </div>
    </div>

        
    {{-- MODALS --}}

@include('Admin.components.footer')

      </div>
    </div>
    
@include('Admin.components.scripts')
<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Bundle with Popper -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

  <script>
  function limitFiles(event) {
      var files = event.target.files;
      if (files.length > 4) {
        
        alertify.alert("You can only upload up to 4 files.", function(){
          alertify.message('OK');
        });
          event.target.value = '';
      }
  }
  document.getElementById('ev_pic').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const image = document.getElementById('event_image');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            image.src = e.target.result;
        }
        reader.readAsDataURL(file);
    } 
});

    function downloadImage(imageUrl) {
      var imageFileName = imageUrl.split('/').pop(); // Extracting the filename from the URL
      var element = document.createElement('a');
      element.setAttribute('href', imageUrl);
      element.setAttribute('download', imageFileName);
      document.body.appendChild(element);
      element.click();
      document.body.removeChild(element);
    }

    document.querySelectorAll(".downloadBtn").forEach(function(btn) {
      btn.addEventListener("click", function () {
        var imageUrl = this.value;
        downloadImage(imageUrl);
      }, false);
    });

    document.getElementById("downloadAllBtn").addEventListener("click", function () {
      document.querySelectorAll(".image-link").forEach(function(link) {
        var imageUrl = link.getAttribute("href");
        downloadImage(imageUrl);
      });
    }, false);

    window.onload = () => {
      EventDetailsLoad("{{route('getEventDetails')}}?event_id={{$event_id}}", "{{ asset('event_images/') }}");
    }
    
  </script>

  </body>
</html>