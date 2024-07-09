<script>
    function reloadElementById(elementId) {
        var element = document.getElementById(elementId);
        if (element) {
            $(element).load(window.location.href + ' #' + elementId);
        }
    }

    function LoginStudent() {
    const formData = $("form#studentloginform").serialize();

    $.ajax({
        type: "POST",
        url: "{{ route('LoginStudent') }}",
        data: formData,
        success: function(response) {
            if (response.status === "success") {
                    window.location.href = "{{ route('StudentDashboard') }}";
            } else if (response.status === "incorrect") {
                alertify.alert("Message", "Incorrect Username or Password!", function() {
                    alertify.message('OK');
                });
            } else if (response.status === "not_found") {
                alertify.alert("Message", "Student Not Found", function() {
                    alertify.message('OK');
                });
            } else {
                alertify.alert("Message", "An unexpected error occurred. Please try again.", function() {
                    alertify.message('OK');
                });
            }
        },
        error: function(xhr, status, error) {
            alertify.alert("Message", "An error occurred while processing your request. Please try again.", function() {
                alertify.message('OK');
            });
            console.error(xhr.responseText);
        }
    });
}


    function UpdateStudentDetails() {
        var formData = $("form#Studentdetailsform").serialize();

        $.ajax({
            type: "POST",
            url: "{{ route('UpdateStudentDetails') }}",
            data: formData,
            success: function(response) {
                if (response.status == "success") {
                    reloadElementById('Studentdetailsform');
                    alertify.alert("Message", "Student Successfully Updated", function() {
                        alertify.message('OK');
                    });
                } else if (response.status == "empty") {
                    alertify.alert("Message", "Please Fill in all Fields", function() {
                        alertify.message('OK');
                    });
                } else {
                    alertify.alert("Message", "Student Not Found", function() {
                        alertify.message('OK');
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }


    function UpdateStudentimage() {
        const pic = document.getElementById('updatestudentpic');
        if (pic.files.length == 0) {
            alertify
                .alert("Warning", "Image Required", function() {
                    alertify.message('OK');
                });
        } else {
            var formData = new FormData();
            formData.append('image', $('#updatestudentpic')[0].files[0]);
            formData.append('_token', '{{ csrf_token() }}');

        $.ajax({
            type: "POST",
            url: "{{ route('UpdateStudentDetails') }}",
            data: formData,
            success: function(response) {
                if (response.status == "success") {
                    reloadElementById('Studentdetailsform');
                    alertify.alert("Message", "Student Successfully Updated", function() {
                        alertify.message('OK');
                    });
                } else if (response.status == "empty") {
                    alertify.alert("Message", "Please Fill in all Fields", function() {
                        alertify.message('OK');
                    });
                } else {
                    alertify.alert("Message", "Student Not Found", function() {
                        alertify.message('OK');
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
    }


var map;
var modal = document.getElementById('timeinmodal');

modal.addEventListener('shown.bs.modal', function() {
    if (!map) {
        map = L.map('map').setView([10.7433, 122.9701], 16);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var universityLocation = L.latLng(10.7425, 122.9701);

        L.circle(universityLocation, {
            color: '#008631',
            fillColor: '#cefad0',
            fillOpacity: 0.3,
            radius: 100
        }).addTo(map).bindPopup('Carlos Hilado Memorial State University Campus');

        var schoolIcon = L.icon({
            iconUrl: '/student_images/schoolL.png',
            iconSize: [90, 90],  // Adjusted size to 90x90
            iconAnchor: [45, 70],  // Adjusted anchor position
            popupAnchor: [0, -30]
        });

        var studentIcon = L.divIcon({
            html: '<img src="/student_images/studentL.png" alt="" id="" style="width:60px;height:60px;transform: translate(-50%, -100%); display: flex;justify-content: center;align-items: center;">',
            iconSize: [1, 1]
        });

        L.marker(universityLocation, { icon: schoolIcon }).addTo(map)
            .bindPopup('<b>Carlos Hilado Memorial State University</b>').openPopup();

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var userLat = position.coords.latitude;
                var userLng = position.coords.longitude;
                var userLocation = L.latLng(userLat, userLng);

                L.marker(userLocation, { icon: studentIcon }).addTo(map)
                    .bindPopup('<b>Your Location</b>').openPopup();

                map.setView(userLocation, 17);

                var distance = userLocation.distanceTo(universityLocation);
                var radius = 100; 

                if (distance <= radius) {
                    console.log("You are inside Carlos Hilado Memorial State University Campus radius.");
                } else {
                    console.log("You are outside Carlos Hilado Memorial State University Campus radius.");
                }

            }, function(error) {
                console.error("Error retrieving location: " + error.message);
                alert("Error retrieving your location. Please enable location services.");
            }, { enableHighAccuracy: true, timeout: 5000, maximumAge: 0 });
        } else {
            console.error("Geolocation is not supported by this browser.");
            alert("Geolocation is not supported by this browser.");
        }
    } else {
        map.invalidateSize();
    }
});




</script>
