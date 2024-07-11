<!doctype html>

<html lang="en">

@include('Student.components.head', ['title' => 'Evaluation Page'])
@include('Student.components.header')
@include('Student.components.nav', ['active' => ''])

  <body >

    <div class="page">
      <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <h2 class="page-title">
                  Empty page
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