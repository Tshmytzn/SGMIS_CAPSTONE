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
    <div class="row row-cols-6 g-3">
      <div class="col">
        <a data-fslightbox="gallery" href="{{asset('./static/photos/beautiful-blonde-woman-relaxing-with-a-can-of-coke-on-a-tree-stump-by-the-beach.jpg')}}">
          <!-- Photo -->
          <div class="img-responsive img-responsive-1x1 rounded border" style="background-image: url({{asset('./static/photos/beautiful-blonde-woman-relaxing-with-a-can-of-coke-on-a-tree-stump-by-the-beach.jpg')}})"></div>
        </a>
      </div>
      <div class="col">
        <a data-fslightbox="gallery" href="{{asset('./static/photos/brainstorming-session-with-creative-designers.jpg')}}">
          <!-- Photo -->
          <div class="img-responsive img-responsive-1x1 rounded border" style="background-image: url({{asset('./static/photos/brainstorming-session-with-creative-designers.jpg')}})"></div>
        </a>
      </div>
      <div class="col">
        <a data-fslightbox="gallery" href="{{asset('./static/photos/finances-us-dollars-and-bitcoins-currency-money.jpg')}}">
          <!-- Photo -->
          <div class="img-responsive img-responsive-1x1 rounded border" style="background-image: url({{asset('./static/photos/finances-us-dollars-and-bitcoins-currency-money.jpg')}})"></div>
        </a>
      </div>
      <div class="col">
        <a data-fslightbox="gallery" href="{{asset('./static/photos/group-of-people-brainstorming-and-taking-notes-2.jpg')}}">
          <!-- Photo -->
          <div class="img-responsive img-responsive-1x1 rounded border" style="background-image: url({{asset('./static/photos/group-of-people-brainstorming-and-taking-notes-2.jpg')}})"></div>
        </a>
      </div>
      <div class="col">
        <a data-fslightbox="gallery" href="{{asset('./static/photos/blue-sofa-with-pillows-in-a-designer-living-room-interior.jpg')}}">
          <!-- Photo -->
          <div class="img-responsive img-responsive-1x1 rounded border" style="background-image: url({{asset('./static/photos/blue-sofa-with-pillows-in-a-designer-living-room-interior.jpg')}})"></div>
        </a>
      </div>
      <div class="col">
        <a data-fslightbox="gallery" href="{{asset('./static/photos/home-office-desk-with-macbook-iphone-calendar-watch-and-organizer.jpg')}}">
          <!-- Photo -->
          <div class="img-responsive img-responsive-1x1 rounded border" style="background-image: url({{asset('./static/photos/home-office-desk-with-macbook-iphone-calendar-watch-and-organizer.jpg')}})"></div>
        </a>
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