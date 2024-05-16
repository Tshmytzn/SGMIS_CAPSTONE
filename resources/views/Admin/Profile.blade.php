<!doctype html>

<html lang="en">
  
@include('Admin.components.header', ['title' => 'Profile'])

  <body >
    <script src="{{asset('./dist/js/demo-theme.min.js?1684106062')}}"></script>
    <div class="page">

      @include('Admin.components.nav', ['active' => 'Profile'])

      <div class="page-wrapper">

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



        @include('Admin.components.footer')

      </div>
    </div>

    @include('Admin.components.scripts')

  </body>
</html>