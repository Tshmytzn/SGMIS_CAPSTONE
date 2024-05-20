<!doctype html>

<html lang="en">
    
<link href="./dist/libs/dropzone/dist/dropzone.css?1684106062" rel="stylesheet"/>
@include('Admin.components.header', ['title' => 'Compendium'])

  <body >
    <script src="{{asset('./dist/js/demo-theme.min.js?1684106062')}}"></script>

    <div class="page">

@include('Admin.components.nav', ['active' => ''])

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
                  Compendium Name
                </h2>
              </div>
              

            </div>
          </div>
        </div>
        
        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">
            <div class="row row-deck row-cards">
              
                <div class="col-lg-12" >
                    <div class="card" >
                      <div class="card-body">
                        <h3 class="card-title">Multiple File Upload</h3>
                        <form class="dropzone" id="dropzone-multiple" action="./" autocomplete="off" novalidate>
                          <div class="fallback">
                            <input name="file" type="file"  multiple  />
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>

            </div>
          </div>
        </div>

@include('Admin.components.footer')

      </div>
    </div>
    
<script src="{{asset('./dist/libs/dropzone/dist/dropzone-min.js?1684106062')}}" defer></script>
@include('Admin.components.scripts')

<script>
    // @formatter:off
    document.addEventListener("DOMContentLoaded", function() {
      new Dropzone("#dropzone-default")
    })
  </script>
  <script>
    // @formatter:off
    document.addEventListener("DOMContentLoaded", function() {
      new Dropzone("#dropzone-multiple")
    })
  </script>
  <script>
    // @formatter:off
    document.addEventListener("DOMContentLoaded", function() {
      new Dropzone("#dropzone-custom")
    })
  </script>

  </body>
</html>