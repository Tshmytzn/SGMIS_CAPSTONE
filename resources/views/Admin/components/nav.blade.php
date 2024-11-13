      {{-- modal --}}
      <div class="modal fade" id="profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-sm">
              <div class="modal-content">
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  <div class="modal-body mt-2">
                      <div class="row g-0 text-center">
                          <div class="col-12">
                              <div class="card-body">
                                @php
                                              $adminAcc = App\Models\Admin::where(
                                                  'admin_id',
                                                  session('admin_id'),
                                              )->first();
                                          @endphp
                                    @if($adminAcc)
                                  <div class="row align-items-center">
                                      <div class="col-12">

                                          <span class="avatar avatar-xl"><img
                                                  src="dept_image/{{ $adminAcc->admin_pic }}" alt=""
                                                  id="adminpicture"></span>
                                      </div>
                                  </div>
                                  <div class="row g-2 mt-2 mb-3">
                                      <div class="col-12">
                                          <div class="form-label mb-0" style="font-size: 20px;">
                                              {{ $adminAcc->admin_name }}</div>
                                          <hr class="my-2 mt-0 mb-1 ms-5" style="width: 263px;">
                                          <div class="form-label" style="font-size: 14px;">{{ $adminAcc->admin_type }}
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col text-start">
                                          <button onclick="window.location.href='{{ route('Settings') }}'"
                                              class="btn btn-success btn-block" style="width: 120px"
                                              data-bs-dismiss="modal">Edit Profile</button>
                                      </div>
                                      <div class="col text-end ">
                                          <form method="POST" action="{{ route('AdminLogout') }}">
                                              @csrf
                                              <button type="submit" class="btn btn-danger btn-block ms"
                                                  style="width: 120px" data-bs-dismiss="modal">Logout</button>
                                          </form>
                                      </div>
                                  </div>
                                  @endif
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      {{-- modal --}}


      <!-- Navbar -->
      <div class="sticky-top">
          <header class="navbar navbar-expand-md sticky-top d-print-none">
              <div class="container-xl">
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
                      aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                  </button>
                  <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                      <a href="{{ route('AdminDashboard') }}">
                          <img src="{{ asset('./static/sgmis_si.png') }}" width="120" height="40" alt="SGMIS"
                              class="navbar-brand-image">
                      </a>
                  </h1>
                  <div class="navbar-nav flex-row order-md-last">
                      <div class="nav-item d-none d-md-flex me-3">

                      </div>
                      <div class="d-none d-md-flex me-3">
                          <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode"
                              data-bs-toggle="tooltip" data-bs-placement="bottom">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                  viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                  stroke-linecap="round" stroke-linejoin="round">
                                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                  <path
                                      d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" />
                              </svg>
                          </a>
                          <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode"
                              data-bs-toggle="tooltip" data-bs-placement="bottom">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                  viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                  stroke-linecap="round" stroke-linejoin="round">
                                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                  <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                  <path
                                      d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" />
                              </svg>
                          </a>

                      </div>
                      <div class="nav-item dropdown">
                          <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                              aria-label="Open user menu">
                              @php
                                  $adminAcc = App\Models\Admin::where('admin_id', session('admin_id'))->first();
                              @endphp
                               @php
                                  $studentacc = App\Models\StudentAccounts::where('student_id', session('admin_id'))->first();
                              @endphp
                              @if($adminAcc)
                                <span class="avatar avatar-sm"><img src="dept_image/{{ $adminAcc->admin_pic }}"
                                      alt="" id="adminpicture"></span>
                              <div class="d-none d-xl-block ps-2">
                                  <div>{{ $adminAcc->admin_name }}</div>
                                  <div class="mt-1 small text-muted">{{ $adminAcc->admin_type }}</div>
                              </div>
                              @elseif ($studentacc)
                            <span class="avatar avatar-sm"><img src="student_images/{{ $studentacc->student_pic }}"
                                      alt="" id="adminpicture"></span>
                              <div class="d-none d-xl-block ps-2">
                                  <div>{{ $studentacc->student_firstname }}</div>
                                  <div class="mt-1 small text-muted">{{ $studentacc->student_type }}</div>
                              </div>
                              @endif
                          </a>
                          <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            @if ($adminAcc)
                            <a href="" data-bs-toggle="modal" data-bs-target="#profile"
                                  class="dropdown-item">Profile</a>
                            <a href="{{ route('Settings') }}" class="dropdown-item">Account Settings</a>
                            @endif
                              <form method="POST" action="{{ route('AdminLogout') }}">
                                  @csrf
                                  <button type="submit" class="dropdown-item">Logout</button>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
          </header>
          <header class="navbar-expand-md">
              <div class="collapse navbar-collapse" id="navbar-menu">
                  <div class="navbar">
                      <div class="container-xl">
                          <ul class="navbar-nav">
                              <li class="nav-item {{ $active == 'Admin Dashboard' ? 'active' : '' }}">
                                  <a class="nav-link" href="{{ route('AdminDashboard') }}">
                                      <span
                                          class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                              height="24" viewBox="0 0 24 24" stroke-width="2"
                                              stroke="currentColor" fill="none" stroke-linecap="round"
                                              stroke-linejoin="round">
                                              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                              <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                              <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                              <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                          </svg>
                                      </span>
                                      <span class="nav-link-title">
                                          Dashboard
                                      </span>
                                  </a>
                              </li>
                              @if($adminAcc)
                              <li class="nav-item dropdown {{ $active == 'Accounts' ? 'active' : '' }}">
                                  <a class="nav-link dropdown-toggle" href="{{ route('Accounts') }}"
                                      data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button"
                                      aria-expanded="false">
                                      <span
                                          class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                              viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                              stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                              class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                                              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                              <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                              <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                              <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                              <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                          </svg> </span>
                                      <span class="nav-link-title">
                                          Accounts
                                      </span>
                                  </a>
                                  <div class="dropdown-menu">

                                      <div class="dropdown-menu-columns">

                                          <div class="dropdown-menu-column">

                                              <div class="dropend">
                                                  @php
                                                      $department = App\Models\Department::all();
                                                  @endphp
                                                  @foreach ($department as $dept)
                                                      <a class="dropdown-item dropdown-toggle"
                                                          data-bs-toggle="dropdown" data-bs-auto-close="outside"
                                                          role="button" aria-expanded="false">
                                                          <svg xmlns="http://www.w3.org/2000/svg"
                                                              class="icon icon-inline me-1" width="24"
                                                              height="24" viewBox="0 0 24 24" stroke-width="2"
                                                              stroke="currentColor" fill="none"
                                                              stroke-linecap="round" stroke-linejoin="round">
                                                              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                              <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                              <path
                                                                  d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                                              <path d="M9 14l6 0" />
                                                          </svg>
                                                          {{ $dept->dept_name }} &nbsp;
                                                      </a>

                                                      <div class="dropdown-menu">
                                                          @php
                                                              $course = App\Models\Course::where(
                                                                  'dept_id',
                                                                  $dept->dept_id,
                                                              )->get();
                                                          @endphp
                                                          @foreach ($course as $cour)
                                                              <a href="{{ route('Accounts') }}?course_id={{ $cour->course_id }}"
                                                                  class="dropdown-item">
                                                                  {{ $cour->course_name }}
                                                              </a>
                                                          @endforeach
                                                      </div>
                                                  @endforeach
                                              </div>

                                          </div>
                                      </div>
                                  </div>
                              </li>

                              <li class="nav-item {{ $active == 'Programs' ? 'active' : '' }}">
                                  <a class="nav-link" href="{{ route('Programs') }}">
                                      <span
                                          class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/ghost -->
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                              viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                              stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                              class="icon icon-tabler icons-tabler-outline icon-tabler-certificate">
                                              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                              <path d="M15 15m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                              <path d="M13 17.5v4.5l2 -1.5l2 1.5v-4.5" />
                                              <path
                                                  d="M10 19h-5a2 2 0 0 1 -2 -2v-10c0 -1.1 .9 -2 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -1 1.73" />
                                              <path d="M6 9l12 0" />
                                              <path d="M6 12l3 0" />
                                              <path d="M6 15l2 0" />
                                          </svg> </span>
                                      <span class="nav-link-title">
                                          Academics
                                      </span>
                                  </a>
                              </li>

                              <li class="nav-item {{ $active == 'Election' ? 'active' : '' }}">
                                  <a class="nav-link" href="{{ route('Election') }}">
                                      <span
                                          class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/ghost -->
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                              viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                              stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                              class="icon icon-tabler icons-tabler-outline icon-tabler-flag">
                                              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                              <path
                                                  d="M5 5a5 5 0 0 1 7 0a5 5 0 0 0 7 0v9a5 5 0 0 1 -7 0a5 5 0 0 0 -7 0v-9z" />
                                              <path d="M5 21v-7" />
                                          </svg> </span>
                                      <span class="nav-link-title">
                                          Campaign Materials
                                      </span>
                                  </a>
                              </li>

                              <li class="nav-item {{ $active == 'Budgeting' ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('Budgeting') }}">
                                    <span
                                        class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/ghost -->
                                        <span
                                            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/ghost -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-coins">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M9 14c0 1.657 2.686 3 6 3s6 -1.343 6 -3s-2.686 -3 -6 -3s-6 1.343 -6 3z" />
                                                <path d="M9 14v4c0 1.656 2.686 3 6 3s6 -1.344 6 -3v-4" />
                                                <path
                                                    d="M3 6c0 1.072 1.144 2.062 3 2.598s4.144 .536 6 0c1.856 -.536 3 -1.526 3 -2.598c0 -1.072 -1.144 -2.062 -3 -2.598s-4.144 -.536 -6 0c-1.856 .536 -3 1.526 -3 2.598z" />
                                                <path d="M3 6v10c0 .888 .772 1.45 2 2" />
                                                <path d="M3 11c0 .888 .772 1.45 2 2" />
                                            </svg>
                                        </span>
                                    </span>
                                    <span class="nav-link-title">
                                        Budgeting
                                    </span>
                                </a>
                            </li>

                              <li class="nav-item dropdown">
                                  <a class="nav-link dropdown-toggle" href="#navbar-help" data-bs-toggle="dropdown"
                                      data-bs-auto-close="outside" role="button" aria-expanded="false">
                                      <span
                                          class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/lifebuoy -->
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                              viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                              stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                              class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-event">
                                              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                              <path
                                                  d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                              <path d="M16 3l0 4" />
                                              <path d="M8 3l0 4" />
                                              <path d="M4 11l16 0" />
                                              <path d="M8 15h2v2h-2z" />
                                          </svg> </span>
                                      </span>
                                      <span class="nav-link-title">
                                          Events
                                      </span>
                                  </a>
                                  <div class="dropdown-menu">
                                      <a class="dropdown-item" href="{{ route('Events') }}" rel="noopener">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                              viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                              stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                              class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-event">
                                              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                              <path
                                                  d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                              <path d="M16 3l0 4" />
                                              <path d="M8 3l0 4" />
                                              <path d="M4 11l16 0" />
                                              <path d="M8 15h2v2h-2z" />
                                          </svg> </span>
                                          &nbsp; Events
                                      </a>
                                      <a class="dropdown-item" href="{{ route('ViewAttendance') }}" rel="noopener">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                              viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                              stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                              class="icon icon-tabler icons-tabler-outline icon-tabler-checklist">
                                              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                              <path
                                                  d="M9.615 20h-2.615a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8" />
                                              <path d="M14 19l2 2l4 -4" />
                                              <path d="M9 8h4" />
                                              <path d="M9 12h2" />
                                          </svg>
                                          &nbsp; Attendance
                                      </a>
                                  </div>
                              </li>

                              <li class="nav-item {{ $active == 'Evaluation' ? 'active' : '' }}">
                                  <a class="nav-link" href="{{ route('Evaluation') }}">
                                      <span
                                          class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/ghost -->
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                              viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                              stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                              class="icon icon-tabler icons-tabler-outline icon-tabler-scale">
                                              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                              <path d="M7 20l10 0" />
                                              <path d="M6 6l6 -1l6 1" />
                                              <path d="M12 3l0 17" />
                                              <path d="M9 12l-3 -6l-3 6a3 3 0 0 0 6 0" />
                                              <path d="M21 12l-3 -6l-3 6a3 3 0 0 0 6 0" />
                                          </svg> </span>
                                      <span class="nav-link-title">
                                          Evaluations
                                      </span>
                                  </a>
                              </li>
                              <li class="nav-item {{ $active == 'Liquidation' ? 'active' : '' }}">
                                  <a class="nav-link" href="{{ route('Liquidation') }}">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                          viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                          stroke-linecap="round" stroke-linejoin="round"
                                          class="icon icon-tabler icons-tabler-outline icon-tabler-moneybag">
                                          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                          <path
                                              d="M9.5 3h5a1.5 1.5 0 0 1 1.5 1.5a3.5 3.5 0 0 1 -3.5 3.5h-1a3.5 3.5 0 0 1 -3.5 -3.5a1.5 1.5 0 0 1 1.5 -1.5z" />
                                          <path d="M4 17v-1a8 8 0 1 1 16 0v1a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z" />
                                      </svg>
                                      <span class="nav-link-title">
                                          Liquidation
                                      </span>
                                  </a>
                              </li>
                              <li class="nav-item {{ $active == 'Documents' ? 'active' : '' }}">
                                  <a class="nav-link" href="{{ route('Documents') }}">
                                      <span
                                          class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/ghost -->
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                              viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                              stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                              class="icon icon-tabler icons-tabler-outline icon-tabler-file-info">
                                              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                              <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                              <path
                                                  d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                              <path d="M11 14h1v4h1" />
                                              <path d="M12 11h.01" />
                                          </svg> </span>
                                      <span class="nav-link-title">
                                          Documents
                                      </span>
                                  </a>
                              </li>
                              @elseif ($studentacc)
                              @if ($studentacc->student_position=='USG PRESIDENT'||$studentacc->student_position=='USG SECRETARY')
                              <li class="nav-item {{ $active == 'Election' ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('Election') }}">
                                    <span
                                        class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/ghost -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-flag">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M5 5a5 5 0 0 1 7 0a5 5 0 0 0 7 0v9a5 5 0 0 1 -7 0a5 5 0 0 0 -7 0v-9z" />
                                            <path d="M5 21v-7" />
                                        </svg> </span>
                                    <span class="nav-link-title">
                                        Campaign Materials
                                    </span>
                                </a>
                            </li>

                            <li class="nav-item {{ $active == 'Budgeting' ? 'active' : '' }}">
                              <a class="nav-link" href="{{ route('Budgeting') }}">
                                  <span
                                      class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/ghost -->
                                      <span
                                          class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/ghost -->
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                              viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                              stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                              class="icon icon-tabler icons-tabler-outline icon-tabler-coins">
                                              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                              <path
                                                  d="M9 14c0 1.657 2.686 3 6 3s6 -1.343 6 -3s-2.686 -3 -6 -3s-6 1.343 -6 3z" />
                                              <path d="M9 14v4c0 1.656 2.686 3 6 3s6 -1.344 6 -3v-4" />
                                              <path
                                                  d="M3 6c0 1.072 1.144 2.062 3 2.598s4.144 .536 6 0c1.856 -.536 3 -1.526 3 -2.598c0 -1.072 -1.144 -2.062 -3 -2.598s-4.144 -.536 -6 0c-1.856 .536 -3 1.526 -3 2.598z" />
                                              <path d="M3 6v10c0 .888 .772 1.45 2 2" />
                                              <path d="M3 11c0 .888 .772 1.45 2 2" />
                                          </svg>
                                      </span>
                                  </span>
                                  <span class="nav-link-title">
                                      Budgeting
                                  </span>
                              </a>
                          </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#navbar-help" data-bs-toggle="dropdown"
                                    data-bs-auto-close="outside" role="button" aria-expanded="false">
                                    <span
                                        class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/lifebuoy -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-event">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                            <path d="M16 3l0 4" />
                                            <path d="M8 3l0 4" />
                                            <path d="M4 11l16 0" />
                                            <path d="M8 15h2v2h-2z" />
                                        </svg> </span>
                                    </span>
                                    <span class="nav-link-title">
                                        Events
                                    </span>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('Events') }}" rel="noopener">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-event">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                            <path d="M16 3l0 4" />
                                            <path d="M8 3l0 4" />
                                            <path d="M4 11l16 0" />
                                            <path d="M8 15h2v2h-2z" />
                                        </svg> </span>
                                        &nbsp; Events
                                    </a>
                                    <a class="dropdown-item" href="{{ route('ViewAttendance') }}" rel="noopener">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-checklist">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M9.615 20h-2.615a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8" />
                                            <path d="M14 19l2 2l4 -4" />
                                            <path d="M9 8h4" />
                                            <path d="M9 12h2" />
                                        </svg>
                                        &nbsp; Attendance
                                    </a>
                                </div>
                            </li>

                            <li class="nav-item {{ $active == 'Evaluation' ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('Evaluation') }}">
                                    <span
                                        class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/ghost -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-scale">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M7 20l10 0" />
                                            <path d="M6 6l6 -1l6 1" />
                                            <path d="M12 3l0 17" />
                                            <path d="M9 12l-3 -6l-3 6a3 3 0 0 0 6 0" />
                                            <path d="M21 12l-3 -6l-3 6a3 3 0 0 0 6 0" />
                                        </svg> </span>
                                    <span class="nav-link-title">
                                        Evaluations
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item {{ $active == 'Liquidation' ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('Liquidation') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-moneybag">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M9.5 3h5a1.5 1.5 0 0 1 1.5 1.5a3.5 3.5 0 0 1 -3.5 3.5h-1a3.5 3.5 0 0 1 -3.5 -3.5a1.5 1.5 0 0 1 1.5 -1.5z" />
                                        <path d="M4 17v-1a8 8 0 1 1 16 0v1a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z" />
                                    </svg>
                                    <span class="nav-link-title">
                                        Liquidation
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item {{ $active == 'Documents' ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('Documents') }}">
                                    <span
                                        class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/ghost -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-file-info">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                            <path
                                                d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                            <path d="M11 14h1v4h1" />
                                            <path d="M12 11h.01" />
                                        </svg> </span>
                                    <span class="nav-link-title">
                                        Documents
                                    </span>
                                </a>
                            </li>

                            @elseif ($studentacc->student_position=='USG BUDGET&FINANCE')
                            <li class="nav-item {{ $active == 'Budgeting' ? 'active' : '' }}">
                              <a class="nav-link" href="{{ route('Budgeting') }}">
                                  <span
                                      class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/ghost -->
                                      <span
                                          class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/ghost -->
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                              viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                              stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                              class="icon icon-tabler icons-tabler-outline icon-tabler-coins">
                                              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                              <path
                                                  d="M9 14c0 1.657 2.686 3 6 3s6 -1.343 6 -3s-2.686 -3 -6 -3s-6 1.343 -6 3z" />
                                              <path d="M9 14v4c0 1.656 2.686 3 6 3s6 -1.344 6 -3v-4" />
                                              <path
                                                  d="M3 6c0 1.072 1.144 2.062 3 2.598s4.144 .536 6 0c1.856 -.536 3 -1.526 3 -2.598c0 -1.072 -1.144 -2.062 -3 -2.598s-4.144 -.536 -6 0c-1.856 .536 -3 1.526 -3 2.598z" />
                                              <path d="M3 6v10c0 .888 .772 1.45 2 2" />
                                              <path d="M3 11c0 .888 .772 1.45 2 2" />
                                          </svg>
                                      </span>
                                  </span>
                                  <span class="nav-link-title">
                                      Budgeting
                                  </span>
                              </a>
                          </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link" href="{{ route('Events') }}">
                                  <span
                                      class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/ghost -->
                                      <span
                                          class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/ghost -->
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-event">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                            <path d="M16 3l0 4" />
                                            <path d="M8 3l0 4" />
                                            <path d="M4 11l16 0" />
                                            <path d="M8 15h2v2h-2z" />
                                        </svg>
                                      </span>
                                  </span>
                                  <span class="nav-link-title">
                                     Events
                                  </span>
                              </a>
                            </li>

                            <li class="nav-item {{ $active == 'Evaluation' ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('Evaluation') }}">
                                    <span
                                        class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/ghost -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-scale">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M7 20l10 0" />
                                            <path d="M6 6l6 -1l6 1" />
                                            <path d="M12 3l0 17" />
                                            <path d="M9 12l-3 -6l-3 6a3 3 0 0 0 6 0" />
                                            <path d="M21 12l-3 -6l-3 6a3 3 0 0 0 6 0" />
                                        </svg> </span>
                                    <span class="nav-link-title">
                                        Evaluations
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item {{ $active == 'Liquidation' ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('Liquidation') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-moneybag">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M9.5 3h5a1.5 1.5 0 0 1 1.5 1.5a3.5 3.5 0 0 1 -3.5 3.5h-1a3.5 3.5 0 0 1 -3.5 -3.5a1.5 1.5 0 0 1 1.5 -1.5z" />
                                        <path d="M4 17v-1a8 8 0 1 1 16 0v1a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z" />
                                    </svg>
                                    <span class="nav-link-title">
                                        Liquidation
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item {{ $active == 'Documents' ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('Documents') }}">
                                    <span
                                        class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/ghost -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-file-info">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                            <path
                                                d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                            <path d="M11 14h1v4h1" />
                                            <path d="M12 11h.01" />
                                        </svg> </span>
                                    <span class="nav-link-title">
                                        Documents
                                    </span>
                                </a>
                            </li>
                            @elseif ($studentacc->student_position=='USG SENATE PRESIDENT'||$studentacc->student_position=='USG SENATE SECRETARY')
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="{{ route('Events') }}">
                                  <span
                                      class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/ghost -->
                                      <span
                                          class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/ghost -->
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-event">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                            <path d="M16 3l0 4" />
                                            <path d="M8 3l0 4" />
                                            <path d="M4 11l16 0" />
                                            <path d="M8 15h2v2h-2z" />
                                        </svg>
                                      </span>
                                  </span>
                                  <span class="nav-link-title">
                                     Events
                                  </span>
                              </a>
                            </li>
                            <li class="nav-item {{ $active == 'Liquidation' ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('Liquidation') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-moneybag">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M9.5 3h5a1.5 1.5 0 0 1 1.5 1.5a3.5 3.5 0 0 1 -3.5 3.5h-1a3.5 3.5 0 0 1 -3.5 -3.5a1.5 1.5 0 0 1 1.5 -1.5z" />
                                        <path d="M4 17v-1a8 8 0 1 1 16 0v1a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z" />
                                    </svg>
                                    <span class="nav-link-title">
                                        Liquidation
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item {{ $active == 'Documents' ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('Documents') }}">
                                    <span
                                        class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/ghost -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-file-info">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                            <path
                                                d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                            <path d="M11 14h1v4h1" />
                                            <path d="M12 11h.01" />
                                        </svg> </span>
                                    <span class="nav-link-title">
                                        Documents
                                    </span>
                                </a>
                            </li>
                              @endif

                              @endif

                          </ul>

                      </div>
                  </div>
              </div>
          </header>
      </div>
