<!doctype html>

<html lang="en">

@include('Admin.components.header', ['title' => 'Election Results'])
@include('Admin.components.adminstyle')

<style>
    .table {
      width: 100%;
      border-collapse: collapse;
      margin: 20px 0;
      font-family: Arial, sans-serif;
      color: #444;
    }
  
    .table thead {
      background-color: #ff7043;
      color: white;
      text-shadow: 1px 1px 2px #0b7701;
      font-size: 20px;
      font-weight: bold;
    }
  
    .table th, .table td {
      padding: 12px;
      border: 1px solid #ddd;
      text-align: center;
    }
  
    .subheader {
      background-color: #ffe0b2;
      font-weight: bold;
      text-transform: uppercase;
    }
  
    .table tbody tr:nth-child(odd) {
      background-color: #f9f9f9;
    }
  
    .table tbody tr:nth-child(even) {
      background-color: #f1f1f1;
    }
  
    .table tbody tr:hover {
      background-color: #d1e7dd;
      transition: 0.3s;
    }
  
    .table-responsive {
      overflow-x: auto;
    }
  
    .page-body {
      background-color: #f7f9fc;
      padding: 20px;
      border-radius: 10px;
    }
  
    .container-xl {
      max-width: 1200px;
      margin: auto;
    }
  
    .card {
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
      padding: 20px;
      background-color: #fff;
    }
  
    th {
      background-color: #ff7043;
    }
  
    tr.bg-light {
      background-color: #ffcc80 !important;
    }
  
    td {
      font-size: 14px;
    }
  </style>

<body>
    <script src="{{ asset('./dist/js/demo-theme.min.js?1684106062') }}"></script>

    <div class="page">

        @include('Admin.components.nav', ['active' => 'electionresults'])

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
                                Election Results
                            </h2>
                        </div>


                    </div>
                </div>
            </div>

            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                  <div class="card">
                    <div class="table-responsive">
                      <table class="table table-vcenter table-bordered table-nowrap card-table">
                        <thead>
                          <tr>
                            <th class="text-center">Position</th>
                            <th class="text-center">Candidate</th>
                            <th class="text-center">Party</th>
                            <th class="text-center">Votes</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr class="bg-light">
                            <th colspan="4" class="subheader text-black">President</th>
                          </tr>
                          <tr>
                            <td class="text-center">President</td>
                            <td class="text-center">John Doe</td>
                            <td class="text-center">Party A</td>
                            <td class="text-center text-success">5000</td>
                          </tr>
                          <tr>
                            <td class="text-center">President</td>
                            <td class="text-center">Jane Smith</td>
                            <td class="text-center">Party B</td>
                            <td class="text-center text-success">4500</td>
                          </tr>
                          <tr class="bg-light">
                            <th colspan="4" class="subheader text-black">Vice President</th>
                          </tr>
                          <tr>
                            <td class="text-center">Vice President</td>
                            <td class="text-center">Emily White</td>
                            <td class="text-center">Party A</td>
                            <td class="text-center text-success">5200</td>
                          </tr>
                          <tr>
                            <td class="text-center">Vice President</td>
                            <td class="text-center">Michael Brown</td>
                            <td class="text-center">Party B</td>
                            <td class="text-center text-success">4800</td>
                          </tr>
                          <tr class="bg-light">
                            <th colspan="4" class="subheader text-black">Senators</th>
                          </tr>
                          <tr>
                            <td class="text-center">Secretary</td>
                            <td class="text-center">Sarah Green</td>
                            <td class="text-center">Party A</td>
                            <td class="text-center text-success">5300</td>
                          </tr>
                          <tr>
                            <td class="text-center">Secretary</td>
                            <td class="text-center">David Black</td>
                            <td class="text-center">Party B</td>
                            <td class="text-center text-success">4700</td>
                          </tr>
                        </tbody>
                      </table>
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
