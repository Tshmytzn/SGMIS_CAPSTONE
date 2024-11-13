<!doctype html>

<html lang="en">

@include('Student.components.head', ['title' => 'Documents'])
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>


@include('Admin.components.adminstyle')
<body>
    <script src="{{ asset('./dist/js/demo-theme.min.js?1684106062') }}"></script>

    <div class="page">
       
        @include('Student.components.nav', ['active' => ''])

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
                                Document Files
                            </h2>
                        </div>


                    </div>
                </div>
            </div>

            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-deck row-cards">
                        @php
                            $com_id = request()->query('com_id');
                        @endphp

                        <div class="col-lg-12" style="height: 100vh; display: flex; flex-direction: column;">
                            <div class="card" style="flex: 1; display: flex; flex-direction: column;">
                                <div class="card-body" style="flex: 1; display: flex; flex-direction: column;">
                                    <h3 class="card-title">Upload Documents</h3>
                                    <input type="hidden" name="com_id" id="com_id" value="{{ $com_id }}">
                                    <div class="page-body">
                                            <div class="container-xl">
                                                @include('Admin.components.lineLoading',['loadID' => 'lineLoading'])
                                                <div class="row row-deck row-cards" id="comfile">
                                                    
                                                </div>
                                            </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            @include('Student.components.footer')

        </div>
    </div>



    @include('Student.components.scripts')
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/mammoth/1.4.2/mammoth.browser.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/pptxgenjs@3.4.0/dist/pptxgen.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
  

  <script>
    $(document).ready(function() {
        GetCompendiumFiles();
});

function runCardAnimation() {
        const cards = document.querySelectorAll('.admincardeffects');
        if (cards.length > 0) {
            cards.forEach(card => {
                card.classList.remove('animate__animated', 'animate__zoomIn'); // Reset animation
                void card.offsetWidth; // Trigger reflow to restart the animation
                card.classList.add('animate__animated', 'animate__zoomIn'); // Add animation classes
            });
        } else {
            console.error('No elements found with the class admincardeffects');
        }
    }
function GetCompendiumFiles() {
    document.getElementById('lineLoading').style.display = '';
    const comfileElement = document.getElementById("comfile");
    comfileElement.innerHTML = "";
    const id = document.getElementById("com_id").value;

    const encodedId = encodeURIComponent(id);

    $.ajax({
        type: "GET",
        url: "{{ route('GetCompendiumFiles') }}?id=" + encodedId,
        success: function(response) {
document.getElementById('lineLoading').style.display = 'none';
console.log(response)
if (response && Array.isArray(response.data)) {
    comfileElement.innerHTML = "";
    response.data.forEach(function(Data) {
        const fileNameWithoutExt = Data.file_name.split('.').slice(0, -1).join('.');
        
        // Create the full HTML for the card, including the conditional delete button
        const div = document.createElement("div");
        div.setAttribute("class", "col-md-2 col-lg-3 admincardeffects");
        div.setAttribute("data-bs-toggle", "modal");
        div.setAttribute("data-bs-target", "#viewFile");
        div.setAttribute("onclick", `viewfile('${Data.file_name}')`);

        div.innerHTML = `
            <div class="card">
                <div class="card-body p-4 text-center">
                    <span class="avatar avatar-xl mb-3" style="background-color:white;">
                        <img style="background-color:white;" class="fileIcon" src="" alt="picture">
                    </span>
                    <embed style="display:none;" class="embeddedFile" src="compendium_file/${Data.file_name}" width="300px" height="auto" />
                    <h3 class="m-0 mb-1">${fileNameWithoutExt}</h3>
                </div>
            </div>
        `;

        // Append the div to the main container
        comfileElement.appendChild(div);

        // Set file icon based on the file type
        const embeddedFile = div.querySelector('.embeddedFile');
        const src = embeddedFile.getAttribute('src');
        const fileType = getFileType(src);
        const icon = fileTypeIcons[fileType] || 'default-icon.png';
        const fileIcon = div.querySelector('.fileIcon');
        fileIcon.src = 'compendium_file/icons/' + icon;
    });

    runCardAnimation();
} else {
    console.error("Invalid or missing data in response");
}

        },
        error: function(xhr, status, error) {
            console.error("Error fetching compendium files:", error);
        }
    });
}

