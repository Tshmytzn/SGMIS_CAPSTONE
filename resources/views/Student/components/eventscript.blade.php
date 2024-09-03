<style>
      #map {
        height: 400px;
        width: 100%;
        position: relative;
    }
    #mapLoading {
    position: absolute; /* Position it on top of the #map */
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000; /* Ensure it appears on top of #map */
    background-color: rgba(255, 255, 255, 0.8); /* Optional: Add a semi-transparent background */
}
.loader-container {
    display: flex;
    justify-content: center;
    align-items: center;
    position: absolute; /* Position relative to the nearest positioned ancestor */
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%); /* Center it horizontally and vertically */
}


.bouncing-dots {
    display: flex;
    justify-content: space-between;
    width: 60px;
}

.dot {
    width: 15px;
    height: 15px;
    background-color: #FF5C35;
    border-radius: 50%;
    animation: bounce 1.5s infinite;
}

.dot:nth-child(1) {
    animation-delay: 0s;
}

.dot:nth-child(2) {
    animation-delay: 0.3s;
}

.dot:nth-child(3) {
    animation-delay: 0.6s;
}

@keyframes bounce {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-20px);
    }
}
</style>
<input type="text" id="latitude" hidden>
<input type="text" id="longitude" hidden>
<input type="text" id="lrange" hidden>

<script>
const studentId = <?php echo session('student_id'); ?>;
console.log(studentId);
function attendance(id) {
    $.ajax({
        type: "GET", // Using GET since you're passing data as query parameters
        url: "{{ route('getVenueByID') }}?l_id=" + id, // Appending the l_id to the URL as a query parameter
        success: function(response) {
            console.log(response); // Log the response to the console
            const data = response.data;
            document.getElementById('latitude').value=data.latitude;
            document.getElementById('longitude').value=data.longitude;
            document.getElementById('lrange').value=data.lrange;
            mapping()
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText); // Log any errors to the console
        }
    });
}

var map;
function mapping() {
    var div = document.getElementById('mapLoading');
    var div2 = document.getElementById('map');
            div.style.display = 'block'; 
            setTimeout(function() {
                div.style.display = 'none';
            }, 5000);

    const range = parseFloat(document.getElementById('lrange').value);
    const lat = parseFloat(document.getElementById('latitude').value);
    const long = parseFloat(document.getElementById('longitude').value);

    if (map) {
        // Remove all layers and markers before reinitializing
        map.eachLayer(function(layer) {
            map.removeLayer(layer);
        });
        map.off();  // Remove all event listeners
        map.remove();  // Remove the map object itself
    }

    // Reinitialize the map at the university location
    map = L.map('map').setView([lat, long], 16);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var universityLocation = L.latLng(lat, long);

    L.circle(universityLocation, {
        color: '#008631',
        fillColor: '#cefad0',
        fillOpacity: 0.3,
        radius: range
    }).addTo(map).bindPopup('Carlos Hilado Memorial State University Campus');

    var schoolIcon = L.icon({
        iconUrl: '/student_images/schoolL.png',
        iconSize: [90, 90], 
        iconAnchor: [45, 70], 
        popupAnchor: [0, -30]
    });

    var studentIcon = L.divIcon({
        html: '<img src="/student_images/studentL.png" alt="" id="" style="width:60px;height:60px;transform: translate(-50%, -100%); display: flex;justify-content: center;align-items: center;">',
        iconSize: [1, 1]
    });

    L.marker(universityLocation, { icon: schoolIcon }).addTo(map)
        .bindPopup('<b>Carlos Hilado Memorial State University</b>').openPopup();

   
        navigator.geolocation.getCurrentPosition(function(position) {
            var userLat = position.coords.latitude;
            var userLng = position.coords.longitude;
            var userLocation = L.latLng(userLat, userLng);

            // Add the user marker
            L.marker(userLocation, { icon: studentIcon }).addTo(map)
                .bindPopup('<b>Your Location</b>').openPopup();

            // Set the map view to the user location after adding the markers
            map.setView(userLocation, 17);

            var distance = userLocation.distanceTo(universityLocation);
            var radius = range;

            if (distance <= radius) {
                console.log("You are inside Carlos Hilado Memorial State University Campus radius.");
            } else {
                console.log("You are outside Carlos Hilado Memorial State University Campus radius.");
                alertify.alert("Warning", "You are outside the venue radius.", function() {
                        alertify.message('OK');
                    });
                    document.getElementById('attend').disabled = true;
            }

        }, function(error) {
            console.error("Error retrieving location: " + error.message);
            alert("Error retrieving your location. Please enable location services.");
        }, { enableHighAccuracy: true, timeout: 15000, maximumAge: 0 });
    
}

</script>