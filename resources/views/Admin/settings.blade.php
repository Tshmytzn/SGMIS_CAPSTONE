<!doctype html>

<html lang="en">
  
@include('Admin.components.header', ['title' => 'Settings'])

  <body >
    <script src="{{asset('./dist/js/demo-theme.min.js?1684106062')}}"></script>
    <div class="page">

      @include('Admin.components.nav', ['active' => 'Settings'])

      <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <h2 class="page-title">
                  Account Settings
                </h2>
              </div>
            </div>
          </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">
            <div class="card">
              <div class="row g-0">
                <div class="col-3 d-none d-md-block border-end">
                  <div class="card-body">
                    <h4 class="subheader">settings</h4>
                    <div class="list-group list-group-transparent">
                      <a href="./settings.html" class="list-group-item list-group-item-action d-flex align-items-center active">My Account</a>
                      <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">My Notifications</a>

                    </div>
                  </div>
                </div>
                <div class="col d-flex flex-column">
                  <div class="card-body">
                    <h2 class="mb-4">My Account </h2>
                    <h3 class="card-title">Profile Details</h3>
                    <div class="row align-items-center">
                      <div class="col-auto"><span class="avatar avatar-xl" style="background-image: url(./static/avatars/000m.jpg)"></span>
                      </div>
                      <div class="col-auto">
                        <label for="avatar-upload" class="btn">
                            Change avatar
                            <input type="file" id="avatar-upload" style="display: none;">
                        </label>
                    </div>
                    </div>
                    <h3 class="card-title mt-4">Student Profile</h3>
                    <div class="row g-3">
                      <div class="col-md">
                        <div class="form-label">Student Name</div>
                        <input type="text" class="form-control" value="SSG PRESS">
                      </div>
                      <div class="col-md">
                        <div class="form-label">Student ID</div>
                        <input type="text" class="form-control" value="20201422">
                      </div>

                    </div>
                    <h3 class="card-title mt-4">Password</h3>
                    <p class="card-subtitle">You can set a permanent password.</p>
                    <div>
                      <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#updatepassword"> 
                        Set new password
                      </a>
                    </div>

                  </div>
                  <div class="card-footer bg-transparent mt-auto">
                    <div class="btn-list justify-content-end">
                      <a href="#" class="btn">
                        Cancel
                      </a>
                      <a href="#" class="btn btn-primary">
                        Submit
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        {{-- Modal --}}
        <div class="modal modal-blur fade" id="updatepassword" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Update Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="mb-3">
                  <label class="form-label">Old Password</label>
                  <input type="Password" class="form-control" name="example-text-input" placeholder="Your report name">
                </div>
                <div class="mb-3">
                <label class="form-label">New Password</label>
                <input type="Password" class="form-control" name="example-text-input" placeholder="Your report name">
            </div>
            <div class="mb-3">
                <label class="form-label">Repeat Password</label>
                <input type="Password" class="form-control" name="example-text-input" placeholder="Your report name">
            </div>
              </div>
              <div class="modal-footer">
                <a href="#" class="btn btn-danger" data-bs-dismiss="modal">
                  Cancel
                </a>
                <a href="#" class="btn btn-primary" data-bs-dismiss="modal">
                  Update 
                </a>
              </div>
            </div>
          </div>
        </div>
        {{-- Modal --}}


        @include('Admin.components.footer')

      </div>
    </div>

    @include('Admin.components.scripts')

  </body>
</html>