<script>

let map, marker,circle;
let radius = 500;
function initMap(lat, lng, name,id) {
    if(name){
        document.getElementById('venue').value=name;
        document.getElementById('venueID').value=id;
        document.getElementById('updateVenue').style.display='';
        document.getElementById('newVenue').style.display='none';
    }
    // Initialize the map centered on the user's location
    if (!map) {
            map = L.map('map').setView([lat, lng], 15);

            // Load and display the tile layer (map tiles)
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
        } else {
            map.setView([lat, lng], 15);
        }

        // Place a marker at the user's location
        if (marker) {
            marker.setLatLng([lat, lng]);
        } else {
            marker = L.marker([lat, lng]).addTo(map)
                .bindPopup('You are here.')
                .openPopup();
        }

        // Draw a circle around the user's location to represent the range
        if (circle) {
            circle.setLatLng([lat, lng]);
            circle.setRadius(radius);
        } else {
            circle = L.circle([lat, lng], {
                color: 'blue',
                fillColor: '#aaddff',
                fillOpacity: 0.5,
                radius: radius // Use the default or current radius
            }).addTo(map);
        }

        // Update the input fields with the new coordinates
        document.getElementById('lat').value = lat.toFixed(6);
        document.getElementById('lng').value = lng.toFixed(6);

        // Listen for map clicks to place a new marker
        map.off('click'); // Remove previous click event listeners to avoid duplicate markers
        map.on('click', function(e) {
            const clickedLat = e.latlng.lat;
            const clickedLng = e.latlng.lng;

            // Move the existing marker or place a new one
            if (marker) {
                marker.setLatLng([clickedLat, clickedLng]);
            } else {
                marker = L.marker([clickedLat, clickedLng]).addTo(map);
            }

            // Move the circle to the new location
            if (circle) {
                circle.setLatLng([clickedLat, clickedLng]);
            } else {
                circle = L.circle([clickedLat, clickedLng], {
                    color: 'blue',
                    fillColor: '#aaddff',
                    fillOpacity: 0.5,
                    radius: radius
                }).addTo(map);
            }

            // Update the input fields with the new coordinates
            document.getElementById('lat').value = clickedLat.toFixed(6);
            document.getElementById('lng').value = clickedLng.toFixed(6);
        });
}

function refreshLocation() {
    // Check if the browser supports geolocation
    document.getElementById('venue').value='';
    document.getElementById('venueID').value='';
    document.getElementById('updateVenue').style.display='none';
    document.getElementById('newVenue').style.display='';
    if ("geolocation" in navigator) {
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;

                    // Initialize or update the map with the user's location
                    initMap(latitude, longitude);
                },
                function(error) {
                    document.getElementById('map').innerText = 'Unable to retrieve your location';
                    console.error('Error Code = ' + error.code + ' - ' + error.message);
                },
                {
                    enableHighAccuracy: true, // Request high-accuracy location
                    timeout: 10000, // Timeout after 10 seconds
                    maximumAge: 0 // Don't use a cached position
                }
            );
        } else {
            document.getElementById('map').innerText = 'Geolocation is not supported by your browser';
        }
}

function updateRadius(newRadius) {
        radius = parseInt(newRadius); // Update the radius with the new value
        document.getElementById('rangeValue').textContent = radius;

        if (circle) {
            circle.setRadius(radius); // Update the circle's radius
        }
    }

// Initialize the map with the user's location on page load
refreshLocation();



    function dynamicFuction(formId, routeUrl) {
    // Show the loader
    document.getElementById('adminloader').style.display = 'grid';
    
    // Serialize the form data
    var formData = $("form#" + formId).serialize();

    // Send the AJAX request
    $.ajax({
        type: "POST",
        url: routeUrl,
        data: formData,
        success: function(response) {
            document.getElementById('adminloader').style.display = 'none';
            console.log('success');
            GetVenue();
            alertify
                        .alert("Message", "Venue Successfully Added", function() {
                            alertify.message('OK');
                        });
            // You can also add custom success handling here if needed
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            // You can also add custom error handling here if needed
        }
    });
}

function GetVenue()
{
    $('#Venuetable').DataTable({
            destroy: true,
            pageLength: 5,
            ajax: {
                url: '{{ route('GetVenue') }}',
                type: 'GET'
            },
            columns: [{
                    data: 'location_name'
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<button class="btn btn-primary" onclick="initMap('+data.latitude+','+data.longitude+',`'+data.location_name+'`,`'+data.l_id+'`)">Select</button>';
                    }
                }
            ]
        });
}
$(document).ready(function() {
    GetVenue()
});

</script>
