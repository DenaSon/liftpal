<div>
@push('styles')

        <link rel="stylesheet" href="https://static.neshan.org/sdk/leaflet/v1.9.4/neshan-sdk/v1.0.8/index.css"/>

@endpush
    @include('livewire.front.panel.components.building-inc._building_modal')

    @if($building_list->count() > 0)

    @include('livewire.front.panel.components.building-inc._elevator_modal')

    @include('livewire.front.panel.components.building-inc._members_modal')
    @endif

    </div>

<div id="map"></div>

<script  src="https://static.neshan.org/sdk/leaflet/v1.9.4/neshan-sdk/v1.0.8/index.js"></script>
<script>
    // Initialize the map
    const neshanMap = new L.Map("map", {
        key: "web.434e560e4ebd4ded9f7630d248ca0b05", // Your API Key
        maptype: "neshan",
        poi: true,
        traffic: true,
        center: [30.6662659463233, 51.58115386962891],
        zoom: 14,
    });

    // Add a marker to the map
    let marker = L.marker([35.699756, 51.338076]).addTo(neshanMap);

    // Listen for map clicks
    neshanMap.on('click', function(e) {
        // Get the latitude and longitude from the click event
        const { lat, lng } = e.latlng;

        // Move the marker to the clicked position
        marker.setLatLng([lat, lng]);

        // Log or use the latitude and longitude values
        console.log("Latitude: " + lat + ", Longitude: " + lng);

        // Optionally, you can update hidden inputs or display the values in the UI
        // document.getElementById('lat').value = lat;
        // document.getElementById('lng').value = lng;
    });
</script>
