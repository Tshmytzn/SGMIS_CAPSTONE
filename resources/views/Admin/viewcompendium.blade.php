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
               @php
              $com_id = request()->query('com_id');
          @endphp
             
             <div class="col-lg-12" style="height: 100vh; display: flex; flex-direction: column;">
              <div class="card" style="flex: 1; display: flex; flex-direction: column;">
                  <div class="card-body" style="flex: 1; display: flex; flex-direction: column;">
                      <h3 class="card-title">Multiple File Upload</h3>
                      <form class="dropzone" id="dropzone-multiple" action="{{ route('UploadCompendiumFile') }}" autocomplete="off" novalidate style="flex: 1; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                          @csrf
                          <input type="hidden" name="com_id" id="com_id" value="{{ $com_id }}">
                          <div class="fallback">
                              <input name="file" type="file" multiple />
                          </div>
                      </form>
                  </div>
              </div>
          </div>

            </div>
          </div>
        </div>
       @if (session('status'))
       <script>
        // Empty the content of #dropzone-multiple
        $("#dropzone-multiple").empty();
        
        // Reload the page after a short delay (e.g., 500 milliseconds)
        
            location.reload();
      
    </script>
        @endif
      
    
@include('Admin.components.footer')

      </div>
    </div>
    

@include('Admin.components.scripts')



  </body>
</html>