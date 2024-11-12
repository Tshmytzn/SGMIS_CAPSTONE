<!doctype html>

<html lang="en">
  
@include('Admin.components.header', ['title' => 'Profile'])

  <body >
    <script src="{{asset('./dist/js/demo-theme.min.js?1684106062')}}"></script>
    <div class="page">

      @include('Admin.components.nav', ['active' => 'Profile'])

      <div class="page-wrapper">

        <!-- Page body -->
        <div class="page-body text-center" style="align-self: center">
          <div class="container-xl">
            <div class="card col-12">
              <div class="row g-0">
                <div class="col-12">
                  <div class="card-body">
                    <h2 class="mb-4">My Profile </h2>
                    <div class="row align-items-center" >
                      <div class="col-12" >
                        <span class="avatar avatar-xl w-300" style="background-image: url(./static/avatars/000m.jpg) "></span>
                      </div>
                    </div>
                    <div class="row g-2 mt-2 mb-2">
                      <div class="col-12">
                        <div class="form-label">Marianne Reyn</div>
                        <hr class="my-4 mt-0 mb-1">
                        <div class="form-label">SSG President</div>
                      </div>
                    </div>
                    <div>
                      <button class="btn btn-danger">Logout</button>
                      <button class="btn btn-success" style="margin-left: 10px;">Go to Settings</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


        @include('Admin.components.footer')

      </div>
    </div>
  </div>

    @include('Admin.components.scripts')

  </body>
</html>