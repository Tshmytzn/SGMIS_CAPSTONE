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
              

            </div>
          </div>
        </div>
        
        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">
            <div class="row row-deck row-cards">
              
              <div class="col-md-3 col-sm-4">
                <div class="card">
                  <div class="ribbon ribbon-top bg-yellow">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-pinned"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 4v6l-2 4v2h10v-2l-2 -4v-6" /><path d="M12 16l0 5" /><path d="M8 4l8 0" /></svg>                  </div>
                  <div class="card-body">
                    <h3 class="card-title">University Week</h3>
                    <p class="text-muted">short desc short desc short desc short desc short desc short descshort desc short desc short desc short desc short</p>
                  </div>
                  <!-- Card footer -->
                  <div class="card-footer">
                    <a href="#" class="btn btn-primary">View Files</a>
                  </div>
                </div>
              </div>
              

            </div>
          </div>
        </div>

@include('Admin.components.footer')

      </div>
    </div>
    
    
@include('Admin.components.scripts')

  </body>
</html>