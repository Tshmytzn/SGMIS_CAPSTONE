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
           
              <div class="form-label">Department   <span style="display: none" id="dept_e" class="text-danger ">(Please Select a department....)</span></div>
              <select id="dept" name="dept" class="form-select" >
                @php
                    $dept = App\Models\Department::where('dept_status', 0)->get();
                @endphp
                <option value="none" selected disabled>-----Select Department-----</option>
               @foreach ($dept as $d)
               <option value="{{$d->dept_id}}">{{$d->dept_name}}</option>
               @endforeach
        
              </select>
         
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
            <button type="button" onclick="VerifyFormEvent('{{route('saveEvent')}}', '{{ route('getEvent') }}', '{{ asset('event_images/') }}', '{{ route('deleteEvent') }}', '{{ route('EventDetails') }}')" class="btn btn-primary">Save</button>
          </div>
        </form>
        </div>
      </div>
    </div>
    
@include('Admin.components.scripts')


<script>
  window.onload = function(){
    LoadEvents("{{ route('getAllEvent') }}", "{{ asset('event_images/') }}", "{{ route('deleteEvent') }}", "{{ route('EventDetails') }}");
  }

</script>
  </body>
</html>