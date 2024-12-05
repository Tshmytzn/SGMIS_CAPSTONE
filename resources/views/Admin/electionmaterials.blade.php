<!doctype html>

<html lang="en">

@include('Admin.components.header', ['title' => 'Election'])
@include('Admin.components.adminstyle')
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

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

        @include('Admin.components.nav', ['active' => 'Election'])

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
                        <div class="d-flex mb-2">
                            <button class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#addOfficerModal">Add Officers</button>
                        </div>
                                <table class="table table-bordered table-hover text-center" id="Candidates">
                                    <thead>
                                        <tr>
                                            <th>DATE</th>
                                            <th>POSITION</th>
                                            <th>NAME</th>
                                            <th>ACTION</th>
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

                </div>

            </div>
        </div>



        @include('Admin.components.footer')

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
                                           <option value="President">President</option>
    <option value="Vice President">Vice President</option>

    <!-- Senators (6 per party) -->
    <optgroup label="Senators">
        <option value="Senator 1">Senator 1</option>
        <option value="Senator 2">Senator 2</option>
        <option value="Senator 3">Senator 3</option>
        <option value="Senator 4">Senator 4</option>
        <option value="Senator 5">Senator 5</option>
        <option value="Senator 6">Senator 6</option>
    </optgroup>

    <!-- Representatives -->
    <optgroup label="Representatives">
        <option value="BECED Representative">BECED Representative</option>
        <option value="BSED Representative">BSED Representative</option>
        <option value="BPED Representative">BPED Representative</option>
        <option value="BEED Representative">BEED Representative</option>
        <option value="BTLED Representative">BTLED Representative</option>
        <option value="BSNED Representative">BSNED Representative</option>
        <option value="AB SocSci Representative">AB SocSci Representative</option>
        <option value="BS Psychology Representative">BS Psychology Representative</option>
        <option value="AB English Representative">AB English Representative</option>
        <option value="BPA Representative">BPA Representative</option>
        <option value="BSAM Representative">BSAM Representative</option>
        <option value="BSIT Representative">BSIT Representative</option>
        <option value="BSIS Representative">BSIS Representative</option>
        <option value="BSHM Representative">BSHM Representative</option>
        <option value="BSCE Representative">BSCE Representative</option>
    </optgroup>

    <!-- Governors -->
    <optgroup label="Governor">
        <option value="Governor - College of Education">Governor - College of Education</option>
        <option value="Governor - College of Arts and Sciences">Governor - College of Arts and Sciences</option>
        <option value="Governor - College of Industrial Technology">Governor - College of Industrial Technology</option>
        <option value="Governor - College of Computer Studies">Governor - College of Computer Studies</option>
        <option value="Governor - College of Business Management and Accountancy">Governor - College of Business Management and Accountancy</option>
        <option value="Governor - College of Engineering">Governor - College of Engineering</option>
    </optgroup>

    <!-- Vice Governors -->
    <optgroup label="Vice Governor">
        <option value="Vice Governor - College of Education">Vice Governor - College of Education</option>
        <option value="Vice Governor - College of Arts and Sciences">Vice Governor - College of Arts and Sciences</option>
        <option value="Vice Governor - College of Industrial Technology">Vice Governor - College of Industrial Technology</option>
        <option value="Vice Governor - College of Computer Studies">Vice Governor - College of Computer Studies</option>
        <option value="Vice Governor - College of Business Management and Accountancy">Vice Governor - College of Business Management and Accountancy</option>
        <option value="Vice Governor - College of Engineering">Vice Governor - College of Engineering</option>
    </optgroup>
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
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                                    <div class="mb-2 col-6">
                                        <label for="firstname" class="form-label">Position</label>
                                        <select name="position" class="form-select" id="up_position">
                                            <option value="President">President</option>
    <option value="Vice President">Vice President</option>

    <!-- Senators (6 per party) -->
    <optgroup label="Senators">
        <option value="Senator 1">Senator 1</option>
        <option value="Senator 2">Senator 2</option>
        <option value="Senator 3">Senator 3</option>
        <option value="Senator 4">Senator 4</option>
        <option value="Senator 5">Senator 5</option>
        <option value="Senator 6">Senator 6</option>
    </optgroup>

    <!-- Representatives -->
    <optgroup label="Representatives">
        <option value="BECED Representative">BECED Representative</option>
        <option value="BSED Representative">BSED Representative</option>
        <option value="BPED Representative">BPED Representative</option>
        <option value="BEED Representative">BEED Representative</option>
        <option value="BTLED Representative">BTLED Representative</option>
        <option value="BSNED Representative">BSNED Representative</option>
        <option value="AB SocSci Representative">AB SocSci Representative</option>
        <option value="BS Psychology Representative">BS Psychology Representative</option>
        <option value="AB English Representative">AB English Representative</option>
        <option value="BPA Representative">BPA Representative</option>
        <option value="BSAM Representative">BSAM Representative</option>
        <option value="BSIT Representative">BSIT Representative</option>
        <option value="BSIS Representative">BSIS Representative</option>
        <option value="BSHM Representative">BSHM Representative</option>
        <option value="BSCE Representative">BSCE Representative</option>
    </optgroup>

    <!-- Governors -->
    <optgroup label="Governor">
        <option value="Governor - College of Education">Governor - College of Education</option>
        <option value="Governor - College of Arts and Sciences">Governor - College of Arts and Sciences</option>
        <option value="Governor - College of Industrial Technology">Governor - College of Industrial Technology</option>
        <option value="Governor - College of Computer Studies">Governor - College of Computer Studies</option>
        <option value="Governor - College of Business Management and Accountancy">Governor - College of Business Management and Accountancy</option>
        <option value="Governor - College of Engineering">Governor - College of Engineering</option>
    </optgroup>

    <!-- Vice Governors -->
    <optgroup label="Vice Governor">
        <option value="Vice Governor - College of Education">Vice Governor - College of Education</option>
        <option value="Vice Governor - College of Arts and Sciences">Vice Governor - College of Arts and Sciences</option>
        <option value="Vice Governor - College of Industrial Technology">Vice Governor - College of Industrial Technology</option>
        <option value="Vice Governor - College of Computer Studies">Vice Governor - College of Computer Studies</option>
        <option value="Vice Governor - College of Business Management and Accountancy">Vice Governor - College of Business Management and Accountancy</option>
        <option value="Vice Governor - College of Engineering">Vice Governor - College of Engineering</option>
    </optgroup>
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


    @include('Admin.components.scripts')
