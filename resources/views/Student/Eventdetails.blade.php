<!doctype html>

<html lang="en">

@include('Student.components.head', ['title' => 'Event Details'])
@include('Student.components.header')
@include('Student.components.nav')

  <body >

    <div class="page">
      <div class="page-wrapper" style="margin-top: -3%">
        <!-- Page header -->
        <div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <h2 class="page-title" >
                  Event Name
                </h2>
              </div>
            </div>
          </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">
            <!-- Content here -->
          </div>
        </div>
      </div>
    </div>
    @include('Student.components.footer')
    @include('Student.components.scripts')
  </body>
</html>