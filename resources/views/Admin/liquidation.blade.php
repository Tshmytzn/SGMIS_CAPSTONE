<!doctype html>

<html lang="en">

@include('Admin.components.header', ['title' => 'Liquidation'])
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<body>
    <script src="{{ asset('./dist/js/demo-theme.min.js?1684106062') }}"></script>

    <div class="page">

        @include('Admin.components.nav', ['active' => 'Liquidation'])

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
                                Liquidation
                            </h2>
                        </div>

                        <div class="col-auto ms-auto d-print-none">
                            <div class="d-flex">
                                <div class="me-3">
                                    <div class="input-icon">
                                        <input type="text" value="" class="form-control" placeholder="Search…">
                                        <span class="input-icon-addon">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                                <path d="M21 21l-6 -6" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <button class="btn" style="background-color: #DF7026; color: white;"
                                    data-bs-toggle="modal" data-bs-target="#liquidation"> Create Liquidation </button>

                            </div>
                        </div>


                        <div class="row mt-2" id="displayLiquidation">
                        </div>


                    </div>
                </div>
            </div>


            
            

            <div class="modal fade" id="liquidation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Liquidition</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="saveLiquidationForm" method="POST">
                        @csrf

                     <div class="row">
                        <div class="col-8 ">
                            <Label>Name</Label>
                            <input type="text" class="form-control" name="liquidition_name" placeholder="Enter Liquidation Name">
                        </div>
                        <div class="col-4 mb-2">
                            <Label>Event</Label>
                            <select class="form-control" name="event">
                                <option value="" selected disabled>Select Event</option>
                                @php
                                    $events = App\Models\SchoolEvents::all();
                                @endphp
                                @foreach ($events as $ev)
                                <option value="{{ $ev->event_id }}">{{ $ev->event_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <Label>Semester</Label>
                            <input type="text" class="form-control" name="semester" placeholder="Enter Semister">
                        </div>
                        <div class="col-4">
                            <Label>From</Label>
                            <input type="text" id="yearPicker" class="form-control" placeholder="Select Year From" name="from">
                        </div>
                        <div class="col-4">
                            <Label>To</Label>
                            <input type="text" id="yearPicker" class="form-control" placeholder="Select Year To" name="to">
                        </div>
                     </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="submitForm()">Save changes</button>
                </div>
                </div>
            </div>
            </div>

            @include('Admin.components.footer')

        </div>
    </div>


    @include('Admin.components.scripts')
    <script>
    function submitForm() {
    if(!validateForm()){
        const formData = $('#saveLiquidationForm').serialize();

        $.ajax({
            url: 'Admin/saveLiquidation',
            type: 'POST',
            data: formData,
            success: function(response) {
                if(response.status=="success"){
                    $('#liquidation').modal('hide');
                    $('#saveLiquidationForm')[0].reset();
                    getLiquidationData();
                }
            },
            error: function(xhr, status, error) {
                $('#response').html(`<p style="color:red;">Error: ${xhr.responseText}</p>`);
            }
        });
    }
    }
    function deleteLiquidation(id){
        alertify.confirm("Warning","Are you sure you want to delete this record?.",
  function(){
    const formData = new FormData();

        formData.append('_token', '{{ csrf_token() }}');
        formData.append('id', id);

        $.ajax({
            url: 'Admin/deleteLiquidation',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if(response.status=="success"){
                    alertify.success(response.message);
                    getLiquidationData();
                }
            },
            error: function(xhr, status, error) {
                $('#response').html(`<p style="color:red;">Error: ${xhr.responseText}</p>`);
            }
        });
  },
  function(){
    alertify.error('Cancel');
  });
    }
    function validateForm() {
    const form = document.getElementById('saveLiquidationForm');
    const inputs = form.querySelectorAll('input');
    const selects = form.querySelectorAll('select');
    let hasEmptyField = false;

    // Check input fields
    inputs.forEach(input => {
        if (input.value.trim() === '') {
            hasEmptyField = true;
            input.style.borderColor = "red"; // Highlight empty field
        } else {
            input.style.borderColor = ""; // Reset border color if filled
        }
    });

    // Check select elements
    selects.forEach(select => {
        if (select.value === '') {
            hasEmptyField = true;
            select.style.borderColor = "red"; // Highlight empty select
        } else {
            select.style.borderColor = ""; // Reset border color if filled
        }
    });

    if (hasEmptyField) {

        return true; // Return true if there's an empty field
    } else {

        return false; // Return false if all fields are filled
    }
}

function getLiquidationData(){
    $.ajax({
            url: 'Admin/getAllLiquidationData',
            type: 'GET',
            success: function(response) {
                const data=response.data;
                const rowHtml = document.getElementById('displayLiquidation');
                rowHtml.innerHTML =``;
                if (data.length > 0) {
                data.forEach(element => {
                    rowHtml.innerHTML +=`
                    <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                        <h5 class="card-title">${element.liquidation_name} - ${element.event_name}</h5>
                        <p class="card-text">${element.semester} | ${element.date_from}-${element.date_to}</p>
                        <div class="row justify-content-center align-item-center text-center">
                            <div class='col-6'>
                                <a href="/Liquidation/Details?liquidation_id=${element.id}" class="btn btn-primary">View</a>
                            </div>
                            <div class='col-6'>
                                <button class="btn btn-danger" onclick="deleteLiquidation(${element.id})">Delete</button>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                    `;
                });
            }else{
                rowHtml.innerHTML =`
                 <div class="page-body">
                <div class="container-xl d-flex flex-column justify-content-center">
                    <div class="empty">
                        <div class="empty-img"><img src="./static/illustrations/undraw_under_construction_-46-pa.svg"
                                height="128" alt="">
                        </div>
                        <p class="empty-title">Feature Coming Soon!</p>
                        <p class="empty-subtitle text-muted">
                            This feature is not yet ready for the pre-oral defense stage. Stay tuned as it will be
                            available for the final defense. See you there!
                        </p>
                        <div class="empty-action">
                            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#liquidation">
                                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>
                                Stay tuned!
                            </a>
                        </div>
                    </div>
                </div>
            </div>
                `;
            }


            },
            error: function(xhr, status, error) {
                $('#response').html(`<p style="color:red;">Error: ${xhr.responseText}</p>`);
            }
        });
}

document.addEventListener("DOMContentLoaded", function() {
    getLiquidationData()
        flatpickr("#yearPicker", {
            dateFormat: "Y", // Display only the year
            minDate: "1900", // Set minimum year
            maxDate: "2100", // Set maximum year
            onReady: function(selectedDates, dateStr, instance) {
                instance.currentYearElement.click(); // Open the calendar in year selection mode
            },
            onChange: function(selectedDates, dateStr, instance) {
                instance.close(); // Close calendar after selecting a year
            }
        });
        flatpickr("#yearPicker1", {
            dateFormat: "Y", // Display only the year
            minDate: "1900", // Set minimum year
            maxDate: "2100", // Set maximum year
            onReady: function(selectedDates, dateStr, instance) {
                instance.currentYearElement.click(); // Open the calendar in year selection mode
            },
            onChange: function(selectedDates, dateStr, instance) {
                instance.close(); // Close calendar after selecting a year
            }
        });
    });
    </script>
</body>

</html>
