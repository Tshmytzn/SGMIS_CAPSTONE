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
                                Election Materials
                            </h2>
                        </div>


                    </div>
                </div>
            </div>



            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <form action="{{route('UploadElectionMaterialFiles')}}"
      class="dropzone"
      id="my-awesome-dropzone"></form>  
                    @include('Admin.components.lineLoading',['loadID' => 'lineLoading'])
                    <div class="row row-deck row-cards mt-4" id="cards">


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



        @include('Admin.components.footer')

        {{-- Modal --}}

        {{-- Create Election Modal --}}
        <div class="modal modal-blur fade" id="createelection" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header text-white" style="background-color: #3E8A34;">
                        <h5 class="modal-title" id="staticBackdropLabel">Create Election Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3" id="createelect" method="POST">
                            @csrf
                            <div class="row g-2">
                                <div class="col-12">

                                    <div class="mb-2">
                                        <label for="firstname" class="form-label">Election Title</label>
                                        <input name="election_name" class="form-control" id="election_name" placeholder="Student Government Elections SY-0000">
                                    </div>

                                    <div class="mb-2">
                                        <label for="election_desc" class="form-label">Election Description(optional)</label>
                                        <textarea name="election_desc" id="election_desc" class="form-control"
                                            placeholder="Enter brief overview of the election, and other notes..."></textarea>
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
        console.log(data);
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
                    <p class="empty-title">No Election Results Available</p>
                    <p class="empty-subtitle text-secondary">
                      Try adjusting your filters or search criteria to find specific election results or candidates.
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
    $(document).ready(function() {
       getMaterials(); 
         });
</script>



</body>

</html>
