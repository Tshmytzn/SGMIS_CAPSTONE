<!doctype html>

<html lang="en">

@include('Student.components.head', ['title' => 'Documents'])
@include('Student.components.header')
@include('Student.components.nav')

<body>

    <div class="page">
        <div class="page-wrapper">
            <!-- Page header -->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <h2 class="page-title">
                                Documents
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    @include('Admin.components.lineLoading', ['loadID' => 'lineLoading'])
                    <div class="row row-deck row-cards" id="eventsContainer">

                        {{-- <div class="col-md-3 col-sm-4">
                  <div class="card card-link card-link-pop folder">
                    <div class="ribbon ribbon-top bg-yellow">
                      <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-pinned"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 4v6l-2 4v2h10v-2l-2 -4v-6" /><path d="M12 16l0 5" /><path d="M8 4l8 0" /></svg>                  </div>
                    <div class="card-body">
                      <h3 class="card-title">Compendium Name</h3>
                      <p class="text-muted"> Event name and event details Event name and event details Event name and event details</p>
                    </div>
                    <!-- Card footer -->
                    <div class="card-footer">
                      <a href="{{route('ViewCompendium')}}" class="btn btn-primary mb-2">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-files"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 3v4a1 1 0 0 0 1 1h4" /><path d="M18 17h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h4l5 5v7a2 2 0 0 1 -2 2z" /><path d="M16 17v2a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h2" /></svg>
                        View Files</a>
                    </div>
                  </div>
                </div> --}}


                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('Student.components.footer')
    @include('Student.components.scripts')
</body>

</html>

<script>
    function GetAllCompendium() {
        document.getElementById('lineLoading').style.display = '';
        
        // Get the route dynamically
        var viewCompendiumRoute = "{{ route('viewdocuments') }}";

        $.ajax({
            type: "GET",
            url: "{{ route('GetAllCompendium') }}",
            success: function(response) {
                // Hide loading indicator
                document.getElementById('lineLoading').style.display = 'none';

                if (response.data.length === 0) {
                    // Handle no documents case
                    document.getElementById("eventsContainer").innerHTML = `
                    <div class="page-body">
                        <div class="container-xl d-flex flex-column justify-content-center">
                            <div class="empty">
                                <div class="empty-img"><img src="./static/illustrations/undraw_add_files_re_v09g.svg" height="128" alt="">
                                </div>
                                <p class="empty-title">No Document Found!</p>
                                <p class="empty-subtitle text-muted">
                                    No files have been uploaded yet. Please upload the necessary files to proceed. Thank you for your understanding.
                                </p>
                            </div>
                        </div>
                    </div>
                `;
                } else {
                    // Clear the container before adding new content
                    document.getElementById("eventsContainer").innerHTML = "";

                    // Iterate through the response and create cards dynamically
                    response.data.forEach(function(event) {
                        var div = document.createElement("div");
                        div.setAttribute("class", "col-md-3 col-sm-4 animate__animated animate__zoomIn");

                        div.innerHTML = `
                        <div class="card card-link card-link-pop folder">
                            <div class="ribbon ribbon-top bg-yellow">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-pinned"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 4v6l-2 4v2h10v-2l-2 -4v-6" /><path d="M12 16l0 5" /><path d="M8 4l8 0" /></svg>
                            </div>
                            <div class="card-body">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4 class="card-title">${event.event_name}</h4>
                                        </div>
                                        <div class="col-md-6">
                                            <h4 class="card-title">#${event.random_id}</h4>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                                <h3>${event.com_name}</h3>
                                <p class="text-muted">${event.event_description}</p>
                            </div>
                            <!-- Card footer -->
                            <div class="card-footer">
                                <a href="${viewCompendiumRoute}?com_id=${event.com_id}" class="btn btn-primary mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-files">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M15 3v4a1 1 0 0 0 1 1h4" />
                                        <path d="M18 17h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h4l5 5v7a2 2 0 0 1 -2 2z" />
                                        <path d="M16 17v2a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h2" />
                                    </svg>
                                    View Files
                                </a>
                            </div>
                        </div>
                    `;

                        document.getElementById("eventsContainer").appendChild(div);
                    });
                }
            },
            error: function(xhr, status, error) {
                document.getElementById('lineLoading').style.display = 'none';
                console.error("Error fetching data: ", error);
                alert("An error occurred while fetching the compendiums. Please try again later.");
            }
        });
    }

    $(document).ready(function() {
        GetAllCompendium();
    });
</script>
