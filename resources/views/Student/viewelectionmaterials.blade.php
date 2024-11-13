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
      @php
    $elect_id = $_GET['elect_id'];
@endphp
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
                                Campaign Materials
                            </h2>
                        </div>


                    </div>
                </div>
            </div>



            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">

                    <div class="">

                                <table class="table table-bordered table-hover text-center" id="Candidates">
                                    <thead>
                                        <tr>
                                            <th>DATE</th>
                                            <th>POSITION</th>
                                            <th>NAME</th>

                                        </tr>
                                    </thead>
                                    <tbody >

                                    </tbody>
                                </table>
                                </div>


                    @include('Admin.components.lineLoading',['loadID' => 'lineLoading'])
                    <div class="row row-deck row-cards mt-4" id="cards">


                    </div>
                    <form action="{{route('UploadElectionMaterialFiles')}}"
      class="dropzone"
      id="my-awesome-dropzone"></form>
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





        {{-- Modal --}}

        {{-- Create Election Modal --}}
        <div class="modal modal-blur fade" id="addOfficerModal" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header text-white" style="background-color: #3E8A34;">
                        <h5 class="modal-title" id="staticBackdropLabel">Add Officer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3" id="addOfficerForm" method="POST">
                            @csrf
                            <div class="row g-2">
                                <input type="text" name="id" value="{{$elect_id}}" hidden>
                                <table class="table table-bordered table-hover text-center" id="StudentListTable" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Student ID</th>
                                            <th>Full Name</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody >

                                    </tbody>
                                </table>
                                    <div class="mb-2 col-6">
                                        <label for="firstname" class="form-label">Position</label>
                                        <select name="position" class="form-select" id="">
                                            <option value="USG PRESIDENT">USG PRESIDENT</option>
                                            <option value="USG SECRETARY">USG SECRETARY</option>
                                            <option value="USG SECRETARY">USG BUDGET&FINANCE</option>
                                            <option value="USG SECRETARY">USG SENATE PRESIDENT</option>
                                            <option value="USG SECRETARY">USG SENATE SECRETARY</option>

                                        </select>
                                    </div>

                                    <div class="mb-2 col-6">
                                        <label for="firstname" class="form-label">Full Name</label>
                                        <input name="name" class="form-control" id="studentFullName" placeholder="Enter Officer Fullname">
                                    </div>

                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" id="closeEvalForm" class="btn btn-danger"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary"
                            onclick="addOfficer()">Save</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- Create Election modal --}}
        <div class="modal modal-blur fade" id="updateOfficerModal" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header text-white" style="background-color: #3E8A34;">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit Officer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3" id="updateOfficerForm" method="POST">
                            @csrf
                            <div class="row g-2">
                                <input type="text" name="up_id" id="up_id" value=" " hidden>
                                <table class="table table-bordered table-hover text-center" id="StudentListTable2" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Student ID</th>
                                            <th>Full Name</th>

                                        </tr>
                                    </thead>
                                    <tbody >

                                    </tbody>
                                </table>
                                    <div class="mb-2 col-6">
                                        <label for="firstname" class="form-label">Position</label>
                                        <select name="position" class="form-select" id="up_position">
                                            <option value="USG PRESIDENT">USG PRESIDENT</option>
                                            <option value="USG SECRETARY">USG SECRETARY</option>
                                            <option value="USG SECRETARY">USG BUDGET&FINANCE</option>
                                            <option value="USG SECRETARY">USG SENATE PRESIDENT</option>
                                            <option value="USG SECRETARY">USG SENATE SECRETARY</option>
                                        </select>
                                    </div>

                                    <div class="mb-2 col-6">
                                        <label for="firstname" class="form-label">Full Name</label>
                                        <input name="name" class="form-control" id="up_name" placeholder="Enter Officer Fullname">
                                    </div>

                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" id="closeEvalForm" class="btn btn-danger"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary"
                            onclick="updateOfficer()">Save</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal --}}
        <input type="text" name="id" id="election_id" value="{{$elect_id}}" hidden>
    </div>
    </div>


    @include('Student.components.footer')
    @include('Student.components.scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/alertifyjs/build/alertify.min.js"></script>
    {{-- datatable --}}
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script>
<script>
    // Get the query string from the URL
    const queryString = window.location.search;

    // Parse the query string
    const urlParams = new URLSearchParams(queryString);

    // Get a specific parameter by name
    const id = urlParams.get('elect_id'); // Retrieve 'elect_id' from the URL


    function getMaterials(){
        document.getElementById('lineLoading').style.display='';
        $.ajax({
    url: `{{route('GetMaterials')}}?id=` + id, // URL to your API endpoint
    method: 'GET',
    success: function(data) {
        document.getElementById('lineLoading').style.display='none';
        const previewContainer = $('#preview-container'); // Assume you have a container for previews
        previewContainer.empty(); // Clear previous content

        if (data.status === 'success' && data.data.length > 0) {
            const card = document.getElementById('cards');
            card.innerHTML = ''; // Clear existing cards

            data.data.forEach(file => {
                const fileName = file.file_name;
                const cleanedFileName = fileName.replace(/^1_/, ''); // Remove the prefix "1_"
                const fileType = cleanedFileName.split('.').pop().toLowerCase(); // Get file extension
                const fileURL = `/election_materials/${fileName}`;  // Adjust the path to your file storage

                // Create a card for each file
                let cardContent = `
                    <div class="card m-2" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">${cleanedFileName}</h5>
                            <p class="card-text">File type: ${fileType}</p>
                `;

                // Display content based on file type
                if (['jpg', 'jpeg', 'png', 'gif', 'ico'].includes(fileType)) {
                    cardContent += `<img src="${fileURL}" class="card-img-top" alt="${fileName}">`;
                } else if (['mp4', 'webm', 'ogg'].includes(fileType)) {
                    cardContent += `
                        <video class="card-img-top" controls>
                            <source src="${fileURL}" type="video/${fileType}">
                            Your browser does not support the video tag.
                        </video>
                    `;
                } else if (fileType === 'pdf') {
                    cardContent += `<img src="/compendium_file/icons/pdf-icon.png" class="card-img-top" alt="PDF Document">`;
                } else if (['doc', 'docx'].includes(fileType)) {
                    cardContent += `<img src="/compendium_file/icons/doc-icon.png" class="card-img-top" alt="Word Document">`;
                } else if (['xls', 'xlsx'].includes(fileType)) {
                    cardContent += `<img src="/compendium_file/icons/xls-icon.png" class="card-img-top" alt="Excel File">`;
                } else {
                    cardContent += `<img src="https://via.placeholder.com/150?text=Unsupported" class="card-img-top" alt="Unsupported File">`;
                }

                // Adding View/Download and Delete buttons
                cardContent += `
                            <div class="d-flex justify-content-between mt-2">
                                <a href="${fileURL}" class="btn btn-primary" target="_blank">View / Download</a>
                            </div>
                        </div>
                    </div>
                `;

                // Append the card content
                card.innerHTML += cardContent;
            });

            // Attach click event for delete buttons
            $('.delete-btn').on('click', function() {
                const fileId = $(this).data('id');
                deleteFile(fileId);
            });
        } else {
            const card = document.getElementById('cards');
            card.innerHTML = '';
            card.innerHTML += `<div class="empty">
                    <div class="empty-img"><img src="./static/illustrations/undraw_voting_nvu7.svg" height="128" alt="">
                    </div>
                    <p class="empty-title">No Campaign Material Available</p>
                    <p class="empty-subtitle text-secondary">
                      Try adjusting your filters or search criteria to find specific campaign material.
                    </p>
                  </div>`;
        }
    },
    error: function(xhr, status, error) {
        console.error('AJAX Error:', status, error);
        $('#result').html('<p>Error fetching data.</p>'); // Display an error message
    }
});

// Function to delete a file
function deleteFile(fileId) {

alertify.confirm("Warning","Are you sure you want to delete this file?",
  function(){

        const formData = new FormData();
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('id', fileId);
        $.ajax({
            url: `{{route('DeleteMaterials')}}`, // URL for deleting the file
            method: 'POST', // Assuming you are using DELETE HTTP method
            processData: false,
            contentType: false,
            data: formData,
            success: function(response) {
                if (response.status === 'success') {
                    alertify.alert("File Successfully Deleted", function(){
                        alertify.message('OK');
                        getMaterials();
                    });
                } else {
                    alert('Failed to delete the file.');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error deleting file:', status, error);
                alert('An error occurred while deleting the file.');
            }
        });

  },
  function(){
    alertify.error('Cancel');
  });

}


    }
    function addOfficer(){

         var formData = $("form#addOfficerForm").serialize();
        $.ajax({
            type: "POST",
            url: "{{ route('AddElectedOfficer') }}",
            data: formData,
            success: function(response) {
                alertify.success(response.message);
                $("form#addOfficerForm")[0].reset();
                $('#addOfficerModal').modal('hide');
                getOfficerData();
         },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
        function updateOfficer(){

        var formData = $("form#updateOfficerForm").serialize();
        $.ajax({
            type: "POST",
            url: "{{ route('updateElectedOfficer') }}",
            data: formData,
            success: function(response) {
                alertify.success(response.message);
                $('#updateOfficerModal').modal('hide');
                getOfficerData();
         },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
    function getOfficerData(){
        const election_id = document.getElementById('election_id').value;
        const formData = new FormData();
        formData.append('id', election_id);
        formData.append('_token', '{{ csrf_token() }}');

        $.ajax({
            type: "POST",
            url: "{{ route('getElectedOfficer') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                let data = response.data;
                $('#Candidates').DataTable( {
                    data: data,
                    destroy: true,
                    columns: [
                        { data: 'batch_date' },
                        { data: 'position' },
                        { data: 'name' },

                    ],
                } );
         },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
    function toModal(id,position,name){
        document.getElementById('up_id').value=id;
        document.getElementById('up_position').value=position
        document.getElementById('up_name').value=name
    }
    function deleteData(id){
        alertify.confirm("Warning","Are you sure you want to delete this data?",
    function(){

        var formData =  new FormData();
        formData.append('id', id);
        formData.append('_token', '{{ csrf_token() }}');

        $.ajax({
            type: "POST",
            url: "{{ route('deleteElectedOfficer') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                alertify.success(response.message);
                getOfficerData();
         },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });

          },
    function(){
        alertify.error('Cancel');
    });
    }

function getStudentList() {
    $.ajax({
        url: `{{ route('getStudentListData') }}`,
        type: 'GET',
        dataType: 'json',
        success: function(response) {

            $('#StudentListTable').DataTable( {
                data: response.data,
                 pageLength: 5,
                columns: [
                    { data: 'school_id' },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return row.student_firstname + ' ' + row.student_lastname;
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return '<button type="button" class="btn btn-primary" onclick="SelectStudent(`' +
                                row.student_firstname + '`,`' + row.student_lastname + '`)">Select</button>';
                        }
                    }
                ]
            } );

            $('#StudentListTable2').DataTable( {
                data: response.data,
                 pageLength: 5,
                columns: [
                    { data: 'school_id' },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return row.student_firstname + ' ' + row.student_lastname;
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return '<button type="button" class="btn btn-primary" onclick="SelectStudent2(`' +
                                row.student_firstname + '`,`' + row.student_lastname + '`)">Select</button>';
                        }
                    }
                ]
            } );

        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', error);
            console.error('Status:', status);
            console.error('Response Text:', xhr.responseText);
        }
    });
}
function SelectStudent(first,last){
    document.getElementById('studentFullName').value=first+' '+last;
}
function SelectStudent2(first,last){
    document.getElementById('up_name').value=first+' '+last;
}
    $(document).ready(function() {
        getStudentList();
        getOfficerData();
       getMaterials();
         });
</script>



</body>

</html>
