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

                <button class="btn" style="background-color: #DF7026; color: white;" data-bs-toggle="modal" data-bs-target="#modal-report"> Create Event</button>
                &nbsp;  <button class="btn" style="background-color: #b9b6b4; color: rgb(61, 61, 61);" data-bs-toggle="modal" data-bs-target="#eventSettings"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-settings"><path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" /><path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                </svg> Settings</button>

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

{{-- modal start --}}
<div class="modal modal-blur fade" id="eventSettings" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update Password</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">


                    <div class="row g-0">
                      <div class="col-3 d-none d-md-block border-end">
                        <div class="card-body">
                          <ul class="nav nav-pills flex-column">
                            <li class="nav-item">
                              <a class="nav-link active" id="my-account-tab" data-bs-toggle="pill" href="#my-account">
                                <h3>My Account</h3>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="administrators-tab" data-bs-toggle="pill" href="#administrators">
                                <h3>Primary Admins</h3>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="studentadmins-tab" data-bs-toggle="pill" href="#studentadmins">
                                <h3>Student Admins</h3>
                              </a>
                            </li>
                          </ul>
                        </div>
                      </div>
                      <div class="col d-flex flex-column">
                        <div class="card-body">
                          <div class="tab-content">
                            <div class="tab-pane fade show active" id="my-account">
                              <!-- Content for My Account tab removed -->
                              <h1>h1</h1>
                            </div>
                            <div class="tab-pane fade" id="administrators">
                              <!-- Content for Primary Admins tab removed -->
                            </div>
                            <div class="tab-pane fade" id="studentadmins">
                              <!-- Content for Student Admins tab removed -->
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>



        </div>
      </div>
    </div>
  </div>
{{-- modal end --}}

@include('Admin.components.scripts')


<script>
  window.onload = function(){
    LoadEvents("{{ route('getAllEvent') }}", "{{ asset('event_images/') }}", "{{ route('deleteEvent') }}", "{{ route('EventDetails') }}",'admin');
  }

</script>
  </body>
</html>
