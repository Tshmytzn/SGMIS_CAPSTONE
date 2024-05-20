<!doctype html>

<html lang="en">
  
@include('Admin.components.header', ['title' => 'Documents'])
@include('Admin.components.adminstyle')

  <body >
    <script src="{{asset('./dist/js/demo-theme.min.js?1684106062')}}"></script>

    <div class="page">

@include('Admin.components.nav', ['active' => 'Documents'])

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
                  Documents
                </h2>
              </div>
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
  
                      <button class="btn" style="background-color: #DF7026; color: white;" data-bs-toggle="modal" data-bs-target="#uploadcomp"> Create Compendium</button>
      
              </div>
            </div>

            </div>
          </div>
        </div>
        
        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">
            <div class="row row-deck row-cards" id="eventsContainer">
              
              {{-- <div class="col-md-3 col-sm-4">
                <div class="card card-link card-link-pop folder">
                  <div class="ribbon ribbon-top bg-yellow">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-pinned"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 4v6l-2 4v2h10v-2l-2 -4v-6" /><path d="M12 16l0 5" /><path d="M8 4l8 0" /></svg>                  </div>
                  <div class="card-body">
                    <h3 class="card-title">Compendium Name</h3>
                    <p class="text-muted"> Event name and event details Event name and event details Event name and event details</p>
                  </div>
                  <!-- Card footer -->
                  <div class="card-footer">
                    <a href="{{route('ViewCompendium')}}" class="btn btn-primary mb-2">
                      <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-files"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 3v4a1 1 0 0 0 1 1h4" /><path d="M18 17h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h4l5 5v7a2 2 0 0 1 -2 2z" /><path d="M16 17v2a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h2" /></svg>
                      View Files</a>
                  </div>
                </div>
              </div> --}}
              

            </div>
          </div>
        </div>

  {{-- MODALS --}}
        {{-- Upload Compedium Modal --}}
        <div class="modal modal-blur fade" id="uploadcomp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header text-white" style="background-color: #3E8A34;">
                <h5 class="modal-title" id="staticBackdropLabel">Create Compendium</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                
                <form class="row g-3" id="uploadcompform" method="POST" enctype="multipart/form-data">@csrf
                  <div class="row g-2">

                  <div class="col-12">
                    <label for="firstname" class="form-label">Event Name</label>
                    <select name="eventId" class="form-select" id="eventId">
                       <option>Select Event</option>
                     @php
                          $currentDate = date('Y-m-d');
                          $event = App\Models\SchoolEvents::where('event_start','>',$currentDate)->get();
                      @endphp

                      @foreach ($event as $eve)
                         <option value="{{$eve->event_id}}">{{$eve->event_name}}</option>
                      @endforeach
                     
                    </select>
                  </div>
                </div>

                <div class="row g-2">
                  <div class="col-12">
                    <label for="firstname" class="form-label">Compendium Name</label>
                    <input type="text" class="form-control" name="compendiumname" id="compendiumname" placeholder="Compendium Name">
                  </div>
                </div>
                </form>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="AddCompendium()">Save</button>
              </div>
            </div>
          </div>
        </div>
        {{-- Upload Compedium Modal --}}


  {{-- MODALS --}}

@include('Admin.components.footer')

      </div>
    </div>
    
    
@include('Admin.components.scripts')
@include('Admin.components.functionscript')

  </body>
</html>