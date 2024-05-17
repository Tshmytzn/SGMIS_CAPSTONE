<!doctype html>

<html lang="en">
  
@include('Admin.components.header', ['title' => 'Documents'])

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
  
                      <button class="btn" style="background-color: #DF7026; color: white;" data-bs-toggle="modal" data-bs-target="#uploadcomp"> Upload Compendium</button>
      
              </div>
            </div>

            </div>
          </div>
        </div>
        
        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">
            <div class="row row-deck row-cards">
              
              <div class="col-md-3 col-sm-4">
                <div class="card card-link card-link-pop folder">
                  <div class="ribbon ribbon-top bg-yellow">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-hand-click"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 13v-8.5a1.5 1.5 0 0 1 3 0v7.5" /><path d="M11 11.5v-2a1.5 1.5 0 0 1 3 0v2.5" /><path d="M14 10.5a1.5 1.5 0 0 1 3 0v1.5" /><path d="M17 11.5a1.5 1.5 0 0 1 3 0v4.5a6 6 0 0 1 -6 6h-2h.208a6 6 0 0 1 -5.012 -2.7l-.196 -.3c-.312 -.479 -1.407 -2.388 -3.286 -5.728a1.5 1.5 0 0 1 .536 -2.022a1.867 1.867 0 0 1 2.28 .28l1.47 1.47" /><path d="M5 3l-1 -1" /><path d="M4 7h-1" /><path d="M14 3l1 -1" /><path d="M15 6h1" /></svg>                  
                  </div>
                  <div class="card-body">
                    <h3 class="card-title">University Week</h3>
                    <p class="text-muted">short desc short desc short desc short desc short desc short descshort desc short desc short desc short desc short</p>
                  </div>
                  <!-- Card footer -->
                  <div class="card-footer">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#viewfiles" class="btn btn-primary mb-2">
                      <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-files"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 3v4a1 1 0 0 0 1 1h4" /><path d="M18 17h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h4l5 5v7a2 2 0 0 1 -2 2z" /><path d="M16 17v2a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h2" /></svg>
                      View Files</a>
                  </div>
                </div>
              </div>
              

            </div>
          </div>
        </div>

  {{-- MODALS --}}
        {{-- Upload Compedium Modal --}}
        <div class="modal modal-blur fade" id="uploadcomp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header text-white" style="background-color: #3E8A34;">
                <h5 class="modal-title" id="staticBackdropLabel">Upload Compendium</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                
                <form class="row g-3" id="uploadcomp" method="POST" enctype="multipart/form-data">@csrf
                  <div class="row g-2">

                  <div class="col-12">
                    <label for="firstname" class="form-label">Event Name</label>
                    <select name="" class="form-select" id="">
                      <option selected>Select Event</option>
                      <option value="">event #1</option>
                      <option value="">event #1</option>
                      <option value="">event #1</option>
                    </select>
                  </div>
                </div>

                <div class="row g-2">
                  <div class="col-12">
                    <label for="firstname" class="form-label">Event Compendium</label>
                    <input type="file" class="form-control" name="eventcompendium" id="eventcompendium" placeholder="Event Compendium" multiple>
                  </div>
                  <div class="col-12">
                    <label for="firstname" class="form-label">Compendium Name</label>
                    <input type="text" class="form-control" name="compendiumname" id="compendiumname" placeholder="Compendium Name">
                  </div>
                </div>
                </form>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="()">Save</button>
              </div>
            </div>
          </div>
        </div>
        {{-- Upload Compedium Modal --}}

        {{-- view files modal --}}
        <div class="modal modal-blur fade" id="viewfiles" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header text-white" style="background-color: #3E8A34;">
                <h5 class="modal-title" id="staticBackdropLabel">View Event Compendium</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="container">
                    <div class="row g-2">
                        <div class="col-md-4">
                            <label for=""> File name</label>
                            <img src="{{asset('./static/avatars/002m.jpg')}}" class="img-thumbnail" alt="Image 1">
                        </div>
                        <div class="col-md-4">
                          <label for=""> File name</label>
                            <img src="{{asset('./static/avatars/002m.jpg')}}" class="img-thumbnail" alt="Image 2">
                        </div>
                        <div class="col-md-4">
                            <label for=""> File name</label>
                            <img src="{{asset('./static/avatars/002m.jpg')}}" class="img-thumbnail" alt="Image 3">
                        </div>
                        <div class="col-md-4">
                           <label for=""> File name</label>
                            <img src="{{asset('./static/avatars/002m.jpg')}}" class="img-thumbnail" alt="Image 4">
                        </div>
                        <div class="col-md-4">
                          <label for=""> File name</label>
                            <img src="{{asset('./static/avatars/002m.jpg')}}" class="img-thumbnail" alt="Image 5">
                        </div>
                        <div class="col-md-4">
                          <label for=""> File name</label>
                            <img src="{{asset('./static/avatars/002m.jpg')}}" class="img-thumbnail" alt="Image 6">
                        </div>
                        <div class="col-md-4">
                          <label for=""> File name</label>
                            <img src="{{asset('./static/avatars/002m.jpg')}}" class="img-thumbnail" alt="Image 7">
                        </div>
                        <div class="col-md-4">
                          <label for=""> File name</label>
                            <img src="{{asset('./static/avatars/002m.jpg')}}" class="img-thumbnail" alt="Image 8">
                        </div>
                        <div class="col-md-4">
                          <label for=""> File name</label>
                            <img src="{{asset('./static/avatars/002m.jpg')}}" class="img-thumbnail" alt="Image 9">
                        </div>
                    </div>
                </div>
            </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Done</button>
              </div>
            </div>
          </div>
        </div>
        {{-- view files modal --}}

  {{-- MODALS --}}

@include('Admin.components.footer')

      </div>
    </div>
    
    
@include('Admin.components.scripts')

  </body>
</html>