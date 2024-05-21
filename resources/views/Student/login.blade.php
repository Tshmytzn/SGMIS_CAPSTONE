<!doctype html>

<html lang="en">

@include('Student.components.head', ['title'=> 'Student Login'])


  <body >

    <div class="page">
      <div class="page-wrapper">

        <div class="page page-center">
          <div class="container container-tight py-4">
            <div class="text-center mb-4">
              <a href="." class="navbar-brand navbar-brand-autodark"><img src="{{asset('./static/sgmis_si.png')}}" height="100" alt=""></a>
            </div>
            <div class="card card-md">
              <div class="card-body">
                <h2 class="h2 text-center mb-4">Login to your account</h2>
                <form action="./" method="get" autocomplete="off" novalidate>
                  <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="email" class="form-control" placeholder="your username" autocomplete="off">
                  </div>
                  <div class="mb-2">
                    <label class="form-label">
                      Password
                    </label>
                    <div class="input-group input-group-flat">
                      <input type="password" class="form-control"  placeholder="Your password"  autocomplete="off">
                      <span class="input-group-text">
                        <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                        </a>
                      </span>
                    </div>
                  </div>
                  <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                  </div>
                </form>
              </div>

            </div>
            <div class="text-center text-muted mt-3">
              Don't have account yet? <a href="" tabindex="-1">Contact Administrator</a>
            </div>
          </div>
        </div>

      </div>
    </div>
    @include('Student.components.footer')
    @include('Student.components.scripts')
  </body>
</html>