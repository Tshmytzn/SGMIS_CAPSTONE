<script>
    $(document).ready(function() {
        GetCompendiumFiles();
});

   const usertype = "<?php echo $usertype; ?>";

   if(usertype === 'USG BUDGET&FINANCE'){
    console.log('here')
   }else{
    console.log('here2')
    Dropzone.options.dropzoneMultiple = {
        paramName: "file",
        maxFilesize: 20,
        dictDefaultMessage: "Drag files here to upload",
        autoProcessQueue: true,

        init: function() {
            var myDropzone = this;

            myDropzone.on("sending", function(file, xhr, formData) {
                formData.append("com_id", document.getElementById("com_id").value);
            });

            myDropzone.on("success", function(file, response) {
                console.log("File uploaded successfully:", response);

                if (response && response.status && response.status === 'success') {
                   GetCompendiumFiles();
                } else {
                    console.error("Invalid or missing response from server");
                }
                myDropzone.removeAllFiles();
            });

            myDropzone.on("error", function(file, errorMessage) {
                console.error("Error uploading file:", errorMessage);
            });

            myDropzone.on("complete", function(file) {
                myDropzone.removeFile(file);
            });
        }
    };
   }

    
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
if (response && Array.isArray(response.data)) {
    comfileElement.innerHTML = "";
    response.data.forEach(function(Data) {
        const fileNameWithoutExt = Data.file_name.split('.').slice(0, -1).join('.');
        const usertype = "<?php echo $usertype; ?>";
        
        // Construct HTML with conditional delete button
        const deleteButtonHTML = usertype === 'USG BUDGET&FINANCE' ? '' : `
            <div class="d-flex">
                <a href="#" data-bs-toggle="modal" data-bs-target="" class="card-btn" onclick="DeleteFile('${Data.com_file_id}')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-trash-x">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M4 7h16" />
                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                        <path d="M10 12l4 4m0 -4l-4 4" />
                    </svg>
                    Delete
                </a>
            </div>
        `;

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
                    ${deleteButtonHTML}
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
