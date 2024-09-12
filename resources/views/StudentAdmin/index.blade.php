<!doctype html>

<html lang="en">
  
@include('Admin.components.header', ['title' => 'Admin Dashboard'])

  <body >
    <script src="{{asset('./dist/js/demo-theme.min.js?1684106062')}}"></script>

    <div class="page">

@include('Admin.components.nav', ['active' => 'Admin Dashboard'])

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
                  Dashboard
                </h2>
              </div>
              
            </div>
          </div>
        </div>
        
        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">
            <div class="row row-deck row-cards">



              <div class="col-12">
                <div class="row row-cards">
                  <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <span class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                              <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-school"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M22 9l-10 -4l-10 4l10 4l10 -4v6" /><path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4" /></svg>                            </span>
                          </div>
                          <div class="col">
                            <div class="font-weight-medium">
                              Students
                            </div>
                            <div class="text-muted">
                              @php
                              $Studentstotal = App\Models\StudentAccounts::all();
                              $count = $Studentstotal->count();

                          @endphp
                              {{ $count }}
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <span class="bg-green text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                              <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-section"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 20h.01" /><path d="M4 20h.01" /><path d="M8 20h.01" /><path d="M12 20h.01" /><path d="M16 20h.01" /><path d="M20 4h.01" /><path d="M4 4h.01" /><path d="M8 4h.01" /><path d="M12 4h.01" /><path d="M16 4l0 .01" /><path d="M4 8m0 1a1 1 0 0 1 1 -1h14a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-14a1 1 0 0 1 -1 -1z" /></svg>                          </div>
                          <div class="col">
                            <div class="font-weight-medium">
                              Sections
                            </div>
                            <div class="text-muted">
                              @php
                              $Sectionstotal = App\Models\Section::all();
                              $count = $Sectionstotal->count();

                          @endphp
                              {{ $count }}
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <span class="bg-twitter text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                              <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-certificate"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 15m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M13 17.5v4.5l2 -1.5l2 1.5v-4.5" /><path d="M10 19h-5a2 2 0 0 1 -2 -2v-10c0 -1.1 .9 -2 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -1 1.73" /><path d="M6 9l12 0" /><path d="M6 12l3 0" /><path d="M6 15l2 0" /></svg>                          </div>
                          <div class="col">
                            <div class="font-weight-medium">
                              Programs 
                            </div>
                            <div class="text-muted">
                              @php
                              $coursestotal = App\Models\Course::all();
                              $count = $coursestotal->count();

                          @endphp
                              {{ $count }}
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <span class="bg-facebook text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-facebook -->
                              <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-building"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 21l18 0" /><path d="M9 8l1 0" /><path d="M9 12l1 0" /><path d="M9 16l1 0" /><path d="M14 8l1 0" /><path d="M14 12l1 0" /><path d="M14 16l1 0" /><path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16" /></svg>                          </div>
                          <div class="col">
                            <div class="font-weight-medium">
                              Departments
                            </div>
                            <div class="text-muted">
                              @php
                              $departmentstotal = App\Models\Department::all();
                              $count = $departmentstotal->count();

                          @endphp
                              {{ $count }} 
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              {{-- <div class="col-lg-6">
                <div class="card">
                  <div class="card-body">
                    <h3 class="card-title">Attendance summary</h3>
                    <div id="chart-mentions" class="chart-lg"></div>
                  </div>
                </div>
              </div> --}}
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-body">
                    <h3 class="card-title">Carlos Hilado Memorial State University</h3>
                    <div class="ratio ratio-21x9">
                      <div>
                        <div id="map-world" class="w-100 h-100">
                          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.8856049044507!2d122.96748287494465!3d10.74329908940343!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33aed6939b70f2a7%3A0x476610a2fa8f42b4!2sCarlos%20Hilado%20Memorial%20State%20University!5e0!3m2!1sen!2sph!4v1715753280800!5m2!1sen!2sph" width="1300" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                      </div>
                    </div>
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