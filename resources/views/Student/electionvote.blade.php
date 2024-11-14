<!doctype html>

<html lang="en">

@include('Student.components.head', ['title' => 'Election'])
@include('Student.components.header')
@include('Student.components.nav')

<style>
    .fade-card {
            opacity: 0;
            transform: scale(0.5); /* Make it slightly smaller */
            transition: opacity 0.5s ease, transform 0.5s ease;
        }

        /* Pop-up animation */
        .fade-card.show {
            opacity: 1;
            transform: scale(1);
        }
    </style>
<body>
    <script src="{{ asset('./dist/js/demo-theme.min.js?1684106062') }}"></script>

    <div class="page">


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
                                Campaign Material
                            </h2>
                        </div>




                    </div>
                </div>
            </div>



            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    @include('Admin.components.lineLoading',['loadID' => 'lineLoading'])
                    <div class="row row-deck row-cards" id="cards">

                        {{-- <div class="col-md-6 col-lg-3">
                            <div class="card card-stacked">
                              <div class="card-status-start bg-success"></div>
                              <div class="ribbon bg-green">Ongoing</div>
                                <div class="card-body">
                                    <h3 class="card-title"> Elections SY-2024 </h3>
                                    <hr class="my-4 mt-1">

                                    <p class="text-secondary">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                        Architecto at consectetur culpa ducimus eum fuga fugiat, ipsa iusto, modi
                                        nostrum recusandae reiciendis saepe.</p>
                                </div>
                                <div class="card-footer card-footer-transparent" >
                                    <a href="{{route('Editelection')}}"class="btn btn-outline-green"
                                        style="display: flex; align-items: center; justify-content: center;">
                                        Update Details <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-edit"
                                            style="margin-left: 8px;">

                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                            <path
                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                            <path d="M16 5l3 3" />
                                        </svg></a>
                                </div>
                            </div>
                        </div> --}}

                    </div>

                    {{-- This is a no search results illustration --}}
                    {{-- <div class="empty">
                    <div class="empty-img"><img src="./static/illustrations/undraw_voting_nvu7.svg" height="128" alt="">
                    </div>
                    <p class="empty-title">No Election Results Available</p>
                    <p class="empty-subtitle text-secondary">
                      Try adjusting your filters or search criteria to find specific election results or candidates.
                    </p>
                  </div> --}}

                </div>
            </div>
        </div>

        <form action="" id="updateElectionForm" method="POST" hidden>
            @csrf
            <input type="text" name="status" id="" value="2">
            <input type="text" name="elect_id" id="elect_id">
            <input type="text" name="method" id="" value="update">
        </form>

        @include('Admin.components.footer')

        {{-- Modal --}}

        {{-- Create Election Modal --}}
        <div class="modal modal-blur fade" id="createelection" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header text-white" style="background-color: #3E8A34;">
                        <h5 class="modal-title" id="staticBackdropLabel">Create Campaign Material Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3" id="createelect" method="POST">
                            @csrf
                            <div class="row g-2">
                                <div class="col-12">

                                    <div class="mb-2">
                                        <label for="firstname" class="form-label">Campaign Material Title</label>
                                        <input name="election_name" class="form-control" id="election_name" placeholder=" Enter Campaign Material Title">
                                    </div>

                                    <div class="mb-2">
                                        <label for="election_desc" class="form-label">Campaign Material Description(optional)</label>
                                        <textarea name="election_desc" id="election_desc" class="form-control"
                                            placeholder="Enter brief overview of the campaign material, and other notes..."></textarea>
                                    </div>

                                    <hr class="my-4">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="voting_start_date" class="form-label">Start From</label>
                                            <input type="date" name="voting_start_date"
                                                id="voting_start_date" class="form-control">
                                        </div>
                                        <div class="col-6">
                                            <label for="voting_end_date" class="form-label">End To</label>
                                            <input type="date" name="voting_end_date" id="voting_end_date"
                                                class="form-control">
                                        </div>
                                    </div>

                                </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" id="closeEvalForm" class="btn btn-danger"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary"
                            onclick="dynamicFuction('createelect','{{route('createElection')}}')">Save</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- Create Election modal --}}

        {{-- Modal --}}

    </div>
    </div>

    @include('Student.components.footer')
    @include('Student.components.scripts')
    <script>
        function dynamicFuction(formId, routeUrl) {
            // Show the loader
            document.getElementById('adminloader').style.display = 'grid';

            // Serialize the form data
            var formData = $("form#" + formId).serialize();

    const form = document.getElementById(formId);
      const inputs = form.querySelectorAll('input, textarea, select');

      for (let input of inputs) {
        if (input.id !== 'election_desc' && !input.value.trim()) {
          console.log('empty');
          document.getElementById('adminloader').style.display = 'none';
          alertify
                            .alert("Warning", 'Fields is empty!', function() {
                                alertify.message('OK');
                            });
        }
      }

            // Send the AJAX request
            $.ajax({
                type: "POST",
                url: routeUrl,
                data: formData,
                success: function(response) {
                    document.getElementById('adminloader').style.display = 'none';
                    if (response.status == 'error') {
                        alertify
                            .alert("Warning", response.message, function() {
                                alertify.message('OK');
                            });
                    } else if (response.status == 'update') {

                    } else {
                        getElection()
                        document.getElementById(formId).reset();
                        $('#' + response.modal).modal('hide');

                        alertify
                            .alert("Message", response.message, function() {
                                alertify.message('OK');
                            });
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    // You can also add custom error handling here if needed
                }
            });
        }
        $(document).ready(function() {
            getElection()
        });
        // function autoSubmit(id){
        //     document.getElementById('elect_id').value=id;
        //     dynamicFuction('updateElectionForm', "{{ route('createElection') }}")
        // }

        function getElection() {
            document.getElementById('lineLoading').style.display = '';
            var cardsContainer = document.getElementById('cards');
            cardsContainer.innerHTML = '';
            $.ajax({
                url: "{{ route('getElection') }}",
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    document.getElementById('lineLoading').style.display = 'none';
                    // Clear previous content
                    cardsContainer.innerHTML = '';
                    if (response.data.length === 0) {
                        // No data available
                        cardsContainer.innerHTML = `<div class="empty">
                        <div class="empty-img"><img src="{{ asset('./static/illustrations/undraw_voting_nvu7.svg') }}" height="128" alt="">
                        </div>
                        <p class="empty-title">No Data Available</p>
                        <p class="empty-subtitle text-secondary">
                          Please adjust your filters or criteria to view results.
                        </p>
                      </div>`;
                    } else {
                        // Iterate through the data array and create card elements
                        response.data.forEach(function(item, index) {
                            const startDate = new Date(item.elect_start);
                            const endDate = new Date(item.elect_end);
                            const currentDate = new Date();

                            let status;
                            let color;
                            let stats;
                            let see;
                            var cardHtml = `
                                    <div class="col-md-6 col-lg-3 fade-card" id="card-${index}">
                                        <div class="card card-stacked">
                                            <div class="card-status-start bg-success"></div>
                                            <div class="card-body">
                                                <h3 class="card-title">${item.elect_name}</h3>
                                                <hr class="my-4 mt-1">
                                                <p class="text-secondary">${item.elect_description || 'No description available.'}</p>
                                                <p class="text-secondary"><strong>From:</strong> ${new Date(item.elect_start).toLocaleString()}</p>
                                                <p class="text-secondary"><strong>To:</strong> ${new Date(item.elect_end).toLocaleString()}</p>
                                            </div>
                                            <div class="card-footer card-footer-transparent" >
                                                <a href="{{ route('viewelectionmaterials') }}?elect_id=${item.elect_id}" class="btn btn-outline-green col-12"
                                                    style="align-items: center; justify-content: center; ">
                                                    View
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                `;
                            // Append the card HTML to the container
                            cardsContainer.innerHTML += cardHtml;
                        });
                    }

                    // Pop up cards one by one
                    $('.fade-card').each(function(index) {
                        var $card = $(this);
                        setTimeout(function() {
                            $card.addClass('show'); // Add class to trigger the CSS transition
                        }, index * 100); // 300ms delay between each card
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Error: " + textStatus + " " + errorThrown);
                }
            });
        }
    </script>

</body>

</html>
