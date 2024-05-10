<!doctype html>

<html lang="en">
  
@include('Admin.components.header', ['title' => 'Accounts'])

  <body >
    <script src="{{asset('./dist/js/demo-theme.min.js?1684106062')}}"></script>

    <div class="page">

@include('Admin.components.nav', ['active' => 'Accounts'])

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
                  Accounts
                </h2>
              </div>
            </div>
          </div>
        </div>     
    
<!-- Page body -->
<div class="page-body" style="margin-top:1%">
  <div class="container-xl">
    <div class="card">

      
      {{-- Dropdown Year Level and Create Account --}}
        <div class="row">
          <div class="row justify-content-between mt-4 align-items-end">
            <div class="col-auto mx-3">
              <div class="dropdown">
                <button class="btn btn-custom dropdown-toggle" type="button" id="yearLevelDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #DF7026; color:white;"> Year Level</button>
                <ul class="dropdown-menu dropdown-menu" aria-labelledby="yearLevelDropdown">
                  <li><a class="dropdown-item" href="#">First Year</a></li>
                  <li><a class="dropdown-item" href="#">Second Year</a></li>
                  <li><a class="dropdown-item" href="#">Third Year</a></li>
                  <li><a class="dropdown-item" href="#">Fourth Year</a></li>
                </ul>
              </div>
            </div>
            <div class="col-auto text-end">
              <button class="btn" style="background-color: #DF7026; color: white;" data-bs-toggle="modal" data-bs-target="#createstudentacc"> Create Student Account</button>
            </div>
          </div>
        </div>
        {{-- Dropdown Year Level and Create Account --}}

              <div class="card-body gy-5">
              <div id="table-default" class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th><button class="table-sort" data-sort="sort-name">Student ID</button></th>
                      <th><button class="table-sort" data-sort="sort-city">First Name</button></th>
                      <th><button class="table-sort" data-sort="sort-type">Middle Name</button></th>
                      <th><button class="table-sort" data-sort="sort-score">Last Name</button></th>
                      <th><button class="table-sort" data-sort="sort-date">Section</button></th>
                    </tr>
                  </thead>
                  <tbody class="table-tbody">
                    <tr>
                      <td class="sort-name">20273463</td>
                      <td class="sort-city">Marianne</td>
                      <td class="sort-type">Reyn</td>
                      <td class="sort-score">Madrona</td>
                      <td class="sort-date" data-date="1628071164">A</td>
                    </tr>
                    <tr>
                      <td class="sort-name">20275643</td>
                      <td class="sort-city">Ghiza</td>
                      <td class="sort-type">Ann</td>
                      <td class="sort-score">Dojoles</td>
                      <td class="sort-date" data-date="1628071164">B</td>
                    </tr>
                    <tr>
                      <td class="sort-name">20279874</td>
                      <td class="sort-city">Perlyn</td>
                      <td class="sort-type">Marie</td>
                      <td class="sort-score">Buenafe</td>
                      <td class="sort-date" data-date="1628071164">C</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>


        {{-- MODALS --}}

        {{-- Create Account --}}
        <div class="modal modal-blur fade" id="createstudentacc" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header text-white" style="background-color: #3E8A34;">
                <h5 class="modal-title" id="staticBackdropLabel">Create Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                
                <form class="row g-3">
                <div class="row g-2">
                  <div class="col-4">
                    <label for="firstname" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstname" placeholder="First Name">
                  </div>
                  <div class="col-4">
                    <label for="middlename" class="form-label">Middle Name</label>
                    <input type="text" class="form-control" id="middlename" placeholder="Middle Name">
                  </div>
                  <div class="col-4">
                    <label for="lastname" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lastname" placeholder="Last Name">
                  </div>
                </div>
                <hr class="my-4 ">
                <div class="row g-2">
                  <div class="col-md-4">
                    <label for="studentid" class="form-label">Student ID</label>
                    <input type="number" class="form-control" id="studentid" placeholder="Student ID">
                  </div>
                  <div class="col-md-4">
                    <label for="inputState" class="form-label">Year Level</label>
                    <select id="inputState" class="form-select">
                      <option selected> Year Level</option>
                      <option>1st</option>
                      <option>2nd</option>
                      <option>3rd</option>    
                      <option>4th</option>                    
                      <option>5th</option>                                    
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label for="inputState" class="form-label">Section</label>
                    <select id="inputState" class="form-select">
                      <option selected> Section</option>
                      <option>A</option>
                      <option>B</option>
                      <option>C</option>
                    </select>
                  </div>
                </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Save</button>
              </div>
            </div>
          </div>
        </div>
        {{-- Create Account --}}

        {{-- MODALS --}}

@include('Admin.components.footer')

      </div>
    </div>

@include('Admin.components.scripts')

  </body>
</html>