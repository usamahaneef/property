@extends('web.layout.app')
@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
            .modal {
        z-index: 1055;
    }
    
    .google_map {
        overflow: hidden; /* prevents clipping */
        position: relative;
        z-index: 1;
    }
    </style>
    
@endpush
@section('content')
    <livewire:Web.index />
@endsection
{{-- <script src="https://unpkg.com/@googlemaps/markerclustererplus/dist/index.min.js"></script>
<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"> --}}

@push('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA7ks8X2YnLcxTuEC3qydL2adzA0NYbl6c&libraries=geometry,drawing"></script>
    <script>
        let map, drawingManager, userMarker;
        const properties = @json($properties);

        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                center: { lat: 27.9944, lng: -81.7603 },
                zoom: 6,
                mapTypeId: "roadmap",
                fullscreenControl: false,
                zoomControl: window.innerWidth > 768
            });

            getMyLocation();
            initDrawingTools();
        }

        function getMyLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const userLocation = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };

                        map.setCenter(userLocation);
                        map.setZoom(12);

                        userMarker = new google.maps.Marker({
                            position: userLocation,
                            map: map,
                            title: "You are here",
                            icon: {
                                url: "https://maps.google.com/mapfiles/ms/icons/blue-dot.png"
                            }
                        });

                        showNearbyProperties(userLocation);
                    },
                    (error) => {
                        console.warn("Geolocation failed:", error.message);
                        addAllPropertyMarkers(); // fallback if geolocation fails
                    }
                );
            } else {
                alert("Geolocation is not supported by your browser.");
                addAllPropertyMarkers(); // fallback if unsupported
            }
        }

        function showNearbyProperties(userLocation) {
            properties.forEach((property) => {
                if (!property.latitude || !property.longitude) return;

                const propertyLocation = new google.maps.LatLng(property.latitude, property.longitude);
                const userLatLng = new google.maps.LatLng(userLocation.lat, userLocation.lng);

                const distanceInMeters = google.maps.geometry.spherical.computeDistanceBetween(userLatLng, propertyLocation);
                const distanceInKm = distanceInMeters / 1000;

                if (distanceInKm <= 10) { // 📍 show only within 10 km
                    createMarker(property);
                }
            });
        }

        function addAllPropertyMarkers() {
            properties.forEach((property) => {
                if (property.latitude && property.longitude) {
                    createMarker(property);
                }
            });
        }

        function createMarker(property) {
            const marker = new google.maps.Marker({
                position: {
                    lat: parseFloat(property.latitude),
                    lng: parseFloat(property.longitude)
                },
                icon: createCustomMarkerIcon(),
                map: map,
                title: property.title
            });

            marker.addListener("click", () => {
                showPropertyModal(property);
            });
        }

        function createCustomMarkerIcon() {
            return {
                url: "https://maps.google.com/mapfiles/ms/icons/red-dot.png",
                scaledSize: new google.maps.Size(40, 40)
            };
        }

        function showPropertyModal(property) {
            const modalBody = document.getElementById('propertyModalBody');
            modalBody.innerHTML = `
                <h5>${property.title}</h5>
                <p><strong>Price:</strong> ${property.price ?? 'N/A'}</p>
                <p><strong>Beds:</strong> ${property.beds ?? 'N/A'}, <strong>Baths:</strong> ${property.baths ?? 'N/A'}</p>
                <p><strong>Sqft:</strong> ${property.sqft ?? 'N/A'}</p>
                <p><strong>Address:</strong> ${property.address ?? 'N/A'}</p>
                <p><strong>Realtor:</strong> ${property.realtor ?? 'N/A'}</p>
            `;
            const modal = new bootstrap.Modal(document.getElementById('propertyModal'));
            modal.show();
        }

        function initDrawingTools() {
            drawingManager = new google.maps.drawing.DrawingManager({
                drawingMode: google.maps.drawing.OverlayType.POLYLINE,
                drawingControl: true,
                drawingControlOptions: {
                    position: google.maps.ControlPosition.TOP_CENTER,
                    drawingModes: ['polyline']
                },
                polylineOptions: {
                    strokeColor: "#0368ff",
                    strokeWeight: 3,
                    clickable: false,
                    editable: true
                }
            });

            drawingManager.setMap(map);

            google.maps.event.addListener(drawingManager, 'polylinecomplete', function(polyline) {
                const path = polyline.getPath().getArray().map(latlng => ({
                    lat: latlng.lat(),
                    lng: latlng.lng()
                }));
                console.log("Polyline path:", path);
            });
        }

        window.addEventListener('load', initMap);
    </script>
@endpush

    

    
