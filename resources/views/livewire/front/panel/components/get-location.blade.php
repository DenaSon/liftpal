<div>
    <link rel="stylesheet" href="https://static.neshan.org/sdk/leaflet/v1.9.4/neshan-sdk/v1.0.8/index.css"/>
    <script data-navigate-once src="https://static.neshan.org/sdk/leaflet/v1.9.4/neshan-sdk/v1.0.8/index.js"></script>
    <style>
        #map {
            height: 355px; /* Set a fixed height */
            width: 100%;
            border-radius: 15px; /* Rounded corners */
            border: 1px solid #657ced; /* A modern blue border */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5); /* Subtle shadow */
            background-color: #ffffff; /* Light grey background before the map loads */
            position: relative;
            overflow: hidden; /* Hide any overflowing content */
            margin-top:15px;
        }

        /* Optional: Add a loading indicator */
        #map::before {
            content: 'درحال آماده سازی نقشه...';
            color: #d55d5d;
            font-size: 12px;
            font-family: 'tahoma', sans-serif;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        #map.ready::before {
            display: none; /* Hide the loading indicator once the map is ready */
        }
    </style>



    <div wire:ignore id="map" class="map shadow">
    <div class="text-center">
        <a  wire:navigate.hover href="{{ route('panel',['page'=>'get-location']) }}">
            <i class="fi-refresh"></i>
        </a>
    </div>
    </div>

    <div class="text-center mt-2">
        <div wire:loading class="spinner-border spinner-border-sm text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>


    <div class="form-floating col-6 visually-hidden">
        <input disabled wire:model="latid"  type="number" class="form-control" id="latid" placeholder="عرض جغرافیایی">
        <label for="latid">عرض جغرافیایی</label>
    </div>

    <div class="form-floating col-6 visually-hidden">
        <input disabled wire:model="lngid"  type="number" class="form-control" id="lngid"
               placeholder="طول جغرافیایی">
        <label for="lngid">طول جغرافیایی</label>
    </div>


    <div class="card mt-3" style="width: 100%;">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-8 mt-2">
                    <input placeholder="آدرس ساختمان شما" wire:model="str_address" class="form-control">
                </div>
                <div class="col-12 col-md-4 mt-4 mt-md-2">
                    <button wire:confirm="از آدرس انتخاب شده اطمینان دارید؟" wire:click="showLocation" class="w-100 btn btn-outline-info  py-2  btn-sm"> استعلام آدرس </button>
                </div>
            </div>
        </div>
    </div>

    <div>
        <button type="button" class="btn btn-success d-block w-100 my-3" >
            <i class="fi-plus-circle me-1 fs-sm"></i>
            ثبت آدرس
        </button>
    </div>

    <script>
        // Function to initialize the map
        function initMap() {
            const neshanMap = new L.Map("map", {
                key: "web.434e560e4ebd4ded9f7630d248ca0b05", // Your API Key
                maptype: "osm-bright",
                poi: true,
                traffic: true,
                center: [30.6662659463233, 51.58115386962891],
                zoom: 14,
            });

            // Add a marker to the map
            let marker = L.marker([35.699756, 51.338076]).addTo(neshanMap);

            // Listen for map clicks
            neshanMap.on('click', function (e) {
                // Get the latitude and longitude from the click event
                const { lat, lng } = e.latlng;

                // Move the marker to the clicked position
                marker.setLatLng([lat, lng]);



                // Log or use the latitude and longitude values
                console.log("Latitude: " + lat + ", Longitude: " + lng);

                // Optionally, you can update hidden inputs or display the values in the UI
                @this.set('latid', lat);
                @this.set('lngid', lng);;
            });
        }
        $(document).ready(function () {
            initMap();
        });
        // Initialize the map when the page loads
        document.addEventListener('DOMContentLoaded', initMap);

        // Reinitialize the map after Livewire navigates
        Livewire.hook('message.processed', (message, component) => {
            initMap();
        });
    </script>
</div>
