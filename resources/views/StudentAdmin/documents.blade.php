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
  
                      <button class="btn" style="background-color: #DF7026; color: white;" data-bs-toggle="modal" data-bs-target="#uploadcomp"> Create Document</button>
      
              </div>
            </div>

            </div>
          </div>
        </div>
        
        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">
              @include('Admin.components.lineLoading',['loadID' => 'lineLoading'])
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
                <h5 class="modal-title" id="staticBackdropLabel">Create Document</h5>
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
                          $event = App\Models\SchoolEvents::All();
                      @endphp

                      @foreach ($event as $eve)
                         <option value="{{$eve->event_id}}">{{$eve->event_name}}</option>
                      @endforeach
                     
                    </select>
                  </div>
                </div>

                <div class="row g-2">
                  <div class="col-12">
                    <label for="firstname" class="form-label">Document Name</label>
                    <input type="text" class="form-control" name="compendiumname" id="compendiumname" placeholder="Document Name">
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
<script>
   function AddCompendium() {
        document.getElementById('adminloader').style.display = '';
        var formData = $("form#uploadcompform").serialize();
        $.ajax({
            type: "POST",
            url: "{{ route('AddCompendium') }}",
            data: formData,
            success: function(response) {
                if (response.status == 'success') {
                    document.getElementById('adminloader').style.display = 'none';
                    closeModal();
                    GetAllCompendium();
                    // GetAllStudentAdminData();

                    alertify
                        .alert("Message", " Document Successfully Added", function() {

                            alertify.message('OK');
                            clearFormInputs('uploadcompform');
                            // reloadElementById('editsectionform');

                        });
                } else if (response.status == 'exist') {
                    document.getElementById('adminloader').style.display = 'none';
                    alertify
                        .alert("Alert", "Compendium Already Exist", function() {
                            alertify.message('OK');
                        });
                } else if (response.status == 'empty') {
                    document.getElementById('adminloader').style.display = 'none';
                    alertify
                        .alert("Warning", "Insert Compendium Name First!", function() {
                            alertify.message('OK');
                        });
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
    function closeModal() {
        var modalElements = document.getElementsByClassName('modal');
        for (var i = 0; i < modalElements.length; i++) {
            if (modalElements[i].classList.contains('show')) {
                var closeButton = modalElements[i].querySelector('[data-bs-dismiss="modal"]');
                if (closeButton) {
                    closeButton.click();
                }
            }
        }
    }
    function clearFormInputs(formId) {
        var form = document.getElementById(formId);
        var inputs = form.getElementsByTagName('input');
        for (var i = 0; i < inputs.length; i++) {
            // Check if the input type is not 'hidden' and its name is not '_token'
            if (inputs[i].type !== 'hidden' && inputs[i].name !== '_token') {
                inputs[i].value = '';
            }
        }
        var textareas = form.getElementsByTagName('textarea');
        for (var i = 0; i < textareas.length; i++) {
            textareas[i].value = '';
        }

    }
    function GetAllCompendium() {
      document.getElementById('lineLoading').style.display = '';
    $.ajax({
        type: "GET",
        url: "{{ route('GetAllCompendium') }}",
        success: function(response) {
          
            // Check if the response is empty
            document.getElementById('lineLoading').style.display = 'none';
            if (response.data.length === 0) {
                // Display the 'Feature Coming Soon' message
                document.getElementById("eventsContainer").innerHTML = `
                    <div class="page-body">
                        <div class="container-xl d-flex flex-column justify-content-center">
                            <div class="empty">
                                <div class="empty-img"><img src="./static/illustrations/undraw_add_files_re_v09g.svg" height="128" alt="">
                                </div>
                                <p class="empty-title">No Document Found!</p>
                                <p class="empty-subtitle text-muted">
                                    No files have been uploaded yet. Please upload the necessary files to proceed. Thank you for your understanding.
                                   </p>
                                <div class="empty-action">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#uploadcomp" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                                        Add Document
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            } else {
                // Clear the container
                document.getElementById("eventsContainer").innerHTML = "";

                // Iterate over each event in the response
                response.data.forEach(function(event) {
                    var div = document.createElement("div");
                    div.setAttribute("class", "col-md-3 col-sm-4 animate__animated animate__zoomIn");

                    div.innerHTML = `
                        <div class="card card-link card-link-pop folder ">
                            <div class="ribbon ribbon-top bg-yellow">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-pinned"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 4v6l-2 4v2h10v-2l-2 -4v-6" /><path d="M12 16l0 5" /><path d="M8 4l8 0" /></svg>
                            </div>
                            <div class="card-body">
                              <div class="container">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4 class="card-title">${event.event_name}</h4>
                                        </div>
                                        <div class="col-md-6">
                                          <h4 class="card-title">#${event.random_id}</h4>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                                <h3>${event.com_name}</h3>
                                <p class="text-muted">${event.event_description}</p>
                            </div>
                            <!-- Card footer -->
                            <div class="card-footer">
                                <a href="{{ route('ViewCompendium') }}?com_id=${event.com_id}" class="btn btn-primary mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-files">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M15 3v4a1 1 0 0 0 1 1h4" />
                                        <path d="M18 17h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h4l5 5v7a2 2 0 0 1 -2 2z" />
                                        <path d="M16 17v2a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h2" />
                                    </svg>
                                    View Files
                                </a>
                            </div>
                        </div>
                    `;

                    // Append the new event card to the container
                    document.getElementById("eventsContainer").appendChild(div);
                });
            }
        }
    });
}
    $(document).ready(function() {
        GetAllCompendium();
 
});
</script>
  </body>
</html>