<!doctype html>

<html lang="en">
  
@include('Admin.components.header' , ['title' => 'Programs'])

  <body >
    <script src="{{asset('./dist/js/demo-theme.min.js?1684106062')}}"></script>

    <div class="page">

@include('Admin.components.nav' , ['active' => 'Programs'])

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
                  Programs & Courses
                </h2>
              </div>
              

            </div>
          </div>
        </div>
        
        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">
            <div class="row row-deck row-cards">
              
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                      <li class="nav-item">
                        <a href="#departments" class="nav-link active" data-bs-toggle="tab">Departments</a>
                      </li>
                      <li class="nav-item">
                        <a href="#courses" class="nav-link" data-bs-toggle="tab">Courses</a>
                      </li>
                      <li class="nav-item">
                        <a href="#sections" class="nav-link" data-bs-toggle="tab">Sections</a>
                      </li>
                    </ul>
                  </div>

                  <div class="card-body">
                    <div class="tab-content">
                      <div class="tab-pane fade active show" id="departments">
                        {{-- ADD DEPARTMENT --}}
                        <div class="container mx-3" style="margin-bottom: -1%;">
                          <div class="row">
                              <div class="col d-flex justify-content-between mt-2 ">
                                  <div style="margin-left: -20px;">
                                    <h3>Carlos Hilado Memorial State of University Departments </h3>
                                  </div>
                                  <button class="btn" style="background-color: #DF7026; color: white;" data-bs-toggle="modal" data-bs-target="#adddepartment">Add Department</button>
                              </div>
                          </div>
                      </div>                                       
                        {{-- ADD DEPARTMENT --}}
                                    <div id="table-default" class="table-responsive">
                                      <table class="table  mt-4">
                                        <thead>
                                          <tr>
                                            <th><button class="table-sort" data-sort="sort-name">#</button></th>
                                            <th><button class="table-sort" data-sort="sort-city">Department Name</button></th>
                                            <th><button class="table-sort" data-sort="sort-name">Actions</button></th>

                                          </tr>
                                        </thead>
                                        <tbody class="table-tbody">
                                          <tr>
                                            <td class="sort-name">1</td>
                                            <td class="sort-city">College of Engineering</td>
                                            <td class="sort-type">
                                              <button class="btn btn-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                  <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                  <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                  <path d="M16 5l3 3" />
                                                </svg>
                                              </button>                                              
                                              <button class="btn btn-danger" >
                                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" />
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                              </button>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td class="sort-name">1</td>
                                            <td class="sort-city">College of Engineering</td>
                                            <td class="sort-type">
                                              <button class="btn btn-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                  <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                  <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                  <path d="M16 5l3 3" />
                                                </svg>
                                              </button>                                              
                                              <button class="btn btn-danger" >
                                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" />
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                              </button>
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </div>
                        </div>
                      </div>

                      <div class="tab-pane fade" id="courses">
                        <h4>Profile tab</h4>
                        <div>


                        </div>
                      </div>

                      <div class="tab-pane fade" id="sections">
                        <h4>Activity tab</h4>
                        <div>
                          
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
          
            </div>
          </div>
        </div>

        {{-- MODALS --}}

        {{-- Add Department Modal --}}
        <div class="modal modal-blur fade" id="adddepartment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header text-white" style="background-color: #3E8A34;">
                <h5 class="modal-title" id="staticBackdropLabel">Add Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                
                <form class="row g-3">
                <div class="row g-2">
                  <div class="col-12">
                    <label for="firstname" class="form-label">Department Name</label>
                    <input type="text" class="form-control" id="firstname" placeholder="Department Name">
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
        {{-- Add Department Modal --}}

        {{-- MODALS --}}

@include('Admin.components.footer')

      </div>
    </div>
    
    
@include('Admin.components.scripts')

  </body>
</html>