<!doctype html>

<html lang="en">

@include('Admin.components.header', ['title' => 'Election Results'])
@include('Admin.components.adminstyle')
<style>
    .fade-card {
    height: 400px; /* Set your desired height */
    overflow: hidden; /* Hide overflow if the content exceeds the height */
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
                     @include('Admin.components.lineLoading',['loadID' => 'cardload'])
                    <div class="row row-cards p-4 mb-2" id="cards" style="display: none">

                    </div> 
                @include('Admin.components.lineLoading',['loadID' => 'lineLoading'])
                  <table class="table table-hover table-bordered" id="table_id" style="display: none">
                        <thead  class="text-center">
                            <tr>
                                <th scope="col">Position</th>
                                <th scope="col">Candidate</th>
                                <th scope="col">Party</th>
                                <th scope="col">Votes</th>
                            </tr>
                        </thead>
                        <tbody  class="text-center" id="president">
                            <tr class="table-success">      
                                <td colspan="4">President</td>
                            </tr>
                        </tbody>
                        <tbody class="text-center" id="vicepresident">
                            <tr class="table-success">      
                                <td colspan="4">Vice President</td>
                            </tr>
                        </tbody>
                        <tbody class="text-center" id="senators">
                             <tr class="table-success">      
                                <td colspan="4">Senators</td>
                            </tr>
                        </tbody>
                        <tbody class="text-center" id="governor">
                            <tr class="table-success">      
                                <td colspan="4">Governor</td>
                            </tr>
                        </tbody>
                        <tbody class="text-center" id="vicegovernor">
                             <tr class="table-success">      
                                <td colspan="4">Vice Governor</td>
                            </tr>
                        </tbody>
                        <tbody class="text-center" id="representatives">
                             <tr class="table-success">      
                                <td colspan="4">Representatives</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
              </div>

            @include('Admin.components.footer')

        </div>
    </div>


    @include('Admin.components.scripts')
    @include('Admin.components.electionresult')
</body>

</html>
