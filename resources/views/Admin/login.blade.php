<!doctype html>

<html lang="en">

@include('Admin.components.header', ['title' => 'Login'])

  <body  class=" d-flex flex-column">
    @include('Admin.components.loginloader')
    <script src="{{asset('./dist/js/demo-theme.min.js?1684106062')}}"></script>
    <div class="page page-center">
      <div class="container container-normal py-4">
        <div class="row align-items-center g-4">
          <div class="col-lg">
            <div class="container-tight">
              <div class="text-center mb-4">
                <a href="." class="navbar-brand navbar-brand-autodark"><img src="{{asset('./static/sgmis_si.png')}}" height="120" alt=""></a>
              </div>
              <div class="card card-md">
                <div class="card-body">
                  <h2 class="h2 text-center mb-4">Login to your account</h2>
                  <form id="admin_login" method="POST">
                    @csrf
                    <div class="mb-3">
                      <label class="form-label">Username</label>
                      <input type="text" class="form-control" placeholder="Your username" name="username" id="username" autocomplete="off">
                    </div>
                    <div class="mb-2">
                      <label class="form-label">
                        Password
                        {{-- <span class="form-label-description">
                          <a href="./forgot-password.html">I forgot password</a>
                        </span> --}}
                      </label>
                      <div class="input-group input-group-flat">
                        <input type="password" class="form-control" name="password" id="password"  placeholder="Your password"  autocomplete="off">
                        <span class="input-group-text">
                          <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                          </a>
                        </span>
                      </div>
                    </div>

                    <div class="form-footer">
                      <button id="loginButton" type="button" onclick="AdminLogin('{{route('adminLogin')}}', '{{route('AdminDashboard')}}')" class="btn btn-primary w-100">Sign in</button>
                    </div>
                  </form>
                </div>

              </div>

            </div>
          </div>
          <div class="col-lg d-none d-lg-block">
            <img src="{{asset('./static/loginpic.png')}}" height="400" class="d-block mx-auto" alt="">
          </div>
        </div>
      </div>
    </div>

    <script>
         function EnterLogin(event) {
            if (event.key === 'Enter' || event.keyCode === 13) {
               document.getElementById('loginButton').click();
            }
        }

        document.addEventListener('keydown', EnterLogin);
    </script>
    @include('Admin.components.scripts')

  </body>
</html>
