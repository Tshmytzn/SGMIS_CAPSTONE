<!doctype html>

<html lang="en">

@include('Student.components.head',['title' => 'Dashboard'])
@include('Student.components.header')
@include('Student.components.nav')

  <body >

    <div class="page">
      <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <h2 class="page-title">
                  Dashboard
                </h2>
              </div>
              <div class="col-md-6">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Event Name</h3>
                    <div class="card-actions">
                      <a href="#" class="btn btn-primary">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-timeline"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 16l6 -7l5 5l5 -6" /><path d="M15 14m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M10 9m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M4 16m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M20 8m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /></svg>                        Time in
                      </a>
                    </div>
                  </div>
                  <div class="card-body p-0">
                    <img src="{{asset('./static/sgmis_si.png')}}" alt="event photo" class="">
                      <line x1="0" y1="0" x2="400" y2="200"></line>
                      <line x1="0" y1="200" x2="400" y2="0"></line>
                    </svg>
                  </div>
                </div>
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
