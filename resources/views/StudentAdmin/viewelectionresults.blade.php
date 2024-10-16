<!doctype html>

<html lang="en">

@include('StudentAdmin.components.header', ['title' => 'Election Results'])
@include('StudentAdmin.components.adminstyle')

<body>
    <script src="{{ asset('./dist/js/demo-theme.min.js?1684106062') }}"></script>

    <div class="page">

        @include('StudentAdmin.components.nav', ['active' => 'electionresults'])

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

                  <table class="table table-hover table-bordered">
                        <thead  class="text-center">
                            <tr>
                                <th scope="col">Position</th>
                                <th scope="col">Candidate</th>
                                <th scope="col">Party</th>
                                <th scope="col">Votes</th>
                            </tr>
                        </thead>
                        <tbody  class="text-center">
                            <tr class="table-success">      
                                <td colspan="4">President</td>
                            </tr>
                            <tr>
                                <td>President</td>
                                <td>Jane Smith</td>
                                <td>Party B</td>
                                <td class="text-success">100</td>
                            </tr>
                             <tr>
                                <td>President</td>
                                <td>Jake Lopez</td>
                                <td>Party A</td>
                                <td class="text-success">101</td>
                            </tr>
                            
                        </tbody>
                    </table>

                </div>
              </div>

            @include('StudentAdmin.components.footer')

        </div>
    </div>


    @include('StudentAdmin.components.scripts')
    @include('StudentAdmin.components.electionresult')
</body>

</html>