<script>
    // Get the query string from the URL
    const queryString = window.location.search;

    // Parse the query string
    const urlParams = new URLSearchParams(queryString);

    // Get a specific parameter by name
    const id = urlParams.get('elect_id'); // Retrieve 'elect_id' from the URL

    Dropzone.options.myAwesomeDropzone = {
        maxFilesize: 20, // Set max file size to 20 MB
        dictDefaultMessage: "Drag files here or click to upload",
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}" // Add CSRF token to headers
        },
        params: {
            id: id // Pass the ID as a parameter
        },
        init: function() {
            this.on("sending", function(file, xhr, formData) {
                formData.append("id", id); // Add additional data (e.g., ID) dynamically
            });
            this.on("success", function(file, response) {
               getMaterials()
            });
            this.on("error", function(file, errorMessage) {
                console.error("File upload error:", errorMessage);
            });
        }
    };


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
                                <button class="btn btn-danger delete-btn" data-id="${file.id}">Delete</button>
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
                    <p class="empty-title">No Campaign Materials Available</p>
                    <p class="empty-subtitle text-secondary">
                      Try adjusting your filters or search criteria to find specific campaign materials.
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
                        {
                            data: null, // No specific data source
                            render: function (data, type, row) {
                                return `<button class="btn btn-primary btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#updateOfficerModal" onclick="toModal('${row.id}','${row.position}','${row.name}')">Edit</button>
                                        <button class="btn btn-danger btn-sm edit-btn" onclick="deleteData('${row.id}')">Remove</button>
                                `;
                            },
                            orderable: false, // Prevent sorting on the action column
                            searchable: false // Prevent searching on the action column
                        }
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
