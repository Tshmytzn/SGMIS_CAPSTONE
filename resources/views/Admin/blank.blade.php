<!doctype html>

<html lang="en">
  
@include('Admin.components.header')

  <body >
    <script src="{{asset('./dist/js/demo-theme.min.js?1684106062')}}"></script>

    <div class="page">

@include('Admin.components.nav')

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
              

            </div>
          </div>
        </div>

@include('Admin.components.footer')

      </div>
    </div>
    
    
@include('Admin.components.scripts')

  </body>
</html>