const fileTypeIcons = {
    'pdf': 'pdf-icon.png',
    'doc': 'doc-icon.png',
    'docx': 'docx-icon.png',
    'xls': 'xls-icon.png',
    'xlsx': 'xlsx-icon.png',
    'ppt': 'ppt-icon.png',
    'pptx': 'ppt-icon.png',
    'jpg': 'jpg-icon.png',
    'jpeg': 'jpeg-icon.png',
    'png': 'png-icon.png',
    'gif': 'gif-icon.png',
    'bmp': 'bmp-icon.png',
    'tiff': 'tiff-icon.png',
    'mp4': 'mp4-icon.png',
    'mp3': 'mp3-icon.png',
    'txt':'txt-icon.png',
    'zip':'zip-icon.png',
    'rar':'rar-icon.png',

};

function getFileType(url) {
    const parts = url.split('.');
    return parts[parts.length - 1].toLowerCase();
}
function downloadFile() {
    const file = document.getElementById('file_id').value
    const fileType = getFileType(file);  // Assuming getFileType returns file extension (e.g., 'pdf', 'docx', etc.)
    const fileUrl = `compendium_file/${file}`; // Your file's path
    
    // Create a hidden <a> element
    const link = document.createElement('a');
    link.href = fileUrl;

    // Set the download attribute with the file name
    link.download = file;

    // Append link to the body temporarily to trigger the download
    document.body.appendChild(link);
    link.click();

    // Remove the link from the DOM after the download starts
    document.body.removeChild(link);
}
function viewfile(file) {
     document.getElementById('file_id').value=file;
    const fileType = getFileType(file);
    const modalBody = document.querySelector('#viewFile .modal-body');
    modalBody.innerHTML = '';  // Clear previous content

    if (fileType === 'pdf' || fileType === 'jpg' || fileType === 'jpeg' || fileType === 'png' || fileType === 'gif' || fileType === 'bmp' || fileType === 'tiff') {
        modalBody.innerHTML = `<embed class="displayfile" src="compendium_file/${file}" width="100%" height="400px" />`;
    } else if (fileType === 'doc' || fileType === 'docx') {
        fetch(`compendium_file/${file}`)
            .then(response => response.arrayBuffer())
            .then(arrayBuffer => mammoth.convertToHtml({ arrayBuffer: arrayBuffer }))
            .then(result => {
                modalBody.innerHTML = result.value;
            })
            .catch(handleError);
    } else if (fileType === 'xls' || fileType === 'xlsx') {
        fetch(`compendium_file/${file}`)
            .then(response => response.arrayBuffer())
            .then(arrayBuffer => {
                const workbook = XLSX.read(arrayBuffer, { type: 'array' });
                const html = XLSX.utils.sheet_to_html(workbook.Sheets[workbook.SheetNames[0]]);
                modalBody.innerHTML = html;
            })
            .catch(handleError);
    } else if (fileType === 'ppt' || fileType === 'pptx') {
        modalBody.innerHTML = `<iframe src="https://view.officeapps.live.com/op/embed.aspx?src=http://your-server/compendium_file/${file}" style="width:100%; height:600px;" frameborder="0"></iframe>`;
    } else if (fileType === 'mp4') {
        modalBody.innerHTML = `<video width="100%" height="400px" controls><source src="compendium_file/${file}" type="video/mp4">Your browser does not support the video tag.</video>`;
    } else if (fileType === 'mp3') {
        modalBody.innerHTML = `<audio controls><source src="compendium_file/${file}" type="audio/mpeg">Your browser does not support the audio element.</audio>`;
    } else if (fileType === 'zip' || fileType === 'rar') {
        // Trigger file download
        const link = document.createElement('a');
        link.href = `compendium_file/${file}`;
        link.download = file;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link); // Clean up the DOM
        modalBody.innerHTML = `<p>Zip/Rar file Downloaded</p>`;
    } else {
        modalBody.innerHTML = `<p>Unsupported file type</p>`;
    }
}

function handleError(err) {
    console.error("An error occurred:", err);
    const modalBody = document.querySelector('#viewFile .modal-body');
    modalBody.innerHTML = `<p>An error occurred while loading the file. Please try again later.</p>`;
}

function DeleteFile(id) {

    alertify.confirm("Warning","Are You Sure You Want To Delete This File?",
  function(){
    var formData = new FormData();
    formData.append('id', id);
    formData.append('_token', '{{ csrf_token() }}');
    document.getElementById('adminloader').style.display = '';
    $.ajax({
        type: "POST",
        url: "{{ route('DeleteFile') }}",
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            document.getElementById('adminloader').style.display = 'none';
            if (response.message) {
                GetCompendiumFiles();
                alertify
                .alert("Message",response.message, function(){
                    });

            }
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


</script>




</body>

</html>
