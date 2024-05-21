 
 <!-- Navbar -->
 <header class="navbar navbar-expand-md d-print-none" >
    <div class="container-xl">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
        <a href=".">
          <img src="{{asset('./static/sgmis_si.png')}}" width="110" height="32" alt="SGMIS" class="navbar-brand-image">
        </a>
      </h1>
      <div class="navbar-nav flex-row order-md-last">

        <div class="d-none d-md-flex">
          <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode" data-bs-toggle="tooltip"
       data-bs-placement="bottom">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" /></svg>
          </a>
          <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode" data-bs-toggle="tooltip"
       data-bs-placement="bottom">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" /></svg>
          </a>
          <div class="nav-item dropdown d-none d-md-flex me-3">
          &nbsp;

          </div>
        </div>

        <div class="nav-item dropdown">
          <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
            <span class="avatar avatar-sm" style="background-image: url({{asset('./static/avatars/000m.jpg')}})"></span>
            <div class="d-none d-xl-block ps-2">
              <div>Ghiza Ann Dojoles</div>
              <div class="mt-1 small text-muted">BSIS 3C</div>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <a href="" data-bs-toggle="modal" data-bs-target="#profile" class="dropdown-item">Profile</a>
            <a href="{{route('accountsettings')}}" class="dropdown-item">Settings</a>
            <a href="" data-bs-toggle="modal" data-bs-target="#logoutmodal" class="dropdown-item">Logout</a>
          </div>
        </div>
      </div>
    </div>
  </header>

  {{-- logout modal --}}
<div class="modal modal-blur fade" id="logoutmodal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      <div class="modal-status bg-danger"></div>
      <div class="modal-body text-center py-4">
        <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
        <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" /><path d="M12 9v4" /><path d="M12 17h.01" /></svg>
        <h3>Confirm Logout</h3>
        <div class="text-muted">Are you sure you want to log out?</div>
      </div>
      <div class="modal-footer">
        <div class="w-100">
          <div class="row">
            <div class="col">
              <a href="#" class="btn w-100" data-bs-dismiss="modal">
                Cancel
              </a>
            </div>
            <div class="col">
              <a href="#" class="btn btn-danger w-100" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                Yes, Logout
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
{{-- logout modal --}}

 {{-- modal --}}
 <div class="modal fade" id="profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
      <div class="modal-content">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="modal-body mt-2">
              <div class="row g-0 text-center">
                  <div class="col-12">
                      <div class="card-body">
                          <div class="row align-items-center">
                              <div class="col-12">
                                  <span class="avatar avatar-xl"><img
                                          src="./static/logoicon.png" alt=""
                                          id="adminpicture"></span>
                              </div>
                          </div>
                          <div class="row g-2 mt-2 mb-3">
                              <div class="col-12">
                                  <div class="form-label mb-0" style="font-size: 20px;">
                                    Ghiza Ann Dojoles</div>
                                  <hr class="my-2 mt-0 mb-1 ms-5" style="width: 263px;">
                                  <div class="form-label" style="font-size: 14px;"> BSIS 3C
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col text-start">
                                  <button onclick="window.location.href='{{ route('EventDashboard') }}'"
                                      class="btn btn-success btn-block" style="width: 120px"
                                      data-bs-dismiss="modal">Edit Profile</button>
                              </div>
                              <div class="col text-end ">
                                  <form method="POST" action="{{ route('AdminLogout') }}">
                                      @csrf
                                      <button type="submit" class="btn btn-danger btn-block ms"
                                          style="width: 120px" data-bs-toggle="modal" data-bs-target="#logoutmodal">Logout</button>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
{{-- modal --}}
