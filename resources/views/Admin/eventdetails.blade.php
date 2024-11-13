<!doctype html>

<html lang="en">

@include('Admin.components.header', ['title' => 'Event Details'])
<link href="{{asset('./dist/libs/dropzone/dist/dropzone.css?1684106062')}}" rel="stylesheet"/>
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
    @php
                                            $admin = App\Models\Admin::where('admin_id', session('admin_id'))->first();
                                            $usertype = '';
                                        @endphp
                                        @php
                                         $studentacc = App\Models\StudentAccounts::where('student_id', session('admin_id'))->first();
                                         if ($studentacc) {
                                          $usertype = $studentacc->student_position;
                                         }
                                        @endphp
    <div class="page">

@include('Admin.components.nav', ['active' => 'Event Details'])

@include('Admin.components.loading')
            <div class="page-wrapper">

        <!-- Page header -->
        <div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col d-flex justify-content-between w-100">
                <!-- Page pre-title -->
               <div>
                <div class="page-pretitle">
                    Overview
                  </div>
                  <h1 class="page-title">
                    Event Details
                  </h1>
                </div>

                <button onclick="publishEvent('{{ $event_id }}', this)" id="publishEventBtn" class="btn btn-primary d-none"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-mood-happy">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                    <path d="M9 9l.01 0" />
                    <path d="M15 9l.01 0" />
                    <path d="M8 13a4 4 0 1 0 8 0h-8" />
                  </svg> Publish Event </button>

               </div>

        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">
              <div class="card">

                <div class="card-header">
                <div class="container mx-3" style="margin-bottom: -1%;">
                  <div class="row">
                      <div class="col d-flex justify-content-between mt-2 ">
                            <h3 style="margin-left: -3%">More Information</h3>

                            <div title="Edit Event" style="border: none; background: none; margin-right:1%; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#editEventDetails">
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

                <div class="card mt-2">
                <div class="table-responsive mt-4">
                  <div class="d-flex align-items-center justify-content-between mb-2">
                    <h3 class="ms-4">Activity List</h1>
                    <button  data-bs-toggle="modal" data-bs-target="#addActivity" class="btn btn-primary me-2"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                      <path d="M12 5l0 14" />
                      <path d="M5 12l14 0" />
                    </svg>Add Activities</button>
                  </div>
                  <hr class="mt-0">
                  <table class="table table-vcenter card-table">
                    <thead>
                      <tr>
                        <th>Activity Name</th>
                        <th>Description</th>
                        <th>Venue</th>
                        <th>Facilitator</th>
                        <th>Date</th>
                        <th>Start</th>
                        <th>End</th>
                        <th class="w-1">Action</th>
                      </tr>
                    </thead>
                    <tbody id="act_list">
                      <tr id="loading-act">
                      <td colspan="8" class="text-center">
                        <div class="text-muted mb-3">Loading Activities</div>
                        <div class="progress progress-sm ">
                          <div class="progress-bar progress-bar-indeterminate"></div>
                        </div>
                      </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
            </div>

            <div class="card mt-2">
                <div class="col-auto w-100 mt-4 d-flex justify-content-between align-items-center">
                <h3 class="ms-4"> Event Programme</h3>
                 <div class="d-flex gap-3 me-2 mb-2">
                  <button data-bs-toggle="modal" data-bs-target="#uploadProgrammeModal" class="btn btn-primary " type="button" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-upload">
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
                <hr class="mt-0">

                  {{-- event program download --}}
                  <div class="row row-cols-4 g-3 mx-3 mt-4" id="programme_list">

                    <div class="page page-center w-100  mt-4" id="loading-programme">
                      <div class="container container-slim py-4">
                        <div class="text-center">
                          <div class="mb-3">
                            <a href="." class="navbar-brand navbar-brand-autodark"><img src="{{ asset('./static/logoicon.png') }}" height="50" alt=""></a>
                          </div>
                          <div class="text-muted mb-3">Loading Programme</div>
                          <div class="progress progress-sm">
                            <div class="progress-bar progress-bar-indeterminate"></div>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>



              <div class="card mt-2">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h3 class="card-title">Participating Departments</h3>
                  <select type="text"  class="form-select w-50" placeholder="Select tags" id="select-tags" value="" multiple>
                   @php
                       $dept = App\Models\Department::all();
                   @endphp
                   @foreach ($dept as $d)
                   @php
                       $eventDept = App\Models\EventDepartment::where('dept_id', $d->dept_id)->where('event_id', $event_id)->first();
                   @endphp
                   <option {{ $eventDept ? 'selected' : '' }} value="{{ $d->dept_id }}">{{ $d->dept_name }}</option>
                   @endforeach
                  </select>

                </div>
              <div class="row row-cards" id="event_department_list">

                <div class="page page-center mt-4" id="loading-dept">
                  <div class="container container-slim py-4">
                    <div class="text-center">
                      <div class="mb-3">
                        <a href="." class="navbar-brand navbar-brand-autodark"><img src="{{ asset('./static/logoicon.png') }}" height="50" alt=""></a>
                      </div>
                      <div class="text-muted mb-3">Loading Departments</div>
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
    </div>

    <div class="modal modal-blur fade" id="viewAct" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Activity</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="card">
                <div class="card-body">
                  <div class="datagrid">
                    <div class="datagrid-item">
                      <div class="datagrid-title">Activity Name</div>
                      <div class="datagrid-content" id="act_name_view"></div>
                    </div>
                    <div class="datagrid-item">
                      <div class="datagrid-title">Facilitator</div>
                      <div class="datagrid-content" id="act_fac_view"></div>
                    </div>
                    <div class="datagrid-item">
                      <div class="datagrid-title">Venue</div>
                      <div class="datagrid-content" id="act_venue_view"></div>
                    </div>
                    <div class="datagrid-item">
                      <div class="datagrid-title">Date & Time</div>
                      <div class="datagrid-content" id="act_date_time_view"></div>
                    </div>
                    <div class="datagrid-item">
                      <div class="datagrid-title">Description</div>
                      <div class="datagrid-content" id="act_description_view">

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal modal-blur fade" id="editAct" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Activity <span id="editActTitle"></span></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editActForm" method="POST">
              @csrf
              <input type="hidden" name="act_id" id="act_id_edit">
            <div class="modal-body">
              <div class="mb-3">
                <label class="form-label">Activity Name <span id="act_name_e_edit" style="display: none" class="text-danger">(Don't Leave this field blank)</span></label>
                <input type="text" class="form-control" id="act_name_edit" name="act_name" placeholder="Activity Name">
              </div>

              <div class="row">
                <div class="col-lg-12">
                  <div class="mb-1">
                    <label class="form-label">Facilitator Name <span id="act_fac_e_edit" style="display: none" class="text-danger">(Don't Leave this field blank)</span></label>
                    <input type="text" class="form-control" id="act_fac_edit" name="act_fac" placeholder="Facilitator Name">
                  </div>
                </div>
                  <div class="col-lg-12">
                <div class="mb-1">
                  <label class="form-label">Activity Venue <span id="act_venue_e_edit" style="display: none" class="text-danger">(Don't Leave this field blank)</span></label>
                  <div class="row">
                  <div class="col-9">
                    <input type="text" class="form-control" id="act_venue3" name="act_venue" placeholder="Venue" hidden>
                    <input type="text" class="form-control" id="act_venue4" name="act_venue2" placeholder="Venue" readonly>
                  </div>
                  <div class="col-3"><button class="btn btn-primary" type="button" id="mapModal" data-bs-toggle="modal" data-bs-target="#eventSettings" onclick="GetVenue('update')">Select Venue</button></div>
                  </div>
                </div>
              </div>
              </div>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-12">
                  <div class="mb-3">
                    <label class="form-label">Date <span id="act_date_e_edit" style="display: none" class="text-danger">(Don't Leave this field blank)</span></label>
                    <input type="date" id="act_date_edit" name="act_date"class="form-control">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="mb-3">
                    <label class="form-label">Start Time <span id="act_time_e_edit" style="display: none" class="text-danger">(Don't Leave this field blank)</span></label>
                    <input type="time" id="act_time_edit" name="act_time" class="form-control">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="mb-3">
                    <label class="form-label">End Time <span id="act_end_e_edit" style="display: none" class="text-danger">(Don't Leave this field blank)</span></label>
                    <input type="time" id="act_end_edit" name="act_end" class="form-control">
                  </div>
                </div>
                <div class="col-lg-12">
                  <div>
                    <label class="form-label">Activity Description <span id="act_description_e_edit" style="display: none" class="text-danger">(Don't Leave this field blank)</span></label>
                    <textarea class="form-control" id="act_description_edit" name="act_description" rows="3"></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" id="close-button-act_edit" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                Cancel
              </button>
              <button type="button" onclick="VerifyEditEventActivity('{{route('updateEventActivities')}}', '{{route('getActDetails')}}', '{{route('deleteEventActivities')}}')" class="btn btn-primary ms-auto">

                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                Update Activity
              </button>
            </div>
          </form>
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


    <div class="modal modal-blur fade" id="addActivity" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">New Activity</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form id="addActForm" method="POST">
            @csrf
            <input type="hidden" name="event_id" id="event_id_act">
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Activity Name <span id="act_name_e" style="display: none" class="text-danger">(Don't Leave this field blank)</span></label>
              <input type="text" class="form-control" id="act_name" name="act_name" placeholder="Activity Name">
            </div>

            <div class="row">
              <div class="col-lg-12">
                <div class="mb-1">
                  <label class="form-label">Facilitator Name <span id="act_fac_e" style="display: none" class="text-danger">(Don't Leave this field blank)</span></label>
                  <input type="text" class="form-control" id="act_fac" name="act_fac" placeholder="Facilitator Name">
                </div>
              </div>
              <div class="col-lg-12">
                <div class="mb-1">
                  <label class="form-label">Activity Venue <span id="act_venue_e" style="display: none" class="text-danger">(Don't Leave this field blank)</span></label>
                  <div class="row">
                  <div class="col-9">
                    <input type="text" class="form-control" id="act_venue" name="act_venue" placeholder="Venue" hidden>
                    <input type="text" class="form-control" id="act_venue2" name="act_venue2" placeholder="Venue" readonly>
                  </div>
                  <div class="col-3"><button class="btn btn-primary" type="button" id="mapModal" data-bs-toggle="modal" data-bs-target="#eventSettings" onclick="GetVenue('add')">Select Venue</button></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="mb-3">
                  <label class="form-label">Date <span id="act_date_e" style="display: none" class="text-danger">(Don't Leave this field blank)</span></label>
                  <input type="date" id="act_date" name="act_date"class="form-control">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Start Time <span id="act_time_e" style="display: none" class="text-danger">(Don't Leave this field blank)</span></label>
                  <input type="time" id="act_time" name="act_time" class="form-control">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">End Time <span id="end_act_time_e" style="display: none" class="text-danger">(Don't Leave this field blank)</span></label>
                  <input type="time" id="end_act_time" name="end_act_time" class="form-control">
                </div>
              </div>
              <div class="col-lg-12">
                <div>
                  <label class="form-label">Activity Description <span id="act_description_e" style="display: none" class="text-danger">(Don't Leave this field blank)</span></label>
                  <textarea class="form-control" id="act_description" name="act_description" rows="3"></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" id="close-button-act" class="btn btn-link link-secondary" data-bs-dismiss="modal">
              Cancel
            </button>
            <button type="button" onclick="VerifyAddEventActivity('{{ route('addEventActivity') }}', '{{ route('deleteEventActivities') }}', '{{ route('getActDetails') }}')" class="btn btn-primary ms-auto">

              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
              Create new activity
            </button>
          </div>
        </form>
        </div>
      </div>
    </div>

    <div class="modal modal-blur fade" id="uploadProgrammeModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add Programme Images</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="card">
              <div class="card-body">
                <h3 class="card-title">You can add multiple Images</h3>
                <form class="dropzone" method="POST" id="dropzone-default" enctype="multipart/form-data" action="{{ route('uploadProgrammeImages') }}" autocomplete="off" novalidate>
                  @csrf
                  <div class="fallback">
                    <input name="programmeImages" type="file"  />
                  </div>
                  <input type="hidden" name="event_id" value="{{ $event_id }}">
                </form>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    @include('Admin.components.layout.map')
    {{-- MODALS --}}


    {{-- Delete Activity Form --}}
    <form method="POST" id="deleteActEvent">
      @csrf
      <input type="hidden" name="act_id" id="delete_act_id">
    </form>

    <form method="POST" id="publishEventForm">
        @csrf
        <input type="hidden" id="publishEventId" name="eventId">
    </form>

    <input type="hidden" id="publishStatusHolder">

    {{-- Other Forms --}}
<input type="hidden" value="{{ route('AddDeptEvent') }}" id="addDeptRoute">
<input type="hidden" value="{{ route('RemoveDeptEvent') }}" id="removeDeptRoute">
<input type="hidden" value="{{ asset('dept_image/') }}" id="imageRouteDept">
<input type="hidden" value="{{ $event_id }}" id="event_id_delete_programme">
<input type="hidden" value="{{ route('removeProgramme') }}" id="removeRouteProgramme">
<input type="hidden" value="{{ asset('programme_images/') }}" id="imageProgramme">
<input type="hidden" value="{{asset('static/illustrations/undraw_joyride_hnno.svg')}}" id="empty_programme_empty_asset">
<input type="hidden" value="{{ asset('./static/illustrations/undraw_quitting_time_dm8t.svg') }}" id="emptyImage">
<form id="deptForm" method="POST">@csrf <input type="hidden" name="event_id" id="dept_event_id"> <input type="hidden" name="dept_id" id="selected_dept"></form>
<form id="removeProgrammeForm" method="POST">@csrf
  <input type="hidden" name="event_id" id="event_id_programme_delete">
  <input type="hidden" name="programme_name" id="programme_name_programme_delete">
  </form>
@include('Admin.components.footer')

      </div>
    </div>

@include('Admin.components.scripts')
@include('Admin.components.eventdscript')
<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
<script src="{{asset('./dist/libs/dropzone/dist/dropzone-min.js?1684106062')}}" defer></script>
<!-- Bootstrap Bundle with Popper -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('./dist/libs/tom-select/dist/js/tom-select.base.min.js?1684106062') }}" defer></script>
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
      LoadEventActivities("{{ route('getEventAct') }}?event_id={{ $event_id }}", "{{ route('deleteEventActivities') }}", "{{ route('getActDetails') }}", 'admin');
      LoadDeptEvent("{{ route('GetDeptEvent') }}?event_id={{ $event_id }}", "{{ route('getDepartment') }}", "{{ route('getCourse') }}", "{{ asset('dept_image') }}", "{{ asset('./static/illustrations/undraw_quitting_time_dm8t.svg') }}");
      LoadProgrammeList("{{ route('getProgramme') }}?event_id={{ $event_id }}","{{asset('programme_images')}}", "{{asset('static/illustrations/undraw_joyride_hnno.svg')}}", "{{route('removeProgramme')}}", "admin");
    }

  </script>

  </body>
</html>
