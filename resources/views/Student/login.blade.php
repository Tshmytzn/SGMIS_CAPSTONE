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
                <form method="post" id="studentloginform"> @csrf

                  <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" id="studentusername" name="studentusername" class="form-control" placeholder="your username" >
                  </div>
                  <div class="mb-2">
                    <label class="form-label">
                      Password
                    </label>
                    <div class="input-group input-group-flat">
                      <input type="password" id="studentpass" name="studentpass" class="form-control"  placeholder="Your password">
                    </div>
                  </div>
                  <div class="form-footer">
                    <button type="button" onclick="LoginStudent()" class="btn btn-primary w-100">Login</button>
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
    @include('Student.components.studentscripts')

  </body>
</html>
